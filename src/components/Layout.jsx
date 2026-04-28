import { useState, useEffect } from 'react';
import { useRouter } from 'next/router';
import Link from 'next/link';
import Head from 'next/head';
import { config } from '../data/portfolio';

const navLinks = [
  { label: 'Projects',   href: '/projects'   },
  { label: 'Experience', href: '/experience' },
  { label: 'About',      href: '/about'       },
  { label: 'Contact',    href: '/contact'     },
];

export default function Layout({ children, toast, title }) {
  const [dark, setDark] = useState(true);
  const [open, setOpen] = useState(false);
  const [showToast, setShowToast] = useState(false);
  const [showTopBtn, setShowTopBtn] = useState(false);
  const router = useRouter();

  useEffect(() => {
    setDark(localStorage.getItem('theme') !== 'light');
  }, []);

  useEffect(() => {
    if (toast) {
      setShowToast(true);
      const t = setTimeout(() => setShowToast(false), 5000);
      return () => clearTimeout(t);
    }
  }, [toast]);

  useEffect(() => {
    setOpen(false);
  }, [router.pathname]);

  useEffect(() => {
    function onScroll() {
      setShowTopBtn(
        window.scrollY + window.innerHeight >= document.body.scrollHeight - 200
      );
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    return () => window.removeEventListener('scroll', onScroll);
  }, []);

  useEffect(() => {
    let ticking = false;
    function update() {
      const wh = window.innerHeight;
      document.querySelectorAll('.card-lift').forEach((el) => {
        const rect = el.getBoundingClientRect();
        const start = wh * 0.95;
        const end   = wh * 0.45;
        const progress = Math.max(0, Math.min(1, (start - rect.top) / (start - end)));
        el.style.opacity   = progress;
        el.style.transform = `translateY(${(1 - progress) * 52}px)`;
      });
      ticking = false;
    }
    function onScroll() {
      if (!ticking) { requestAnimationFrame(update); ticking = true; }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    update();
    return () => window.removeEventListener('scroll', onScroll);
  }, [router.pathname]);

  const toggleTheme = () => {
    const newDark = !dark;
    setDark(newDark);
    document.documentElement.classList.toggle('dark', newDark);
    localStorage.setItem('theme', newDark ? 'dark' : 'light');
  };

  const isActive = (href) =>
    router.pathname === href || router.pathname.startsWith(href + '/');

  return (
    <>
      <Head>
        <title>{title || `${config.name} — Portfolio`}</title>
      </Head>

      {/* ════ NAV ════ */}
      <nav className="nav-glass fixed top-0 inset-x-0 z-50 border-b dark:border-dark-border border-slate-200/80">
        <div className="max-w-7xl mx-auto px-6 h-14 flex items-center justify-between gap-6">

          {/* Logo */}
          <Link href="/"
            className="flex items-center gap-2 font-mono text-sm font-semibold
                       tracking-widest uppercase text-accent shrink-0">
            <span className="w-5 h-5 border border-accent/70 rounded-sm
                             flex items-center justify-center text-[9px] font-bold">
              K
            </span>
            KIAN.BECERA
          </Link>

          {/* Desktop nav links */}
          <ul className="hidden md:flex items-center gap-7 text-xs font-medium tracking-widest uppercase">
            {navLinks.map((link) => (
              <li key={link.href}>
                <Link href={link.href}
                  className={`transition-colors duration-200 ${
                    isActive(link.href)
                      ? 'text-accent'
                      : 'dark:text-slate-400 text-slate-500 hover:dark:text-white hover:text-slate-900'
                  }`}>
                  {link.label}
                </Link>
              </li>
            ))}
          </ul>

          {/* Desktop right: toggle + hire */}
          <div className="hidden md:flex items-center gap-4 shrink-0">
            {/* Theme toggle */}
            <div className="flex items-center gap-2.5">
              <i className="fas fa-sun text-[11px] dark:text-dark-muted text-yellow-500 transition-colors duration-300" />
              <button
                onClick={toggleTheme}
                className="relative inline-flex h-6 w-11 shrink-0 cursor-pointer
                           items-center rounded-full border-2 transition-colors duration-300
                           focus:outline-none focus-visible:ring-2 focus-visible:ring-accent/40
                           dark:border-accent/30 dark:bg-accent/[.15]
                           border-slate-300 bg-slate-200"
                aria-label={dark ? 'Switch to light mode' : 'Switch to dark mode'}>
                <span className={`pointer-events-none inline-block h-[14px] w-[14px] transform
                                  rounded-full shadow-md transition-transform duration-300
                                  dark:bg-accent bg-slate-500
                                  ${dark ? 'translate-x-[22px]' : 'translate-x-[3px]'}`} />
              </button>
              <i className="fas fa-moon text-[11px] dark:text-accent text-slate-400 transition-colors duration-300" />
            </div>
            <Link href="/contact" className="btn-hire">Hire</Link>
          </div>

          {/* Mobile: theme icon + burger */}
          <div className="md:hidden flex items-center gap-4">
            <button onClick={toggleTheme}
              className="dark:text-slate-400 text-slate-500 hover:text-accent transition-colors text-sm"
              aria-label="Toggle theme">
              {dark
                ? <i className="fas fa-sun" />
                : <i className="fas fa-moon" />
              }
            </button>
            <button onClick={() => setOpen(!open)}
              className="dark:text-slate-400 text-slate-600 hover:text-accent transition-colors">
              <i className={`fas ${open ? 'fa-xmark' : 'fa-bars'} text-lg`} />
            </button>
          </div>
        </div>

        {/* Mobile menu */}
        <div className={`md:hidden overflow-hidden transition-all duration-150
                         dark:bg-dark-card bg-white
                         border-t dark:border-dark-border border-slate-200
                         px-6 space-y-1
                         ${open ? 'max-h-96 opacity-100 py-4' : 'max-h-0 opacity-0'}`}>
          {navLinks.map((link) => (
            <Link key={link.href} href={link.href}
              onClick={() => setOpen(false)}
              className={`flex items-center gap-2 text-xs uppercase tracking-widest
                         py-2.5 border-b dark:border-dark-border border-slate-100
                         transition-colors
                         ${isActive(link.href)
                           ? 'text-accent'
                           : 'dark:text-slate-400 text-slate-600 hover:text-accent'}`}>
              {link.label}
            </Link>
          ))}
          <Link href="/contact" onClick={() => setOpen(false)}
            className="block mt-3 text-center btn-hire w-full">
            Hire Me
          </Link>
        </div>
      </nav>

      {/* Scroll-to-top */}
      <button
        onClick={() => window.scrollTo({ top: 0, behavior: 'smooth' })}
        aria-label="Back to top"
        className={`fixed bottom-6 right-6 z-50 w-10 h-10 rounded-full
                    bg-accent text-dark-bg
                    flex items-center justify-center
                    shadow-lg hover:brightness-110 transition-all duration-300
                    ${showTopBtn ? 'opacity-100 translate-y-0 pointer-events-auto'
                                 : 'opacity-0 translate-y-4 pointer-events-none'}`}>
        <i className="fas fa-chevron-up text-sm" />
      </button>

      {/* Flash toast */}
      {showToast && (
        <div className="fixed bottom-20 right-6 z-50 flex items-center gap-3
                        dark:bg-dark-card bg-white
                        border dark:border-accent/30 border-cyan-300
                        text-accent px-5 py-3 rounded-xl shadow-2xl text-sm font-mono">
          <i className="fas fa-check-circle" />
          <span>{toast}</span>
          <button onClick={() => setShowToast(false)}
            className="ml-2 opacity-60 hover:opacity-100 transition-opacity">
            <i className="fas fa-xmark text-xs" />
          </button>
        </div>
      )}

      {/* Page content */}
      <main className="pt-14 animate-fade-up">
        {children}
      </main>

      {/* Footer */}
      <footer className="dark:bg-dark-card bg-slate-100 border-t dark:border-dark-border border-slate-200 py-8">
        <div className="max-w-7xl mx-auto px-6
                        flex flex-col md:flex-row items-center justify-between gap-4">
          <span className="font-mono text-xs text-accent tracking-widest uppercase">
            KIAN.BECERA
          </span>
          <p className="text-xs dark:text-dark-muted text-slate-400">
            &copy; {new Date().getFullYear()} {config.name}. 
            Built with{' '}
            <span className="text-accent">Next.js</span> &amp;{' '}
            <span className="text-accent">Tailwind CSS</span>
          </p>
          <div className="flex gap-5">
            <a href={config.github}   target="_blank" rel="noreferrer"
               className="dark:text-dark-muted text-slate-400 hover:text-accent transition-colors text-sm">
              <i className="fab fa-github" />
            </a>
            <a href={config.linkedin} target="_blank" rel="noreferrer"
               className="dark:text-dark-muted text-slate-400 hover:text-accent transition-colors text-sm">
              <i className="fab fa-linkedin" />
            </a>
            <a href={config.twitter}  target="_blank" rel="noreferrer"
               className="dark:text-dark-muted text-slate-400 hover:text-accent transition-colors text-sm">
              <i className="fab fa-x-twitter" />
            </a>
          </div>
        </div>
      </footer>
    </>
  );
}
