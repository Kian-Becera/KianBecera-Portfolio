<!DOCTYPE html>
<html lang="en" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', ($name ?? 'Portfolio') . ' — KIAN BECERA')</title>

    {{-- ① Prevent FOUC: run BEFORE any CSS or JS loads --}}
    <script>
        (function () {
            var saved = localStorage.getItem('theme');
            if (saved === 'light') {
                document.documentElement.classList.remove('dark');
            } else {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    {{-- ② Tailwind Play CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        accent:       '#00e5cc',
                        'dark-bg':    '#060c1a',
                        'dark-card':  '#0d1526',
                        'dark-border':'#162032',
                        'dark-muted': '#6b7a99',
                    },
                    fontFamily: {
                        sans: ['Space Grotesk', 'Inter', 'ui-sans-serif'],
                        mono: ['JetBrains Mono', 'Fira Code', 'ui-monospace'],
                    },
                    keyframes: {
                        fadeUp: {
                            from: { opacity: '0', transform: 'translateY(20px)' },
                            to:   { opacity: '1', transform: 'translateY(0)'    },
                        },
                    },
                    animation: {
                        'fade-up': 'fadeUp .6s ease both',
                    },
                },
            },
        }
    </script>

    {{-- ③ Component classes via @apply (processed by Tailwind Play CDN) --}}
    <style type="text/tailwindcss">
        /* ─── Hide Alpine cloak ─────────────────────────── */
        [x-cloak] { display: none !important; }

        /* ─── Dot-grid background (no Tailwind equivalent) ─ */
        .dot-grid {
            background-image: radial-gradient(circle, rgba(0,229,204,.06) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        /* ─── Accent text-shadow (Tailwind has no text-shadow) */
        .glow-accent { text-shadow: 0 0 40px rgba(0,229,204,.4); }

        /* ─── Resume modal gate gradient (dark / light aware) ── */
        :root                { --gate-bg: rgba(255,255,255,0);   --gate-solid: #ffffff; }
        :root.dark           { --gate-bg: rgba(13,21,38,0);      --gate-solid: #0d1526; }

        /* ─── Hide scrollbars visually while keeping scroll function ── */
        .no-scrollbar { scrollbar-width: none; -ms-overflow-style: none; }
        .no-scrollbar::-webkit-scrollbar { display: none; }

        /* ─── Scroll-reveal: initial hidden state set by JS ── */
        .card-lift { will-change: opacity, transform; }

        /* ─── Ticker / marquee (train-station scroll) ── */
        @keyframes ticker {
            0%   { transform: translateX(110%); }
            100% { transform: translateX(-110%); }
        }
        .ticker {
            display: inline-block;
            white-space: nowrap;
            animation: ticker 14s linear infinite;
        }

        /* ─── All remaining components use @apply ─────────── */

        .accent-line {
            @apply h-0.5 bg-gradient-to-r from-accent to-transparent;
        }

        .nav-glass {
            @apply dark:bg-dark-bg/90 bg-white/95 backdrop-blur-lg;
        }

        .card-lift {
            @apply transition-all duration-200 hover:-translate-y-1.5
                   dark:hover:shadow-[0_20px_48px_rgba(0,229,204,.07)]
                   hover:shadow-xl;
        }

        .tag {
            @apply inline-flex items-center px-2.5 py-0.5 rounded-full
                   text-[.7rem] font-medium tracking-widest uppercase;
            @apply dark:bg-accent/[.08] dark:text-accent dark:border dark:border-accent/[.2];
            @apply bg-cyan-50 text-cyan-700 border border-cyan-200;
        }

        .code-block {
            @apply font-mono text-xs leading-relaxed overflow-x-auto rounded-xl;
            @apply dark:bg-[#020810] bg-slate-900 text-slate-300;
            @apply border dark:border-dark-border border-slate-700;
        }

        .field {
            @apply w-full rounded-lg px-4 py-3 outline-none transition-all font-sans;
            @apply dark:bg-dark-bg/80 dark:border dark:border-dark-border
                   dark:text-slate-200 dark:placeholder:text-dark-muted
                   dark:focus:border-accent dark:focus:ring-1 dark:focus:ring-accent/30;
            @apply bg-slate-50 border border-slate-200
                   text-slate-800 placeholder:text-slate-400
                   focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500/20;
        }

        .btn-hire {
            @apply border text-[.75rem] font-semibold tracking-widest uppercase
                   px-4 py-1.5 rounded transition-all;
            @apply dark:border-accent dark:text-accent
                   dark:hover:bg-accent dark:hover:text-dark-bg;
            @apply border-cyan-600 text-cyan-600
                   hover:bg-cyan-600 hover:text-white;
        }
    </style>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- ④ Alpine store — toggle adds/removes 'dark' on <html> directly --}}
    <script>
        document.addEventListener('alpine:init', function () {
            Alpine.store('theme', {
                dark: document.documentElement.classList.contains('dark'),

                toggle: function () {
                    this.dark = !this.dark;
                    document.documentElement.classList.toggle('dark', this.dark);
                    localStorage.setItem('theme', this.dark ? 'dark' : 'light');
                },
            });
        });
    </script>

    @stack('head')
</head>

<body class="font-sans antialiased transition-colors duration-300
             dark:bg-dark-bg dark:text-slate-300
             bg-[#f0f4f8] text-slate-700">

    {{-- ════════════════════════════════ NAV ════ --}}
    <nav x-data="{ open: false }"
         class="nav-glass fixed top-0 inset-x-0 z-50
                border-b dark:border-dark-border border-slate-200/80">
        <div class="max-w-7xl mx-auto px-6 h-14 flex items-center justify-between gap-6">

            {{-- Logo --}}
            <a href="{{ route('home') }}"
               class="flex items-center gap-2 font-mono text-sm font-semibold
                      tracking-widest uppercase text-accent shrink-0">
                <span class="w-5 h-5 border border-accent/70 rounded-sm
                             flex items-center justify-center text-[9px] font-bold">
                    K
                </span>
                KIAN.BECERA
            </a>

            {{-- Desktop nav links --}}
            <ul class="hidden md:flex items-center gap-7 text-xs font-medium tracking-widest uppercase">
                @foreach([
                    ['label' => 'Projects',   'href' => route('projects'),                    'active' => 'projects'],
                    ['label' => 'Experience', 'href' => route('experience'),                   'active' => 'experience'],
                    ['label' => 'About',      'href' => route('about'),                        'active' => 'about'],
                    ['label' => 'Contact',    'href' => route('contact'),                      'active' => 'contact'],
                ] as $link)
                    <li>
                        <a href="{{ $link['href'] }}"
                           class="transition-colors duration-200
                                  {{ $link['active'] && request()->routeIs($link['active'])
                                     ? 'text-accent'
                                     : 'dark:text-slate-400 text-slate-500
                                        hover:dark:text-white hover:text-slate-900' }}">
                            {{ $link['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- Desktop right: toggle + hire --}}
            <div class="hidden md:flex items-center gap-4 shrink-0">

                {{-- ── Theme Toggle ── --}}
                <div class="flex items-center gap-2.5">
                    {{-- Sun icon --}}
                    <i class="fas fa-sun text-[11px]
                              dark:text-dark-muted text-yellow-500
                              transition-colors duration-300"></i>

                    {{-- Toggle switch --}}
                    <button @click="$store.theme.toggle()"
                            class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer
                                   items-center rounded-full border-2 transition-colors duration-300
                                   focus:outline-none focus-visible:ring-2 focus-visible:ring-accent/40
                                   dark:border-accent/30 dark:bg-accent/[.15]
                                   border-slate-300 bg-slate-200"
                            :aria-label="$store.theme.dark ? 'Switch to light mode' : 'Switch to dark mode'">
                        {{-- Knob --}}
                        <span :class="$store.theme.dark ? 'translate-x-[22px]' : 'translate-x-[3px]'"
                              class="pointer-events-none inline-block h-[14px] w-[14px] transform
                                     rounded-full shadow-md transition-transform duration-300
                                     dark:bg-accent bg-slate-500">
                        </span>
                    </button>

                    {{-- Moon icon --}}
                    <i class="fas fa-moon text-[11px]
                              dark:text-accent text-slate-400
                              transition-colors duration-300"></i>
                </div>

                <a href="{{ route('contact') }}" class="btn-hire">Hire</a>
            </div>

            {{-- Mobile: theme icon + burger --}}
            <div class="md:hidden flex items-center gap-4">
                <button @click="$store.theme.toggle()"
                        class="dark:text-slate-400 text-slate-500
                               hover:text-accent transition-colors text-sm"
                        aria-label="Toggle theme">
                    <i x-show="$store.theme.dark"  class="fas fa-sun"></i>
                    <i x-show="!$store.theme.dark" x-cloak class="fas fa-moon"></i>
                </button>
                <button @click="open = !open"
                        class="dark:text-slate-400 text-slate-600 hover:text-accent transition-colors">
                    <i :class="open ? 'fa-xmark' : 'fa-bars'" class="fas text-lg"></i>
                </button>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div x-show="open" x-cloak
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden dark:bg-dark-card bg-white
                    border-t dark:border-dark-border border-slate-200
                    px-6 py-4 space-y-1">
            @foreach([
                ['label' => 'Projects',   'href' => route('projects'),                   'active' => 'projects'],
                ['label' => 'Experience', 'href' => route('about') . '#work-history',     'active' => null],
                ['label' => 'About',      'href' => route('about'),                       'active' => 'about'],
                ['label' => 'Contact',    'href' => route('contact'),                     'active' => 'contact'],
            ] as $link)
                <a href="{{ $link['href'] }}" @click="open = false"
                   class="flex items-center gap-2 text-xs uppercase tracking-widest
                          py-2.5 border-b dark:border-dark-border border-slate-100
                          transition-colors
                          {{ $link['active'] && request()->routeIs($link['active'])
                             ? 'text-accent'
                             : 'dark:text-slate-400 text-slate-600 hover:text-accent' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
            <a href="{{ route('contact') }}"
               class="block mt-3 text-center btn-hire w-full">Hire Me</a>
        </div>
    </nav>

    {{-- Flash toast --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-cloak
             x-init="setTimeout(() => show = false, 5000)"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-end="opacity-0 translate-y-2"
             class="fixed bottom-6 right-6 z-50 flex items-center gap-3
                    dark:bg-dark-card bg-white
                    border dark:border-accent/30 border-cyan-300
                    text-accent px-5 py-3 rounded-xl shadow-2xl text-sm font-mono">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
            <button @click="show = false"
                    class="ml-2 opacity-60 hover:opacity-100 transition-opacity">
                <i class="fas fa-xmark text-xs"></i>
            </button>
        </div>
    @endif

    {{-- Page content --}}
    <main class="pt-14 animate-fade-up">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="dark:bg-dark-card bg-slate-100
                   border-t dark:border-dark-border border-slate-200 py-8">
        <div class="max-w-7xl mx-auto px-6
                    flex flex-col md:flex-row items-center justify-between gap-4">
            <span class="font-mono text-xs text-accent tracking-widest uppercase">
                KIAN.BECERA
            </span>
            <p class="text-xs dark:text-dark-muted text-slate-400">
                &copy; {{ date('Y') }} {{ $name ?? 'Alex Morgan' }}
                — Created in
                <span class="text-[#fd366e]">Stitch. </span>
                Built with
                <span class="text-accent">Laravel</span> &amp;
                <span class="text-accent">Tailwind CSS</span>
            </p>
            <div class="flex gap-5">
                <a href="{{ $github   ?? '#' }}" target="_blank"
                   class="dark:text-dark-muted text-slate-400 hover:text-accent transition-colors text-sm">
                    <i class="fab fa-github"></i>
                </a>
                <a href="{{ $linkedin ?? '#' }}" target="_blank"
                   class="dark:text-dark-muted text-slate-400 hover:text-accent transition-colors text-sm">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="{{ $twitter  ?? '#' }}" target="_blank"
                   class="dark:text-dark-muted text-slate-400 hover:text-accent transition-colors text-sm">
                    <i class="fab fa-x-twitter"></i>
                </a>
            </div>
        </div>
    </footer>

    @stack('scripts')

    <script>
        (function () {
            var ticking = false;
            function update() {
                var wh = window.innerHeight;
                document.querySelectorAll('.card-lift').forEach(function (el) {
                    var rect = el.getBoundingClientRect();
                    var start = wh * 0.95;
                    var end   = wh * 0.45;
                    var progress = Math.max(0, Math.min(1, (start - rect.top) / (start - end)));
                    el.style.opacity   = progress;
                    el.style.transform = 'translateY(' + ((1 - progress) * 52) + 'px)';
                });
                ticking = false;
            }
            function onScroll() {
                if (!ticking) { requestAnimationFrame(update); ticking = true; }
            }
            window.addEventListener('scroll', onScroll, { passive: true });
            document.addEventListener('DOMContentLoaded', update);
        })();
    </script>
</body>
</html>
