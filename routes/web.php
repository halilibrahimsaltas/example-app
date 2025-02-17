<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SupportFormController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'contact'])->name('contact.submit');

Route::get("/user/{id}", [HomeController::class, 'user'])->name('user');


Route::match(["get", "post"], "support-form", [SupportFormController::class, "supportForm"])->name("support-form");

Route::patch("user/{id}/guncelle", [ContactController::class, "update"])->name("user.update");

Route::put("user/{id}/guncelle", [ContactController::class, "update"])->name("user.update");