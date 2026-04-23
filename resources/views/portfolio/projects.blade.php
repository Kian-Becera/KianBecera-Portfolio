@extends('layouts.app')
@section('title', 'Projects — KIAN BECERA')

@section('content')

<section class="py-24 min-h-[calc(100vh-3.5rem)]">
    <div class="max-w-6xl mx-auto px-6">

        <div class="mb-16 animate-fade-up">
            <p class="font-mono text-xs text-accent tracking-widest uppercase mb-3">
                // selected_works
            </p>
            <h1 class="text-5xl md:text-6xl font-bold dark:text-white text-slate-900 mb-4">
                Selected Works
            </h1>
           
            <div class="accent-line mt-8 w-24"></div>
        </div>

        @php
            $gradients = [
                'qms'  => ['from' => '#3b82f6', 'to' => '#7c3aed'],
                'cotamila-coffee' => ['from' => '#005A32', 'to' => '#15803D'],
                'writerity' => ['from' => '#503C28', 'to' => '#8B735B'],
                'ams'      => ['from' => '#14b8a6', 'to' => '#3b82f6'],
                'katsumok' => ['from' => '#8b5cf6', 'to' => '#ec4899'],
                'prinstax' => ['from' => '#c9a84c', 'to' => '#7a6010'],
            ];
            $meta = [
                'qms'             => ['domain'=>'qms.becera.dev', 'duration'=>'6 Months', 'classification'=>'Capstone Project', 'year'=>'© 2022', 'image'=>'images/projects/qms.png'],
                'cotamila-coffee' => ['domain'=>'cotamila-coffee.becera.dev', 'duration'=>'2 Weeks', 'classification'=>'Personal Project', 'year'=>'© 2026', 'image'=>'images/projects/cotamila.png'],
                'writerity'  => ['domain'=>'writerity.becera.dev', 'duration'=>'4 Months', 'classification'=>'Client Project', 'year'=>'© 2025', 'image'=>'images/projects/writerity.png'],
                'ams'      => ['domain'=>'ams.becera.dev', 'duration'=>'2 Months', 'classification'=>'Client Project', 'year'=>'© 2025', 'image'=>'images/projects/ams.png'],
                'katsumok' => ['domain'=>'katsumok.becera.dev', 'duration'=>'3 Months', 'classification'=>'Client Project', 'year'=>'© 2024', 'image'=>'images/projects/katsumok.png'],
                'prinstax'   => ['domain'=>'prinstax.becera.dev', 'duration'=>'3 Weeks', 'classification'=>'Personal Project', 'year'=>'© 2026', 'image'=>'images/projects/prinstax.png'],
            ];
        @endphp

        <div class="space-y-7">
            @foreach($projects as $i => $project)
                @php
                    $g  = $gradients[$project['slug']] ?? ['from'=>'#00e5cc','to'=>'#0891b2'];
                    $m  = $meta[$project['slug']] ?? ['domain'=>$project['slug'].'.becera.dev','duration'=>'—','classification'=>'—','year'=>$project['year'],'image'=>null];
                @endphp

                <div class="group dark:bg-dark-card bg-white
                            border dark:border-dark-border border-slate-200
                            rounded-2xl overflow-hidden card-lift shadow-sm animate-fade-up
                            flex flex-col md:flex-row"
                     style="animation-delay:{{ $i * 0.07 }}s">

                    {{-- ── LEFT: preview mockup ── --}}
                    <div class="md:w-[38%] flex flex-col shrink-0 relative overflow-hidden
                                dark:bg-dark-bg bg-slate-100 min-h-[220px]">

                        {{-- Browser chrome --}}
                        <div class="flex items-center gap-2 px-4 py-3
                                    dark:bg-dark-card/80 bg-white/80 backdrop-blur-sm
                                    border-b dark:border-dark-border border-slate-200 shrink-0">
                            <span class="w-2.5 h-2.5 rounded-full bg-red-400/80 shrink-0"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-yellow-400/80 shrink-0"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-green-400/80 shrink-0"></span>
                            <div class="flex-1 mx-3 px-3 py-1 rounded-md text-[11px]
                                        font-mono dark:text-slate-400 text-slate-500
                                        dark:bg-dark-bg bg-slate-100
                                        border dark:border-dark-border border-slate-200
                                        truncate">
                                {{ $m['domain'] }}
                            </div>
                        </div>

                        {{-- Preview canvas --}}
                        @if($m['image'] ?? null)
                            <div class="flex-1 relative overflow-hidden">
                                <img src="{{ asset($m['image']) }}"
                                     alt="{{ $project['title'] }}"
                                     class="absolute inset-0 w-full h-full object-cover object-top
                                            transition-transform duration-700 group-hover:scale-105">
                                <div class="absolute inset-0"
                                     style="background: linear-gradient(to bottom, transparent 40%, {{ $g['from'] }}88 100%)"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-4 z-10">
                                    <h3 class="font-mono font-bold text-sm leading-tight text-white drop-shadow">
                                        {{ $project['title'] }}
                                    </h3>
                                </div>
                            </div>
                        @else
                            <div class="flex-1 flex items-center justify-center relative p-6"
                                 style="background: linear-gradient(135deg, {{ $g['from'] }}22, {{ $g['to'] }}44)">
                                <div class="absolute inset-0 dot-grid opacity-20"></div>
                                <div class="relative text-center z-10">
                                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3"
                                         style="background: linear-gradient(135deg, {{ $g['from'] }}, {{ $g['to'] }}); box-shadow: 0 8px 32px {{ $g['from'] }}55">
                                        <i class="fas fa-code text-white text-lg"></i>
                                    </div>
                                    <h3 class="font-mono font-bold text-base leading-tight
                                               dark:text-white text-slate-800
                                               group-hover:text-accent transition-colors">
                                        {{ $project['title'] }}
                                    </h3>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- ── RIGHT: deployment details ── --}}
                    <div class="flex-1 p-6 flex flex-col justify-between gap-5
                                border-t md:border-t-0 md:border-l
                                dark:border-dark-border border-slate-200">

                        {{-- Stats grid --}}
                        <div class="grid grid-cols-3 gap-x-5 gap-y-2">
                            <div>
                                <p class="font-mono text-xs dark:text-dark-muted text-slate-400
                                          uppercase tracking-widest mb-0.5">Build duration</p>
                                <p class="text-sm dark:text-white text-slate-800">
                                    {{ $m['duration'] }}
                                </p>
                            </div>
                            <div>
                                <p class="font-mono text-xs dark:text-dark-muted text-slate-400
                                          uppercase tracking-widest mb-0.5">CLASSIFICATION</p>
                                <p class="text-sm dark:text-white text-slate-800">
                                    {{ $m['classification'] }}
                                </p>
                            </div>
                        </div>

                        {{-- Category --}}
                        <div>
                            <p class="font-mono text-xs dark:text-dark-muted text-slate-400
                                      uppercase tracking-widest mb-0.5">
                                <i class="fas fa-code text-accent text-xs"></i> ROLE
                            </p>
                            <span class="inline-flex items-center gap-1.5 font-mono text-sm
                                         dark:text-slate-300 text-slate-700">
                                {{ $project['role'] }}
                            </span>
                        </div>

                        {{-- Source + tags --}}
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 font-mono text-xs
                                         dark:text-slate-400 text-slate-600">
                                <i class="fas fa-code text-accent text-[11px]"></i> {{ $project['category'] }}
                            </span>
                            
                        </div>
                        <div class="flex flex-wrap items-center gap-1">
                            <span class="dark:bg-dark-border/50 bg-slate-200 w-px h-4"></span>
                            @foreach(array_slice($project['tags'], 0, 7) as $t)
                                <span class="tag">{{ $t }}</span>
                            @endforeach
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end pt-1
                                    border-t dark:border-dark-border border-slate-100">
                            
                            <div class="flex items-center gap-3">
                                {{-- <a href="{{ route('project.detail', $project['slug']) }}"
                                   class="inline-flex items-center gap-1.5 mt-[10px]
                                          bg-accent text-dark-bg font-bold text-xs
                                          px-4 py-1.5 rounded hover:brightness-110 transition-all">
                                    View Details
                                </a> --}}
                                <span class="font-mono text-xs dark:text-dark-muted text-slate-400
                                             dark:bg-dark-bg bg-slate-100
                                             border dark:border-dark-border border-slate-200
                                             px-3 py-1 rounded-full whitespace-nowrap">
                                    {{ $m['year'] }}
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

            {{-- CTA card --}}
            <a href="{{ route('contact') }}"
               class="group bg-accent rounded-2xl overflow-hidden card-lift
                      flex items-center justify-center gap-6 p-10
                      animate-fade-up"
               style="animation-delay:{{ count($projects) * 0.07 }}s">
                <div class="w-12 h-12 rounded-full bg-dark-bg/20
                            flex items-center justify-center
                            group-hover:scale-110 transition-transform shrink-0">
                    <i class="fas fa-plus text-dark-bg text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-dark-bg text-lg mb-0.5">Start A Project</h3>
                    <p class="text-dark-bg/70 text-sm">Let's build something great together →</p>
                </div>
            </a>
        </div>

    </div>
</section>

@endsection
