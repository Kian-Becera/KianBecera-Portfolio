import { useState } from 'react';
import Link from 'next/link';
import Layout from '../components/Layout';
import { config } from '../data/portfolio';

const CHANNELS = [
  { icon: 'fas fa-envelope',  label: 'Email',    value: config.email,        href: `mailto:${config.email}` },
  { icon: 'fab fa-x-twitter', label: 'Twitter',  value: '@kyaa_nnn',         href: config.twitter },
  { icon: 'fab fa-github',    label: 'GitHub',   value: '@Kian-Becera',      href: config.github },
  { icon: 'fab fa-linkedin',  label: 'LinkedIn', value: 'in/kian-becera',    href: config.linkedin },
];

export default function Contact() {
  const [form, setForm]       = useState({ name: '', email: '', inquiry: '', message: '' });
  const [errors, setErrors]   = useState({});
  const [loading, setLoading] = useState(false);
  const [toast, setToast]     = useState('');

  const validate = () => {
    const e = {};
    if (!form.name.trim())                       e.name    = 'Name is required.';
    if (!form.email.trim())                      e.email   = 'Email is required.';
    else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email)) e.email = 'Invalid email address.';
    if (!form.message.trim())                    e.message = 'Message is required.';
    return e;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    const errs = validate();
    if (Object.keys(errs).length) { setErrors(errs); return; }

    setLoading(true);
    setErrors({});
    try {
      const res = await fetch('/api/contact', {
        method:  'POST',
        headers: { 'Content-Type': 'application/json' },
        body:    JSON.stringify(form),
      });
      if (res.ok) {
        setForm({ name: '', email: '', inquiry: '', message: '' });
        setToast("Transmission received. I'll respond within 24 hours.");
        setTimeout(() => setToast(''), 5000);
      } else {
        const data = await res.json();
        setErrors({ submit: data.message || 'Something went wrong. Please try again.' });
      }
    } catch {
      setErrors({ submit: 'Network error. Please try again.' });
    } finally {
      setLoading(false);
    }
  };

  return (
    <Layout toast={toast} title="Contact — KIAN BECERA">
      {/* ════ HERO ════ */}
      <section className="relative py-24 dark:bg-dark-card bg-slate-50
                          border-b dark:border-dark-border border-slate-200
                          dot-grid overflow-hidden">
        <div className="pointer-events-none absolute -top-40 -right-40
                        w-[500px] h-[500px] dark:bg-accent/5 bg-cyan-300/10
                        rounded-full blur-3xl" />
        <div className="max-w-7xl mx-auto px-6 animate-fade-up">
          <p className="font-mono text-xs text-accent tracking-widest uppercase mb-4">
            // get_in_touch
          </p>
          <h1 className="text-6xl md:text-7xl lg:text-8xl font-bold
                         dark:text-white text-slate-900 leading-[1] mb-2">
            LET&apos;S<br />BUILD.
          </h1>
          <p className="dark:text-dark-muted text-slate-500 mt-4 max-w-md">
            Transforming your vision into a high-performance digital presence.
          </p>
          <div className="accent-line w-32 mt-8" />
        </div>
      </section>

      {/* ════ BODY ════ */}
      <section className="py-20 overflow-x-hidden">
        <div className="max-w-7xl mx-auto px-6">
          <div className="grid lg:grid-cols-5 gap-10">

            {/* ── Contact form ── */}
            <div className="lg:col-span-3 animate-fade-up">
              <h2 className="font-mono text-xs text-accent tracking-widest uppercase mb-6">
                // initiate_inquiry
              </h2>

              {/* Validation errors */}
              {(Object.keys(errors).length > 0) && (
                <div className="dark:bg-red-900/20 bg-red-50
                                border border-red-400/40
                                rounded-xl p-4 mb-6 text-sm text-red-400">
                  {Object.values(errors).map((err, i) => (
                    <p key={i} className="flex items-center gap-2">
                      <i className="fas fa-triangle-exclamation" />{err}
                    </p>
                  ))}
                </div>
              )}

              <form onSubmit={handleSubmit}
                className="dark:bg-dark-card bg-white
                           border dark:border-dark-border border-slate-200
                           rounded-2xl p-8 shadow-sm space-y-5">

                {/* Name + Email */}
                <div className="grid sm:grid-cols-2 gap-5">
                  <div>
                    <label className="block font-mono text-xs dark:text-dark-muted text-slate-500
                                      uppercase tracking-widest mb-2">Name</label>
                    <input type="text" value={form.name}
                      onChange={(e) => setForm({ ...form, name: e.target.value })}
                      placeholder=" Ex. Juan Dela Cruz"
                      className={`field ${errors.name ? '!border-red-500' : ''}`} />
                  </div>
                  <div>
                    <label className="block font-mono text-xs dark:text-dark-muted text-slate-500
                                      uppercase tracking-widest mb-2">Email</label>
                    <input type="email" value={form.email}
                      onChange={(e) => setForm({ ...form, email: e.target.value })}
                      placeholder="juandelacruz@gmail.com"
                      className={`field ${errors.email ? '!border-red-500' : ''}`} />
                  </div>
                </div>

                {/* Budget */}
                <div>
                  <label className="block font-mono text-xs dark:text-dark-muted text-slate-500
                                    uppercase tracking-widest mb-2">Purpose of Inquiry</label>
                  <select value={form.inquiry}
                    onChange={(e) => setForm({ ...form, inquiry: e.target.value })}
                    className="field max-w-full">
                    <option value=""              className="dark:bg-dark-bg bg-white">Select a purpose</option>
                    <option value="Freelance"     className="dark:bg-dark-bg bg-white">Freelance Project</option>
                    <option value="Recruitment"   className="dark:bg-dark-bg bg-white">Recruitment / Job Offer</option>
                    <option value="Consultation"  className="dark:bg-dark-bg bg-white">Consultation</option>
                    <option value="Collaboration" className="dark:bg-dark-bg bg-white">Collaboration</option>
                    <option value="Other"         className="dark:bg-dark-bg bg-white">Other</option>
                  </select>
                </div>

                {/* Message */}
                <div>
                  <label className="block font-mono text-xs dark:text-dark-muted text-slate-500
                                    uppercase tracking-widest mb-2">Message</label>
                  <textarea rows={6} value={form.message}
                    onChange={(e) => setForm({ ...form, message: e.target.value })}
                    placeholder="Tell me about your project…"
                    className={`field resize-none ${errors.message ? '!border-red-500' : ''}`} />
                </div>

                {/* Submit */}
                <button type="submit" disabled={loading}
                  className="w-full bg-accent text-dark-bg font-bold text-sm
                             py-3.5 rounded-lg hover:brightness-110 transition-all
                             disabled:opacity-50 disabled:cursor-not-allowed
                             flex items-center justify-center gap-2">
                  {loading ? (
                    <><i className="fas fa-circle-notch fa-spin mr-2" />Transmitting…</>
                  ) : (
                    <>Transmit Message <i className="fas fa-paper-plane ml-1" /></>
                  )}
                </button>
              </form>
            </div>

            {/* ── Sidebar ── */}
            <div className="lg:col-span-2 space-y-5 animate-fade-up [animation-delay:.12s]">

              {/* Identity card */}
              <div className="dark:bg-dark-card bg-white
                              border dark:border-dark-border border-slate-200
                              rounded-2xl p-6 shadow-sm">
                <h2 className="font-mono text-xs text-accent tracking-widest uppercase mb-4">
                  // byte_identity
                </h2>
                <div className="flex items-center gap-4 mb-4">
                  <div className="w-14 h-14 rounded-xl
                                  dark:bg-dark-bg bg-slate-100
                                  border dark:border-dark-border border-slate-200
                                  flex items-center justify-center shrink-0">
                    <i className="fas fa-user-astronaut text-accent text-xl" />
                  </div>
                  <div>
                    <p className="font-bold dark:text-white text-slate-900">{config.name}</p>
                    <p className="text-xs dark:text-dark-muted text-slate-500">{config.role}</p>
                  </div>
                </div>
                <div className="flex items-center gap-2">
                  <span className="w-2 h-2 rounded-full bg-accent animate-pulse shrink-0" />
                  <span className="font-mono text-xs text-accent">Available for new projects</span>
                </div>
                <p className="text-xs dark:text-dark-muted text-slate-500 mt-1">
                  Response time: &lt; 24 hours
                </p>
              </div>

              {/* Direct channels */}
              <div className="dark:bg-dark-card bg-white
                              border dark:border-dark-border border-slate-200
                              rounded-2xl p-6 shadow-sm">
                <h2 className="font-mono text-xs text-accent tracking-widest uppercase mb-4">
                  // direct_channels
                </h2>
                <div className="space-y-3">
                  {CHANNELS.map((ch) => (
                    <a key={ch.label} href={ch.href} target="_blank" rel="noreferrer"
                      className="flex items-center gap-3 p-3
                                 dark:bg-dark-bg bg-slate-50
                                 border dark:border-dark-border border-slate-200
                                 rounded-xl hover:border-accent
                                 group transition-all">
                      <div className="w-8 h-8 rounded-lg dark:bg-dark-card bg-white
                                      flex items-center justify-center shrink-0">
                        <i className={`${ch.icon} text-accent text-xs`} />
                      </div>
                      <div className="min-w-0 flex-1">
                        <p className="text-xs dark:text-dark-muted text-slate-400">{ch.label}</p>
                        <p className="text-sm dark:text-slate-300 text-slate-700
                                      font-medium group-hover:text-accent
                                      transition-colors truncate">
                          {ch.value}
                        </p>
                      </div>
                      <i className="fas fa-arrow-right text-[10px]
                                    dark:text-dark-muted text-slate-400
                                    group-hover:text-accent transition-colors shrink-0" />
                    </a>
                  ))}
                </div>
              </div>

              {/* Map placeholder */}
              <div className="dark:bg-dark-card bg-white
                              border dark:border-dark-border border-slate-200
                              rounded-2xl overflow-hidden shadow-sm">
                <div className="h-40 dark:bg-dark-bg bg-slate-100
                                relative flex items-center justify-center dot-grid">
                  <div className="pointer-events-none absolute inset-0
                                  bg-gradient-to-t dark:from-dark-card from-white to-transparent" />
                  <div className="relative z-10 text-center">
                    <i className="fas fa-location-dot text-accent text-2xl mb-2 block" />
                    <p className="font-mono text-sm dark:text-white text-slate-800 font-bold">
                      {config.location}
                    </p>
                  </div>
                </div>
                <div className="px-5 py-3 border-t dark:border-dark-border border-slate-200">
                  <p className="text-xs dark:text-dark-muted text-slate-500">
                    Operating Globally from {config.location}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </Layout>
  );
}
