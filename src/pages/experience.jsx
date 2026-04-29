import Link from 'next/link';
import Layout from '../components/Layout';
import { experience, techStack } from '../data/portfolio';

/* Seeded LCG PRNG for stable contribution grid */
function seededRand(seed) {
  let s = seed >>> 0;
  return function () {
    s = (Math.imul(1664525, s) + 1013904223) >>> 0;
    return s / 4294967296;
  };
}

function buildGrid() {
  const rand = seededRand(2024);
  const cw = [];
  for (let w = 0; w < 52; w++) {
    cw[w] = [];
    for (let d = 0; d < 7; d++) {
      const r = Math.floor(rand() * 11);
      cw[w][d] = r <= 3 ? 0 : r <= 5 ? 1 : r <= 7 ? 2 : r <= 9 ? 3 : 4;
    }
  }
  return cw;
}

const grid = buildGrid();
const MONTHS = { May: 0, Jun: 4, Jul: 9, Aug: 13, Sep: 18, Oct: 22, Nov: 27, Dec: 31, Jan: 36, Feb: 40, Mar: 44, Apr: 48 };

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
                    <p className="text-accent font-mono text-sm mt-0.5">{exp.company}</p>
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

          <div className="dark:bg-dark-card bg-white
                          border dark:border-dark-border border-slate-200
                          rounded-2xl p-6 overflow-x-auto no-scrollbar">
            <div className="min-w-[560px]">

              <div className="relative mb-2" style={{ height: 16 }}>
                {Object.entries(MONTHS).map(([month, col]) => (
                  <span key={month}
                    className="absolute font-mono text-[11px] dark:text-slate-500 text-slate-400 leading-none"
                    style={{ left: `calc(${col} * (100% / 52))` }}>
                    {month}
                  </span>
                ))}
              </div>

              <div className="flex gap-[3px]">
                {grid.map((week, w) => (
                  <div key={w} className="flex flex-col gap-[3px] flex-1">
                    {week.map((level, d) => (
                      <div key={d} className={`w-full aspect-square rounded-[3px] cgrid-${level}`} />
                    ))}
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
