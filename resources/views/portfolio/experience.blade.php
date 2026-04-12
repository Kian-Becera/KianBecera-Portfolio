@extends('layouts.app')
@section('title', 'Experience — KIAN BECERA')

@section('content')

{{-- ══════════════════════════════ HERO ════ --}}
<section class="relative py-24
                dark:bg-dark-card bg-slate-50
                border-b dark:border-dark-border border-slate-200
                dot-grid overflow-hidden">

    <div class="pointer-events-none absolute -top-40 -right-40
                w-[500px] h-[500px] dark:bg-accent/5 bg-cyan-200/20
                rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-6 animate-fade-up">
        <p class="font-mono text-xs text-accent tracking-widest uppercase mb-4">
            // work_history
        </p>
        <h1 class="text-6xl md:text-7xl lg:text-8xl font-bold
                   dark:text-white text-slate-900 leading-[1] mb-6">
            EXPERIENCE.
        </h1>
        <div class="accent-line w-32 mb-8"></div>
        <p class="dark:text-dark-muted text-slate-500 max-w-xl">
            A track record of building reliable systems, shipping fast,
            and growing with every project.
        </p>
    </div>
</section>

{{-- ════════════════════ WORK HISTORY ════ --}}
<section id="work-history" class="py-20">
    <div class="max-w-7xl mx-auto px-6">

        <p class="font-mono text-xs text-accent tracking-widest uppercase mb-3">
            // positions
        </p>
        <h2 class="text-3xl font-bold dark:text-white text-slate-900 mb-12">
            Work History
        </h2>

        <div class="space-y-5">
            @foreach($experience as $i => $exp)
                <div class="dark:bg-dark-card bg-white
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
                                         dark:bg-dark-bg bg-slate-100
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

{{-- ══════════════════ CONTRIBUTION GRAPH ════ --}}
<section class="py-20 border-t dark:border-dark-border border-slate-200
                dark:bg-dark-card/40 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6">

        <p class="font-mono text-xs text-accent tracking-widest uppercase mb-3">
            // activity
        </p>
        <h2 class="text-3xl font-bold dark:text-white text-slate-900 mb-10">
            Contribution Activity
        </h2>

        @php
            mt_srand(2024);
            $cw = [];
            for ($w = 0; $w < 52; $w++) {
                $cw[$w] = [];
                for ($d = 0; $d < 7; $d++) {
                    $r = mt_rand(0, 10);
                    $cw[$w][$d] = $r <= 3 ? 0 : ($r <= 5 ? 1 : ($r <= 7 ? 2 : ($r <= 9 ? 3 : 4)));
                }
            }
            $months = ['May'=>0,'Jun'=>4,'Jul'=>9,'Aug'=>13,'Sep'=>18,'Oct'=>22,'Nov'=>27,'Dec'=>31,'Jan'=>36,'Feb'=>40,'Mar'=>44,'Apr'=>48];
        @endphp

        <style>
            .dark .cgrid-0 { background: rgba(13,21,38,0.95); }
            .dark .cgrid-1 { background: rgba(0,229,204,0.13); }
            .dark .cgrid-2 { background: rgba(0,229,204,0.32); }
            .dark .cgrid-3 { background: rgba(0,229,204,0.58); }
            .dark .cgrid-4 { background: #00e5cc; }
            html:not(.dark) .cgrid-0 { background: #d1d9e2; }
            html:not(.dark) .cgrid-1 { background: rgba(8,145,178,0.20); }
            html:not(.dark) .cgrid-2 { background: rgba(8,145,178,0.42); }
            html:not(.dark) .cgrid-3 { background: rgba(8,145,178,0.65); }
            html:not(.dark) .cgrid-4 { background: #0891b2; }
        </style>

        <div class="dark:bg-dark-card bg-white
                    border dark:border-dark-border border-slate-200
                    rounded-2xl p-6 overflow-x-auto no-scrollbar">

            <div class="relative mb-2" style="height:16px">
                @foreach($months as $month => $col)
                    <span class="absolute font-mono text-[11px]
                                 dark:text-slate-500 text-slate-400 leading-none"
                          style="left:calc({{ $col }} * (100% / 52))">{{ $month }}</span>
                @endforeach
            </div>

            <div class="flex gap-[3px]">
                @for ($w = 0; $w < 52; $w++)
                    <div class="flex flex-col gap-[3px] flex-1">
                        @for ($d = 0; $d < 7; $d++)
                            <div class="w-full aspect-square rounded-[3px] cgrid-{{ $cw[$w][$d] }}"></div>
                        @endfor
                    </div>
                @endfor
            </div>

            <div class="flex items-center justify-end gap-2 mt-4">
                <span class="font-mono text-[10px] dark:text-slate-500 text-slate-400">Less</span>
                @foreach([0,1,2,3,4] as $lvl)
                    <div class="w-3 h-3 rounded-[2px] cgrid-{{ $lvl }}"></div>
                @endforeach
                <span class="font-mono text-[10px] dark:text-slate-500 text-slate-400">More</span>
            </div>
        </div>

    </div>
</section>

{{-- ══════════════════════════ CTA ════ --}}
<section class="py-16 border-t dark:border-dark-border border-slate-200">
    <div class="max-w-7xl mx-auto px-6
                flex flex-col md:flex-row items-center justify-between gap-6">
        <div>
            <p class="font-mono text-xs text-accent tracking-widest uppercase mb-1">
                Want to work together?
            </p>
            <h3 class="text-2xl font-bold dark:text-white text-slate-900">
                Let's build something great.
            </h3>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('contact') }}"
               class="inline-flex items-center gap-2
                      bg-accent text-dark-bg font-bold text-sm
                      px-7 py-3 rounded hover:brightness-110 transition-all">
                Hire Me
            </a>
            <a href="{{ route('about') }}"
               class="inline-flex items-center gap-2
                      dark:bg-dark-card bg-white
                      border dark:border-dark-border border-slate-200
                      dark:text-slate-300 text-slate-700
                      font-semibold text-sm px-7 py-3 rounded shadow-sm
                      hover:border-accent hover:text-accent transition-all">
                About Me
            </a>
        </div>
    </div>
</section>

@endsection
