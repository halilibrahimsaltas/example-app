<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::post('/contact', [HomeController::class, 'contact'])->name('user');

Route::get("/user/{id}", [HomeController::class, 'user'])->name('user');