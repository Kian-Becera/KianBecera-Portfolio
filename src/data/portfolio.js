export const config = {
  name:      'KIAN BECERA',
  role:      'Software Engineer',
  tagline:   'Bridging the Gap Between Design and Technical Execution.',
  email:     'becera.kian@gmail.com',
  location:  'Bacolod City, Negros Occidental, Philippines',
  github:    'https://github.com/Kian-Becera',
  linkedin:  'https://www.linkedin.com/in/kian-becera-377926278?utm_source=share_via&utm_content=profile&utm_medium=member_android',
  twitter:   'https://x.com/kyaa_nnn',
  available: true,
  avatar:    '/images/avatar/profile.jpg',
  resume:    '/files/resume/Becera_Kian Resume.pdf',
};

export const projects = [
  {
    slug:        'qms',
    title:       'Queueing Management System',
    subtitle:    'QMS of Business Permits and Licensing Office',
    description: 'A comprehensive Queue Management System designed for the Talisay City BPLO featuring virtual queuing, real-time monitoring, and automated notifications to enhance service efficiency and overall usability.',
    tags:        ['ADOBEXD', 'VB.NET', 'C#', 'SQL'],
    role:        'Contributor / UI Designer',
    live:        '#',
    year:        '© 2022',
    category:    'TECH STACK',
  },
  {
    slug:        'cotamila-coffee',
    title:       'Cotamila Coffee',
    subtitle:    'AI-driven operating interface',
    description: 'A high-performance WordPress site for an artisan coffee shop featuring a customized theme, integrated local environment migration, and optimized performance for a seamless customer experience.',
    long_description: "The core challenge was designing a system that could ingest heterogeneous data streams — market feeds, sensor arrays, and user telemetry — and produce actionable intelligence in under 12ms.\n\nWe built a modular pipeline architecture with zero-copy memory management and GPU-accelerated tensor operations at the edge.",
    tags:        ['Wordpress', 'SQL', 'PHP', 'Customized Theme'],
    role:        'Developer / UI Designer',
    live:        '#',
    year:        '© 2026',
    category:    'TECH STACK',
    metrics: [
      { label: 'Uptime',     value: '99.8%' },
      { label: 'Latency',    value: '12ms'  },
      { label: 'Operations', value: '10M+'  },
    ],
    tech_details: [
      { title: 'GPU-Accelerated Rendering', desc: 'Harnessing the power of WebGPU to render complex data structures in real-time across distributed node clusters.' },
      { title: 'Zero Knowledge Auth',       desc: 'Privacy-preserving authentication using zk-SNARKs — users prove identity without revealing sensitive data.' },
      { title: 'WASM Pipeline',             desc: 'WebAssembly modules handle computationally intensive tasks at near-native speed in the browser.' },
      { title: 'Modular UI Architecture',   desc: 'Micro-frontend pattern with lazy-loaded modules, shared state bus, and hot-reload capability in production.' },
    ],
    code_snippet: "// Optimizing the WebSocket Bridge\nconst bridge = new NeuralBridge({\n  transport: 'ws://neural.local:9000',\n  compression: 'lz4',\n  maxRetries: 3,\n  onMessage: (payload) => {\n    pipeline.ingest(payload);\n    metrics.record('latency', Date.now());\n  }\n});\n\nawait bridge.connect();",
  },
  {
    slug:        'writerity',
    title:       'Writerity',
    subtitle:    'Decentralized identity layer',
    description: 'A self-sovereign identity protocol enabling users to own and control their digital credentials across platforms without a central authority.',
    tags:        ['Wordpress', 'PHP', 'WPBakery', 'ACF', 'SQL'],
    role:        'Contributor / UI Designer / Project Maintainer',
    live:        null,
    year:        '© 2026',
    category:    'TECH STACK',
  },
  {
    slug:        'ams',
    title:       'AMS',
    subtitle:    'Real-time data synchronization engine',
    description: 'Multi-platform sync engine with conflict resolution, offline support, and end-to-end encryption for collaborative workspaces.',
    tags:        ['React', 'Tailwind CSS', 'OPENAI', 'Appscript'],
    role:        'Co-Developer',
    live:        '#',
    year:        '2025',
    category:    'TECH STACK',
  },
  {
    slug:        'katsumok',
    title:       'Katsumok',
    subtitle:    'WordPress plugin for distributed job hiring and management',
    description: 'Priority-aware distributed job queue with adaptive concurrency, dead-letter recovery, and real-time monitoring dashboard.',
    tags:        ['Wordpress', 'PHP', 'ACF', 'SQL'],
    role:        'Contributor / UI Designer / Project Maintainer',
    live:        '#',
    year:        '2024',
    category:    'TECH STACK',
  },
  {
    slug:        'prinstax',
    title:       'Prinstax',
    subtitle:    'WordPress Site for a Local Photography and Printing Business',
    description: 'A lightweight build orchestration platform supporting parallel pipelines, artifact caching, and multi-cloud deployment targets.',
    tags:        ['Wordpress', 'PHP', 'ACF', 'SQL', 'Customized Theme'],
    role:        'Developer / UI Designer',
    live:        null,
    year:        '2026',
    category:    'TECH STACK',
  },
];

export const featuredSlugs = ['qms', 'prinstax'];
export const featured = projects.filter(p => featuredSlugs.includes(p.slug));

export const experience = [
  {
    role:    'Freelance Graphic Artist',
    company: 'Self-Employed',
    period:  '2022 – Ongoing',
    tags:    ['Logo Design', 'Visual Design', 'Illustration'],
    desc:    'Conceptualized and designed cohesive brand identities and visual assets, focusing on high-impact logos and marketing materials that align with client vision.',
    image: '/images/locations/manapla.png',
  },
  {
    role:    'Freelance Photographer',
    company: 'Self-Employed',
    period:  '2022 – Ongoing',
    tags:    ['Adobe Lightroom', 'Photo Editing', 'Digital Media', 'Color Theory'],
    desc:    'Specializing in visual storytelling through portrait and lifestyle photography, with a strong emphasis on color grading and aesthetic consistency.',
    image: '/images/locations/manapla.png',
  },
  {
    role:    'Computer Laboratory Assistant',
    company: 'BSIS Department, CHMSU',
    period:  '2022 – 2023',
    tags:    ['Hardware', 'Maintenance', 'Software Support'],
    desc:    'Managing laboratory infrastructure and providing technical support for software and hardware systems to ensure optimal performance for departmental operations',
    image: '/images/locations/talisay.png',
  },
  {
    role:    'Intern- OJT',
    company: 'Business Permits and Licensing Office, Municipal Hall of Manapla',
    period:  '2023',
    tags:    ['Customer Service', 'Administrative', 'Documentation'],
    desc:    'Provided administrative and technical support for business licensing operations and customer service documentation during a structured internship.',
    image: '/images/locations/manapla.png',
  },
  {
    role:    'Part-Time Crew',
    company: 'LGBTea Café & Diner',
    period:  '2023',
    tags:    ['Customer Service', 'Food and Beverage Preparation', 'Maintenance'],
    desc:    'Provided excellent customer service and operational support, focusing on efficiency and quality standards within a high-volume hospitality setting.',
    image: '/images/locations/manapla.png',
  },
  {
    role:    'Accounting Clerk',
    company: 'Accounting & Finance Office, CHMSU',
    period:  '2023',
    tags:    ['Administrative', 'Documentation', 'Student Support', 'Financial Reporting'],
    desc:    'Managed accounting and financial records, ensuring accuracy and compliance with regulations.',
    image: '/images/locations/talisay.png',
  },
  {
    role:    'Software Engineer',
    company: 'Thy Web Development Inc.',
    period:  '2023 – 2026',
    tags:    ['Web Development', 'UI/UX Design', 'Client Communication'],
    desc:    'Designing and developing custom websites for individual, small and Enterprise Businesses, focusing on responsive design and user experience.',
    image: '/images/locations/bacolod.png',
  },
];

export const techStack = [
  { name: 'WordPress',             icon: 'fab fa-wordpress',          tags: ['Elementor', 'WPBakery', 'ACF'],       color: '#21759b' },
  { name: 'React & Ecosystem',     icon: 'fab fa-react',               tags: ['Redux', 'React Query'],               color: '#61dafb' },
  { name: 'Node.js',               icon: 'fab fa-node-js',             tags: ['Express', 'Fastify', 'tRPC'],         color: '#68a063' },
  { name: 'Laravel',               icon: 'fab fa-laravel',             tags: ['Blade', 'Herd', 'Sail'],              color: '#ff2d20' },
  { name: 'UI / UX',               icon: 'fas fa-pen-ruler',           tags: ['Figma', 'Adobe XD', 'Stitch'],        color: '#a259ff' },
  { name: 'HTML5 / CSS3 / JS',     icon: 'fab fa-html5',               tags: ['CSS3', 'SCSS', 'Tailwind'],           color: '#e34f26' },
  { name: 'Dart & Flutter',        icon: 'fas fa-mobile-screen',       tags: ['Flutter', 'Dart', 'FlutterFlow'],     color: '#54c5f8' },
  { name: 'Google Ecosystem',      icon: 'fab fa-google',              tags: ['Apps Script', 'Stitch', 'AI Studio'], color: '#4285f4' },
  { name: 'Database',              icon: 'fas fa-database',            tags: ['SQLite', 'MySQL', 'SQL'],             color: '#00758f' },
  { name: 'Appwrite',              icon: 'fas fa-server',              tags: ['Auth', 'Functions', 'Storage'],       color: '#fd366e' },
  { name: 'AI Tools & Automation', icon: 'fas fa-robot',               tags: ['DifyAI', 'n8n', 'Automation'],        color: '#7c3aed' },
  { name: 'Git & GitHub',          icon: 'fab fa-github',              tags: ['Git', 'GitHub Actions', 'CI/CD'],     color: '#f05032' },
  { name: 'Tools',                 icon: 'fas fa-screwdriver-wrench',  tags: ['Docker', 'XAMPP', 'Laragon'],         color: '#f59e0b' },
];

export const certificates = [
  { image: '/images/certificates/blastik.jpeg', title: 'Blastik Workshop for PSITS Organization',                                                          issuer: 'Peacepond - Binalbagan, Negros Occidental',                                      year: '2020' },
  { image: '/images/certificates/dict.jpeg',    title: 'Startup Basiqs+',                                                                                  issuer: 'Department of Information and Communications Technology (DICT) - Philippines',   year: '2021' },
  { image: '/images/certificates/glitch.png',   title: 'PUPSJ GLITCH Cybersecurity Webinar',                                                               issuer: 'Polythechnic University of the Philippines - San Juan Campus',                   year: '2022' },
  { image: null,                                title: 'Synology Virtual Solution Day 2022',                                                                issuer: 'Synology',                                                                       year: '2022' },
  { image: null,                                title: 'Financial Management Services Division Policies and Procedures',                                    issuer: 'Finance Office - CHMSU Talisay Campus',                                          year: '2023' },
  { image: '/images/certificates/opswat.png',   title: 'OPSWAT ACADEMY CERTIFICATIONS',                                                                    issuer: 'OPSWAT',                                                                         year: '2023' },
  { image: '/images/certificates/lasalle.png',  title: 'USLS ISG Career Talk 2023',                                                                        issuer: 'University of St. La Salle Bacolod Campus',                                      year: '2023' },
  { image: '/images/certificates/devdesign.png',title: 'DevSign Philippines: Introduction to Basic Python',                                                 issuer: 'DevSign Philippines',                                                            year: '2024' },
  { image: '/images/certificates/datascience.png', title: 'DICT-ITU DTC Initiative through the Cisco Networking Academy program: Introduction to Data Science', issuer: 'Department of Information and Communications Technology (DICT) - Philippines', year: '2025' },
  { image: null,                                title: 'DICT-ITU DTC Initiative through the Cisco Networking Academy program: Introduction to Cybersecurity', issuer: 'Department of Information and Communications Technology (DICT) - Philippines', year: '2025' },
];

export const education = [
  { degree: 'Elementary Education',                          school: 'Patlagan Elementary School',                                      period: '2006 – 2013', desc: 'First Honorable Mention' },
  { degree: 'High School - Senior High School (GAS Track)',  school: 'Manapla National High School',                                    period: '2014 – 2019', desc: "With Honors, Governor's Gold Medal Awardee" },
  { degree: 'Bachelor of Science in Information Systems',    school: 'Carlos Hilado Memorial State University (CHMSU) - Talisay Campus', period: '2019 – 2023', desc: 'Completed a full-stack information systems degree covering software development, database administration, systems analysis, and network fundamentals.' },
  { degree: 'Masters in Information Technology',             school: 'State University of Northern Negros (SUNN)',                      period: '2025 – Ongoing', desc: 'Graduate-level study focused on advanced software engineering, research methodologies, and emerging technologies in information systems.' },
];

export const leadership = [
  { org: 'Philippine Society of Information Technology Students (PSITS)', role: 'Board of Director',     years: '2019 – 2021' },
  { org: 'Philippine Society of Information Technology Students (PSITS)', role: 'Vice President-External', years: '2021 – 2022' },
  { org: 'University Student Government (U.S.G), CHMSU',                  role: 'CCS Senator',           years: '2022 – 2023' },
  { org: 'Federation Student Government (F.S.G), CHMSU',                  role: 'Board Member',          years: '2022 – 2023' },
];

export const projectGradients = {
  'qms':           { from: '#3b82f6', to: '#7c3aed' },
  'cotamila-coffee': { from: '#005A32', to: '#15803D' },
  'writerity':     { from: '#503C28', to: '#8B735B' },
  'ams':           { from: '#14b8a6', to: '#3b82f6' },
  'katsumok':      { from: '#8b5cf6', to: '#ec4899' },
  'prinstax':      { from: '#c9a84c', to: '#7a6010' },
};

export const projectMeta = {
  'qms':           { domain: 'qms.becera.dev',           duration: '6 Months',  classification: 'Capstone Project',  year: '© 2022', image: '/images/projects/qms.png' },
  'cotamila-coffee': { domain: 'cotamila-coffee.becera.dev', duration: '2 Weeks', classification: 'Personal Project', year: '© 2026', image: '/images/projects/cotamila.png' },
  'writerity':     { domain: 'writerity.becera.dev',     duration: '4 Months',  classification: 'Client Project',    year: '© 2025', image: '/images/projects/writerity.png' },
  'ams':           { domain: 'ams.becera.dev',           duration: '2 Months',  classification: 'Client Project',    year: '© 2025', image: '/images/projects/ams.png' },
  'katsumok':      { domain: 'katsumok.becera.dev',      duration: '3 Months',  classification: 'Client Project',    year: '© 2024', image: '/images/projects/katsumok.png' },
  'prinstax':      { domain: 'prinstax.becera.dev',      duration: '3 Weeks',   classification: 'Personal Project',  year: '© 2026', image: '/images/projects/prinstax.png' },
};
