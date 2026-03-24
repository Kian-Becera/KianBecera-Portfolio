<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $name . ' — Portfolio')</title>
    <meta name="description" content="@yield('description', $bio ?? 'Personal portfolio website')">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary:  { DEFAULT: '#6366f1', dark: '#4f46e5' },
                        surface:  '#0f172a',
                        card:     '#1e293b',
                        muted:    '#94a3b8',
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                        mono: ['Fira Code', 'ui-monospace'],
                    },
                },
            },
        }
    </script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
        .gradient-text {
            background: linear-gradient(135deg, #6366f1, #a78bfa, #38bdf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .skill-bar { transition: width 1.4s cubic-bezier(.4,0,.2,1); }
        .card-hover { transition: transform .2s, box-shadow .2s; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(99,102,241,.15); }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp .6s ease both; }
    </style>

    @stack('head')
</head>
<body class="bg-[#0f172a] text-slate-300 font-sans antialiased">

    {{-- Navigation --}}
    <nav x-data="{ open: false, scrolled: false }"
         x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 40)"
         :class="scrolled ? 'bg-[#0f172a]/95 backdrop-blur shadow-lg' : 'bg-transparent'"
         class="fixed top-0 inset-x-0 z-50 transition-all duration-300">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="#hero" class="font-mono text-primary font-semibold text-lg tracking-tight">
                &lt;{{ Str::lower(explode(' ', $name)[0]) }} /&gt;
            </a>

            {{-- Desktop links --}}
            <ul class="hidden md:flex items-center gap-8 text-sm font-medium">
                @foreach(['About' => '#about', 'Skills' => '#skills', 'Projects' => '#projects', 'Experience' => '#experience', 'Contact' => '#contact'] as $label => $href)
                    <li>
                        <a href="{{ $href }}"
                           class="text-slate-400 hover:text-white transition-colors duration-200">
                            {{ $label }}
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- Mobile burger --}}
            <button @click="open = !open" class="md:hidden text-slate-400 hover:text-white focus:outline-none">
                <i :class="open ? 'fa-xmark' : 'fa-bars'" class="fas text-xl w-5"></i>
            </button>
        </div>

        {{-- Mobile menu --}}
        <div x-show="open" x-cloak x-transition
             class="md:hidden bg-[#1e293b] border-t border-slate-700 px-6 py-4 space-y-3">
            @foreach(['About' => '#about', 'Skills' => '#skills', 'Projects' => '#projects', 'Experience' => '#experience', 'Contact' => '#contact'] as $label => $href)
                <a href="{{ $href }}" @click="open = false"
                   class="block text-slate-300 hover:text-white py-1 transition-colors">{{ $label }}</a>
            @endforeach
        </div>
    </nav>

    {{-- Flash message --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-cloak
             x-init="setTimeout(() => show = false, 5000)"
             class="fixed bottom-6 right-6 z-50 bg-emerald-600 text-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-3 animate-fade-in-up">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="ml-2 opacity-70 hover:opacity-100">
                <i class="fas fa-xmark"></i>
            </button>
        </div>
    @endif

    @yield('content')

    {{-- Footer --}}
    <footer class="border-t border-slate-800 py-8 text-center text-slate-500 text-sm">
        <p>Built with <span class="text-primary font-medium">Laravel</span> &amp; <span class="text-primary font-medium">Tailwind CSS</span> &mdash; &copy; {{ date('Y') }} {{ $name }}</p>
    </footer>

    @stack('scripts')
</body>
</html>
