<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\ContactController;
use App\Models\Auction;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $auctions = Auction::where('user_id', '!=', auth()->id())
        ->where('ends_at', '>', now())
        ->with('user')
        ->latest()
        ->get();

    return view('dashboard', compact('auctions'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Auction routes
Route::resource('auctions', AuctionController::class);
Route::get('/auctions/my', [AuctionController::class, 'myAuctions'])->name('auctions.my');
Route::post('auctions/{auction}/bid', [AuctionController::class, 'bid'])->name('auctions.bid');

// Route for /auctions
Route::get('/auctions', [AuctionController::class, 'index'])->name('auctions.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

require __DIR__.'/auth.php';