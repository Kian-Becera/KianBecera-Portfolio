@extends('layouts.app')
@section('title', $project['title'] . ' — ARCHITECT.IO')

@section('content')

<article class="min-h-[calc(100vh-3.5rem)]">

    {{-- ── Hero banner ── --}}
    <section class="relative py-24
                    dark:bg-dark-card bg-slate-50
                    border-b dark:border-dark-border border-slate-200
                    overflow-hidden dot-grid">

        <div class="pointer-events-none absolute -top-32 -right-32
                    w-96 h-96 dark:bg-accent/5 bg-cyan-300/10
                    rounded-full blur-3xl"></div>

        <div class="max-w-5xl mx-auto px-6 animate-fade-up">

            {{-- Back link --}}
            <a href="{{ route('projects') }}"
               class="inline-flex items-center gap-2
                      text-xs font-mono text-accent
                      hover:underline tracking-widest uppercase mb-8">
                <i class="fas fa-arrow-left text-[10px]"></i> All Projects
            </a>

            <div class="flex flex-wrap items-start justify-between gap-6">
                <div>
                    <p class="text-xs font-mono text-accent tracking-widest uppercase mb-2">
                        {{ $project['category'] }} · {{ $project['year'] }}
                    </p>
                    <h1 class="font-mono font-bold text-4xl md:text-5xl
                               dark:text-white text-slate-900 mb-3">
                        {{ $project['title'] }}
                    </h1>
                    <p class="dark:text-dark-muted text-slate-500 text-lg">
                        {{ $project['subtitle'] }}
                    </p>
                </div>

                {{-- Action buttons --}}
                <div class="flex gap-3 mt-2">
                    @if($project['github'])
                        <a href="{{ $project['github'] }}" target="_blank" class="btn-hire">
                            <i class="fab fa-github mr-1.5"></i> Source
                        </a>
                    @endif
                    @if($project['live'] ?? null)
                        <a href="{{ $project['live'] }}" target="_blank"
                           class="inline-flex items-center gap-2
                                  bg-accent text-dark-bg font-semibold
                                  text-xs px-4 py-1.5 rounded
                                  hover:brightness-110 transition-all">
                            <i class="fas fa-arrow-up-right-from-square text-[10px]"></i> Live
                        </a>
                    @endif
                </div>
            </div>

            {{-- Tech tags --}}
            <div class="flex flex-wrap gap-2 mt-6">
                @foreach($project['tags'] as $t)
                    <span class="tag">{{ $t }}</span>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Body ── --}}
    <section class="py-16">
        <div class="max-w-5xl mx-auto px-6">

            {{-- Overview + metrics --}}
            <div class="grid md:grid-cols-3 gap-8 mb-16">

                <div class="md:col-span-2">
                    <h2 class="font-mono text-xs text-accent tracking-widest uppercase mb-4">
                        // overview
                    </h2>
                    <p class="dark:text-slate-300 text-slate-700 leading-relaxed text-lg">
                        {{ $project['description'] }}
                    </p>
                    @if($project['long_description'] ?? null)
                        <div class="mt-4 space-y-3">
                            @foreach(explode("\n\n", $project['long_description']) as $para)
                                <p class="dark:text-slate-400 text-slate-600 leading-relaxed">
                                    {{ $para }}
                                </p>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if($project['metrics'] ?? null)
                    <div class="space-y-4">
                        <h2 class="font-mono text-xs text-accent tracking-widest uppercase mb-4">
                            // metrics
                        </h2>
                        @foreach($project['metrics'] as $metric)
                            <div class="dark:bg-dark-card bg-white
                                        border dark:border-dark-border border-slate-200
                                        rounded-xl p-5 text-center shadow-sm">
                                <p class="font-mono font-bold text-3xl text-accent">
                                    {{ $metric['value'] }}
                                </p>
                                <p class="text-xs dark:text-dark-muted text-slate-500
                                          mt-1 uppercase tracking-widest">
                                    {{ $metric['label'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Code snippet --}}
            @if($project['code_snippet'] ?? null)
                <div class="mb-16">
                    <h2 class="font-mono text-xs text-accent tracking-widest uppercase mb-4">
                        // code_highlight
                    </h2>
                    <div class="code-block">
                        {{-- Window chrome --}}
                        <div class="flex items-center gap-2 px-5 py-3
                                    border-b dark:border-dark-border border-slate-700">
                            <span class="w-3 h-3 rounded-full bg-red-500/60"></span>
                            <span class="w-3 h-3 rounded-full bg-yellow-500/60"></span>
                            <span class="w-3 h-3 rounded-full bg-green-500/60"></span>
                            <span class="ml-4 text-xs dark:text-dark-muted text-slate-500 font-mono">
                                bridge.config.ts
                            </span>
                        </div>
                        <pre class="p-5 text-slate-300 text-sm overflow-x-auto"><code>{{ $project['code_snippet'] }}</code></pre>
                    </div>
                </div>
            @endif

            {{-- Tech detail cards --}}
            @if($project['tech_details'] ?? null)
                <div class="mb-16">
                    <h2 class="font-mono text-xs text-accent tracking-widest uppercase mb-6">
                        // technical_features
                    </h2>
                    <div class="grid sm:grid-cols-2 gap-5">
                        @foreach($project['tech_details'] as $detail)
                            <div class="dark:bg-dark-card bg-white
                                        border dark:border-dark-border border-slate-200
                                        rounded-xl p-6 card-lift shadow-sm">
                                <div class="flex items-start gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-accent/10
                                                flex items-center justify-center
                                                shrink-0 mt-0.5">
                                        <i class="fas fa-microchip text-accent text-xs"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold dark:text-white text-slate-800
                                                   text-sm mb-1">
                                            {{ $detail['title'] }}
                                        </h3>
                                        <p class="dark:text-slate-400 text-slate-600
                                                  text-sm leading-relaxed">
                                            {{ $detail['desc'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Bottom CTA --}}
            <div class="dark:bg-dark-card bg-slate-50
                        border dark:border-dark-border border-slate-200
                        rounded-2xl p-8 text-center">
                <p class="font-mono text-xs text-accent tracking-widest uppercase mb-2">
                    // next_steps
                </p>
                <h3 class="text-xl font-bold dark:text-white text-slate-900 mb-2">
                    Ready to engineer your next breakthrough?
                </h3>
                <p class="dark:text-dark-muted text-slate-500 text-sm mb-6">
                    Let's collaborate on something extraordinary.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center gap-2
                              bg-accent text-dark-bg font-bold text-sm
                              px-7 py-3 rounded hover:brightness-110 transition-all">
                        Start a Project
                    </a>
                    <a href="{{ route('projects') }}"
                       class="inline-flex items-center gap-2
                              dark:bg-dark-bg bg-white
                              border dark:border-dark-border border-slate-200
                              dark:text-slate-300 text-slate-700
                              font-semibold text-sm px-7 py-3 rounded shadow-sm
                              hover:border-accent hover:text-accent transition-all">
                        View More Work
                    </a>
                </div>
            </div>

        </div>
    </section>
</article>

@endsection
