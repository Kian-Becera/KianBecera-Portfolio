@extends('layouts.app')
@section('title', 'Projects — ARCHITECT.IO')

@section('content')

<section class="py-24 min-h-[calc(100vh-3.5rem)]">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Page header --}}
        <div class="mb-16 animate-fade-up">
            <p class="font-mono text-xs text-accent tracking-widest uppercase mb-3">
                // selected_works
            </p>
            <h1 class="text-5xl md:text-6xl font-bold dark:text-white text-slate-900 mb-4">
                Selected Works
            </h1>
            <p class="dark:text-dark-muted text-slate-500 max-w-xl">
                A curated collection of systems, tools, and products —
                each built to solve a real problem at scale.
            </p>
            <div class="accent-line mt-8 w-24"></div>
        </div>

        {{-- Project grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">

            @foreach($projects as $i => $project)
                <a href="{{ route('project.detail', $project['slug']) }}"
                   class="group dark:bg-dark-card bg-white
                          border dark:border-dark-border border-slate-200
                          rounded-2xl overflow-hidden card-lift shadow-sm block
                          animate-fade-up"
                   style="animation-delay:{{ $i * 0.07 }}s">

                    {{-- Thumbnail --}}
                    <div class="h-44 dark:bg-dark-bg bg-slate-100
                                relative overflow-hidden flex items-center justify-center">

                        <div class="absolute inset-0 dot-grid opacity-60"></div>
                        <div class="absolute bottom-0 inset-x-0 h-px
                                    dark:bg-dark-border bg-slate-200"></div>

                        {{-- Year --}}
                        <span class="absolute top-4 left-4 font-mono text-xs
                                     dark:text-dark-muted text-slate-400">
                            {{ $project['year'] }}
                        </span>

                        {{-- Title --}}
                        <div class="relative text-center px-4 z-10">
                            <h3 class="font-mono font-bold text-xl
                                       dark:text-white text-slate-800
                                       group-hover:text-accent transition-colors">
                                {{ $project['title'] }}
                            </h3>
                            <p class="text-xs dark:text-dark-muted text-slate-500
                                      mt-1 uppercase tracking-widest">
                                {{ $project['category'] }}
                            </p>
                        </div>

                        {{-- Hover arrow --}}
                        <div class="absolute top-4 right-4 w-7 h-7 rounded-full
                                    border dark:border-dark-border border-slate-300
                                    flex items-center justify-center
                                    opacity-0 group-hover:opacity-100
                                    group-hover:border-accent transition-all">
                            <i class="fas fa-arrow-right text-[10px] text-accent"></i>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="p-5">
                        <p class="dark:text-slate-400 text-slate-600
                                  text-sm leading-relaxed mb-4 line-clamp-2">
                            {{ $project['description'] }}
                        </p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(array_slice($project['tags'], 0, 4) as $t)
                                <span class="tag">{{ $t }}</span>
                            @endforeach
                        </div>
                    </div>
                </a>
            @endforeach

            {{-- Start a project CTA card --}}
            <a href="{{ route('contact') }}"
               class="group bg-accent rounded-2xl overflow-hidden card-lift
                      flex flex-col items-center justify-center
                      text-center p-10 min-h-[200px] animate-fade-up"
               style="animation-delay:{{ count($projects) * 0.07 }}s">
                <div class="w-12 h-12 rounded-full bg-dark-bg/20
                            flex items-center justify-center mb-4
                            group-hover:scale-110 transition-transform">
                    <i class="fas fa-plus text-dark-bg text-xl"></i>
                </div>
                <h3 class="font-bold text-dark-bg text-lg mb-1">Start A Project</h3>
                <p class="text-dark-bg/70 text-sm">Let's build together →</p>
            </a>
        </div>

    </div>
</section>

@endsection
