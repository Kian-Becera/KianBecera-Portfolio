import Link from 'next/link';
import Layout from '../../components/Layout';
import { projects, projectGradients, projectMeta } from '../../data/portfolio';

export default function Projects() {
  return (
    <Layout title="Projects — KIAN BECERA">
      <section className="py-24 min-h-[calc(100vh-3.5rem)]">
        <div className="max-w-6xl mx-auto px-6">

          <div className="mb-16 animate-fade-up">
            <p className="font-mono text-xs text-accent tracking-widest uppercase mb-3">
              // selected_works
            </p>
            <h1 className="text-4xl sm:text-5xl md:text-6xl font-bold dark:text-white text-slate-900 mb-4">
              SELECTED WORKS
            </h1>
            <div className="accent-line mt-8 w-24" />
          </div>

          <div className="space-y-7">
            {projects.map((project, i) => {
              const g = projectGradients[project.slug] ?? { from: '#00e5cc', to: '#0891b2' };
              const m = projectMeta[project.slug] ?? { domain: `${project.slug}.becera.dev`, duration: '—', classification: '—', year: project.year, image: null };

              return (
                <div key={project.slug}
                  className="group dark:bg-dark-card bg-white
                             border dark:border-dark-border border-slate-200
                             rounded-2xl overflow-hidden card-lift shadow-sm animate-fade-up
                             flex flex-col md:flex-row"
                  style={{ animationDelay: `${i * 0.07}s` }}>

                  {/* ── LEFT: preview mockup ── */}
                  <div className="w-full md:w-[38%] flex flex-col shrink-0 relative overflow-hidden
                                  dark:bg-dark-bg bg-slate-100 min-h-[200px] md:min-h-[220px]">

                    {/* Browser chrome */}
                    <div className="flex items-center gap-2 px-4 py-3
                                    dark:bg-dark-card/80 bg-white/80 backdrop-blur-sm
                                    border-b dark:border-dark-border border-slate-200 shrink-0">
                      <span className="w-2.5 h-2.5 rounded-full bg-red-400/80 shrink-0" />
                      <span className="w-2.5 h-2.5 rounded-full bg-yellow-400/80 shrink-0" />
                      <span className="w-2.5 h-2.5 rounded-full bg-green-400/80 shrink-0" />
                      <div className="flex-1 mx-3 px-3 py-1 rounded-md text-[11px]
                                      font-mono dark:text-slate-400 text-slate-500
                                      dark:bg-dark-bg bg-slate-100
                                      border dark:border-dark-border border-slate-200
                                      truncate">
                        {m.domain}
                      </div>
                    </div>

                    {/* Preview canvas */}
                    {m.image ? (
                      <div className="flex-1 relative overflow-hidden">
                        <img src={m.image} alt={project.title}
                          className="absolute inset-0 w-full h-full object-cover object-top
                                     transition-transform duration-700 group-hover:scale-105" />
                        <div className="absolute inset-0"
                          style={{ background: `linear-gradient(to bottom, transparent 40%, ${g.from}88 100%)` }} />
                        <div className="absolute bottom-0 left-0 right-0 p-4 z-10">
                          <h3 className="font-mono font-bold text-sm leading-tight text-black drop-shadow">
                            {project.title}
                          </h3>
                        </div>
                      </div>
                    ) : (
                      <div className="flex-1 flex items-center justify-center relative p-6"
                        style={{ background: `linear-gradient(135deg, ${g.from}22, ${g.to}44)` }}>
                        <div className="absolute inset-0 dot-grid opacity-20" />
                        <div className="relative text-center z-10">
                          <div className="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3"
                            style={{ background: `linear-gradient(135deg, ${g.from}, ${g.to})`, boxShadow: `0 8px 32px ${g.from}55` }}>
                            <i className="fas fa-code text-white text-lg" />
                          </div>
                          <h3 className="font-mono font-bold text-base leading-tight
                                         dark:text-white text-slate-800
                                         group-hover:text-accent transition-colors">
                            {project.title}
                          </h3>
                        </div>
                      </div>
                    )}
                  </div>

                  {/* ── RIGHT: deployment details ── */}
                  <div className="flex-1 p-6 flex flex-col justify-between gap-5
                                  border-t md:border-t-0 md:border-l
                                  dark:border-dark-border border-slate-200">

                    <div className="grid grid-cols-2 gap-x-5 gap-y-2">
                      <div>
                        <p className="font-mono text-xs dark:text-dark-muted text-slate-400
                                      uppercase tracking-widest mb-0.5">Build duration</p>
                        <p className="text-sm dark:text-white text-slate-800">{m.duration}</p>
                      </div>
                      <div>
                        <p className="font-mono text-xs dark:text-dark-muted text-slate-400
                                      uppercase tracking-widest mb-0.5">CLASSIFICATION</p>
                        <p className="text-sm dark:text-white text-slate-800">{m.classification}</p>
                      </div>
                    </div>

                    <div>
                      <p className="font-mono text-xs dark:text-dark-muted text-slate-400
                                    uppercase tracking-widest mb-0.5">
                        <i className="fas fa-code text-accent text-xs" /> ROLE
                      </p>
                      <span className="inline-flex items-center gap-1.5 font-mono text-sm
                                       dark:text-slate-300 text-slate-700">
                        {project.role}
                      </span>
                    </div>

                    <div className="flex flex-wrap items-center gap-2">
                      <span className="inline-flex items-center gap-1.5 font-mono text-xs
                                       dark:text-slate-400 text-slate-600">
                        <i className="fas fa-code text-accent text-[11px]" /> {project.category}
                      </span>
                    </div>
                    <div className="flex flex-wrap items-center gap-1">
                      <span className="dark:bg-dark-border/50 bg-slate-200 w-px h-4" />
                      {project.tags.slice(0, 7).map((t) => (
                        <span key={t} className="tag">{t}</span>
                      ))}
                    </div>

                    <div className="flex items-center justify-end pt-1
                                    border-t dark:border-dark-border border-slate-100">
                      <span className="font-mono text-xs dark:text-dark-muted text-slate-400
                                       dark:bg-dark-bg bg-slate-100
                                       border dark:border-dark-border border-slate-200
                                       px-3 py-1 rounded-full whitespace-nowrap">
                        {m.year}
                      </span>
                    </div>
                  </div>
                </div>
              );
            })}

            {/* CTA card */}
            <Link href="/contact"
              className="group bg-accent rounded-2xl overflow-hidden card-lift
                         flex items-center justify-center gap-6 p-10 animate-fade-up"
              style={{ animationDelay: `${projects.length * 0.07}s` }}>
              <div className="w-12 h-12 rounded-full bg-dark-bg/20
                              flex items-center justify-center
                              group-hover:scale-110 transition-transform shrink-0">
                <i className="fas fa-plus text-dark-bg text-xl" />
              </div>
              <div>
                <h3 className="font-bold text-dark-bg text-lg mb-0.5">Start A Project</h3>
                <p className="text-dark-bg/70 text-sm">Let&apos;s build something great together →</p>
              </div>
            </Link>
          </div>
        </div>
      </section>
    </Layout>
  );
}
