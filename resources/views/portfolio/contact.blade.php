@extends('layouts.app')
@section('title', 'Contact — KIAN BECERA')

@section('content')

{{-- ════════════════════════════ HERO ════ --}}
<section class="relative py-24
                dark:bg-dark-card bg-slate-50
                border-b dark:border-dark-border border-slate-200
                dot-grid overflow-hidden">

    <div class="pointer-events-none absolute -top-40 -right-40
                w-[500px] h-[500px] dark:bg-accent/5 bg-cyan-300/10
                rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-6 animate-fade-up">
        <p class="font-mono text-xs text-accent tracking-widest uppercase mb-4">
            // get_in_touch
        </p>
        <h1 class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-bold
                   dark:text-white text-slate-900 leading-[1] mb-2">
            LET'S<br>BUILD.
        </h1>
        <p class="dark:text-dark-muted text-slate-500 mt-4 max-w-md">
            Transforming your vision into a high-performance digital presence.
        </p>
        <div class="accent-line w-32 mt-8"></div>
    </div>
</section>

{{-- ══════════════════════════ BODY ════ --}}
<section class="py-20 overflow-x-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-5 gap-10">

            {{-- ── Contact form ── --}}
            <div class="lg:col-span-3 animate-fade-up">

                <h2 class="font-mono text-xs text-accent tracking-widest uppercase mb-6">
                    // initiate_inquiry
                </h2>

                {{-- Success message --}}
                @if(session('success'))
                    <div class="dark:bg-accent/10 bg-cyan-50
                                border border-accent/40
                                rounded-xl p-4 mb-6 text-sm text-accent flex items-center gap-2">
                        <i class="fas fa-circle-check"></i> {{ session('success') }}
                    </div>
                @endif

                {{-- Validation errors --}}
                @if($errors->any())
                    <div class="dark:bg-red-900/20 bg-red-50
                                border border-red-400/40
                                rounded-xl p-4 mb-6 text-sm text-red-400">
                        @foreach($errors->all() as $error)
                            <p class="flex items-center gap-2">
                                <i class="fas fa-triangle-exclamation"></i>{{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST"
                      x-data="{ loading: false }"
                      @submit="loading = true"
                      class="dark:bg-dark-card bg-white
                             border dark:border-dark-border border-slate-200
                             rounded-2xl p-8 shadow-sm space-y-5">
                    @csrf

                    {{-- Name + Email --}}
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block font-mono text-xs
                                          dark:text-dark-muted text-slate-500
                                          uppercase tracking-widest mb-2">Name</label>
                            <input type="text" name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Name"
                                   class="field @error('name') !border-red-500 @enderror">
                        </div>
                        <div>
                            <label class="block font-mono text-xs
                                          dark:text-dark-muted text-slate-500
                                          uppercase tracking-widest mb-2">Email</label>
                            <input type="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="Email"
                                   class="field @error('email') !border-red-500 @enderror">
                        </div>
                    </div>

                    {{-- Budget --}}
                    <div>
                        <label class="block font-mono text-xs
                                      dark:text-dark-muted text-slate-500
                                      uppercase tracking-widest mb-2">
                            Nature of Inquiry
                        </label>
                        <select name="budget" class="field max-w-full">
                            <option value="" class="dark:bg-dark-bg bg-white">Select</option>
                            <option value="Employment"            class="dark:bg-dark-bg bg-white">Employment</option>
                            <option value="Freelance / Contract"  class="dark:bg-dark-bg bg-white">Freelance / Contract</option>
                            <option value="Project Collaboration" class="dark:bg-dark-bg bg-white">Project Collaboration</option>
                            <option value="Personal"              class="dark:bg-dark-bg bg-white">Personal</option>
                            <option value="Consultation"          class="dark:bg-dark-bg bg-white">Consultation</option>
                        </select>
                    </div>

                    {{-- Message --}}
                    <div>
                        <label class="block font-mono text-xs
                                      dark:text-dark-muted text-slate-500
                                      uppercase tracking-widest mb-2">Message</label>
                        <textarea name="message" rows="6" placeholder="Tell me about your project…"
                                  class="field resize-none @error('message') !border-red-500 @enderror">{{ old('message') }}</textarea>
                    </div>

                    {{-- Submit --}}
                    <button type="submit" :disabled="loading"
                            class="w-full bg-accent text-dark-bg font-bold text-sm
                                   py-3.5 rounded-lg hover:brightness-110 transition-all
                                   disabled:opacity-50 disabled:cursor-not-allowed
                                   flex items-center justify-center gap-2">
                        <span x-show="!loading">
                            Transmit Message <i class="fas fa-paper-plane ml-1"></i>
                        </span>
                        <span x-show="loading" x-cloak>
                            <i class="fas fa-circle-notch fa-spin mr-2"></i>Transmitting…
                        </span>
                    </button>
                </form>
            </div>

            {{-- ── Sidebar ── --}}
            <div class="lg:col-span-2 space-y-5 animate-fade-up [animation-delay:.12s]">

                {{-- Identity card --}}
                <div class="dark:bg-dark-card bg-white
                            border dark:border-dark-border border-slate-200
                            rounded-2xl p-6 shadow-sm">
                    <h2 class="font-mono text-xs text-accent tracking-widest uppercase mb-4">
                        // byte_identity
                    </h2>
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 rounded-xl
                                    dark:bg-dark-bg bg-slate-100
                                    border dark:border-dark-border border-slate-200
                                    flex items-center justify-center shrink-0">
                            <i class="fas fa-user-astronaut text-accent text-xl"></i>
                        </div>
                        <div>
                            <p class="font-bold dark:text-white text-slate-900">{{ $name }}</p>
                            <p class="text-xs dark:text-dark-muted text-slate-500">{{ $role }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-accent animate-pulse shrink-0"></span>
                        <span class="font-mono text-xs text-accent">Available for new projects</span>
                    </div>
                    <p class="text-xs dark:text-dark-muted text-slate-500 mt-1">
                        Response time: &lt; 24 hours
                    </p>
                </div>

                {{-- Direct channels --}}
                <div class="dark:bg-dark-card bg-white
                            border dark:border-dark-border border-slate-200
                            rounded-2xl p-6 shadow-sm">
                    <h2 class="font-mono text-xs text-accent tracking-widest uppercase mb-4">
                        // direct_channels
                    </h2>
                    <div class="space-y-3">
                        @foreach([
                            ['icon'=>'fas fa-envelope',  'label'=>'Email',    'value'=>$email,        'href'=>'mailto:'.$email],
                            ['icon'=>'fab fa-x-twitter', 'label'=>'Twitter',  'value'=>'@kyaa_nnn', 'href'=>$twitter],
                            ['icon'=>'fab fa-github',    'label'=>'GitHub',   'value'=>'Kian-Becera',  'href'=>$github],
                            ['icon'=>'fab fa-linkedin',  'label'=>'LinkedIn', 'value'=>'Kian Becera','href'=>$linkedin],
                        ] as $ch)
                            <a href="{{ $ch['href'] }}" target="_blank"
                               class="flex items-center gap-3 p-3
                                      dark:bg-dark-bg bg-slate-50
                                      border dark:border-dark-border border-slate-200
                                      rounded-xl hover:border-accent
                                      group transition-all">
                                <div class="w-8 h-8 rounded-lg
                                            dark:bg-dark-card bg-white
                                            flex items-center justify-center shrink-0">
                                    <i class="{{ $ch['icon'] }} text-accent text-xs"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs dark:text-dark-muted text-slate-400">
                                        {{ $ch['label'] }}
                                    </p>
                                    <p class="text-sm dark:text-slate-300 text-slate-700
                                              font-medium group-hover:text-accent
                                              transition-colors truncate">
                                        {{ $ch['value'] }}
                                    </p>
                                </div>
                                <i class="fas fa-arrow-right text-[10px]
                                          dark:text-dark-muted text-slate-400
                                          group-hover:text-accent transition-colors shrink-0"></i>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Map placeholder --}}
                <div class="dark:bg-dark-card bg-white
                            border dark:border-dark-border border-slate-200
                            rounded-2xl overflow-hidden shadow-sm">
                    <div class="h-40 dark:bg-dark-bg bg-slate-100
                                relative flex items-center justify-center dot-grid">
                        <div class="pointer-events-none absolute inset-0
                                    bg-gradient-to-t dark:from-dark-card from-white to-transparent"></div>
                        <div class="relative z-10 text-center">
                            <i class="fas fa-location-dot text-accent text-2xl mb-2 block"></i>
                            <p class="font-mono text-sm dark:text-white text-slate-800 font-bold">
                                {{ $location }}
                            </p>
                        </div>
                    </div>
                    <div class="px-5 py-3 border-t dark:border-dark-border border-slate-200">
                        <p class="text-xs dark:text-dark-muted text-slate-500">
                            Operating Globally from {{ $location }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
