@extends('layouts.app')
@section('title', 'About — ARCHITECT.IO')

@section('content')

{{-- ══════════════════════════════ HERO ════ --}}
<section class="relative py-24
                dark:bg-dark-card bg-slate-50
                border-b dark:border-dark-border border-slate-200
                dot-grid overflow-hidden">

    <div class="pointer-events-none absolute top-0 right-0
                w-[500px] h-[500px] dark:bg-accent/5 bg-cyan-200/20
                rounded-full blur-3xl -translate-y-1/2"></div>

    <div class="max-w-7xl mx-auto px-6 animate-fade-up">
        <p class="font-mono text-xs text-accent tracking-widest uppercase mb-4">
            // about_me
        </p>
        <h1 class="text-6xl md:text-7xl lg:text-8xl font-bold
                   dark:text-white text-slate-900 leading-[1] mb-6">
            THE<br>ARCHITECT.
        </h1>
        <div class="accent-line w-32 mb-8"></div>
    </div>
</section>

{{-- ═════════════════════ ABOUT + AVATAR ════ --}}
<section class="py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-start">

            {{-- Avatar card --}}
            <div class="animate-fade-up">
                <div class="relative">
                    <div class="dark:bg-dark-card bg-slate-100
                                border dark:border-dark-border border-slate-200
                                rounded-2xl aspect-[4/5] max-w-sm
                                flex items-center justify-center overflow-hidden shadow-xl">
                        <div class="absolute inset-0 dot-grid opacity-50"></div>
                        <div class="relative text-center z-10">
                            <div class="w-32 h-32 rounded-full
                                        dark:bg-dark-bg bg-slate-200
                                        border-2 border-accent/30
                                        mx-auto flex items-center justify-center mb-4">
                                <i class="fas fa-user-tie text-5xl text-accent/50"></i>
                            </div>
                            <p class="font-mono text-sm font-bold dark:text-white text-slate-800">
                                {{ $name }}
                            </p>
                            <p class="font-mono text-xs text-accent mt-1">{{ $role }}</p>
                        </div>
                    </div>

                    {{-- Location badge --}}
                    <div class="absolute -bottom-4 -right-4
                                dark:bg-dark-bg bg-white
                                border dark:border-dark-border border-slate-200
                                rounded-xl px-4 py-2 shadow-lg
                                flex items-center gap-2">
                        <i class="fas fa-location-dot text-accent text-xs"></i>
                        <span class="font-mono text-xs dark:text-slate-300 text-slate-700">
                            {{ $location }}
                        </span>
                        <span class="text-xs dark:text-dark-muted text-slate-400">· Remote</span>
                    </div>
                </div>
            </div>

            {{-- Bio content --}}
            <div class="animate-fade-up [animation-delay:.1s]">
                <h2 class="text-2xl font-bold dark:text-white text-slate-900 mb-5">
                    I specialize in building high-performance digital systems
                    that bridge the gap between complex logic and intuitive
                    user experiences.
                </h2>

                <div class="space-y-4 dark:text-slate-400 text-slate-600 leading-relaxed">
                    <p>{{ $tagline }}</p>
                    <p>
                        With over 6 years in production environments, I've shipped systems
                        ranging from real-time trading interfaces to distributed ML pipelines —
                        always with a bias toward simplicity and measurable outcomes.
                    </p>
                    <p>
                        I hold a B.Sc in Systems Engineering and believe the best engineers
                        are perpetual students. Currently exploring GPU-accelerated rendering
                        and edge computing paradigms.
                    </p>
                </div>

                {{-- Info grid --}}
                <div class="mt-8 grid grid-cols-2 gap-4">
                    @foreach([
                        ['label'=>'Email',       'value'=>$email,        'icon'=>'fa-envelope'],
                        ['label'=>'Location',    'value'=>$location,     'icon'=>'fa-location-dot'],
                        ['label'=>'GitHub',      'value'=>'@alexmorgan', 'icon'=>'fa-github fab'],
                        ['label'=>'Availability','value'=>'Open to Work','icon'=>'fa-circle-check'],
                    ] as $info)
                        <div class="dark:bg-dark-card bg-slate-50
                                    border dark:border-dark-border border-slate-200
                                    rounded-xl p-4">
                            <p class="text-xs dark:text-dark-muted text-slate-400 mb-1
                                      flex items-center gap-1.5">
                                <i class="{{ str_contains($info['icon'],'fab') ? $info['icon'] : 'fas '.$info['icon'] }}
                                           text-accent text-[10px]"></i>
                                {{ $info['label'] }}
                            </p>
                            <p class="text-sm dark:text-white text-slate-800 font-medium truncate">
                                {{ $info['value'] }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <div class="flex gap-4 mt-8">
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center gap-2
                              bg-accent text-dark-bg font-bold text-sm
                              px-6 py-3 rounded hover:brightness-110 transition-all">
                        Hire Me
                    </a>
                    <a href="{{ route('projects') }}"
                       class="inline-flex items-center gap-2
                              dark:bg-dark-card bg-white
                              border dark:border-dark-border border-slate-200
                              dark:text-slate-300 text-slate-700
                              font-semibold text-sm px-6 py-3 rounded shadow-sm
                              hover:border-accent hover:text-accent transition-all">
                        View Work
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ════════════════════ WORK HISTORY ════ --}}
<section class="py-20 dark:bg-dark-card/50 bg-slate-50
                border-y dark:border-dark-border border-slate-200">
    <div class="max-w-7xl mx-auto px-6">

        <p class="font-mono text-xs text-accent tracking-widest uppercase mb-3">
            // work_history
        </p>
        <h2 class="text-3xl font-bold dark:text-white text-slate-900 mb-12">
            Work History
        </h2>

        <div class="space-y-5">
            @foreach($experience as $i => $exp)
                <div class="dark:bg-dark-bg bg-white
                            border dark:border-dark-border border-slate-200
                            rounded-2xl p-6 card-lift shadow-sm animate-fade-up"
                     style="animation-delay:{{ $i * 0.1 }}s">

                    <div class="flex flex-wrap items-start justify-between gap-4">
                        <div>
                            <h3 class="font-bold dark:text-white text-slate-900 text-lg">
                                {{ $exp['role'] }}
                            </h3>
                            <p class="text-accent font-mono text-sm mt-0.5">
                                {{ $exp['company'] }}
                            </p>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            @foreach($exp['tags'] as $t)
                                <span class="tag">{{ $t }}</span>
                            @endforeach
                            <span class="font-mono text-xs dark:text-dark-muted text-slate-500
                                         dark:bg-dark-card bg-slate-100
                                         px-3 py-1 rounded-full
                                         border dark:border-dark-border border-slate-200 whitespace-nowrap">
                                {{ $exp['period'] }}
                            </span>
                        </div>
                    </div>

                    <p class="dark:text-slate-400 text-slate-600
                              text-sm leading-relaxed mt-4">
                        {{ $exp['desc'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════ TECHNICAL ARSENAL ════ --}}
<section class="py-20">
    <div class="max-w-7xl mx-auto px-6">

        <p class="font-mono text-xs text-accent tracking-widest uppercase mb-3">
            // technical_arsenal
        </p>
        <h2 class="text-3xl font-bold dark:text-white text-slate-900 mb-12">
            Technical Arsenal
        </h2>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach($arsenal as $category => $skills)
                <div class="dark:bg-dark-card bg-white
                            border dark:border-dark-border border-slate-200
                            rounded-2xl p-6 card-lift shadow-sm">

                    {{-- Category header --}}
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-lg bg-accent/10
                                    flex items-center justify-center">
                            @if($category === 'Frontend')
                                <i class="fas fa-display text-accent text-xs"></i>
                            @elseif($category === 'Backend')
                                <i class="fas fa-server text-accent text-xs"></i>
                            @else
                                <i class="fas fa-wrench text-accent text-xs"></i>
                            @endif
                        </div>
                        <h3 class="font-mono text-sm font-bold
                                   dark:text-white text-slate-800
                                   uppercase tracking-widest">
                            {{ $category }}
                        </h3>
                    </div>

                    {{-- Primary skills --}}
                    <div class="space-y-2 mb-4">
                        @foreach($skills['primary'] as $skill)
                            <div class="flex items-center gap-2
                                        dark:bg-dark-bg bg-slate-50
                                        border dark:border-dark-border border-slate-200
                                        rounded-lg px-3 py-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-accent shrink-0"></span>
                                <span class="text-sm dark:text-slate-300 text-slate-700 font-medium">
                                    {{ $skill }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    {{-- Secondary tags --}}
                    <div class="flex flex-wrap gap-2 pt-3
                                border-t dark:border-dark-border border-slate-100">
                        @foreach($skills['secondary'] as $skill)
                            <span class="tag">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
