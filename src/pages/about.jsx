import { useState, useEffect, useRef } from 'react';
import Link from 'next/link';
import Layout from '../components/Layout';
import { config, techStack, certificates, education, leadership } from '../data/portfolio';

/* ─── Certificate Carousel ─── */
function CertCarousel({ items }) {
  const [current, setCurrent] = useState(0);
  const timerRef = useRef(null);

  const resetTimer = () => {
    clearInterval(timerRef.current);
    timerRef.current = setInterval(() => {
      setCurrent((c) => (c + 1) % items.length);
    }, 4000);
  };

  useEffect(() => {
    resetTimer();
    return () => clearInterval(timerRef.current);
  }, []);

  const next = () => { setCurrent((c) => (c + 1) % items.length); resetTimer(); };
  const prev = () => { setCurrent((c) => (c - 1 + items.length) % items.length); resetTimer(); };
  const goto = (i) => { setCurrent(i); resetTimer(); };

  useEffect(() => {
    const onKey = (e) => {
      if (e.key === 'ArrowRight') next();
      if (e.key === 'ArrowLeft')  prev();
    };
    window.addEventListener('keydown', onKey);
    return () => window.removeEventListener('keydown', onKey);
  }, []);

  return (
    <div>
      <div className="relative">
        <div className="overflow-hidden rounded-2xl">
          <div className="flex"
            style={{ transform: `translateX(-${current * 100}%)`, transition: 'transform 0.5s cubic-bezier(.4,0,.2,1)' }}>
            {items.map((cert, i) => (
              <div key={i} className="w-full shrink-0">
                <div className="group dark:bg-dark-card bg-slate-50
                                border dark:border-dark-border border-slate-200
                                rounded-2xl overflow-hidden shadow-sm
                                flex flex-col md:flex-row min-h-[440px] md:min-h-[480px]">
                  <div className="md:w-1/2 h-52 sm:h-60 md:h-auto md:aspect-auto
                                  dark:bg-dark-bg bg-slate-200
                                  flex items-center justify-center
                                  relative overflow-hidden shrink-0">
                    {cert.image ? (
                      <img src={cert.image} alt={cert.title}
                        className="w-full h-full object-cover
                                   transition-transform duration-700 ease-in-out
                                   group-hover:scale-110 origin-center" />
                    ) : (
                      <>
                        <div className="absolute inset-0 dot-grid opacity-40" />
                        <div className="relative z-10 text-center px-8
                                        transition-transform duration-700 ease-in-out
                                        group-hover:scale-110">
                          <div className="w-20 h-20 rounded-2xl bg-accent/10
                                          border border-accent/20
                                          flex items-center justify-center mx-auto mb-4">
                            <i className="fas fa-certificate text-3xl text-accent/60" />
                          </div>
                          <p className="font-mono text-xs text-accent/40 tracking-widest uppercase">
                            Certificate Image
                          </p>
                        </div>
                      </>
                    )}
                  </div>
                  <div className="md:w-1/2 flex flex-col justify-center flex-1 p-8 md:p-14">
                    <div className="inline-flex items-center gap-2 mb-5">
                      <span className="w-1.5 h-1.5 rounded-full bg-accent shrink-0" />
                      <span className="font-mono text-xs text-accent tracking-widest uppercase">
                        {cert.year}
                      </span>
                    </div>
                    <h3 className="text-2xl md:text-3xl font-bold leading-snug mb-4
                                   dark:text-white text-slate-900
                                   transition-all duration-500
                                   group-hover:text-accent
                                   group-hover:[text-shadow:0_0_32px_rgba(0,229,204,0.55)]">
                      {cert.title}
                    </h3>
                    <p className="font-mono text-sm text-accent">{cert.issuer}</p>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>

        <button onClick={prev}
          className="absolute left-3 top-1/2 -translate-y-1/2 z-10
                     w-10 h-10 rounded-full
                     dark:bg-dark-bg/90 bg-white/90 backdrop-blur-sm
                     border dark:border-dark-border border-slate-200
                     dark:text-slate-400 text-slate-500
                     hover:border-accent hover:text-accent
                     transition-all shadow-lg flex items-center justify-center">
          <i className="fas fa-chevron-left text-sm" />
        </button>
        <button onClick={next}
          className="absolute right-3 top-1/2 -translate-y-1/2 z-10
                     w-10 h-10 rounded-full
                     dark:bg-dark-bg/90 bg-white/90 backdrop-blur-sm
                     border dark:border-dark-border border-slate-200
                     dark:text-slate-400 text-slate-500
                     hover:border-accent hover:text-accent
                     transition-all shadow-lg flex items-center justify-center">
          <i className="fas fa-chevron-right text-sm" />
        </button>
      </div>

      <div className="flex items-center justify-center gap-2 mt-8 flex-wrap">
        {items.map((_, i) => (
          <button key={i} onClick={() => goto(i)}
            className={`h-2 rounded-full transition-all duration-300 shrink-0
                        ${current === i
                          ? 'w-6 bg-accent'
                          : 'w-2 dark:bg-dark-border bg-slate-300 hover:bg-accent/50'}`} />
        ))}
      </div>

      <p className="text-center font-mono text-xs dark:text-dark-muted text-slate-400 mt-3 tabular-nums">
        {String(current + 1).padStart(2, '0')} &nbsp;/&nbsp; {String(items.length).padStart(2, '0')}
      </p>
    </div>
  );
}

/* ─── Bouncing Education Hat ─── */
function EduHat({ sectionRef }) {
  const hatRef = useRef(null);

  useEffect(() => {
    const hat     = hatRef.current;
    const section = sectionRef.current;
    const tip     = document.getElementById('edu-hat-tip');
    if (!hat || !section) return;

    let hatL, hatT;
    let vx = 2.2, vy = 1.6;
    let dragging = false;
    let sCX, sCY, sL, sT;
    let lastX, lastY, lastTime;
    let touched = false;
    let angle = 0;
    let rafId;

    const clamp = (v, lo, hi) => Math.max(lo, Math.min(hi, v));

    function place() {
      hatL = section.offsetWidth * 0.65;
      hatT = 60;
      hat.style.left = hatL + 'px';
      hat.style.top  = hatT + 'px';
    }

    function checkOverlap() {
      const hr  = hat.getBoundingClientRect();
      let hit = false;
      section.querySelectorAll('[data-edu-entry]').forEach((el) => {
        const er = el.getBoundingClientRect();
        if (hr.left < er.right && hr.right > er.left &&
            hr.top  < er.bottom && hr.bottom > er.top) hit = true;
      });
      hat.style.width  = hit ? '96px' : '52px';
      hat.style.height = hit ? '96px' : '52px';
    }

    function bounce() {
      if (dragging) return;
      const sw = section.offsetWidth;
      const sh = section.offsetHeight;
      const hw = hat.offsetWidth;
      const hh = hat.offsetHeight;

      hatL += vx; hatT += vy;
      if (hatL <= 0)       { hatL = 0;       vx =  Math.abs(vx); }
      if (hatL >= sw - hw) { hatL = sw - hw; vx = -Math.abs(vx); }
      if (hatT <= 0)       { hatT = 0;       vy =  Math.abs(vy); }
      if (hatT >= sh - hh) { hatT = sh - hh; vy = -Math.abs(vy); }

      angle += vx * 1.5;
      hat.style.left      = hatL + 'px';
      hat.style.top       = hatT + 'px';
      hat.style.transform = `rotate(${angle}deg)`;
      checkOverlap();
      rafId = requestAnimationFrame(bounce);
    }

    function grab(cx, cy) {
      dragging = true;
      cancelAnimationFrame(rafId);
      hat.style.cursor = 'grabbing';
      sCX = cx; sCY = cy; sL = hatL; sT = hatT;
      lastX = cx; lastY = cy; lastTime = Date.now();
      if (!touched && tip) { tip.style.opacity = '0'; touched = true; }
    }

    function dragMove(cx, cy) {
      if (!dragging) return;
      const now = Date.now();
      const dt  = Math.max(now - lastTime, 1);
      vx = (cx - lastX) / dt * 14;
      vy = (cy - lastY) / dt * 14;
      lastX = cx; lastY = cy; lastTime = now;
      hatL = clamp(sL + cx - sCX, 0, section.offsetWidth  - hat.offsetWidth);
      hatT = clamp(sT + cy - sCY, 0, section.offsetHeight - hat.offsetHeight);
      hat.style.left = hatL + 'px';
      hat.style.top  = hatT + 'px';
      checkOverlap();
    }

    function drop() {
      if (!dragging) return;
      dragging = false;
      hat.style.cursor = 'grab';
      const maxSpeed = 7;
      vx = clamp(vx, -maxSpeed, maxSpeed);
      vy = clamp(vy, -maxSpeed, maxSpeed);
      if (Math.abs(vx) < 1.2) vx = vx >= 0 ? 1.8 : -1.8;
      if (Math.abs(vy) < 1.2) vy = vy >= 0 ? 1.4 : -1.4;
      rafId = requestAnimationFrame(bounce);
    }

    hat.addEventListener('mousedown', (e) => { grab(e.clientX, e.clientY); e.preventDefault(); });
    window.addEventListener('mousemove', (e) => dragMove(e.clientX, e.clientY));
    window.addEventListener('mouseup', drop);
    hat.addEventListener('touchstart', (e) => { grab(e.touches[0].clientX, e.touches[0].clientY); e.preventDefault(); }, { passive: false });
    window.addEventListener('touchmove', (e) => { if (dragging) { dragMove(e.touches[0].clientX, e.touches[0].clientY); e.preventDefault(); } }, { passive: false });
    window.addEventListener('touchend', drop);

    place();
    rafId = requestAnimationFrame(bounce);

    return () => {
      cancelAnimationFrame(rafId);
      window.removeEventListener('mousemove', (e) => dragMove(e.clientX, e.clientY));
      window.removeEventListener('mouseup', drop);
      window.removeEventListener('touchend', drop);
    };
  }, []);

  return (
    <div ref={hatRef}
      id="edu-hat"
      style={{
        position: 'absolute', top: 44, right: 80,
        width: 52, height: 52,
        cursor: 'grab', zIndex: 20,
        transition: 'width 0.35s cubic-bezier(.34,1.56,.64,1), height 0.35s cubic-bezier(.34,1.56,.64,1), filter 0.3s ease',
        userSelect: 'none', WebkitUserSelect: 'none',
      }}>
      <svg viewBox="0 0 84 72" xmlns="http://www.w3.org/2000/svg"
        style={{ width: '100%', height: '100%', display: 'block', filter: 'drop-shadow(0 4px 14px rgba(0,229,204,0.3))' }}>
        <polygon points="42,4 82,25 42,45 2,25" className="edu-hat-fill" />
        <path d="M20,34 L20,57 Q42,70 64,57 L64,34 L42,45 Z" className="edu-hat-fill" opacity="0.78" />
        <line x1="82" y1="25" x2="82" y2="55" className="edu-hat-stroke" strokeWidth="2.5" strokeLinecap="round" />
        <circle cx="82" cy="61" r="5.5" className="edu-hat-fill" />
      </svg>
      <span id="edu-hat-tip" style={{
        position: 'absolute', top: 'calc(100% + 5px)', left: '50%',
        transform: 'translateX(-50%)', fontSize: 8, whiteSpace: 'nowrap',
        fontFamily: "'JetBrains Mono', monospace", letterSpacing: '0.1em',
        color: '#00e5cc', opacity: 0.65, pointerEvents: 'none', transition: 'opacity 0.4s ease',
      }}>
        drag me
      </span>
    </div>
  );
}

export default function About() {
  const [hoveredEdu, setHoveredEdu] = useState(null);
  const [modalEdu, setModalEdu] = useState(null);
  const [resumeOpen, setResumeOpen] = useState(false);
  const eduSectionRef = useRef(null);

  useEffect(() => {
    const onKey = (e) => { if (e.key === 'Escape') { setModalEdu(null); setResumeOpen(false); } };
    window.addEventListener('keydown', onKey);
    return () => window.removeEventListener('keydown', onKey);
  }, []);

  return (
    <Layout title="About — KIAN BECERA">
      {/* ════ HERO ════ */}
      <section className="relative py-24 dark:bg-dark-card bg-slate-50
                          border-b dark:border-dark-border border-slate-200
                          dot-grid overflow-hidden">
        <div className="pointer-events-none absolute top-0 right-0
                        w-[500px] h-[500px] dark:bg-accent/5 bg-cyan-200/20
                        rounded-full blur-3xl -translate-y-1/2" />
        <div className="max-w-7xl mx-auto px-6 animate-fade-up">
          <p className="font-mono text-xs text-accent tracking-widest uppercase mb-4">// about_me</p>
          <h1 className="text-6xl md:text-7xl lg:text-8xl font-bold
                         dark:text-white text-slate-900 leading-[1] mb-6">
            THE<br />DEVELOPER.
          </h1>
          <div className="accent-line w-32 mb-8" />
        </div>
      </section>

      {/* ════ PROFILE ════ */}
      <section className="py-20">
        <div className="max-w-7xl mx-auto px-6">
          <div className="grid lg:grid-cols-2 gap-16 items-start">

            <div className="animate-fade-up">
              <div className="relative">
                <div className="dark:bg-dark-card bg-slate-100
                                border dark:border-dark-border border-slate-200
                                rounded-2xl aspect-[4/5] max-w-sm
                                flex items-center justify-center overflow-hidden shadow-xl">
                  <div className="absolute inset-0 dot-grid opacity-50" />
                  {config.avatar ? (
                    <img src={config.avatar} alt={config.name}
                      className="w-full h-full object-cover object-top" />
                  ) : (
                    <div className="relative text-center z-10">
                      <div className="w-32 h-32 rounded-full dark:bg-dark-bg bg-slate-200
                                      border-2 border-accent/30 mx-auto flex items-center justify-center mb-4">
                        <i className="fas fa-user-tie text-5xl text-accent/50" />
                      </div>
                      <p className="font-mono text-sm font-bold dark:text-white text-slate-800">{config.name}</p>
                      <p className="font-mono text-xs text-accent mt-1">{config.role}</p>
                    </div>
                  )}
                </div>
              </div>
            </div>

            <div className="animate-fade-up [animation-delay:.1s]">
              <h2 className="text-2xl font-bold dark:text-white text-slate-900 mb-5">
                I specialize in building clean, scalable web applications and intuitive user experiences.
              </h2>
              <div className="space-y-4 dark:text-slate-400 text-slate-600 leading-relaxed">
                <p>
                  Focused on delivering clean, scalable solutions — from WordPress sites
                  to full-stack web apps and mobile experiences using Flutter.
                  I bring both design sensibility and engineering discipline to every project.
                </p>
                <p>
                  I hold a B.S. in Information Systems and continuing as a Masteral Student in Information Technology.
                  Currently exploring AI automation workflows and edge-deployment patterns.
                </p>
              </div>

              <div className="mt-8 grid grid-cols-2 gap-4">
                {[
                  { label: 'Email',       value: config.email,    icon: 'fas fa-envelope' },
                  { label: 'Location',    value: config.location, icon: 'fas fa-location-dot' },
                  { label: 'GitHub',      value: '@Kian-Becera',  icon: 'fab fa-github' },
                  { label: 'Availability', value: 'Open to Work', icon: 'fas fa-circle-check' },
                ].map((info) => (
                  <div key={info.label}
                    className="dark:bg-dark-card bg-slate-50
                               border dark:border-dark-border border-slate-200
                               rounded-xl p-4">
                    <p className="text-xs dark:text-dark-muted text-slate-400 mb-1 flex items-center gap-1.5">
                      <i className={`${info.icon} text-accent text-[10px]`} />
                      {info.label}
                    </p>
                    <p className="text-sm dark:text-white text-slate-800 font-medium truncate">
                      {info.value}
                    </p>
                  </div>
                ))}
              </div>

              <div className="flex flex-wrap gap-4 mt-8">
                <Link href="/contact"
                  className="inline-flex items-center gap-2
                             bg-accent text-dark-bg font-bold text-sm
                             px-6 py-3 rounded hover:brightness-110 transition-all">
                  Hire Me
                </Link>
                <Link href="/projects"
                  className="inline-flex items-center gap-2
                             dark:bg-dark-card bg-white
                             border dark:border-dark-border border-slate-200
                             dark:text-slate-300 text-slate-700
                             font-semibold text-sm px-6 py-3 rounded shadow-sm
                             hover:border-accent hover:text-accent transition-all">
                  View Work
                </Link>
                {config.resume && (
                  <button onClick={() => setResumeOpen(true)}
                    className="inline-flex items-center gap-2
                               dark:bg-dark-card bg-white
                               border dark:border-accent border-cyan-600
                               dark:text-accent text-cyan-600
                               font-semibold text-sm px-6 py-3 rounded shadow-sm
                               hover:bg-accent hover:text-dark-bg transition-all">
                    <i className="fas fa-file-lines text-xs" /> Resume
                  </button>
                )}
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Resume Modal */}
      {config.resume && resumeOpen && (
        <div onClick={(e) => { if (e.target === e.currentTarget) setResumeOpen(false); }}
          className="fixed inset-0 z-50 overflow-y-auto bg-black/70 backdrop-blur-sm">
          <div className="flex min-h-full items-start justify-center px-6 pt-16 pb-10">
            <div className="relative w-full max-w-2xl
                            dark:bg-dark-card bg-white
                            border dark:border-dark-border border-slate-200
                            rounded-2xl shadow-2xl overflow-hidden">
              <div className="h-1 w-full bg-gradient-to-r from-accent to-transparent" />
              <div className="sticky top-0 z-20 dark:bg-dark-card bg-white
                              flex items-center justify-between gap-4 px-6 pt-5 pb-4
                              border-b dark:border-dark-border border-slate-100">
                <div className="flex items-center gap-3">
                  <div className="w-10 h-10 rounded-xl bg-accent/10 border border-accent/20
                                  flex items-center justify-center shrink-0">
                    <i className="fas fa-file-lines text-accent" />
                  </div>
                  <div>
                    <p className="font-mono text-[10px] text-accent tracking-widest uppercase">
                      // curriculum_vitae
                    </p>
                    <h3 className="font-bold dark:text-white text-slate-900 text-base leading-snug">
                      {config.name} — {config.role}
                    </h3>
                  </div>
                </div>
                <button onClick={() => setResumeOpen(false)}
                  className="w-8 h-8 rounded-lg shrink-0
                             dark:bg-dark-bg bg-slate-100
                             dark:text-dark-muted text-slate-500
                             hover:text-accent transition-colors
                             flex items-center justify-center text-sm">
                  <i className="fas fa-xmark" />
                </button>
              </div>

              <div className="overflow-y-auto no-scrollbar" style={{ maxHeight: 'calc(100vh - 12rem)' }}>
                <div className="relative mx-6 mt-4 rounded-xl overflow-hidden
                                border dark:border-dark-border border-slate-200"
                  style={{ height: 500 }}>
                  <iframe src={`${config.resume}#toolbar=0&navpanes=0&scrollbar=0&view=FitH`}
                    style={{ border: 'none', display: 'block', width: 'calc(100% + 20px)', height: '100%' }}
                    title="Resume Preview"
                    scrolling="no" />
                  <div className="absolute inset-0 z-10" style={{ pointerEvents: 'all', cursor: 'default' }} />
                  <div className="absolute bottom-0 left-0 right-0 h-1/2 z-20
                                  flex flex-col items-center justify-end pb-8"
                    style={{
                      backdropFilter: 'blur(6px)', WebkitBackdropFilter: 'blur(6px)',
                      background: 'linear-gradient(to bottom, transparent 0%, var(--gate-bg, rgba(13,21,38,0)) 30%, var(--gate-solid, #0d1526) 100%)',
                    }}>
                    <div className="text-center">
                      <div className="w-10 h-10 rounded-full bg-accent/10 border border-accent/30
                                      flex items-center justify-center mx-auto mb-3">
                        <i className="fas fa-lock text-accent text-sm" />
                      </div>
                      <p className="font-mono text-xs text-accent tracking-widest uppercase">
                        Download for Full File View
                      </p>
                    </div>
                  </div>
                </div>

                <div className="flex items-center gap-3 px-6 py-5">
                  <a href={config.resume} download="Kian-Becera-Resume.pdf"
                    className="inline-flex items-center gap-2
                               bg-accent text-dark-bg font-bold text-sm
                               px-6 py-2.5 rounded hover:brightness-110 transition-all">
                    <i className="fas fa-file-arrow-down text-xs" />
                    Download Resume
                  </a>
                  <button onClick={() => setResumeOpen(false)}
                    className="inline-flex items-center
                               dark:bg-dark-bg bg-slate-100
                               dark:text-slate-400 text-slate-600
                               font-semibold text-sm px-5 py-2.5 rounded
                               hover:text-accent transition-colors">
                    Close
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      )}

      {/* ════ EDUCATION ════ */}
      <section ref={eduSectionRef} id="edu-section"
        className="relative py-20 overflow-hidden
                   dark:bg-dark-card/50 bg-slate-50
                   border-y dark:border-dark-border border-slate-200">
        <div className="pointer-events-none absolute inset-0 dot-grid opacity-[.18]" />
        <div className="pointer-events-none absolute -top-40 -left-40
                        w-[480px] h-[480px] dark:bg-accent/[.04] bg-cyan-200/20
                        rounded-full blur-3xl" />
        <div className="pointer-events-none absolute -bottom-24 right-0
                        w-80 h-80 dark:bg-accent/[.03] bg-cyan-100/15
                        rounded-full blur-3xl" />

        <EduHat sectionRef={eduSectionRef} />

        <div className="max-w-5xl mx-auto px-6">
          <p className="font-mono text-xs text-accent tracking-widest uppercase mb-3">
            // educational_background
          </p>
          <h2 className="text-3xl font-bold dark:text-white text-slate-900 mb-16">
            Educational Background
          </h2>

          <div className="relative max-w-3xl mx-auto">
            <div className="absolute left-1/2 -translate-x-1/2 top-0 bottom-0
                            w-1 rounded-full dark:bg-dark-border bg-slate-300" />
            <div className="space-y-0">
              {education.map((edu, i) => {
                const left = i % 2 === 0;
                const clickable = i < 2;
                return (
                  <div key={i} data-edu-entry
                    className="relative grid grid-cols-[1fr_auto_1fr] items-start animate-fade-up py-10"
                    style={{ animationDelay: `${i * 0.15}s` }}>

                    <div className="flex justify-end pr-8">
                      {left && (
                        clickable ? (
                          <button onClick={() => setModalEdu(i)}
                            onMouseEnter={() => setHoveredEdu(i)}
                            onMouseLeave={() => setHoveredEdu(null)}
                            className="w-full max-w-xs text-right cursor-pointer group">
                            <h3 className="font-bold dark:text-white text-slate-900 text-lg leading-snug mb-1 group-hover:text-accent transition-colors">{edu.school}</h3>
                            <p className="font-mono text-xs text-accent tracking-widest uppercase mb-2">{edu.degree}</p>
                            <p className="text-sm dark:text-dark-muted text-slate-500 leading-relaxed mb-2">{edu.desc}</p>
                            <p className="font-mono text-xs dark:text-slate-500 text-slate-400">{edu.period}</p>
                          </button>
                        ) : (
                          <div className="w-full max-w-xs text-right">
                            <h3 className="font-bold dark:text-white text-slate-900 text-lg leading-snug mb-1">{edu.school}</h3>
                            <p className="font-mono text-xs text-accent tracking-widest uppercase mb-2">{edu.degree}</p>
                            <p className="font-mono text-xs dark:text-slate-500 text-slate-400">{edu.period}</p>
                          </div>
                        )
                      )}
                    </div>

                    <div className="flex flex-col items-center pt-2.5 relative z-10">
                      <div className="w-4 h-4 rounded-full border-2 shrink-0
                                      dark:bg-dark-border bg-slate-300
                                      dark:border-accent/50 border-slate-400" />
                    </div>

                    <div className="flex justify-start pl-8">
                      {!left && (
                        clickable ? (
                          <button onClick={() => setModalEdu(i)}
                            onMouseEnter={() => setHoveredEdu(i)}
                            onMouseLeave={() => setHoveredEdu(null)}
                            className="w-full max-w-xs text-left cursor-pointer group">
                            <h3 className="font-bold dark:text-white text-slate-900 text-lg leading-snug mb-1 group-hover:text-accent transition-colors">{edu.school}</h3>
                            <p className="font-mono text-xs text-accent tracking-widest uppercase mb-2">{edu.degree}</p>
                            <p className="text-sm dark:text-dark-muted text-slate-500 leading-relaxed mb-2">{edu.desc}</p>
                            <p className="font-mono text-xs dark:text-slate-500 text-slate-400">{edu.period}</p>
                          </button>
                        ) : (
                          <div className="w-full max-w-xs text-left">
                            <h3 className="font-bold dark:text-white text-slate-900 text-lg leading-snug mb-1">{edu.school}</h3>
                            <p className="font-mono text-xs text-accent tracking-widest uppercase mb-2">{edu.degree}</p>
                            <p className="font-mono text-xs dark:text-slate-500 text-slate-400">{edu.period}</p>
                          </div>
                        )
                      )}
                    </div>
                  </div>
                );
              })}
            </div>
          </div>

          {/* Hover preview tooltip */}
          {hoveredEdu !== null && (
            <div className="fixed bottom-8 right-8 z-40 w-72 pointer-events-none
                            dark:bg-dark-card bg-white
                            border dark:border-accent/30 border-cyan-300
                            rounded-2xl p-5 shadow-2xl">
              <div className="flex items-center gap-2 mb-3">
                <div className="w-7 h-7 rounded-lg bg-accent/10 flex items-center justify-center shrink-0">
                  <i className="fas fa-graduation-cap text-accent text-xs" />
                </div>
                <span className="font-mono text-[10px] text-accent tracking-widest uppercase">
                  {education[hoveredEdu].period}
                </span>
              </div>
              <p className="font-bold dark:text-white text-slate-900 text-sm mb-0.5">
                {education[hoveredEdu].degree}
              </p>
              <p className="font-mono text-xs text-accent mb-3">{education[hoveredEdu].school}</p>
              <p className="text-xs dark:text-slate-400 text-slate-600 leading-relaxed line-clamp-2">
                {education[hoveredEdu].desc}
              </p>
              <p className="font-mono text-[10px] text-accent/60 mt-3">Click to view details →</p>
            </div>
          )}

          {/* Education modal */}
          {modalEdu !== null && (
            <div onClick={(e) => { if (e.target === e.currentTarget) setModalEdu(null); }}
              className="fixed inset-0 z-50 flex items-center justify-center p-4
                         bg-black/60 backdrop-blur-sm">
              <div className="relative w-full max-w-md
                              dark:bg-dark-card bg-white
                              border dark:border-dark-border border-slate-200
                              rounded-2xl p-8 shadow-2xl">
                <button onClick={() => setModalEdu(null)}
                  className="absolute top-4 right-4 w-7 h-7
                             dark:bg-dark-bg bg-slate-100
                             rounded-lg flex items-center justify-center
                             dark:text-dark-muted text-slate-500
                             hover:text-accent transition-colors text-xs">
                  <i className="fas fa-xmark" />
                </button>
                <div className="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center mb-5">
                  <i className="fas fa-graduation-cap text-accent text-lg" />
                </div>
                <p className="font-mono text-xs text-accent tracking-widest uppercase mb-2">
                  {education[modalEdu].period}
                </p>
                <h3 className="font-bold dark:text-white text-slate-900 text-xl leading-snug mb-1">
                  {education[modalEdu].degree}
                </h3>
                <p className="font-mono text-sm text-accent mb-5">{education[modalEdu].school}</p>
                <div className="h-px dark:bg-dark-border bg-slate-100 mb-5" />
                <p className="dark:text-slate-400 text-slate-600 text-sm leading-relaxed">
                  {education[modalEdu].desc}
                </p>
              </div>
            </div>
          )}
        </div>
      </section>

      {/* ════ LEADERSHIP ════ */}
      <section className="py-20 border-b dark:border-dark-border border-slate-200 overflow-x-hidden">
        <div className="max-w-7xl mx-auto px-6">
          <p className="font-mono text-xs text-accent tracking-widest uppercase mb-3">
            // leadership_&amp;_activities
          </p>
          <h2 className="text-3xl font-bold dark:text-white text-slate-900 mb-12">
            Leadership &amp; Activities
          </h2>

          <div className="grid grid-cols-1 sm:grid-cols-2 gap-5">
            {leadership.map((item, i) => (
              <div key={i}
                className="dark:bg-dark-card bg-white
                           border dark:border-dark-border border-slate-200
                           rounded-2xl p-6 card-lift shadow-sm animate-fade-up
                           min-w-0 overflow-hidden"
                style={{ animationDelay: `${i * 0.08}s` }}>
                <div className="flex items-start justify-between gap-4">
                  <div className="w-10 h-10 rounded-xl bg-accent/10 border border-accent/20
                                  flex items-center justify-center shrink-0">
                    <i className="fas fa-users text-accent text-sm" />
                  </div>
                  <span className="font-mono text-xs dark:text-dark-muted text-slate-400
                                   dark:bg-dark-bg bg-slate-100
                                   border dark:border-dark-border border-slate-200
                                   px-3 py-1 rounded-full whitespace-nowrap">
                    {item.years}
                  </span>
                </div>
                <div className="mt-4">
                  <p className="font-bold dark:text-white text-slate-900 text-base leading-snug mb-1">
                    {item.role}
                  </p>
                  <div className="overflow-hidden w-full mt-1">
                    <p className="ticker font-mono text-xs text-accent tracking-wide">
                      {item.org}
                    </p>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ════ CERTIFICATES ════ */}
      <section className="py-20 dark:bg-dark-bg bg-white
                          border-b dark:border-dark-border border-slate-200 overflow-hidden">
        <div className="max-w-7xl mx-auto px-6">
          <p className="font-mono text-xs text-accent tracking-widest uppercase mb-3">
            // certificates_&amp;_seminars
          </p>
          <h2 className="text-3xl font-bold dark:text-white text-slate-900 mb-12">
            Certificates &amp; Seminars
          </h2>
          <CertCarousel items={certificates} />
        </div>
      </section>

      {/* ════ TECH STACK ════ */}
      <section className="py-20">
        <div className="max-w-7xl mx-auto px-6">
          <p className="font-mono text-xs text-accent tracking-widest uppercase mb-3">
            // technological_stack
          </p>
          <h2 className="text-3xl font-bold dark:text-white text-slate-900 mb-12">
            Technological Stack
          </h2>

          <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            {techStack.map((tech, i) => (
              <div key={tech.name}
                className="dark:bg-dark-card bg-white
                           border dark:border-dark-border border-slate-200
                           rounded-2xl p-6 card-lift shadow-sm animate-fade-up"
                style={{ animationDelay: `${i * 0.05}s` }}>
                <div className="flex items-center gap-3 mb-5">
                  <div className="w-10 h-10 rounded-xl flex items-center justify-center text-xl shrink-0"
                    style={{ background: `${tech.color}1a`, color: tech.color }}>
                    <i className={tech.icon} />
                  </div>
                  <h3 className="font-mono text-sm font-bold
                                 dark:text-white text-slate-800
                                 uppercase tracking-widest leading-tight">
                    {tech.name}
                  </h3>
                </div>

                <div className="space-y-2 mb-4">
                  {tech.tags.slice(0, 2).map((tag) => (
                    <div key={tag}
                      className="flex items-center gap-2
                                 dark:bg-dark-bg bg-slate-50
                                 border dark:border-dark-border border-slate-200
                                 rounded-lg px-3 py-2">
                      <span className="w-1.5 h-1.5 rounded-full shrink-0"
                        style={{ background: tech.color }} />
                      <span className="text-sm dark:text-slate-300 text-slate-700 font-medium">{tag}</span>
                    </div>
                  ))}
                </div>

                {tech.tags.length > 2 && (
                  <div className="flex flex-wrap gap-2 pt-3
                                  border-t dark:border-dark-border border-slate-100">
                    {tech.tags.slice(2).map((tag) => (
                      <span key={tag} className="tag">{tag}</span>
                    ))}
                  </div>
                )}
              </div>
            ))}
          </div>
        </div>
      </section>
    </Layout>
  );
}
