<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BidController extends Controller
{
    public function store(Request $request, Auction $auction)
    {
        $request->validate([
            'amount' => 'required|numeric|gt:' . $auction->current_bid,
        ]);

        $bid = new Bid();
        $bid->user_id = auth()->id();
        $bid->auction_id = $auction->id;
        $bid->amount = $request->amount;
        $bid->save();

        // Updating the current bid in the auction
        $auction->current_bid = $request->amount;
        $auction->save();

        return redirect()->route('auctions.index')->with('success', 'Bid placed successfully.');
    }

    public function show(Auction $auction)
    {
        $bids = $auction->bids()->with('user')->latest()->get();
        return view('auctions.show', compact('auction', 'bids'));
    }

}
