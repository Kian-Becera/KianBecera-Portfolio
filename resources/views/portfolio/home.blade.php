@extends('layouts.app')
@section('title', $name . ' — Software Engineer')

@section('content')

{{-- ═══════════════════════════════════════ HERO ════ --}}
<section class="relative min-h-[calc(100vh-3.5rem)] flex flex-col
                justify-center dot-grid overflow-hidden">

    {{-- Ambient glow blobs --}}
    <div class="pointer-events-none absolute -top-40 -left-40
                w-[500px] h-[500px] dark:bg-accent/5 bg-cyan-300/10
                rounded-full blur-3xl"></div>
    <div class="pointer-events-none absolute bottom-0 right-0
                w-96 h-96 dark:bg-accent/5 bg-cyan-100/30
                rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-6 py-24 w-full">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            {{-- Left: copy --}}
            <div class="animate-fade-up">

                {{-- Available badge --}}
                <div class="inline-flex items-center gap-2
                            dark:bg-dark-card bg-white
                            border dark:border-dark-border border-slate-200
                            rounded-full px-4 py-1.5 mb-8 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                    <span class="font-mono text-xs text-accent tracking-widest uppercase">
                        Available for projects
                    </span>
                </div>

                {{-- Headline --}}
                <h1 class="font-bold leading-[1.05] dark:text-white text-slate-900 mb-6">
                    <span class="block text-5xl md:text-6xl lg:text-7xl tracking-tight">CODE</span>
                    <span class="block text-5xl md:text-6xl lg:text-7xl tracking-tight">THAT</span>
                    <span class="block text-5xl md:text-6xl lg:text-7xl tracking-tight italic
                                 text-accent glow-accent">DRIVES</span>
                    <span class="block text-5xl md:text-6xl lg:text-7xl tracking-tight">RESULTS.</span>
                </h1>

                <p class="dark:text-dark-muted text-slate-500 max-w-lg leading-relaxed mb-10">
                    {{ $tagline }}
                </p>

                {{-- CTA buttons --}}
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('projects') }}"
                       class="inline-flex items-center gap-2
                              bg-accent text-dark-bg font-semibold text-sm
                              px-6 py-3 rounded transition-all hover:brightness-110">
                        Explore Work <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                    <a href="{{ route('about') }}"
                       class="inline-flex items-center gap-2
                              dark:bg-dark-card bg-white
                              border dark:border-dark-border border-slate-200
                              dark:text-slate-300 text-slate-700
                              font-semibold text-sm px-6 py-3 rounded shadow-sm
                              hover:border-accent hover:text-accent transition-all">
                        KIAN.BECERA
                    </a>
                </div>

                {{-- Social icons --}}
                <div class="flex gap-5 mt-10">
                    <a href="{{ $github }}" target="_blank"
                       class="dark:text-dark-muted text-slate-400 hover:text-accent transition-colors">
                        <i class="fab fa-github text-lg"></i></a>
                    <a href="{{ $linkedin }}" target="_blank"
                       class="dark:text-dark-muted text-slate-400 hover:text-accent transition-colors">
                        <i class="fab fa-linkedin text-lg"></i></a>
                    <a href="{{ $twitter }}" target="_blank"
                       class="dark:text-dark-muted text-slate-400 hover:text-accent transition-colors">
                        <i class="fab fa-x-twitter text-lg"></i></a>
                    <a href="mailto:{{ $email }}"
                       class="dark:text-dark-muted text-slate-400 hover:text-accent transition-colors">
                        <i class="fas fa-envelope text-lg"></i></a>
                </div>
            </div>

            {{-- Right: stats + mini diff --}}
            <div class="hidden lg:flex flex-col gap-4 animate-fade-up
                        [animation-delay:.15s]">

                {{-- Stats card --}}
                <div class="dark:bg-dark-card bg-white
                            border dark:border-dark-border border-slate-200
                            rounded-2xl p-6 shadow-xl">
                    <p class="font-mono text-xs text-accent tracking-widest uppercase mb-4">
                        // engineer.status
                    </p>
                    <script>
                        window.scrambleStat = function (el, finalText, delay) {
                            var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ+ms';
                            setTimeout(function () {
                                var frame = 0;
                                var total = finalText.length;
                                var totalFrames = Math.max(50, total * 6);
                                var tick = function () {
                                    var resolved = Math.floor((frame / totalFrames) * total);
                                    var out = '';
                                    for (var i = 0; i < total; i++) {
                                        var c = finalText[i];
                                        if (i < resolved) {
                                            out += c;
                                        } else if (/[\w+]/.test(c)) {
                                            out += chars[Math.floor(Math.random() * chars.length)];
                                        } else {
                                            out += c;
                                        }
                                    }
                                    el.textContent = out;
                                    frame++;
                                    if (frame <= totalFrames) {
                                        setTimeout(tick, 40);
                                    } else {
                                        el.textContent = finalText;
                                    }
                                };
                                tick();
                            }, delay);
                        };
                    </script>

                    <div class="grid grid-cols-3 gap-4">
                        @foreach([['3+','Years Exp.'],['10+','Projects'],['12ms','Avg Latency']] as $si => $stat)
                            <div class="text-center p-3
                                        dark:bg-dark-bg bg-slate-50
                                        rounded-xl">
                                <p class="text-2xl font-bold text-accent font-mono"
                                   x-data
                                   x-init="scrambleStat($el, '{{ $stat[0] }}', {{ $si * 200 }})">
                                    {{ $stat[0] }}
                                </p>
                                <p class="text-xs dark:text-dark-muted text-slate-500 mt-1">{{ $stat[1] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Mini code diff --}}
                <div class="code-block p-5">
                    <p class="dark:text-dark-muted text-slate-500 text-xs mb-2">
                        // latest_commit.diff
                    </p>
                    <p>
                        <span class="text-emerald-400">+</span>
                        <span class="dark:text-slate-400 text-slate-500">feat(ui):</span>
                        <span class="dark:text-white text-slate-200"> gallery, footer & specials page — pixel-perfect layouts delivered</span>
                    </p>
                    <p>
                        <span class="text-emerald-400">+</span>
                        <span class="dark:text-slate-400 text-slate-500">perf(env):</span>
                        <span class="dark:text-white text-slate-200">docker migration complete — local env now containerized & clean</span>
                    </p>
                    <p>
                        <span class="text-red-400">-</span>
                        <span class="dark:text-slate-500 text-slate-600">chore: cms</span>
                    </p>
                    <p class="mt-3 text-accent font-mono text-xs">
                        ▸ WordPress 6.9.1 upgraded & Elementor wired in
                        {{-- <span class="text-emerald-400">+247 −83</span> --}}
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════ TECH STACK ════ --}}
<section class="py-20 dark:bg-dark-card/50 bg-white
                border-y dark:border-dark-border border-slate-100">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-center gap-4 mb-10">
            <p class="font-mono text-xs text-accent tracking-widest uppercase whitespace-nowrap">
                Technological Stack
            </p>
            <div class="flex-1 accent-line opacity-40"></div>
        </div>

        <div class="grid md:grid-cols-3 gap-5">
            @foreach($techStack as $tech)
                <div class="dark:bg-dark-bg bg-slate-50
                            border dark:border-dark-border border-slate-200
                            rounded-2xl p-6 card-lift group
                            transition-all duration-300
                            hover:border-accent/40 hover:dark:bg-dark-card">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center text-xl
                                    transition-all duration-300
                                    group-hover:w-12 group-hover:h-12 group-hover:rounded-xl
                                    group-hover:shadow-[0_0_18px_rgba(0,229,204,.2)]"
                             style="background:{{ $tech['color'] }}1a; color:{{ $tech['color'] }}">
                            <i class="{{ $tech['icon'] }}
                                      transition-transform duration-300 group-hover:scale-125"></i>
                        </div>
                        <h3 class="font-semibold dark:text-white text-slate-800 text-sm
                                   transition-all duration-300
                                   group-hover:text-accent group-hover:tracking-wider">
                            {{ $tech['name'] }}
                        </h3>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tech['tags'] as $t)
                            <span class="tag transition-all duration-200
                                         group-hover:dark:bg-accent/[.14] group-hover:dark:border-accent/40">
                                {{ $t }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════ FEATURED PROJECTS ════ --}}
<section class="py-24">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-end justify-between mb-12">
            <div>
                <p class="font-mono text-xs text-accent tracking-widest uppercase mb-2">
                    // featured_work
                </p>
                <h2 class="text-3xl font-bold dark:text-white text-slate-900">
                    Selected Projects
                </h2>
            </div>
            <a href="{{ route('projects') }}"
               class="hidden sm:block text-xs font-mono text-accent
                      hover:underline tracking-widest uppercase">
                View All →
            </a>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            @foreach($featured as $project)
                <a href="{{ route('project.detail', $project['slug']) }}"
                   class="group dark:bg-dark-card bg-white
                          border dark:border-dark-border border-slate-200
                          rounded-2xl overflow-hidden card-lift shadow-sm block">

                    {{-- Card thumbnail --}}
                    <div class="h-48 dark:bg-dark-bg bg-slate-100
                                relative flex items-center justify-center overflow-hidden">
                        <div class="absolute inset-0 dot-grid"></div>
                        <div class="relative z-10 text-center">
                            <p class="font-mono text-2xl font-bold
                                      dark:text-white text-slate-700
                                      group-hover:text-accent transition-colors">
                                {{ $project['title'] }}
                            </p>
                            <p class="text-xs dark:text-dark-muted text-slate-500
                                      mt-1 uppercase tracking-widest">
                                {{ $project['category'] }}
                            </p>
                        </div>
                        <span class="absolute top-4 right-4 font-mono text-xs
                                     dark:text-dark-muted text-slate-400">
                            {{ $project['year'] }}
                        </span>
                    </div>

                    <div class="p-6">
                        <p class="dark:text-slate-400 text-slate-600
                                  text-sm leading-relaxed mb-4">
                            {{ $project['description'] }}
                        </p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach(array_slice($project['tags'], 0, 4) as $t)
                                <span class="tag">{{ $t }}</span>
                            @endforeach
                        </div>
                        <span class="text-xs text-accent font-mono group-hover:underline">
                            View case study →
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════ CTA STRIP ════ --}}
<section class="py-20 dark:bg-dark-card bg-slate-50
                border-y dark:border-dark-border border-slate-200">
    <div class="max-w-7xl mx-auto px-6
                flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <p class="font-mono text-xs text-accent tracking-widest uppercase mb-1">
                Ready to collaborate?
            </p>
            <h3 class="text-2xl font-bold dark:text-white text-slate-900">
                Let's build something exceptional.
            </h3>
        </div>
        <a href="{{ route('contact') }}"
           class="shrink-0 inline-flex items-center gap-2
                  bg-accent text-dark-bg font-bold text-sm
                  px-8 py-3 rounded hover:brightness-110 transition-all whitespace-nowrap">
            Start a Project <i class="fas fa-arrow-right text-xs"></i>
        </a>
    </div>
</section>

@endsection
