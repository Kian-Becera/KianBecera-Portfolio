@extends('layouts.app')

@section('content')

{{-- ═══════════════════════════════════════ HERO ═══ --}}
<section id="hero" class="min-h-screen flex items-center justify-center relative overflow-hidden">
    {{-- Background glow blobs --}}
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-violet-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-6xl mx-auto px-6 py-32 text-center animate-fade-in-up">
        <p class="font-mono text-primary text-sm mb-4 tracking-widest uppercase">Hello, I am</p>
        <h1 class="text-5xl md:text-7xl font-bold text-white mb-4 leading-tight">
            {{ $name }}
        </h1>
        <h2 class="text-2xl md:text-3xl font-light gradient-text mb-6">
            {{ $role }}
        </h2>
        <p class="text-slate-400 max-w-xl mx-auto text-lg leading-relaxed mb-10">
            {{ $bio }}
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="#projects"
               class="bg-primary hover:bg-primary-dark text-white font-semibold px-8 py-3 rounded-full transition-all duration-200 hover:shadow-lg hover:shadow-indigo-500/30">
                View My Work
            </a>
            <a href="#contact"
               class="border border-slate-600 hover:border-primary text-slate-300 hover:text-white font-semibold px-8 py-3 rounded-full transition-all duration-200">
                Get In Touch
            </a>
        </div>

        {{-- Social icons --}}
        <div class="flex justify-center gap-6 mt-12">
            <a href="{{ $github }}" target="_blank" rel="noopener"
               class="text-slate-500 hover:text-white text-2xl transition-colors duration-200" aria-label="GitHub">
                <i class="fab fa-github"></i>
            </a>
            <a href="{{ $linkedin }}" target="_blank" rel="noopener"
               class="text-slate-500 hover:text-[#0a66c2] text-2xl transition-colors duration-200" aria-label="LinkedIn">
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="mailto:{{ $email }}"
               class="text-slate-500 hover:text-primary text-2xl transition-colors duration-200" aria-label="Email">
                <i class="fas fa-envelope"></i>
            </a>
        </div>

        {{-- Scroll indicator --}}
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 text-slate-600 animate-bounce">
            <i class="fas fa-chevron-down text-lg"></i>
        </div>
    </div>
</section>

{{-- ═════════════════════════════════════ ABOUT ═══ --}}
<section id="about" class="py-24">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-white mb-2">About Me</h2>
        <div class="w-16 h-1 bg-primary rounded mb-12"></div>

        <div class="grid md:grid-cols-2 gap-12 items-center">
            {{-- Avatar placeholder --}}
            <div class="flex justify-center">
                <div class="w-64 h-64 rounded-2xl bg-gradient-to-br from-indigo-600/40 to-violet-600/40 border border-indigo-500/30 flex items-center justify-center shadow-2xl">
                    <i class="fas fa-user text-8xl text-indigo-400/50"></i>
                </div>
            </div>

            <div class="space-y-5 text-slate-400 text-lg leading-relaxed">
                <p>
                    Hi! I'm <span class="text-white font-semibold">{{ $name }}</span>, a passionate
                    <span class="text-primary font-medium">{{ $role }}</span> with a strong background in building
                    robust, maintainable web applications.
                </p>
                <p>{{ $bio }}</p>
                <p>
                    When I'm not coding, you'll find me exploring new technologies, contributing to
                    open-source projects, or sharing knowledge with the developer community.
                </p>

                <div class="pt-2 grid grid-cols-2 gap-4 text-sm">
                    <div class="bg-[#1e293b] rounded-xl p-4 border border-slate-700">
                        <p class="text-slate-500 mb-1">Email</p>
                        <p class="text-white font-medium truncate">{{ $email }}</p>
                    </div>
                    <div class="bg-[#1e293b] rounded-xl p-4 border border-slate-700">
                        <p class="text-slate-500 mb-1">Location</p>
                        <p class="text-white font-medium">Available Remote</p>
                    </div>
                </div>

                <a href="#contact"
                   class="inline-block mt-2 bg-primary hover:bg-primary-dark text-white font-semibold px-6 py-2.5 rounded-full transition-all duration-200">
                    Hire Me
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═════════════════════════════════════ SKILLS ═══ --}}
<section id="skills" class="py-24 bg-[#1e293b]/50">
    <div class="max-w-6xl mx-auto px-6"
         x-data="{ animated: false }"
         x-intersect.once="animated = true">
        <h2 class="text-3xl font-bold text-white mb-2">Skills</h2>
        <div class="w-16 h-1 bg-primary rounded mb-12"></div>

        <div class="grid sm:grid-cols-2 gap-6">
            @foreach($skills as $skill)
                <div class="bg-[#0f172a] rounded-xl p-5 border border-slate-800 card-hover">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <i class="{{ $skill['icon'] }} text-primary text-xl w-6 text-center"></i>
                            <span class="text-white font-medium">{{ $skill['name'] }}</span>
                        </div>
                        <span class="font-mono text-sm text-slate-500">{{ $skill['level'] }}%</span>
                    </div>
                    <div class="h-2 bg-slate-800 rounded-full overflow-hidden">
                        <div class="skill-bar h-full bg-gradient-to-r from-indigo-500 to-violet-500 rounded-full"
                             :style="animated ? 'width: {{ $skill['level'] }}%' : 'width: 0%'">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════ PROJECTS ═══ --}}
<section id="projects" class="py-24">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-white mb-2">Projects</h2>
        <div class="w-16 h-1 bg-primary rounded mb-12"></div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $project)
                <div class="bg-[#1e293b] rounded-2xl overflow-hidden border border-slate-700 card-hover flex flex-col">
                    {{-- Project image / placeholder --}}
                    <div class="h-44 bg-gradient-to-br from-indigo-900/60 to-violet-900/60 flex items-center justify-center">
                        @if($project['image'])
                            <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}" class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-code text-5xl text-indigo-500/40"></i>
                        @endif
                    </div>

                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-white font-bold text-lg mb-2">{{ $project['title'] }}</h3>
                        <p class="text-slate-400 text-sm leading-relaxed mb-4 flex-1">{{ $project['description'] }}</p>

                        {{-- Tags --}}
                        <div class="flex flex-wrap gap-2 mb-5">
                            @foreach($project['tags'] as $tag)
                                <span class="bg-indigo-900/50 text-indigo-300 text-xs font-medium px-2.5 py-1 rounded-full border border-indigo-700/40">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>

                        {{-- Links --}}
                        <div class="flex gap-3">
                            <a href="{{ $project['github'] }}" target="_blank" rel="noopener"
                               class="flex items-center gap-2 text-sm text-slate-400 hover:text-white border border-slate-700 hover:border-slate-500 px-3 py-1.5 rounded-lg transition-colors">
                                <i class="fab fa-github"></i> Code
                            </a>
                            @if($project['live'])
                                <a href="{{ $project['live'] }}" target="_blank" rel="noopener"
                                   class="flex items-center gap-2 text-sm text-white bg-primary hover:bg-primary-dark px-3 py-1.5 rounded-lg transition-colors">
                                    <i class="fas fa-arrow-up-right-from-square"></i> Live
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════ EXPERIENCE ═══ --}}
<section id="experience" class="py-24 bg-[#1e293b]/50">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-white mb-2">Experience</h2>
        <div class="w-16 h-1 bg-primary rounded mb-12"></div>

        <div class="relative border-l-2 border-slate-700 ml-4 space-y-0">
            @foreach($experience as $i => $exp)
                <div class="relative pl-8 pb-10 {{ $loop->last ? 'pb-0' : '' }}">
                    {{-- Timeline dot --}}
                    <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-primary border-2 border-[#0f172a] ring-2 ring-indigo-500/30"></div>

                    <div class="bg-[#0f172a] rounded-xl p-6 border border-slate-800 card-hover">
                        <div class="flex flex-wrap items-start justify-between gap-2 mb-2">
                            <div>
                                <h3 class="text-white font-bold text-lg">{{ $exp['role'] }}</h3>
                                <p class="text-primary font-medium text-sm">{{ $exp['company'] }}</p>
                            </div>
                            <span class="font-mono text-xs text-slate-500 bg-slate-800 px-3 py-1 rounded-full">
                                {{ $exp['period'] }}
                            </span>
                        </div>
                        <p class="text-slate-400 text-sm leading-relaxed">{{ $exp['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════════════════════════ CONTACT ═══ --}}
<section id="contact" class="py-24">
    <div class="max-w-3xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-white mb-2 text-center">Get In Touch</h2>
        <div class="w-16 h-1 bg-primary rounded mb-4 mx-auto"></div>
        <p class="text-slate-400 text-center mb-12">Have a project in mind or want to collaborate? I'd love to hear from you.</p>

        @if($errors->any())
            <div class="bg-red-900/30 border border-red-700 text-red-300 rounded-xl p-4 mb-6 text-sm">
                <ul class="space-y-1">
                    @foreach($errors->all() as $error)
                        <li><i class="fas fa-circle-exclamation mr-2"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('portfolio.contact') }}" method="POST"
              x-data="{ loading: false }" @submit="loading = true"
              class="bg-[#1e293b] rounded-2xl p-8 border border-slate-700 space-y-5 shadow-2xl">
            @csrf

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-400 mb-1.5">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           placeholder="John Doe"
                           class="w-full bg-[#0f172a] border border-slate-700 focus:border-primary focus:ring-1 focus:ring-primary rounded-xl px-4 py-3 text-white placeholder-slate-600 outline-none transition-colors @error('name') border-red-500 @enderror">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-400 mb-1.5">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           placeholder="john@example.com"
                           class="w-full bg-[#0f172a] border border-slate-700 focus:border-primary focus:ring-1 focus:ring-primary rounded-xl px-4 py-3 text-white placeholder-slate-600 outline-none transition-colors @error('email') border-red-500 @enderror">
                </div>
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-slate-400 mb-1.5">Message</label>
                <textarea id="message" name="message" rows="6"
                          placeholder="Tell me about your project..."
                          class="w-full bg-[#0f172a] border border-slate-700 focus:border-primary focus:ring-1 focus:ring-primary rounded-xl px-4 py-3 text-white placeholder-slate-600 outline-none transition-colors resize-none @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
            </div>

            <button type="submit"
                    :disabled="loading"
                    class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-indigo-500/30 disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                <span x-show="!loading">Send Message <i class="fas fa-paper-plane ml-1"></i></span>
                <span x-show="loading" x-cloak><i class="fas fa-circle-notch fa-spin mr-2"></i>Sending...</span>
            </button>
        </form>

        {{-- Direct contact links --}}
        <div class="mt-10 flex flex-wrap justify-center gap-6 text-slate-500">
            <a href="mailto:{{ $email }}"
               class="flex items-center gap-2 hover:text-primary transition-colors">
                <i class="fas fa-envelope"></i> {{ $email }}
            </a>
            <a href="{{ $github }}" target="_blank" rel="noopener"
               class="flex items-center gap-2 hover:text-primary transition-colors">
                <i class="fab fa-github"></i> GitHub
            </a>
            <a href="{{ $linkedin }}" target="_blank" rel="noopener"
               class="flex items-center gap-2 hover:text-[#0a66c2] transition-colors">
                <i class="fab fa-linkedin"></i> LinkedIn
            </a>
        </div>
    </div>
</section>

@endsection
