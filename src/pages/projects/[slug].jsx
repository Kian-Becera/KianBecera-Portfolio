import Link from 'next/link';
import { useRouter } from 'next/router';
import Layout from '../../components/Layout';
import { projects } from '../../data/portfolio';

export async function getStaticPaths() {
  return {
    paths: projects.map((p) => ({ params: { slug: p.slug } })),
    fallback: false,
  };
}

export async function getStaticProps({ params }) {
  const project = projects.find((p) => p.slug === params.slug) || null;
  return project ? { props: { project } } : { notFound: true };
}

export default function ProjectDetail({ project }) {
  return (
    <Layout title={`${project.title} — KIAN BECERA`}>
      <article className="min-h-[calc(100vh-3.5rem)]">

        {/* ── Hero banner ── */}
        <section className="relative py-24
                            dark:bg-dark-card bg-slate-50
                            border-b dark:border-dark-border border-slate-200
                            overflow-hidden dot-grid">
          <div className="pointer-events-none absolute -top-32 -right-32
                          w-96 h-96 dark:bg-accent/5 bg-cyan-300/10
                          rounded-full blur-3xl" />

          <div className="max-w-5xl mx-auto px-6 animate-fade-up">
            <Link href="/projects"
              className="inline-flex items-center gap-2
                         text-xs font-mono text-accent
                         hover:underline tracking-widest uppercase mb-8">
              <i className="fas fa-arrow-left text-[10px]" /> All Projects
            </Link>

            <div className="flex flex-wrap items-start justify-between gap-6">
              <div>
                <p className="text-xs font-mono text-accent tracking-widest uppercase mb-2">
                  {project.category} · {project.year}
                </p>
                <h1 className="font-mono font-bold text-4xl md:text-5xl
                               dark:text-white text-slate-900 mb-3">
                  {project.title}
                </h1>
                <p className="dark:text-dark-muted text-slate-500 text-lg">
                  {project.subtitle}
                </p>
              </div>

              <div className="flex gap-3 mt-2">
                {project.github && (
                  <a href={project.github} target="_blank" rel="noreferrer" className="btn-hire">
                    <i className="fab fa-github mr-1.5" /> Source
                  </a>
                )}
                {project.live && project.live !== '#' && (
                  <a href={project.live} target="_blank" rel="noreferrer"
                    className="inline-flex items-center gap-2
                               bg-accent text-dark-bg font-semibold
                               text-xs px-4 py-1.5 rounded
                               hover:brightness-110 transition-all">
                    <i className="fas fa-arrow-up-right-from-square text-[10px]" /> Live
                  </a>
                )}
              </div>
            </div>

            <div className="flex flex-wrap gap-2 mt-6">
              {project.tags.map((t) => (
                <span key={t} className="tag">{t}</span>
              ))}
            </div>
          </div>
        </section>

        {/* ── Body ── */}
        <section className="py-16">
          <div className="max-w-5xl mx-auto px-6">

            {/* Overview + metrics */}
            <div className="grid md:grid-cols-3 gap-8 mb-16">
              <div className="md:col-span-2">
                <h2 className="font-mono text-xs text-accent tracking-widest uppercase mb-4">
                  // overview
                </h2>
                <p className="dark:text-slate-300 text-slate-700 leading-relaxed text-lg">
                  {project.description}
                </p>
                {project.long_description && (
                  <div className="mt-4 space-y-3">
                    {project.long_description.split('\n\n').map((para, i) => (
                      <p key={i} className="dark:text-slate-400 text-slate-600 leading-relaxed">
                        {para}
                      </p>
                    ))}
                  </div>
                )}
              </div>

              {project.metrics && (
                <div className="space-y-4">
                  <h2 className="font-mono text-xs text-accent tracking-widest uppercase mb-4">
                    // metrics
                  </h2>
                  {project.metrics.map((metric) => (
                    <div key={metric.label}
                      className="dark:bg-dark-card bg-white
                                 border dark:border-dark-border border-slate-200
                                 rounded-xl p-5 text-center shadow-sm">
                      <p className="font-mono font-bold text-3xl text-accent">{metric.value}</p>
                      <p className="text-xs dark:text-dark-muted text-slate-500
                                    mt-1 uppercase tracking-widest">
                        {metric.label}
                      </p>
                    </div>
                  ))}
                </div>
              )}
            </div>

            {/* Code snippet */}
            {project.code_snippet && (
              <div className="mb-16">
                <h2 className="font-mono text-xs text-accent tracking-widest uppercase mb-4">
                  // code_highlight
                </h2>
                <div className="code-block">
                  <div className="flex items-center gap-2 px-5 py-3
                                  border-b dark:border-dark-border border-slate-700">
                    <span className="w-3 h-3 rounded-full bg-red-500/60" />
                    <span className="w-3 h-3 rounded-full bg-yellow-500/60" />
                    <span className="w-3 h-3 rounded-full bg-green-500/60" />
                    <span className="ml-4 text-xs dark:text-dark-muted text-slate-500 font-mono">
                      bridge.config.ts
                    </span>
                  </div>
                  <pre className="p-5 text-slate-300 text-sm overflow-x-auto">
                    <code>{project.code_snippet}</code>
                  </pre>
                </div>
              </div>
            )}

            {/* Tech detail cards */}
            {project.tech_details && (
              <div className="mb-16">
                <h2 className="font-mono text-xs text-accent tracking-widest uppercase mb-6">
                  // technical_features
                </h2>
                <div className="grid sm:grid-cols-2 gap-5">
                  {project.tech_details.map((detail) => (
                    <div key={detail.title}
                      className="dark:bg-dark-card bg-white
                                 border dark:border-dark-border border-slate-200
                                 rounded-xl p-6 card-lift shadow-sm">
                      <div className="flex items-start gap-3">
                        <div className="w-8 h-8 rounded-lg bg-accent/10
                                        flex items-center justify-center
                                        shrink-0 mt-0.5">
                          <i className="fas fa-microchip text-accent text-xs" />
                        </div>
                        <div>
                          <h3 className="font-semibold dark:text-white text-slate-800 text-sm mb-1">
                            {detail.title}
                          </h3>
                          <p className="dark:text-slate-400 text-slate-600 text-sm leading-relaxed">
                            {detail.desc}
                          </p>
                        </div>
                      </div>
                    </div>
                  ))}
                </div>
              </div>
            )}

            {/* Bottom CTA */}
            <div className="dark:bg-dark-card bg-slate-50
                            border dark:border-dark-border border-slate-200
                            rounded-2xl p-8 text-center">
              <p className="font-mono text-xs text-accent tracking-widest uppercase mb-2">
                // next_steps
              </p>
              <h3 className="text-xl font-bold dark:text-white text-slate-900 mb-2">
                Ready to engineer your next breakthrough?
              </h3>
              <p className="dark:text-dark-muted text-slate-500 text-sm mb-6">
                Let&apos;s collaborate on something extraordinary.
              </p>
              <div className="flex flex-wrap justify-center gap-4">
                <Link href="/contact"
                  className="inline-flex items-center gap-2
                             bg-accent text-dark-bg font-bold text-sm
                             px-7 py-3 rounded hover:brightness-110 transition-all">
                  Start a Project
                </Link>
                <Link href="/projects"
                  className="inline-flex items-center gap-2
                             dark:bg-dark-bg bg-white
                             border dark:border-dark-border border-slate-200
                             dark:text-slate-300 text-slate-700
                             font-semibold text-sm px-7 py-3 rounded shadow-sm
                             hover:border-accent hover:text-accent transition-all">
                  View More Work
                </Link>
              </div>
            </div>
          </div>
        </section>
      </article>
    </Layout>
  );
}
