import { useState, useEffect, useRef, useMemo } from 'react';
import { createPortal } from 'react-dom';
import Link from 'next/link';
import Layout from '../components/Layout';
import { experience, techStack } from '../data/portfolio';

/* ───────── Contribution activity (live GitHub data) ───────── */

const GH_USERNAME = 'Becera-Kian';
const GH_YEARS = [2026, 2025, 2024, 2023];  // years shown in the selector
const MONTH_NAMES = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

function buildWeeks(days) {
  if (!days.length) return { weeks: [], months: [] };
  const first = new Date(days[0].date + 'T00:00:00');
  const padded = [...Array(first.getDay()).fill(null), ...days];
  const weeks = [];
  for (let i = 0; i < padded.length; i += 7) weeks.push(padded.slice(i, i + 7));
  const months = [];
  let last = -1;
  weeks.forEach((week, w) => {
    const d = week.find(Boolean);
    if (!d) return;
    const m = new Date(d.date + 'T00:00:00').getMonth();
    if (m !== last) { months.push({ label: MONTH_NAMES[m], col: w }); last = m; }
  });
  return { weeks, months };
}

function Radar({ data }) {
  const total = data.commits + data.issues + data.pullRequests + data.reviews || 1;
  const pct = {
    review:  (data.reviews / total) * 100,
    issues:  (data.issues / total) * 100,
    prs:     (data.pullRequests / total) * 100,
    commits: (data.commits / total) * 100,
  };
  const max = Math.max(...Object.values(pct), 1);
  const R = 80, C = 130;
  const r = (v) => 8 + (v / max) * (R - 8);
  const pts = [
    [C, C - r(pct.review)],
    [C + r(pct.issues), C],
    [C, C + r(pct.prs)],
    [C - r(pct.commits), C],
  ];
  const Label = ({ x, y, v, text }) => (
    <text x={x} y={y} textAnchor="middle" className="fill-slate-400 font-mono" fontSize="11">
      <tspan x={x} dy="0">{Math.round(v)}%</tspan>
      <tspan x={x} dy="14">{text}</tspan>
    </text>
  );
  return (
    <svg viewBox="0 0 260 280" width="260" height="280"
         style={{ width: '100%', maxWidth: 280, height: 'auto', display: 'block' }}
         className="mx-auto overflow-visible">
      <line x1={C} y1={C - R} x2={C} y2={C + R} stroke="currentColor" className="text-accent" />
      <line x1={C - R} y1={C} x2={C + R} y2={C} stroke="currentColor" className="text-accent" />
      <polygon points={pts.map((p) => p.join(',')).join(' ')}
               className="fill-accent/30 stroke-accent" strokeWidth="1.5" />
      {pts.map(([x, y], i) => <circle key={i} cx={x} cy={y} r="3.5" className="fill-accent" />)}
      <Label x={C} y={14} v={pct.review} text="Code review" />
      <Label x={C} y={C + R + 18} v={pct.prs} text="Pull requests" />
      <Label x={28} y={C - 4} v={pct.commits} text="Commits" />
      <Label x={232} y={C - 4} v={pct.issues} text="Issues" />
    </svg>
  );
}

function ContributionActivity() {
  const [year, setYear] = useState(GH_YEARS[0]);
  const [days, setDays] = useState([]);
  const [total, setTotal] = useState(null);
  const [overview, setOverview] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(false);
  const scrollRef = useRef(null);
  const [scroll, setScroll] = useState({ left: false, right: false });

  const updateScroll = () => {
    const el = scrollRef.current;
    if (!el) return;
    setScroll({
      left: el.scrollLeft > 4,
      right: el.scrollLeft + el.clientWidth < el.scrollWidth - 4,
    });
  };

  useEffect(() => {
    const ctrl = new AbortController();
    setLoading(true);
    setError(false);

    fetch(`https://github-contributions-api.jogruber.de/v4/${GH_USERNAME}?y=${year}`, { signal: ctrl.signal })
      .then((r) => { if (!r.ok) throw new Error('not ok'); return r.json(); })
      .then((j) => { setDays(j.contributions || []); setTotal(j.total?.[year] ?? null); })
      .catch((e) => { if (e.name !== 'AbortError') { setDays([]); setTotal(null); setError(true); } })
      .finally(() => setLoading(false));

    setOverview(null);
    fetch(`/api/github-activity?year=${year}`, { signal: ctrl.signal })
      .then((r) => (r.ok ? r.json() : null))
      .then(setOverview)
      .catch(() => {});

    return () => ctrl.abort();
  }, [year]);

  const { weeks, months } = useMemo(() => buildWeeks(days), [days]);

  useEffect(() => {
    updateScroll();
    window.addEventListener('resize', updateScroll);
    return () => window.removeEventListener('resize', updateScroll);
  }, [weeks.length]);

  return (
    <div className="flex flex-col-reverse md:flex-row gap-6">
      <div className="w-full md:flex-1 min-w-0 dark:bg-dark-card bg-white border dark:border-dark-border
                      border-slate-200 rounded-2xl overflow-hidden">
        <div className="p-6">
          <p className="text-lg dark:text-white text-slate-900 mb-4">
            {total === null ? '…' : total.toLocaleString()} contributions in {year}
          </p>

          {error && (
            <p className="text-sm text-red-400 mb-3">
              Couldn&apos;t load contributions for &quot;{GH_USERNAME}&quot;. Check the GitHub username.
            </p>
          )}

          <div className="relative">
          <div ref={scrollRef} onScroll={updateScroll} className="overflow-x-auto no-scrollbar">
            <div className={`min-w-[560px] transition-opacity ${loading ? 'opacity-40' : ''}`}>
              <div className="relative mb-2" style={{ height: 16 }}>
                {months.map(({ label, col }) => (
                  <span key={label + col}
                    className="absolute font-mono text-[11px] dark:text-slate-500 text-slate-400 leading-none"
                    style={{ left: `calc(${col} * (100% / ${weeks.length}))` }}>
                    {label}
                  </span>
                ))}
              </div>

              <div className="flex gap-[3px]">
                {weeks.map((week, w) => (
                  <div key={w} className="flex flex-col gap-[3px] flex-1">
                    {Array.from({ length: 7 }).map((_, d) => {
                      const day = week[d];
                      return day ? (
                        <div key={d}
                          title={`${day.count} contribution${day.count === 1 ? '' : 's'} on ${day.date}`}
                          className={`w-full aspect-square rounded-[3px] ring-1 ring-inset dark:ring-white/5 ring-black/5 cgrid-${day.level}`} />
                      ) : (
                        <div key={d} className="w-full aspect-square" />
                      );
                    })}
                  </div>
                ))}
              </div>

              <div className="flex items-center justify-end gap-2 mt-4">
                <span className="font-mono text-[10px] dark:text-slate-500 text-slate-400">Less</span>
                {[0, 1, 2, 3, 4].map((lvl) => (
                  <div key={lvl} className={`w-3 h-3 rounded-[2px] cgrid-${lvl}`} />
                ))}
                <span className="font-mono text-[10px] dark:text-slate-500 text-slate-400">More</span>
              </div>
            </div>
          </div>
          {/* edge fades = "there is more this way" */}
          <div className={`pointer-events-none absolute inset-y-0 left-0 w-10 bg-gradient-to-r dark:from-dark-card from-white to-transparent transition-opacity md:hidden ${scroll.left ? 'opacity-100' : 'opacity-0'}`} />
          <div className={`pointer-events-none absolute inset-y-0 right-0 w-10 bg-gradient-to-l dark:from-dark-card from-white to-transparent transition-opacity md:hidden ${scroll.right ? 'opacity-100' : 'opacity-0'}`} />
          </div>

          {/* swipe hint (mobile only) */}
          {(scroll.left || scroll.right) && (
            <p className="md:hidden mt-3 flex items-center justify-center gap-2 font-mono text-[11px] dark:text-slate-500 text-slate-400">
              {scroll.left && <span>←</span>}
              <span>{scroll.right ? 'Swipe to see more months' : 'Swipe back to see earlier months'}</span>
              {scroll.right && <span className="animate-pulse">→</span>}
            </p>
          )}
        </div>

        {overview && overview.repos && (
          <div className="border-t dark:border-dark-border border-slate-200 p-6">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
              <div>
                <h3 className="dark:text-white text-slate-900 mb-4">Activity overview</h3>
                <p className="text-sm dark:text-slate-300 text-slate-600 leading-relaxed">
                  Contributed to{' '}
                  {overview.repos.slice(0, 3).map((r, i, arr) => (
                    <span key={r.name}>
                      <a href={r.url} target="_blank" rel="noreferrer"
                         className="text-accent hover:underline break-all">{r.name}</a>
                      {i < arr.length - 1 ? ', ' : ''}
                    </span>
                  ))}
                  {overview.totalRepos > 3 &&
                    ` and ${overview.totalRepos - 3} other repositor${overview.totalRepos - 3 === 1 ? 'y' : 'ies'}`}
                </p>
              </div>
              <div className="w-full flex justify-center min-w-0">
                <Radar data={overview} />
              </div>
            </div>
          </div>
        )}
      </div>

      <div className="flex md:flex-col gap-2 md:w-28 shrink-0">
        {GH_YEARS.map((y) => (
          <button key={y} onClick={() => setYear(y)}
            className={`px-4 py-2 rounded-lg text-sm text-left transition-colors ${
              y === year
                ? 'bg-accent text-dark-bg font-semibold'
                : 'dark:text-slate-400 text-slate-500 dark:hover:bg-dark-card hover:bg-slate-100'
            }`}>
            {y}
          </button>
        ))}
      </div>
    </div>
  );
}

const LocationLink = ({ imageSrc, company }) => {
  const [showImage, setShowImage] = useState(false);
  const [mounted, setMounted] = useState(false);

  useEffect(() => { setMounted(true); }, []);

  useEffect(() => {
    const handleKey = (e) => { if (e.key === 'Escape') setShowImage(false); };
    if (showImage) document.addEventListener('keydown', handleKey);
    return () => document.removeEventListener('keydown', handleKey);
  }, [showImage]);

  const modal = showImage && (
    <div
      style={{
        position: 'fixed',
        inset: 0,
        zIndex: 9999,
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        backgroundColor: 'rgba(0,0,0,0.7)',
      }}
      onMouseDown={(e) => { if (e.target === e.currentTarget) setShowImage(false); }}
    >
      <div style={{ position: 'relative', borderRadius: '1rem', overflow: 'hidden', boxShadow: '0 25px 60px rgba(0,0,0,0.6)' }}>
        <button
          onClick={() => setShowImage(false)}
          style={{
            position: 'absolute', top: 8, right: 8, zIndex: 10,
            background: 'rgba(0,0,0,0.55)', border: 'none', color: '#fff',
            borderRadius: '50%', width: 28, height: 28,
            cursor: 'pointer', fontSize: 14, fontWeight: 'bold',
            display: 'flex', alignItems: 'center', justifyContent: 'center',
          }}
          aria-label="Close"
        >
          ✕
        </button>
        <img
          src={imageSrc}
          alt="Location Map"
          style={{ display: 'block', width: '420px', height: 'auto' }}
        />
      </div>
    </div>
  );

  return (
    <>
      <button
        onClick={() => setShowImage(true)}
        className="text-accent font-mono text-sm mt-0.5 underline bg-transparent border-none p-0 cursor-pointer text-left"
      >
        {company}
      </button>
      {mounted && createPortal(modal, document.body)}
    </>
  );
};

export default function Experience() {
  return (
    <Layout title="Experience — KIAN BECERA">
      {/* ════ HERO ════ */}
      <section className="relative py-24 dark:bg-dark-card bg-slate-50
                          border-b dark:border-dark-border border-slate-200
                          dot-grid overflow-hidden">
        <div className="pointer-events-none absolute -top-40 -right-40
                        w-[500px] h-[500px] dark:bg-accent/5 bg-cyan-200/20
                        rounded-full blur-3xl" />
        <div className="max-w-7xl mx-auto px-6 animate-fade-up">
          <p className="font-mono text-xs text-accent tracking-widest uppercase mb-4">
            // work_history
          </p>
          <h1 className="text-4xl sm:text-5xl md:text-7xl lg:text-8xl font-bold
                         dark:text-white text-slate-900 leading-[1] mb-6">
            EXPERIENCE.
          </h1>
          <div className="accent-line w-32 mb-8" />
        </div>
      </section>

      {/* ════ WORK HISTORY ════ */}
      <section id="work-history" className="py-20">
        <div className="max-w-7xl mx-auto px-6">
          <p className="font-mono text-xs text-accent tracking-widest uppercase mb-3">
            // work history
          </p>
          <h2 className="text-3xl font-bold dark:text-white text-slate-900 mb-12">
            PRE-PROFESSIONAL EXPERIENCE
          </h2>

          <div className="space-y-5">
            {experience.map((exp, i) => (
              <div key={i}
                className="dark:bg-dark-card bg-white
                           border dark:border-dark-border border-slate-200
                           rounded-2xl p-6 card-lift shadow-sm animate-fade-up"
                style={{ animationDelay: `${i * 0.1}s` }}>
                <div className="flex flex-wrap items-start justify-between gap-4">
                  <div>
                    <h3 className="font-bold dark:text-white text-slate-900 text-lg">
                      {exp.role}
                    </h3>
                    <LocationLink imageSrc={exp.image} company={exp.company} />
                  </div>
                  <div className="flex flex-wrap items-center gap-2">
                    {exp.tags.map((t) => (
                      <span key={t} className="tag">{t}</span>
                    ))}
                    <span className="font-mono text-xs dark:text-dark-muted text-slate-500
                                     dark:bg-dark-bg bg-slate-100
                                     px-3 py-1 rounded-full
                                     border dark:border-dark-border border-slate-200 whitespace-nowrap">
                      {exp.period}
                    </span>
                  </div>
                </div>
                <p className="dark:text-slate-400 text-slate-600 text-sm leading-relaxed mt-4">
                  {exp.desc}
                </p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ════ CONTRIBUTION GRAPH ════ */}
      <section className="py-20 border-t dark:border-dark-border border-slate-200
                          dark:bg-dark-card/40 bg-slate-50">
        <div className="max-w-7xl mx-auto px-6">
          <p className="font-mono text-xs text-accent tracking-widest uppercase mb-3">
            // activity
          </p>
          <h2 className="text-3xl font-bold dark:text-white text-slate-900 mb-10">
            Contribution Activity
          </h2>

          <ContributionActivity />
        </div>
      </section>

      {/* ════ CTA ════ */}
      <section className="py-16 border-t dark:border-dark-border border-slate-200">
        <div className="max-w-7xl mx-auto px-6
                        flex flex-col md:flex-row items-center justify-between gap-6">
          <div>
            <p className="font-mono text-xs text-accent tracking-widest uppercase mb-1">
              Want to work together?
            </p>
            <h3 className="text-2xl font-bold dark:text-white text-slate-900">
              Let&apos;s build something great.
            </h3>
          </div>
          <div className="flex gap-4">
            <Link href="/contact"
              className="inline-flex items-center gap-2
                         bg-accent text-dark-bg font-bold text-sm
                         px-7 py-3 rounded hover:brightness-110 transition-all">
              Hire Me
            </Link>
            <Link href="/about"
              className="inline-flex items-center gap-2
                         dark:bg-dark-card bg-white
                         border dark:border-dark-border border-slate-200
                         dark:text-slate-300 text-slate-700
                         font-semibold text-sm px-7 py-3 rounded shadow-sm
                         hover:border-accent hover:text-accent transition-all">
              About Me
            </Link>
          </div>
        </div>
      </section>
    </Layout>
  );
}