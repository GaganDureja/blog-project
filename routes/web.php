<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});


// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Home Page
Route::get('/', [PostController::class, 'index'])->name('home');

// Category Routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('categories', CategoryController::class)->except(['index','show']);
});

// Tag Routes
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tags/{tag:slug}', [CategoryController::class, 'show'])->name('tag.show');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('tags', TagController::class)->except(['index','show']);
});

// Post Routes
Route::resource('posts', PostController::class)->except(['index','show'])->middleware('auth');
Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::resource('posts', PostController::class)->only(['index']);

// Route::resource('posts', PostController::class)->except(['show']);
// Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');