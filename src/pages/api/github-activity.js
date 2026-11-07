
const USERNAME = 'Becera-Kian'; 

const REPO = 'repository { nameWithOwner url }';
const QUERY = `
query($login: String!, $from: DateTime!, $to: DateTime!) {
  user(login: $login) {
    contributionsCollection(from: $from, to: $to) {
      totalCommitContributions
      totalIssueContributions
      totalPullRequestContributions
      totalPullRequestReviewContributions
      commitContributionsByRepository(maxRepositories: 100) { ${REPO} }
      issueContributionsByRepository(maxRepositories: 100) { ${REPO} }
      pullRequestContributionsByRepository(maxRepositories: 100) { ${REPO} }
      pullRequestReviewContributionsByRepository(maxRepositories: 100) { ${REPO} }
    }
  }
}`;

export default async function handler(req, res) {
  if (!process.env.GITHUB_TOKEN) {
    return res.status(500).json({ error: 'GITHUB_TOKEN is not set' });
  }
  const year = parseInt(req.query.year, 10) || new Date().getFullYear();
  const now = new Date();
  const from = new Date(Date.UTC(year, 0, 1));
  const end = new Date(Date.UTC(year, 11, 31, 23, 59, 59));
  const to = end > now ? now : end;

  try {
    const r = await fetch('https://api.github.com/graphql', {
      method: 'POST',
      headers: {
        Authorization: `bearer ${process.env.GITHUB_TOKEN}`,
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        query: QUERY,
        variables: { login: USERNAME, from: from.toISOString(), to: to.toISOString() },
      }),
    });
    const json = await r.json();
    const c = json.data.user.contributionsCollection;

    const map = new Map();
    [
      ...c.commitContributionsByRepository,
      ...c.issueContributionsByRepository,
      ...c.pullRequestContributionsByRepository,
      ...c.pullRequestReviewContributionsByRepository,
    ].forEach(({ repository: repo }) => map.set(repo.nameWithOwner, repo.url));
    const repos = [...map].map(([name, url]) => ({ name, url }));

    res.setHeader('Cache-Control', 's-maxage=3600, stale-while-revalidate');
    res.status(200).json({
      commits: c.totalCommitContributions,
      issues: c.totalIssueContributions,
      pullRequests: c.totalPullRequestContributions,
      reviews: c.totalPullRequestReviewContributions,
      repos,
      totalRepos: repos.length,
    });
  } catch (e) {
    res.status(500).json({ error: 'Failed to load GitHub activity' });
  }
}
