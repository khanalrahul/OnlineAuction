<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');


// Route to store a new product (POST request)
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
