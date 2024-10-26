<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;

class AuctionController extends Controller
{
    public function index()
    {
        $auctions = Auction::where('ends_at', '>', now())->get();
        return view('auctions.index', compact('auctions'));
    }

    public function bid(Request $request, Auction $auction)
    {
        $request->validate(['bid_amount' => 'required|numeric|min:' . ($auction->current_bid ?? $auction->starting_bid + 1)]);

        $auction->update([
            'current_bid' => $request->bid_amount,
            'winner_id' => auth()->id(),
        ]);

        return redirect()->route('auctions.show', $auction)->with('success', 'Bid placed successfully.');
    }
}
