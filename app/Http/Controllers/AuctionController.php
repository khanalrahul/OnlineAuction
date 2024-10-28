<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
    public function myAuctions()
    {
        $auctions = Auth::user()->auctions()->latest()->get();
        return view('auctions.my', compact('auctions'));
    }

    public function create()
    {
        return view('auctions.create');
    }

    public function index()
    {
        $auctions = Auction::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('auctions.index', compact('auctions'));
    }

    public function bid(Request $request, Auction $auction)
    {
        if (now()->gt($auction->ends_at)) {
            return redirect()->route('auctions.show', $auction)->with('error', 'This auction has already ended.');
        }

        $request->validate([
            'bid_amount' => 'required|numeric|min:' . (($auction->current_bid ?? $auction->starting_bid) + 1),
        ]);

        $bid = new Bid();
        $bid->user_id = auth()->id();
        $bid->auction_id = $auction->id;
        $bid->amount = $request->bid_amount;
        $bid->save();

        $auction->current_bid = $bid->amount;
        $auction->save();

        return redirect()->route('auctions.show', $auction)->with('success', 'Bid placed successfully.');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item' => 'required|string|max:255',
            'description' => 'required|string',
            'starting_bid' => 'required|numeric|min:0',
            'ends_at' => 'required|date|after:now',
        ]);

        $validatedData['user_id'] = auth()->id();
        
        Auction::create($validatedData);
        
        return redirect()->route('auctions.index')->with('success', 'Auction created successfully.');
    }

    public function show(Auction $auction)
    {
        $bids = $auction->bids()->with('user')->latest()->get();
        return view('auctions.show', compact('auction', 'bids'));
    }

    public function edit(Auction $auction)
    {
        if ($auction->user_id !== auth()->id()) {
            return redirect()->route('auctions.index')->with('error', 'You do not have permission to edit this auction.');
        }
        
        return view('auctions.edit', compact('auction'));
    }

    public function update(Request $request, Auction $auction)
    {
        if ($auction->user_id !== auth()->id()) {
            return redirect()->route('auctions.index')->with('error', 'You do not have permission to update this auction.');
        }

        $request->validate([
            'item' => 'required|string|max:255',
            'description' => 'nullable|string',
            'starting_bid' => 'required|numeric|min:0',
        ]);

        $auction->update($request->only('item', 'description', 'starting_bid'));

        return redirect()->route('auctions.index')->with('success', 'Auction updated successfully.');
    }

    public function destroy(Auction $auction)
    {
        if ($auction->user_id !== auth()->id()) {
            return redirect()->route('auctions.index')->with('error', 'You do not have permission to delete this auction.');
        }
        
        $auction->delete();

        return redirect()->route('auctions.index')->with('success', 'Auction deleted successfully.');
    }
}
