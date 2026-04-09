<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

Route::get('/',               [PortfolioController::class, 'home'])->name('home');
Route::get('/projects',       [PortfolioController::class, 'projects'])->name('projects');
Route::get('/projects/{slug}',[PortfolioController::class, 'projectDetail'])->name('project.detail');
Route::get('/about',          [PortfolioController::class, 'about'])->name('about');
Route::get('/experience',     [PortfolioController::class, 'experience'])->name('experience');
Route::get('/contact',        [PortfolioController::class, 'contact'])->name('contact');
Route::post('/contact',       [PortfolioController::class, 'sendContact'])->name('contact.send');
Route::get('/resume/download', [PortfolioController::class, 'downloadResume'])->name('resume.download');
