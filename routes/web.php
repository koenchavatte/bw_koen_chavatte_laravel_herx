<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FaqCategoryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactFormController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/promote/{user}', [AdminController::class, 'promoteToAdmin'])->name('admin.promote');
    Route::post('/admin/create', [AdminController::class, 'createAdmin'])->name('admin.create');

    
    Route::resource('news', NewsController::class)->except(['show']);

    
    Route::resource('faq-categories', FaqCategoryController::class)->except(['show']);

    
    Route::resource('faqs', FaqController::class)->except(['show']);
});


Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');


Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');


Route::get('/profile/{username}', [PublicProfileController::class, 'show'])->name('profile.public.show');


Route::get('/search', [PublicProfileController::class, 'search'])->name('profile.search');


Route::get('/contact', [ContactFormController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactFormController::class, 'store'])->name('contact.store');


Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        return Inertia::render('Auth/Login');
    })->name('login');

    Route::get('/register', function () {
        return Inertia::render('Auth/Register');
    })->name('register');
});
