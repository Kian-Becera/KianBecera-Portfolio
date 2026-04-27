@extends('layouts.app')
@section('title', 'About — KIAN BECERA')

@section('content')

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
        <h1 class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-bold
                   dark:text-white text-slate-900 leading-[1] mb-6">
            THE<br>DEVELOPER.
        </h1>
        <div class="accent-line w-32 mb-8"></div>
    </div>
</section>

<section class="py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-start">

            <div class="animate-fade-up">
                <div class="relative">
                    <div class="dark:bg-dark-card bg-slate-100
                                border dark:border-dark-border border-slate-200
                                rounded-2xl aspect-[4/5] max-w-sm
                                flex items-center justify-center overflow-hidden shadow-xl">
                        <div class="absolute inset-0 dot-grid opacity-50"></div>
                        @if($avatar ?? null)
                            <img src="{{ asset($avatar) }}"
                                 alt="{{ $name }}"
                                 class="w-full h-full object-cover object-top">
                        @else
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
                        @endif
                    </div>
                </div>
            </div>

            <div class="animate-fade-up [animation-delay:.1s]">
                <h2 class="text-2xl font-bold dark:text-white text-slate-900 mb-5">
                    I specialize in building clean, scalable web applications and intuitive user experiences.
                </h2>

                <div class="space-y-4 dark:text-slate-400 text-slate-600 leading-relaxed">
                    <p>
                        Focused on delivering clean, scalable solutions — from WordPress sites
                        to full-stack web apps and mobile experiences using Flutter.
                        I bring both design sensibility and engineering discipline to every project.
                    </p>
                    <p>
                        I hold a B.S. in Information Systems and continuing as a Masteral Student in Information Technology.
                        Currently exploring AI automation workflows and edge-deployment patterns.
                    </p>
                </div>

                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach([
                        ['label'=>'Email',       'value'=>$email,        'icon'=>'fas fa-envelope'],
                        ['label'=>'Location',    'value'=>$location,     'icon'=>'fas fa-location-dot'],
                        ['label'=>'GitHub',      'value'=>'@Kian-Becera','icon'=>'fab fa-github'],
                        ['label'=>'Availability','value'=>'Open to Work','icon'=>'fas fa-circle-check'],
                    ] as $info)
                        <div class="dark:bg-dark-card bg-slate-50
                                    border dark:border-dark-border border-slate-200
                                    rounded-xl p-4">
                            <p class="text-xs dark:text-dark-muted text-slate-400 mb-1
                                      flex items-center gap-1.5">
                                <i class="{{ $info['icon'] }} text-accent text-[10px]"></i>
                                {{ $info['label'] }}
                            </p>
                            <p class="text-sm dark:text-white text-slate-800 font-medium truncate">
                                {{ $info['value'] }}
                            </p>
                        </div>
                    @endforeach
                </div>

                <div class="flex flex-wrap gap-4 mt-8">
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
                    @if($resume ?? null)
                        <button type="button"
                                onclick="window.dispatchEvent(new CustomEvent('open-resume'))"
                                class="inline-flex items-center gap-2
                                       dark:bg-dark-card bg-white
                                       border dark:border-accent border-cyan-600
                                       dark:text-accent text-cyan-600
                                       font-semibold text-sm px-6 py-3 rounded shadow-sm
                                       hover:bg-accent hover:text-dark-bg transition-all">
                            <i class="fas fa-file-lines text-xs"></i> Resume
                        </button>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

@if($resume ?? null)
<div x-data="{ open: false }"
     @open-resume.window="open = true"
     @keydown.escape.window="open = false">

    <div x-show="open"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 overflow-y-auto bg-black/70 backdrop-blur-sm">

        <div class="flex min-h-full items-start justify-center px-6 pt-16 pb-10"
             @click.self="open = false">

            <div x-show="open"
                 x-transition:enter="transition ease-out duration-250"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 class="relative w-full max-w-2xl
                        dark:bg-dark-card bg-white
                        border dark:border-dark-border border-slate-200
                        rounded-2xl shadow-2xl overflow-hidden">

                <div class="h-1 w-full bg-gradient-to-r from-accent to-transparent"></div>

                <div class="sticky top-0 z-20 dark:bg-dark-card bg-white
                            flex items-center justify-between gap-4 px-6 pt-5 pb-4
                            border-b dark:border-dark-border border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-accent/10 border border-accent/20
                                    flex items-center justify-center shrink-0">
                            <i class="fas fa-file-lines text-accent"></i>
                        </div>
                        <div>
                            <p class="font-mono text-[10px] text-accent tracking-widest uppercase">
                                // curriculum_vitae
                            </p>
                            <h3 class="font-bold dark:text-white text-slate-900 text-base leading-snug">
                                {{ $name }} — {{ $role }}
                            </h3>
                        </div>
                    </div>
                    <button @click="open = false"
                            class="w-8 h-8 rounded-lg shrink-0
                                   dark:bg-dark-bg bg-slate-100
                                   dark:text-dark-muted text-slate-500
                                   hover:text-accent transition-colors
                                   flex items-center justify-center text-sm">
                        <i class="fas fa-xmark"></i>
                    </button>
                </div>

                <div class="overflow-y-auto no-scrollbar" style="max-height: calc(100vh - 12rem)">

                    <div class="relative mx-6 mt-4 rounded-xl overflow-hidden
                                border dark:border-dark-border border-slate-200"
                         style="height: 500px">

                        <iframe src="{{ asset($resume) }}#toolbar=0&navpanes=0&scrollbar=0&view=FitH"
                                style="border:none; display:block; width: calc(100% + 20px); height: 100%;"
                                title="Resume Preview"
                                scrolling="no">
                        </iframe>

                        <div class="absolute inset-0 z-10"
                             style="pointer-events: all; cursor: default;"></div>

                        <div class="absolute bottom-0 left-0 right-0 h-1/2 z-20
                                    flex flex-col items-center justify-end pb-8"
                             style="backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px);
                                    background: linear-gradient(to bottom, transparent 0%, var(--gate-bg, rgba(13,21,38,0)) 30%, var(--gate-solid, #0d1526) 100%);">
                            <div class="text-center">
                                <div class="w-10 h-10 rounded-full bg-accent/10 border border-accent/30
                                            flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-lock text-accent text-sm"></i>
                                </div>
                                <p class="font-mono text-xs text-accent tracking-widest uppercase">
                                    Download for Full File View
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 px-6 py-5">
                        <a href="{{ route('resume.download') }}"
                           class="inline-flex items-center gap-2
                                  bg-accent text-dark-bg font-bold text-sm
                                  px-6 py-2.5 rounded hover:brightness-110 transition-all">
                            <i class="fas fa-file-arrow-down text-xs"></i>
                            Download Resume
                        </a>
                        <button @click="open = false"
                                class="inline-flex items-center
                                       dark:bg-dark-bg bg-slate-100
                                       dark:text-slate-400 text-slate-600
                                       font-semibold text-sm px-5 py-2.5 rounded
                                       hover:text-accent transition-colors">
                            Close
                        </button>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
@endif

<section id="edu-section" class="relative py-20 overflow-hidden
                dark:bg-dark-card/50 bg-slate-50
                border-y dark:border-dark-border border-slate-200">

    <div class="pointer-events-none absolute inset-0 dot-grid opacity-[.18]"></div>
    <div class="pointer-events-none absolute -top-40 -left-40
                w-[480px] h-[480px] dark:bg-accent/[.04] bg-cyan-200/20
                rounded-full blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-24 right-0
                w-80 h-80 dark:bg-accent/[.03] bg-cyan-100/15
                rounded-full blur-3xl"></div>

    <style>
        @keyframes hatBob {
            0%, 100% { transform: translateY(0) rotate(-5deg); }
            50%       { transform: translateY(-12px) rotate(5deg); }
        }
        #edu-hat.hat-idle { animation: hatBob 3s ease-in-out infinite; }
        .edu-hat-fill   { fill: #00e5cc; }
        .edu-hat-stroke { stroke: #00e5cc; fill: none; }
        html:not(.dark) .edu-hat-fill   { fill: #0891b2; }
        html:not(.dark) .edu-hat-stroke { stroke: #0891b2; }
        #edu-hat-tip {
            position: absolute;
            top: calc(100% + 5px);
            left: 50%;
            transform: translateX(-50%);
            font-size: 8px;
            white-space: nowrap;
            font-family: 'JetBrains Mono', monospace;
            letter-spacing: 0.1em;
            color: #00e5cc;
            opacity: 0.65;
            pointer-events: none;
            transition: opacity 0.4s ease;
        }
        html:not(.dark) #edu-hat-tip { color: #0891b2; }
    </style>

    <div id="edu-hat"
         style="position: absolute; top: 44px; right: 80px;
                width: 52px; height: 52px;
                cursor: grab; z-index: 20;
                transition: width 0.35s cubic-bezier(.34,1.56,.64,1),
                             height 0.35s cubic-bezier(.34,1.56,.64,1),
                             filter 0.3s ease;
                user-select: none; -webkit-user-select: none;">
        <svg viewBox="0 0 84 72" xmlns="http://www.w3.org/2000/svg"
             style="width:100%;height:100%;display:block;
                    filter:drop-shadow(0 4px 14px rgba(0,229,204,0.3))">
            <polygon points="42,4 82,25 42,45 2,25" class="edu-hat-fill"/>
            <path d="M20,34 L20,57 Q42,70 64,57 L64,34 L42,45 Z"
                  class="edu-hat-fill" opacity="0.78"/>
            <line x1="82" y1="25" x2="82" y2="55"
                  class="edu-hat-stroke" stroke-width="2.5" stroke-linecap="round"/>
            <circle cx="82" cy="61" r="5.5" class="edu-hat-fill"/>
        </svg>
        <span id="edu-hat-tip">drag me</span>
    </div>

    <script>
        (function () {
            function initEduHat() {
                var hat     = document.getElementById('edu-hat');
                var section = document.getElementById('edu-section');
                var tip     = document.getElementById('edu-hat-tip');
                if (!hat || !section) return;

                var hatL, hatT;
                var vx = 2.2, vy = 1.6;
                var dragging = false;
                var sCX, sCY, sL, sT;
                var lastX, lastY, lastTime;
                var touched = false;
                var angle = 0;
                var rafId;

                function clamp(v, lo, hi) { return Math.max(lo, Math.min(hi, v)); }

                function place() {
                    hatL = section.offsetWidth * 0.65;
                    hatT = 60;
                    hat.style.left = hatL + 'px';
                    hat.style.top  = hatT + 'px';
                }

                function checkOverlap() {
                    var hr  = hat.getBoundingClientRect();
                    var hit = false;
                    section.querySelectorAll('[data-edu-entry]').forEach(function (el) {
                        var er = el.getBoundingClientRect();
                        if (hr.left < er.right && hr.right > er.left &&
                            hr.top  < er.bottom && hr.bottom > er.top) hit = true;
                    });
                    hat.style.width  = hit ? '96px' : '52px';
                    hat.style.height = hit ? '96px' : '52px';
                }

                function bounce() {
                    if (dragging) return;
                    var sw = section.offsetWidth;
                    var sh = section.offsetHeight;
                    var hw = hat.offsetWidth;
                    var hh = hat.offsetHeight;

                    hatL += vx;
                    hatT += vy;

                    if (hatL <= 0)       { hatL = 0;       vx =  Math.abs(vx); }
                    if (hatL >= sw - hw) { hatL = sw - hw; vx = -Math.abs(vx); }
                    if (hatT <= 0)       { hatT = 0;       vy =  Math.abs(vy); }
                    if (hatT >= sh - hh) { hatT = sh - hh; vy = -Math.abs(vy); }

                    angle += vx * 1.5;
                    hat.style.left      = hatL + 'px';
                    hat.style.top       = hatT + 'px';
                    hat.style.transform = 'rotate(' + angle + 'deg)';

                    checkOverlap();
                    rafId = requestAnimationFrame(bounce);
                }

                function grab(cx, cy) {
                    dragging = true;
                    cancelAnimationFrame(rafId);
                    hat.style.cursor = 'grabbing';
                    sCX = cx; sCY = cy; sL = hatL; sT = hatT;
                    lastX = cx; lastY = cy; lastTime = Date.now();
                    if (!touched && tip) { tip.style.opacity = '0'; touched = true; }
                }

                function dragMove(cx, cy) {
                    if (!dragging) return;
                    var now = Date.now();
                    var dt  = Math.max(now - lastTime, 1);
                    vx = (cx - lastX) / dt * 14;
                    vy = (cy - lastY) / dt * 14;
                    lastX = cx; lastY = cy; lastTime = now;
                    hatL = clamp(sL + cx - sCX, 0, section.offsetWidth  - hat.offsetWidth);
                    hatT = clamp(sT + cy - sCY, 0, section.offsetHeight - hat.offsetHeight);
                    hat.style.left = hatL + 'px';
                    hat.style.top  = hatT + 'px';
                    checkOverlap();
                }

                function drop() {
                    if (!dragging) return;
                    dragging = false;
                    hat.style.cursor = 'grab';
                    var maxSpeed = 7;
                    vx = clamp(vx, -maxSpeed, maxSpeed);
                    vy = clamp(vy, -maxSpeed, maxSpeed);
                    if (Math.abs(vx) < 1.2) vx = vx >= 0 ? 1.8 : -1.8;
                    if (Math.abs(vy) < 1.2) vy = vy >= 0 ? 1.4 : -1.4;
                    rafId = requestAnimationFrame(bounce);
                }

                hat.addEventListener('mousedown', function (e) { grab(e.clientX, e.clientY); e.preventDefault(); });
                window.addEventListener('mousemove', function (e) { dragMove(e.clientX, e.clientY); });
                window.addEventListener('mouseup', drop);

                hat.addEventListener('touchstart', function (e) {
                    grab(e.touches[0].clientX, e.touches[0].clientY);
                    e.preventDefault();
                }, { passive: false });
                window.addEventListener('touchmove', function (e) {
                    if (dragging) { dragMove(e.touches[0].clientX, e.touches[0].clientY); e.preventDefault(); }
                }, { passive: false });
                window.addEventListener('touchend', drop);

                place();
                rafId = requestAnimationFrame(bounce);
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initEduHat);
            } else {
                initEduHat();
            }
        })();
    </script>

    <div class="max-w-5xl mx-auto px-6">

        <p class="font-mono text-xs text-accent tracking-widest uppercase mb-3">
            // educational_background
        </p>
        <h2 class="text-3xl font-bold dark:text-white text-slate-900 mb-16">
            Educational Background
        </h2>

        <div x-data="{
                hovered: null,
                modal: null,
                items: @json($education)
             }">

            {{-- Mobile timeline --}}
            <div class="md:hidden relative pl-8 border-l-2 dark:border-dark-border border-slate-300 space-y-8">
                @foreach($education as $i => $edu)
                    <div class="relative animate-fade-up" style="animation-delay:{{ $i * 0.1 }}s">
                        <div class="absolute -left-[2.35rem] w-3.5 h-3.5 rounded-full border-2
                                    dark:bg-dark-bg bg-white
                                    dark:border-accent/60 border-slate-400 top-1.5"></div>
                        <p class="font-mono text-[10px] text-accent tracking-widest uppercase mb-1">
                            {{ $edu['period'] }}
                        </p>
                        <h3 class="font-bold dark:text-white text-slate-900 text-base leading-snug mb-1">
                            {{ $edu['school'] }}
                        </h3>
                        <p class="font-mono text-xs text-accent tracking-widest uppercase mb-1">
                            {{ $edu['degree'] }}
                        </p>
                        @if(isset($edu['desc']))
                            <p class="text-sm dark:text-dark-muted text-slate-500 leading-relaxed">
                                {{ $edu['desc'] }}
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Desktop timeline --}}
            <div class="hidden md:block relative max-w-3xl mx-auto">

                <div class="absolute left-1/2 -translate-x-1/2 top-0 bottom-0
                            w-1 rounded-full dark:bg-dark-border bg-slate-300"></div>

                <div class="space-y-0">
                    @foreach($education as $i => $edu)
                        @php $left = ($i % 2 === 0); @endphp

                        <div data-edu-entry
                             class="relative grid grid-cols-[1fr_auto_1fr] items-start
                                    animate-fade-up py-10"
                             style="animation-delay:{{ $i * 0.15 }}s">

                            <div class="flex justify-end pr-8">
                                @if($left)
                                    @if($i < 2)
                                        <button type="button"
                                                @mouseenter="hovered = {{ $i }}"
                                                @mouseleave="hovered = null"
                                                @click="modal = {{ $i }}"
                                                class="w-full max-w-xs text-right cursor-pointer group">
                                            <h3 class="font-bold dark:text-white text-slate-900
                                                       text-lg leading-snug mb-1
                                                       group-hover:text-accent transition-colors">
                                                {{ $edu['school'] }}
                                            </h3>
                                            <p class="font-mono text-xs text-accent
                                                      tracking-widest uppercase mb-2">
                                                {{ $edu['degree'] }}
                                            </p>
                                            <p class="text-sm dark:text-dark-muted text-slate-500 leading-relaxed mb-2">
                                                {{ $edu['desc'] }}
                                            </p>
                                            <p class="font-mono text-xs dark:text-slate-500 text-slate-400">
                                                {{ $edu['period'] }}
                                            </p>
                                        </button>
                                    @else
                                        <div class="w-full max-w-xs text-right">
                                            <h3 class="font-bold dark:text-white text-slate-900
                                                       text-lg leading-snug mb-1">
                                                {{ $edu['school'] }}
                                            </h3>
                                            <p class="font-mono text-xs text-accent
                                                      tracking-widest uppercase mb-2">
                                                {{ $edu['degree'] }}
                                            </p>
                                            <p class="font-mono text-xs dark:text-slate-500 text-slate-400">
                                                {{ $edu['period'] }}
                                            </p>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <div class="flex flex-col items-center pt-2.5 relative z-10">
                                <div class="w-4 h-4 rounded-full border-2 shrink-0
                                            dark:bg-dark-border bg-slate-300
                                            dark:border-accent/50 border-slate-400">
                                </div>
                            </div>

                            <div class="flex justify-start pl-8">
                                @if(!$left)
                                    @if($i < 2)
                                        <button type="button"
                                                @mouseenter="hovered = {{ $i }}"
                                                @mouseleave="hovered = null"
                                                @click="modal = {{ $i }}"
                                                class="w-full max-w-xs text-left cursor-pointer group">
                                            <h3 class="font-bold dark:text-white text-slate-900
                                                       text-lg leading-snug mb-1
                                                       group-hover:text-accent transition-colors">
                                                {{ $edu['school'] }}
                                            </h3>
                                            <p class="font-mono text-xs text-accent
                                                      tracking-widest uppercase mb-2">
                                                {{ $edu['degree'] }}
                                            </p>
                                            <p class="text-sm dark:text-dark-muted text-slate-500 leading-relaxed mb-2">
                                                {{ $edu['desc'] }}
                                            </p>
                                            <p class="font-mono text-xs dark:text-slate-500 text-slate-400">
                                                {{ $edu['period'] }}
                                            </p>
                                        </button>
                                    @else
                                        <div class="w-full max-w-xs text-left">
                                            <h3 class="font-bold dark:text-white text-slate-900
                                                       text-lg leading-snug mb-1">
                                                {{ $edu['school'] }}
                                            </h3>
                                            <p class="font-mono text-xs text-accent
                                                      tracking-widest uppercase mb-2">
                                                {{ $edu['degree'] }}
                                            </p>
                                            <p class="font-mono text-xs dark:text-slate-500 text-slate-400">
                                                {{ $edu['period'] }}
                                            </p>
                                        </div>
                                    @endif
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>
            </div>{{-- end hidden md:block --}}

            <template x-for="(item, i) in items" :key="'preview-' + i">
                <div x-show="hovered === i"
                     x-cloak
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-end="opacity-0 translate-y-2"
                     class="fixed bottom-8 right-8 z-40 w-72 pointer-events-none
                            dark:bg-dark-card bg-white
                            border dark:border-accent/30 border-cyan-300
                            rounded-2xl p-5 shadow-2xl">

                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-7 h-7 rounded-lg bg-accent/10
                                    flex items-center justify-center shrink-0">
                            <i class="fas fa-graduation-cap text-accent text-xs"></i>
                        </div>
                        <span class="font-mono text-[10px] text-accent tracking-widest uppercase"
                              x-text="item.period"></span>
                    </div>

                    <p class="font-bold dark:text-white text-slate-900 text-sm mb-0.5"
                       x-text="item.degree"></p>
                    <p class="font-mono text-xs text-accent mb-3"
                       x-text="item.school"></p>

                    <p class="text-xs dark:text-slate-400 text-slate-600 leading-relaxed line-clamp-2"
                       x-text="item.desc"></p>

                    <p class="font-mono text-[10px] text-accent/60 mt-3">
                        Click to view details →
                    </p>
                </div>
            </template>

            <template x-for="(item, i) in items" :key="'modal-' + i">
                <div x-show="modal === i"
                     x-cloak
                     @click.self="modal = null"
                     @keydown.escape.window="modal = null"
                     class="fixed inset-0 z-50 flex items-center justify-center p-4
                            bg-black/60 backdrop-blur-sm">

                    <div x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="relative w-full max-w-md
                                dark:bg-dark-card bg-white
                                border dark:border-dark-border border-slate-200
                                rounded-2xl p-8 shadow-2xl">

                        <button @click="modal = null"
                                class="absolute top-4 right-4 w-7 h-7
                                       dark:bg-dark-bg bg-slate-100
                                       rounded-lg flex items-center justify-center
                                       dark:text-dark-muted text-slate-500
                                       hover:text-accent transition-colors text-xs">
                            <i class="fas fa-xmark"></i>
                        </button>

                        <div class="w-12 h-12 rounded-xl bg-accent/10
                                    flex items-center justify-center mb-5">
                            <i class="fas fa-graduation-cap text-accent text-lg"></i>
                        </div>

                        <p class="font-mono text-xs text-accent tracking-widest uppercase mb-2"
                           x-text="item.period"></p>
                        <h3 class="font-bold dark:text-white text-slate-900 text-xl leading-snug mb-1"
                            x-text="item.degree"></h3>
                        <p class="font-mono text-sm text-accent mb-5"
                           x-text="item.school"></p>

                        <div class="h-px dark:bg-dark-border bg-slate-100 mb-5"></div>

                        <p class="dark:text-slate-400 text-slate-600 text-sm leading-relaxed"
                           x-text="item.desc"></p>
                    </div>
                </div>
            </template>

        </div>
    </div>
</section>

<section class="py-20 border-b dark:border-dark-border border-slate-200 overflow-x-hidden">
    <div class="max-w-7xl mx-auto px-6">

        <p class="font-mono text-xs text-accent tracking-widest uppercase mb-3">
            // leadership_&_activities
        </p>
        <h2 class="text-3xl font-bold dark:text-white text-slate-900 mb-12">
            Leadership &amp; Activities
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            @foreach($leadership as $i => $item)
                <div class="dark:bg-dark-card bg-white
                            border dark:border-dark-border border-slate-200
                            rounded-2xl p-6 card-lift shadow-sm animate-fade-up min-w-0 overflow-hidden"
                     style="animation-delay:{{ $i * 0.08 }}s">

                    <div class="flex items-start justify-between gap-4">
                        <div class="w-10 h-10 rounded-xl bg-accent/10 border border-accent/20
                                    flex items-center justify-center shrink-0">
                            <i class="fas fa-users text-accent text-sm"></i>
                        </div>
                        <span class="font-mono text-xs dark:text-dark-muted text-slate-400
                                     dark:bg-dark-bg bg-slate-100
                                     border dark:border-dark-border border-slate-200
                                     px-3 py-1 rounded-full whitespace-nowrap">
                            {{ $item['years'] }}
                        </span>
                    </div>

                    <div class="mt-4">
                        <p class="font-bold dark:text-white text-slate-900 text-base leading-snug mb-1">
                            {{ $item['role'] }}
                        </p>
                        <div class="overflow-hidden w-full mt-1">
                            <p class="ticker font-mono text-xs text-accent tracking-wide">
                                {{ $item['org'] }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-20 dark:bg-dark-bg bg-white
                border-b dark:border-dark-border border-slate-200 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">

        <p class="font-mono text-xs text-accent tracking-widest uppercase mb-3">
            // certificates_&_seminars
        </p>
        <h2 class="text-3xl font-bold dark:text-white text-slate-900 mb-12">
            Certificates &amp; Seminars
        </h2>

        <script>
            document.addEventListener('alpine:init', function () {
                Alpine.data('certCarousel', function () {
                    return {
                        items: @json($certificates),
                        current: 0,
                        timer: null,
                        init() {
                            this.timer = setInterval(() => {
                                this.current = (this.current + 1) % this.items.length;
                            }, 4000);
                        },
                        next() {
                            this.current = (this.current + 1) % this.items.length;
                            this.resetTimer();
                        },
                        prev() {
                            this.current = (this.current - 1 + this.items.length) % this.items.length;
                            this.resetTimer();
                        },
                        goto(i) {
                            this.current = i;
                            this.resetTimer();
                        },
                        resetTimer() {
                            clearInterval(this.timer);
                            this.timer = setInterval(() => {
                                this.current = (this.current + 1) % this.items.length;
                            }, 4000);
                        }
                    };
                });
            });
        </script>

        <div x-data="certCarousel"
             @keydown.arrow-right.window="next()"
             @keydown.arrow-left.window="prev()">

            <div class="relative">

                <div class="overflow-hidden rounded-2xl">
                    <div class="flex"
                         :style="'transform: translateX(-' + (current * 100) + '%); transition: transform 0.5s cubic-bezier(.4,0,.2,1)'">

                        @foreach($certificates as $cert)
                            <div class="w-full shrink-0">
                                <div class="group dark:bg-dark-card bg-slate-50
                                            border dark:border-dark-border border-slate-200
                                            rounded-2xl overflow-hidden shadow-sm
                                            flex flex-col md:flex-row md:min-h-[480px]">

                                    <div class="md:w-1/2 aspect-[3/2] md:aspect-auto
                                                dark:bg-dark-bg bg-slate-200
                                                flex items-center justify-center
                                                relative overflow-hidden shrink-0">
                                        @if($cert['image'])
                                            <img src="{{ asset($cert['image']) }}"
                                                 alt="{{ $cert['title'] }}"
                                                 class="w-full h-full object-cover
                                                        transition-transform duration-700 ease-in-out
                                                        group-hover:scale-110 origin-center">
                                        @else
                                            <div class="absolute inset-0 dot-grid opacity-40"></div>
                                            <div class="relative z-10 text-center px-8
                                                        transition-transform duration-700 ease-in-out
                                                        group-hover:scale-110">
                                                <div class="w-20 h-20 rounded-2xl bg-accent/10
                                                            border border-accent/20
                                                            flex items-center justify-center mx-auto mb-4">
                                                    <i class="fas fa-certificate text-3xl text-accent/60"></i>
                                                </div>
                                                <p class="font-mono text-xs text-accent/40 tracking-widest uppercase">
                                                    Certificate Image
                                                </p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="md:w-1/2 flex flex-col justify-center p-8 md:p-14">
                                        <div class="inline-flex items-center gap-2 mb-5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-accent shrink-0"></span>
                                            <span class="font-mono text-xs text-accent tracking-widest uppercase">
                                                {{ $cert['year'] }}
                                            </span>
                                        </div>
                                        <h3 class="text-2xl md:text-3xl font-bold leading-snug mb-4
                                                   dark:text-white text-slate-900
                                                   transition-all duration-500
                                                   group-hover:text-accent
                                                   group-hover:[text-shadow:0_0_32px_rgba(0,229,204,0.55)]">
                                            {{ $cert['title'] }}
                                        </h3>
                                        <p class="font-mono text-sm text-accent">
                                            {{ $cert['issuer'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <button @click="prev()"
                        class="absolute left-3 top-[calc((100vw-3rem)/3)] sm:top-1/2 -translate-y-1/2 z-10
                               w-10 h-10 rounded-full
                               dark:bg-dark-bg/90 bg-white/90 backdrop-blur-sm
                               border dark:border-dark-border border-slate-200
                               dark:text-slate-400 text-slate-500
                               hover:border-accent hover:text-accent
                               transition-all shadow-lg flex items-center justify-center">
                    <i class="fas fa-chevron-left text-sm"></i>
                </button>

                <button @click="next()"
                        class="absolute right-3 top-[calc((100vw-3rem)/3)] sm:top-1/2 -translate-y-1/2 z-10
                               w-10 h-10 rounded-full
                               dark:bg-dark-bg/90 bg-white/90 backdrop-blur-sm
                               border dark:border-dark-border border-slate-200
                               dark:text-slate-400 text-slate-500
                               hover:border-accent hover:text-accent
                               transition-all shadow-lg flex items-center justify-center">
                    <i class="fas fa-chevron-right text-sm"></i>
                </button>
            </div>

            <div class="flex items-center justify-center gap-2 mt-8 flex-wrap">
                @foreach($certificates as $di => $__)
                    <button @click="goto({{ $di }})"
                            :class="current === {{ $di }}
                                    ? 'w-6 bg-accent'
                                    : 'w-2 dark:bg-dark-border bg-slate-300 hover:bg-accent/50'"
                            class="h-2 rounded-full transition-all duration-300 shrink-0">
                    </button>
                @endforeach
            </div>

            <p class="text-center font-mono text-xs dark:text-dark-muted text-slate-400 mt-3 tabular-nums">
                <span x-text="String(current + 1).padStart(2, '0')"></span>
                &nbsp;/&nbsp;{{ str_pad(count($certificates), 2, '0', STR_PAD_LEFT) }}
            </p>

        </div>
    </div>
</section>

<section class="py-20">
    <div class="max-w-7xl mx-auto px-6">

        <p class="font-mono text-xs text-accent tracking-widest uppercase mb-3">
            // technological_stack
        </p>
        <h2 class="text-3xl font-bold dark:text-white text-slate-900 mb-12">
            Technological Stack
        </h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($techStack as $i => $tech)
                <div class="dark:bg-dark-card bg-white
                            border dark:border-dark-border border-slate-200
                            rounded-2xl p-6 card-lift shadow-sm animate-fade-up"
                     style="animation-delay:{{ $i * 0.05 }}s">

                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl shrink-0"
                             style="background:{{ $tech['color'] }}1a; color:{{ $tech['color'] }}">
                            <i class="{{ $tech['icon'] }}"></i>
                        </div>
                        <h3 class="font-mono text-sm font-bold
                                   dark:text-white text-slate-800
                                   uppercase tracking-widest leading-tight">
                            {{ $tech['name'] }}
                        </h3>
                    </div>

                    <div class="space-y-2 mb-4">
                        @foreach(array_slice($tech['tags'], 0, 2) as $tag)
                            <div class="flex items-center gap-2
                                        dark:bg-dark-bg bg-slate-50
                                        border dark:border-dark-border border-slate-200
                                        rounded-lg px-3 py-2">
                                <span class="w-1.5 h-1.5 rounded-full shrink-0"
                                      style="background:{{ $tech['color'] }}"></span>
                                <span class="text-sm dark:text-slate-300 text-slate-700 font-medium">
                                    {{ $tag }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    @if(count($tech['tags']) > 2)
                        <div class="flex flex-wrap gap-2 pt-3
                                    border-t dark:border-dark-border border-slate-100">
                            @foreach(array_slice($tech['tags'], 2) as $tag)
                                <span class="tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
