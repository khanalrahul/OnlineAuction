<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Product;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function store(Request $request, $productId)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        $product = Product::find($productId);

        if ($validatedData['amount'] <= $product->current_price) {
            return back()->withErrors(['amount' => 'Bid must be higher than current price.']);
        }

        $bid = new Bid();
        $bid->product_id = $productId;
        $bid->user_id = auth()->id();
        $bid->amount = $validatedData['amount'];
        $bid->save();

        $product->current_price = $validatedData['amount'];
        $product->save();

        return back()->with('success', 'Bid placed successfully.');
    }
}
