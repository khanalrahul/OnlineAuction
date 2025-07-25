<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\ContactController;
use App\Models\Auction;
use App\Models\Bid;
use notifications\NewUserNotification;

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'], '/admin', function(Request $request) {
    // Simple session-based login
    $error = NULL;
    if (!session('is_admin')) {
        if ($request->isMethod('post')) {
            if ($request->input('username') === 'admin' && $request->input('password') === 'admin') {
                session(['is_admin' => true]);
                return redirect('/admin');
            }
            $error = 'Invalid credentials';
        }
        return <<<HTML
        <html>
        <head>
            <title>Admin Login</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
            body {
                background: #f8f9fa;
            }
            .login-container {
                max-width: 400px;
                margin: 80px auto;
                padding: 32px 28px;
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 2px 16px rgba(0,0,0,0.08);
            }
            .login-title {
                font-weight: 600;
                margin-bottom: 24px;
                text-align: center;
            }
            </style>
        </head>
        <body>
            <div class="login-container">
            <h2 class="login-title">Admin Login</h2>
            <form method="POST">
                <input type="hidden" name="_token" value="{$request->session()->token()}">
                <div class="mb-3">
                <label class="form-label">Username</label>
                <input name="username" class="form-control" placeholder="Enter username" required autofocus>
                </div>
                <div class="mb-3">
                <label class="form-label">Password</label>
                <input name="password" type="password" class="form-control" placeholder="Enter password" required>
                </div>
                <!-- Show error if present -->
                <div class="alert alert-danger py-2">$error</div>
                <button class="btn btn-primary w-100">Login</button>
            </form>
            </div>
        </body>
        </html>
        HTML;
    }

    // Handle actions
    if ($request->get('logout')) {
        session()->forget('is_admin');
        return redirect('/admin');
    }
    // User actions
    if ($request->get('reset_user')) {
        $user = User::find($request->get('reset_user'));
        if ($user) $user->update(['password' => bcrypt('password')]);
    }
    if ($request->get('delete_user')) {
        User::find($request->get('delete_user'))?->delete();
    }
    // Auction actions
    if ($request->get('delete_auction')) {
        Auction::find($request->get('delete_auction'))?->delete();
    }
    if ($request->isMethod('post') && $request->get('edit_auction')) {
        $auction = Auction::find($request->get('edit_auction'));
        if ($auction) $auction->update($request->only(['item', 'description', 'starting_bid']));
    }
    // Bid actions
    if ($request->get('delete_bid')) {
        Bid::find($request->get('delete_bid'))?->delete();
    }
    if ($request->isMethod('post') && $request->get('edit_bid')) {
        $bid = Bid::find($request->get('edit_bid'));
        if ($bid) $bid->update($request->only(['amount']));
    }

    // Fetch all
    $users = User::all();
    $auctions = Auction::all();
    $bids = Bid::all();

    // Render admin panel
    return view('admin_panel', compact('users', 'auctions', 'bids'));
});

Route::post('/admin/change-password', function(Request $request) {
    $user = App\Models\User::find($request->user_id);
    $user->password = Hash::make($request->password);
    $user->save();
    
    return back()->with('success', 'Password changed successfully!');
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

Route::get('/test', function(){
    $user = auth()->user();
    if ($user) {
        $user->notify(new App\Notifications\NewUserNotification());
        return redirect('/')->with('success', 'Notification sent!');
    } else {
        return redirect('/')->with('error', 'You must be logged in to send a notification.');
    }
})->middleware('auth')->name('test.notification');

// Notifications
Route::prefix('notifications')->group(function() {
    Route::post('/{id}/read', function($id) {
        auth()->user()->notifications()->where('id', $id)->update(['read_at' => now()]);
        return response()->json(['success' => true]);
    })->name('notifications.mark-read');

    Route::post('/mark-all-read', function() {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    })->name('notifications.mark-all-read');

    Route::get('/', function() {
        return view('notifications.index', [
            'notifications' => auth()->user()->notifications()->paginate(20)
        ]);
    })->name('notifications.index');
});

Route::get('/mail-test', function() {
    try {
        Mail::raw('This is a test email', function($message) {
            $message->to('khanalrahul79@gmail.com')
                   ->subject('Laravel Mail Test');
        });
        
        if (count(Mail::failures()) > 0) {
            return response()->json([
                'status' => 'error',
                'failures' => Mail::failures()
            ], 500);
        }
        
        return response()->json(['status' => 'success']);
        
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

require __DIR__.'/auth.php';