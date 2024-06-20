<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/auctions', function () {
    return view('auctions');
})->name('auctions');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');
