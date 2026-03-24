<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    private array $config = [
        'name'     => 'Alex Morgan',
        'role'     => 'Full Stack Engineer',
        'tagline'  => 'Architecting high-performance digital systems that bridge the gap between complex logic and intuitive user experiences.',
        'email'    => 'alex@architect.io',
        'location' => 'Austin, TX',
        'github'   => 'https://github.com/alexmorgan',
        'linkedin' => 'https://linkedin.com/in/alexmorgan',
        'twitter'  => 'https://twitter.com/alexmorgan',
        'available'=> true,
    ];

    private array $projects = [
        [
            'slug'        => 'quantum-ledger',
            'title'       => 'Quantum_Ledger',
            'subtitle'    => 'Distributed financial infrastructure',
            'description' => 'A blockchain-inspired ledger system for high-frequency financial transactions. Handles 10M+ operations per day with sub-15ms latency.',
            'tags'        => ['Laravel', 'PHP', 'Redis', 'PostgreSQL', 'Docker'],
            'github'      => '#',
            'live'        => '#',
            'year'        => '2024',
            'category'    => 'Backend Infrastructure',
        ],
        [
            'slug'        => 'neural-os',
            'title'       => 'NEURAL_OS v2.0',
            'subtitle'    => 'AI-driven operating interface',
            'description' => 'Fragmented data pipelines were causing significant latency in critical financial decision-making environments. NEURAL_OS v2.0 unifies distributed services into a single coherent runtime.',
            'long_description' => "The core challenge was designing a system that could ingest heterogeneous data streams — market feeds, sensor arrays, and user telemetry — and produce actionable intelligence in under 12ms.\n\nWe built a modular pipeline architecture with zero-copy memory management and GPU-accelerated tensor operations at the edge.",
            'tags'        => ['Node.js', 'TypeScript', 'WebSockets', 'TensorFlow', 'Kubernetes'],
            'github'      => '#',
            'live'        => '#',
            'year'        => '2024',
            'category'    => 'AI / Systems',
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
            'slug'        => 'atlas-protocol',
            'title'       => 'Atlas_Protocol',
            'subtitle'    => 'Decentralized identity layer',
            'description' => 'A self-sovereign identity protocol enabling users to own and control their digital credentials across platforms without a central authority.',
            'tags'        => ['Rust', 'WebAssembly', 'IPFS', 'Solidity'],
            'github'      => '#',
            'live'        => null,
            'year'        => '2023',
            'category'    => 'Web3 / Security',
        ],
        [
            'slug'        => 'ether-sync',
            'title'       => 'Ether_Sync',
            'subtitle'    => 'Real-time data synchronization engine',
            'description' => 'Multi-platform sync engine with conflict resolution, offline support, and end-to-end encryption for collaborative workspaces.',
            'tags'        => ['Go', 'gRPC', 'SQLite', 'React'],
            'github'      => '#',
            'live'        => '#',
            'year'        => '2023',
            'category'    => 'Infrastructure',
        ],
        [
            'slug'        => 'vanguard-jobble',
            'title'       => 'Vanguard_Jobble',
            'subtitle'    => 'Intelligent job queue processor',
            'description' => 'Priority-aware distributed job queue with adaptive concurrency, dead-letter recovery, and real-time monitoring dashboard.',
            'tags'        => ['Laravel', 'Redis', 'Vue.js', 'Horizon'],
            'github'      => '#',
            'live'        => '#',
            'year'        => '2023',
            'category'    => 'DevOps / Backend',
        ],
        [
            'slug'        => 'build-process',
            'title'       => 'Build_Process',
            'subtitle'    => 'CI/CD orchestration platform',
            'description' => 'A lightweight build orchestration platform supporting parallel pipelines, artifact caching, and multi-cloud deployment targets.',
            'tags'        => ['Python', 'Docker', 'AWS', 'Terraform'],
            'github'      => '#',
            'live'        => null,
            'year'        => '2022',
            'category'    => 'DevOps',
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

    private array $arsenal = [
        'Frontend' => [
            'primary'   => ['React / Next.js', 'Vue.js / Nuxt', 'TypeScript'],
            'secondary' => ['Alpine.js', 'Tailwind CSS', 'Three.js'],
        ],
        'Backend' => [
            'primary'   => ['Laravel / PHP', 'Node.js / Express', 'Go'],
            'secondary' => ['PostgreSQL', 'Redis', 'GraphQL'],
        ],
        'Tools' => [
            'primary'   => ['Docker / K8s', 'AWS / GCP', 'Terraform'],
            'secondary' => ['GitHub Actions', 'Datadog', 'Linear'],
        ],
    ];

    // ──────────────────────────────────────────────

    public function home()
    {
        return view('portfolio.home', [
            ...$this->config,
            'featured'   => array_slice($this->projects, 0, 2),
            'techStack'  => [
                ['name' => 'React & Ecosystem', 'icon' => 'fab fa-react', 'tags' => ['Redux', 'Next.js', 'React Query'], 'color' => '#61dafb'],
                ['name' => 'Node.js',            'icon' => 'fab fa-node-js', 'tags' => ['Express', 'Fastify', 'tRPC'],    'color' => '#68a063'],
                ['name' => 'TypeScript',          'icon' => 'fas fa-code',   'tags' => ['Zod', 'Prisma', 'tRPC'],         'color' => '#3178c6'],
            ],
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
            'experience' => $this->experience,
            'arsenal'    => $this->arsenal,
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
}
