<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SupportFormController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'contact'])->name('contact.submit');

Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');

Route::match(["get", "post"], "support-form", [SupportFormController::class, "supportForm"])->name("support-form");

Route::patch("user/{id}/guncelle", [ContactController::class, "update"])->name("user.update.patch");

Route::put("user/{id}/guncelle", [ContactController::class, "update"])->name("user.update.put");

Route::resource("/api/articles", "ArticleController");

Route::apiResource("/api/articles", "Api/ArticleController");

Route::prefix("admin")->group(function () {
    Route::get("/edit-article/{id}", "ArticleController@edit")->name("admin.edit-article");
    Route::delete("/delete-article/{id}", "ArticleController@destroy")->name("admin.delete-article");
});