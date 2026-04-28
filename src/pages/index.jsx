import { useEffect, useRef } from 'react';
import Link from 'next/link';
import Layout from '../components/Layout';
import { config, featured, techStack } from '../data/portfolio';

const STATS = [['3+', 'Years Exp.'], ['10+', 'Projects'], ['12ms', 'Avg Latency']];
const CHARS = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ+ms';

function scramble(el, finalText, delay) {
  const total = finalText.length;
  const totalFrames = Math.max(40, total * 6);
  let frame = 0;
  setTimeout(() => {
    const tick = () => {
      const resolved = Math.floor((frame / totalFrames) * total);
      let out = '';
      for (let i = 0; i < total; i++) {
        const c = finalText[i];
        if (i < resolved) {
          out += c;
        } else if (/[\w+]/.test(c)) {
          out += CHARS[Math.floor(Math.random() * CHARS.length)];
        } else {
          out += c;
        }
      }
      el.textContent = out;
      frame++;
      if (frame <= totalFrames) setTimeout(tick, 40);
      else el.textContent = finalText;
    };
    tick();
  }, delay);
}

export default function Home() {
  const statRefs = [useRef(null), useRef(null), useRef(null)];

  useEffect(() => {
    STATS.forEach(([val], i) => {
      if (statRefs[i].current) scramble(statRefs[i].current, val, i * 200);
    });
  }, []);

  return (
    <Layout title={`${config.name} — Software Engineer`}>
      {/* ════ HERO ════ */}
      <section className="relative min-h-[calc(100vh-3.5rem)] flex flex-col
                          justify-center dot-grid overflow-hidden">
        <div className="pointer-events-none absolute -top-40 -left-40
                        w-[500px] h-[500px] dark:bg-accent/5 bg-cyan-300/10
                        rounded-full blur-3xl" />
        <div className="pointer-events-none absolute bottom-0 right-0
                        w-96 h-96 dark:bg-accent/5 bg-cyan-100/30
                        rounded-full blur-3xl" />

        <div className="max-w-7xl mx-auto px-6 py-24 w-full">
          <div className="grid lg:grid-cols-2 gap-16 items-center">

            {/* Left: copy */}
            <div className="animate-fade-up">
              {/* Available badge */}
              <div className="inline-flex items-center gap-2
                              dark:bg-dark-card bg-white
                              border dark:border-dark-border border-slate-200
                              rounded-full px-4 py-1.5 mb-8 shadow-sm">
                <span className="w-2 h-2 rounded-full bg-accent animate-pulse" />
                <span className="font-mono text-xs text-accent tracking-widest uppercase">
                  Available for projects
                </span>
              </div>

              {/* Headline */}
              <h1 className="font-bold leading-[1.05] dark:text-white text-slate-900 mb-6">
                <span className="block text-4xl sm:text-5xl md:text-6xl lg:text-7xl tracking-tight">CODE</span>
                <span className="block text-4xl sm:text-5xl md:text-6xl lg:text-7xl tracking-tight">THAT</span>
                <span className="block text-4xl sm:text-5xl md:text-6xl lg:text-7xl tracking-tight italic text-accent glow-accent">DRIVES</span>
                <span className="block text-4xl sm:text-5xl md:text-6xl lg:text-7xl tracking-tight">RESULTS.</span>
              </h1>

              <p className="dark:text-dark-muted text-slate-500 max-w-lg leading-relaxed mb-10">
                {config.tagline}
              </p>

              <div className="flex flex-wrap gap-4">
                <Link href="/projects"
                  className="inline-flex items-center gap-2
                             bg-accent text-dark-bg font-semibold text-sm
                             px-6 py-3 rounded transition-all hover:brightness-110">
                  Explore Work <i className="fas fa-arrow-right text-xs" />
                </Link>
                <Link href="/about"
                  className="inline-flex items-center gap-2
                             dark:bg-dark-card bg-white
                             border dark:border-dark-border border-slate-200
                             dark:text-slate-300 text-slate-700
                             font-semibold text-sm px-6 py-3 rounded shadow-sm
                             hover:border-accent hover:text-accent transition-all">
                  KIAN.BECERA
                </Link>
              </div>

              <div className="flex gap-5 mt-10">
                <a href={config.github} target="_blank" rel="noreferrer"
                   className="dark:text-dark-muted text-slate-400 hover:text-accent transition-colors">
                  <i className="fab fa-github text-lg" />
                </a>
                <a href={config.linkedin} target="_blank" rel="noreferrer"
                   className="dark:text-dark-muted text-slate-400 hover:text-accent transition-colors">
                  <i className="fab fa-linkedin text-lg" />
                </a>
                <a href={config.twitter} target="_blank" rel="noreferrer"
                   className="dark:text-dark-muted text-slate-400 hover:text-accent transition-colors">
                  <i className="fab fa-x-twitter text-lg" />
                </a>
                <a href={`mailto:${config.email}`}
                   className="dark:text-dark-muted text-slate-400 hover:text-accent transition-colors">
                  <i className="fas fa-envelope text-lg" />
                </a>
              </div>
            </div>

            {/* Right: stats + mini diff */}
            <div className="hidden lg:flex flex-col gap-4 animate-fade-up [animation-delay:.15s]">
              {/* Stats card */}
              <div className="dark:bg-dark-card bg-white
                              border dark:border-dark-border border-slate-200
                              rounded-2xl p-6 shadow-xl">
                <p className="font-mono text-xs text-accent tracking-widest uppercase mb-4">
                  // engineer.status
                </p>
                <div className="grid grid-cols-3 gap-4">
                  {STATS.map(([val, label], i) => (
                    <div key={label} className="text-center p-3 dark:bg-dark-bg bg-slate-50 rounded-xl">
                      <p ref={statRefs[i]}
                         className="text-2xl font-bold text-accent font-mono">
                        {val}
                      </p>
                      <p className="text-xs dark:text-dark-muted text-slate-500 mt-1">{label}</p>
                    </div>
                  ))}
                </div>
              </div>

              {/* Mini code diff */}
              <div className="code-block p-5">
                <p className="dark:text-dark-muted text-slate-500 text-xs mb-2">
                  // latest_commit.diff
                </p>
                <p>
                  <span className="text-emerald-400">+</span>
                  <span className="dark:text-slate-400 text-slate-500">feat(ui):</span>
                  <span className="dark:text-white text-slate-200"> gallery, footer &amp; specials page — pixel-perfect layouts delivered</span>
                </p>
                <p>
                  <span className="text-emerald-400">+</span>
                  <span className="dark:text-slate-400 text-slate-500">perf(env):</span>
                  <span className="dark:text-white text-slate-200"> docker migration complete — local env now containerized &amp; clean</span>
                </p>
                <p>
                  <span className="text-red-400">-</span>
                  <span className="dark:text-slate-500 text-slate-600">chore: cms</span>
                </p>
                <p className="mt-3 text-accent font-mono text-xs">
                  ▸ WordPress 6.9.1 upgraded &amp; Elementor wired in
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ════ TECH STACK ════ */}
      <section className="py-20 dark:bg-dark-card/50 bg-white
                          border-y dark:border-dark-border border-slate-100">
        <div className="max-w-7xl mx-auto px-6">
          <div className="flex items-center gap-4 mb-10">
            <p className="font-mono text-xs text-accent tracking-widest uppercase whitespace-nowrap">
              Technological Stack
            </p>
            <div className="flex-1 accent-line opacity-40" />
          </div>

          <div className="grid sm:grid-cols-2 md:grid-cols-3 gap-5">
            {techStack.map((tech) => (
              <div key={tech.name}
                className="dark:bg-dark-bg bg-slate-50
                           border dark:border-dark-border border-slate-200
                           rounded-2xl p-6 card-lift group
                           transition-all duration-300
                           hover:border-accent/40 hover:dark:bg-dark-card">
                <div className="flex items-center gap-3 mb-4">
                  <div className="w-10 h-10 rounded-lg flex items-center justify-center text-xl
                                  transition-all duration-300
                                  group-hover:w-12 group-hover:h-12 group-hover:rounded-xl
                                  group-hover:shadow-[0_0_18px_rgba(0,229,204,.2)]"
                    style={{ background: `${tech.color}1a`, color: tech.color }}>
                    <i className={`${tech.icon} transition-transform duration-300 group-hover:scale-125`} />
                  </div>
                  <h3 className="font-semibold dark:text-white text-slate-800 text-sm
                                 transition-all duration-300
                                 group-hover:text-accent group-hover:tracking-wider">
                    {tech.name}
                  </h3>
                </div>
                <div className="flex flex-wrap gap-2">
                  {tech.tags.map((t) => (
                    <span key={t} className="tag transition-all duration-200
                                             group-hover:dark:bg-accent/[.14] group-hover:dark:border-accent/40">
                      {t}
                    </span>
                  ))}
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ════ FEATURED PROJECTS ════ */}
      <section className="py-24">
        <div className="max-w-7xl mx-auto px-6">
          <div className="flex items-end justify-between mb-12">
            <div>
              <p className="font-mono text-xs text-accent tracking-widest uppercase mb-2">
                // featured_work
              </p>
              <h2 className="text-3xl font-bold dark:text-white text-slate-900">
                Selected Projects
              </h2>
            </div>
            <Link href="/projects"
              className="hidden sm:block text-xs font-mono text-accent
                         hover:underline tracking-widest uppercase">
              View All →
            </Link>
          </div>

          <div className="flex flex-col gap-6">
            {featured.map((project) => (
              <Link key={project.slug} href="/projects"
                className="group dark:bg-dark-card bg-white
                           border dark:border-dark-border border-slate-200
                           rounded-2xl overflow-hidden card-lift shadow-sm
                           flex flex-col md:flex-row">
                {/* Left: title box */}
                <div className="md:w-2/5 dark:bg-dark-bg bg-slate-100
                                relative flex items-center justify-center
                                overflow-hidden min-h-[200px]">
                  <div className="absolute inset-0 dot-grid" />
                  <div className="relative z-10 text-center px-6">
                    <p className="font-mono text-2xl font-bold
                                  dark:text-white text-slate-700
                                  group-hover:text-accent transition-colors">
                      {project.title}
                    </p>
                  </div>
                  <span className="absolute top-4 right-4 font-mono text-xs
                                   dark:text-dark-muted text-slate-400">
                    {project.year}
                  </span>
                </div>

                {/* Right: content */}
                <div className="flex-1 p-6 flex flex-col justify-center">
                  <div className="flex flex-wrap gap-2 mb-4">
                    {project.tags.slice(0, 4).map((t) => (
                      <span key={t} className="tag">{t}</span>
                    ))}
                  </div>
                  <span className="text-xs text-accent font-mono group-hover:underline">
                    View All →
                  </span>
                </div>
              </Link>
            ))}
          </div>
        </div>
      </section>

      {/* ════ CTA STRIP ════ */}
      <section className="py-20 dark:bg-dark-card bg-slate-50
                          border-y dark:border-dark-border border-slate-200">
        <div className="max-w-7xl mx-auto px-6
                        flex flex-col md:flex-row items-center justify-between gap-6">
          <div>
            <p className="font-mono text-xs text-accent tracking-widest uppercase mb-1">
              Ready to collaborate?
            </p>
            <h3 className="text-2xl font-bold dark:text-white text-slate-900">
              Let&apos;s build something exceptional.
            </h3>
          </div>
          <Link href="/contact"
            className="shrink-0 inline-flex items-center gap-2
                       bg-accent text-dark-bg font-bold text-sm
                       px-8 py-3 rounded hover:brightness-110 transition-all whitespace-nowrap">
            Start a Project <i className="fas fa-arrow-right text-xs" />
          </Link>
        </div>
      </section>
    </Layout>
  );
}
