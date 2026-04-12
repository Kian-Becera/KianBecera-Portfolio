<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    private array $config = [
        'name'     => 'KIAN BECERA',
        'role'     => 'Software Engineer',
        'tagline'  => 'Bridging the Gap Between Design and Technical Execution.',
        'email'    => 'becera.kian@gmail.com',
        'location' => 'Bacolod City, Negros Occidental, Philippines',
        'github'   => 'https://github.com/Kian-Becera',
        'linkedin' => 'https://www.linkedin.com/in/kian-becera-377926278?utm_source=share_via&utm_content=profile&utm_medium=member_android',
        'twitter'  => 'https://x.com/kyaa_nnn',
        'available'=> true,

        // ── Static assets (drop files into public/ and update the filename) ──
        'avatar'   => 'images/avatar/profile.jpg',
        'resume'   => 'files/resume/Becera_Kian Resume.pdf',             // e.g. 'files/resume/kian-becera-cv.pdf'
        'demo_video' => null,           // e.g. 'videos/portfolio-demo.mp4'
    ];

    private array $projects = [
        [
            'slug'        => 'qms',
            'title'       => 'Queueing Management System',
            'subtitle'    => 'QMS of Business Permits and Licensing Office',
            'description' => 'A comprehensive Queue Management System designed for the Talisay City BPLO featuring virtual queuing, real-time monitoring, and automated notifications to enhance service efficiency and overall usability.',
            'tags'        => ['ADOBEXD', 'VB.NET', 'C#', 'SQL'],
            'role'      => 'Contributor / UI Designer',
            'live'        => '#',
            'year'        => '© 2022',
            'category'    => 'TECH STACK',
        ],
        [
            'slug'        => 'cotamila-coffee',
            'title'       => 'Cotamila Coffee',
            'subtitle'    => 'AI-driven operating interface',
            'description' => 'A high-performance WordPress site for an artisan coffee shop featuring a customized theme, integrated local environment migration, and optimized performance for a seamless customer experience.',
            'long_description' => "The core challenge was designing a system that could ingest heterogeneous data streams — market feeds, sensor arrays, and user telemetry — and produce actionable intelligence in under 12ms.\n\nWe built a modular pipeline architecture with zero-copy memory management and GPU-accelerated tensor operations at the edge.",
            'tags'        => ['Stitch', 'Wordpress', 'SQL', 'PHP', 'Elementor', 'CUSTOMIZED THEME'],
            'role'      => 'Developer / UI Designer',
            'live'        => '#',
            'year'        => '© 2026',
            'category'    => 'TECH STACK',
            'metrics'     => [
                ['label' => 'Uptime', 'value' => '99.8%'],
                ['label' => 'Latency', 'value' => '12ms'],
                ['label' => 'Operations', 'value' => '10M+'],
            ],
            'tech_details' => [
                ['title' => 'GPU-Accelerated Rendering', 'desc' => 'Harnessing the power of WebGPU to render complex data structures in real-time across distributed node clusters.'],
                ['title' => 'Zero Knowledge Auth', 'desc' => 'Privacy-preserving authentication using zk-SNARKs — users prove identity without revealing sensitive data.'],
                ['title' => 'WASM Pipeline', 'desc' => 'WebAssembly modules handle computationally intensive tasks at near-native speed in the browser.'],
                ['title' => 'Modular UI Architecture', 'desc' => 'Micro-frontend pattern with lazy-loaded modules, shared state bus, and hot-reload capability in production.'],
            ],
            'code_snippet' => "// Optimizing the WebSocket Bridge\nconst bridge = new NeuralBridge({\n  transport: 'ws://neural.local:9000',\n  compression: 'lz4',\n  maxRetries: 3,\n  onMessage: (payload) => {\n    pipeline.ingest(payload);\n    metrics.record('latency', Date.now());\n  }\n});\n\nawait bridge.connect();",
        ],
        [
            'slug'        => 'writerity',
            'title'       => 'Writerity',
            'subtitle'    => 'Decentralized identity layer',
            'description' => 'A self-sovereign identity protocol enabling users to own and control their digital credentials across platforms without a central authority.',
            'tags'        => ['Wordpress', 'PHP', 'WPBakery', 'ACF', 'SQL'],
            'role'      => 'Contributor / UI Designer / Project Maintainer',
            'live'        => null,
            'year'        => '© 2026',
            'category'    => 'TECH STACK',
        ],
        [
            'slug'        => 'ams',
            'title'       => 'AMS',
            'subtitle'    => 'Real-time data synchronization engine',
            'description' => 'Multi-platform sync engine with conflict resolution, offline support, and end-to-end encryption for collaborative workspaces.',
            'tags'        => ['React', 'Tailwind CSS', 'OPENAI', 'Appscript'],
            'role'      => 'Co-Developer',
            'live'        => '#',
            'year'        => '2025',
            'category'    => 'TECH STACK',
        ],
        [
            'slug'        => 'katsumok',
            'title'       => 'Katsumok',
            'subtitle'    => 'Intelligent job queue processor',
            'description' => 'Priority-aware distributed job queue with adaptive concurrency, dead-letter recovery, and real-time monitoring dashboard.',
            'tags'        => ['Wordpress', 'PHP', 'ACF', 'SQL'],
            'role'      => 'Contributor / UI Designer / Project Maintainer',
            'live'        => '#',
            'year'        => '2024',
            'category'    => 'TECH STACK',
        ],
        [
            'slug'        => 'build-process',
            'title'       => 'Build_Process',
            'subtitle'    => 'CI/CD orchestration platform',
            'description' => 'A lightweight build orchestration platform supporting parallel pipelines, artifact caching, and multi-cloud deployment targets.',
            'tags'        => ['Python', 'Docker', 'AWS', 'Terraform'],
            'role'      => '#',
            'live'        => null,
            'year'        => '2022',
            'category'    => 'TECH STACK',
        ],
    ];

    private array $experience = [
        [
            'role'    => 'Principal Engineer',
            'company' => 'Hyperion Systems',
            'period'  => '2022 – Present',
            'tags'    => ['Laravel', 'Go', 'AWS'],
            'desc'    => 'Architecting scalable microservices for enterprise clients. Led a team of 8 engineers to deliver a distributed ledger platform processing $2B+ in daily transactions.',
        ],
        [
            'role'    => 'Senior Full Stack Developer',
            'company' => 'Neural Node',
            'period'  => '2020 – 2022',
            'tags'    => ['React', 'Node.js', 'PostgreSQL'],
            'desc'    => 'Principal developer for an AI-powered analytics platform. Reduced infrastructure costs by 60% through intelligent caching and query optimization.',
        ],
        [
            'role'    => 'Full Stack Engineer',
            'company' => 'Void Creative',
            'period'  => '2018 – 2020',
            'tags'    => ['Vue.js', 'Laravel', 'MySQL'],
            'desc'    => 'Built bespoke web platforms for creative agencies. Shipped 14 client projects across e-commerce, media, and fintech verticals.',
        ],
    ];

    private array $techStack = [
        ['name' => 'WordPress',             'icon' => 'fab fa-wordpress',   'tags' => ['Elementor', 'WPBakery', 'ACF'],          'color' => '#21759b'],
        ['name' => 'React & Ecosystem',     'icon' => 'fab fa-react',       'tags' => ['Redux', 'React Query'],                  'color' => '#61dafb'],
        ['name' => 'Node.js',               'icon' => 'fab fa-node-js',     'tags' => ['Express', 'Fastify', 'tRPC'],            'color' => '#68a063'],
        ['name' => 'Laravel',               'icon' => 'fab fa-laravel',     'tags' => ['Blade', 'Herd', 'Sail'],                 'color' => '#ff2d20'],
        ['name' => 'UI / UX',               'icon' => 'fas fa-pen-ruler',   'tags' => ['Figma', 'Adobe XD', 'Stitch'],           'color' => '#a259ff'],
        ['name' => 'HTML5 / CSS3 / JS',     'icon' => 'fab fa-html5',       'tags' => ['CSS3', 'SCSS', 'Tailwind'],        'color' => '#e34f26'],
        ['name' => 'Dart & Flutter',        'icon' => 'fas fa-mobile-screen','tags' => ['Flutter', 'Dart', 'FlutterFlow'],       'color' => '#54c5f8'],
        ['name' => 'Google Ecosystem',      'icon' => 'fab fa-google',      'tags' => ['Apps Script', 'Stitch', 'AI Studio'],    'color' => '#4285f4'],
        ['name' => 'Database',              'icon' => 'fas fa-database',    'tags' => ['SQLite', 'MySQL', 'SQL'],                'color' => '#00758f'],
        ['name' => 'Appwrite',              'icon' => 'fas fa-server',      'tags' => ['Auth', 'Functions', 'Storage'],          'color' => '#fd366e'],
        ['name' => 'AI Tools & Automation', 'icon' => 'fas fa-robot',       'tags' => ['DifyAI', 'n8n', 'Automation'],           'color' => '#7c3aed'],
        ['name' => 'Git & GitHub',          'icon' => 'fab fa-github',      'tags' => ['Git', 'GitHub Actions', 'CI/CD'],        'color' => '#f05032'],
        ['name' => 'Tools',                 'icon' => 'fas fa-screwdriver-wrench', 'tags' => ['Docker', 'XAMPP', 'Laragon'],       'color' => '#f59e0b'],
    ];

    private array $certificates = [
        [
            'image'  => 'images/certificates/blastik.jpeg',
            'title'  => 'Blastik Workshop for PSITS Organization',
            'issuer' => 'Peacepond - Binalbagan, Negros Occidental',
            'year'   => '2020',
        ],
        [
            'image'  => 'images/certificates/dict.jpeg',
            'title'  => 'Startup Basiqs+',
            'issuer' => 'Department of Information and Communications Technology (DICT) - Philippines',
            'year'   => '2021',
        ],
        [
            'image'  => 'images/certificates/glitch.png',
            'title'  => 'PUPSJ GLITCH Cybersecurity Webinar ',
            'issuer' => 'Polythechnic University of the Philippines - San Juan Campus',
            'year'   => '2022',
        ],
        [
            'image'  => null,
            'title'  => 'Synology Virtual Solution Day 2022',
            'issuer' => 'Synology',
            'year'   => '2022',
        ],
        [
            'image'  => null,
            'title'  => 'Financial Management Services Division Policies and Procedures',
            'issuer' => 'Finance Office - CHMSU Talisay Campus',
            'year'   => '2023',
        ],
        [
            'image'  => 'images/certificates/opswat.png',
            'title'  => 'OPSWAT ACADEMY CERTIFICATIONS',
            'issuer' => 'OPSWAT',
            'year'   => '2023',
        ],
        [
            'image'  => 'images/certificates/lasalle.png',
            'title'  => 'USLS ISG Career Talk 2023 ',
            'issuer' => 'University of St. La Salle Bacolod Campus',
            'year'   => '2023',
        ],
        [
            'image'  => 'images/certificates/devdesign.png',
            'title'  => 'DevSign Philippines: Introduction to Basic Python ',
            'issuer' => 'DevSign Philippines',
            'year'   => '2024',
        ],
        [
            'image'  => 'images/certificates/datascience.png',
            'title'  => 'DICT-ITU DTC Initiative through the Cisco Networking Academy program: Introduction to Data Science',
            'issuer' => 'Department of Information and Communications Technology (DICT) - Philippines',
            'year'   => '2025',
        ],
        [
            'image'  => null,
           'title'  => 'DICT-ITU DTC Initiative through the Cisco Networking Academy program: Introduction to Cybersecurity',
            'issuer' => 'Department of Information and Communications Technology (DICT) - Philippines',
            'year'   => '2025',
        ],
    ];

    private array $education = [
        [
            'degree'  => 'Elementary Education',
            'school'  => 'Patlagan Elementary School',
            'period'  => '2006 – 2013',
            'desc'    => 'First Honarable Mention',
        ],
        [
            'degree'  => 'High School - Senior High School (GAS Track)',
            'school'  => 'Manapla National High School ',
            'period'  => '2014 – 2019',
            'desc'    => 'With Honors, Governor’s Gold Medal Awardee ',
        ],
        [
            'degree'  => 'Bachelor of Science in Information Systems',
            'school'  => 'Carlos Hilado Memorial State University (CHMSU) - Talisay Campus',
            'period'  => '2019 – 2023',
            'desc'    => 'Completed a full-stack information systems degree covering software development, database administration, systems analysis, and network fundamentals.',
        ],
        [
            'degree'  => 'Masters in Information Technology',
            'school'  => 'State University of Northern Negros (SUNN)',
            'period'  => '2025 – Ongoing',
            'desc'    => 'Graduate-level study focused on advanced software engineering, research methodologies, and emerging technologies in information systems.',
        ],
    ];

    private array $leadership = [
        [
            'org'   => 'Philippine Society of Information Technology Students (PSITS)',
            'role'  => 'Board of Director ',
            'years' => '2019 – 2021',
        ],
        [
            'org'   => 'Philippine Society of Information Technology Students (PSITS)',
            'role'  => 'Vice President-External',
            'years' => '2021 – 2022',
        ],
        [
            'org'   => 'University Student Government (U.S.G), CHMSU ',
            'role'  => 'CCS Senator',
            'years' => '2022 – 2023',
        ],
        [
            'org'   => 'Federation Student Government (F.S.G), CHMSU ',
            'role'  => 'Board Member',
            'years' => '2022 – 2023',
        ],
    ];

    // ──────────────────────────────────────────────

    public function home()
    {
        return view('portfolio.home', [
            ...$this->config,
            'featured'   => array_slice($this->projects, 0, 2),
            'techStack'  => $this->techStack,
        ]);
    }

    public function projects()
    {
        return view('portfolio.projects', [
            ...$this->config,
            'projects' => $this->projects,
        ]);
    }

    public function projectDetail(string $slug)
    {
        $project = collect($this->projects)->firstWhere('slug', $slug);
        abort_if(!$project, 404);

        return view('portfolio.project-detail', [
            ...$this->config,
            'project' => $project,
        ]);
    }

    public function about()
    {
        return view('portfolio.about', [
            ...$this->config,
            'techStack'    => $this->techStack,
            'education'    => $this->education,
            'certificates' => $this->certificates,
            'leadership'   => $this->leadership,
        ]);
    }

    public function experience()
    {
        return view('portfolio.experience', [
            ...$this->config,
            'experience' => $this->experience,
            'arsenal'    => $this->techStack,
        ]);
    }

    public function contact()
    {
        return view('portfolio.contact', [
            ...$this->config,
        ]);
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'budget'  => 'nullable|string|max:50',
            'message' => 'required|string|max:3000',
        ]);

        return redirect()->route('contact')
            ->with('success', 'Transmission received. I\'ll respond within 24 hours.');
    }

    public function downloadResume()
    {
        $path = public_path($this->config['resume'] ?? 'files/resume/.gitkeep');

        if (! file_exists($path) || str_ends_with($path, '.gitkeep')) {
            abort(404, 'Resume not yet uploaded.');
        }

        return response()->download($path, 'Kian-Becera-Resume.pdf');
    }
}
