<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $data = [
            'name'       => 'Your Name',
            'role'       => 'Full Stack Developer',
            'bio'        => 'I build clean, scalable web applications with a focus on user experience and performance. Passionate about modern technologies and best practices.',
            'email'      => 'your@email.com',
            'github'     => 'https://github.com/yourusername',
            'linkedin'   => 'https://linkedin.com/in/yourusername',
            'skills'     => [
                ['name' => 'Laravel',     'level' => 90, 'icon' => 'fab fa-laravel'],
                ['name' => 'PHP',         'level' => 85, 'icon' => 'fab fa-php'],
                ['name' => 'JavaScript',  'level' => 80, 'icon' => 'fab fa-js'],
                ['name' => 'Vue.js',      'level' => 75, 'icon' => 'fab fa-vuejs'],
                ['name' => 'MySQL',       'level' => 80, 'icon' => 'fas fa-database'],
                ['name' => 'Git',         'level' => 85, 'icon' => 'fab fa-git-alt'],
                ['name' => 'Docker',      'level' => 65, 'icon' => 'fab fa-docker'],
                ['name' => 'Tailwind CSS','level' => 80, 'icon' => 'fab fa-css3-alt'],
            ],
            'projects'   => [
                [
                    'title'       => 'E-Commerce Platform',
                    'description' => 'A full-featured online store built with Laravel, Vue.js, and Stripe integration. Includes inventory management and admin dashboard.',
                    'tags'        => ['Laravel', 'Vue.js', 'MySQL', 'Stripe'],
                    'github'      => '#',
                    'live'        => '#',
                    'image'       => null,
                ],
                [
                    'title'       => 'Task Management App',
                    'description' => 'A real-time collaborative task manager using Laravel Broadcasting, WebSockets, and a clean Blade + Alpine.js frontend.',
                    'tags'        => ['Laravel', 'Alpine.js', 'WebSockets', 'SQLite'],
                    'github'      => '#',
                    'live'        => '#',
                    'image'       => null,
                ],
                [
                    'title'       => 'REST API Service',
                    'description' => 'A high-performance RESTful API built with Laravel Sanctum authentication, rate limiting, and comprehensive API documentation.',
                    'tags'        => ['Laravel', 'Sanctum', 'API', 'PHPUnit'],
                    'github'      => '#',
                    'live'        => null,
                    'image'       => null,
                ],
            ],
            'experience' => [
                [
                    'role'     => 'Senior Backend Developer',
                    'company'  => 'Tech Company Inc.',
                    'period'   => '2022 – Present',
                    'desc'     => 'Led development of microservices architecture, improved API response time by 40%, and mentored junior developers.',
                ],
                [
                    'role'     => 'Full Stack Developer',
                    'company'  => 'Digital Agency',
                    'period'   => '2020 – 2022',
                    'desc'     => 'Built and maintained multiple client web applications using Laravel and Vue.js in an agile environment.',
                ],
                [
                    'role'     => 'Junior Web Developer',
                    'company'  => 'StartUp XYZ',
                    'period'   => '2018 – 2020',
                    'desc'     => 'Developed features for a SaaS platform, wrote unit tests, and participated in code reviews.',
                ],
            ],
        ];

        return view('portfolio.index', $data);
    }

    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'message' => 'required|string|max:2000',
        ]);

        // TODO: implement Mail::to('your@email.com')->send(new ContactMail($validated));

        return redirect()->route('portfolio.index')
            ->with('success', 'Thank you! Your message has been received. I\'ll get back to you soon.');
    }
}
