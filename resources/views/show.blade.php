@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p>Starting Price: ${{ $product->starting_price }}</p>
    <p>Current Price: ${{ $product->current_price }}</p>
    <p>Auction Ends: {{ $product->auction_end }}</p>

    @if(auth()->check())
        <form action="{{ route('bids.store', $product->id) }}" method="POST">
            @csrf
            <label for="amount">Bid Amount:</label>
            <input type="number" name="amount" id="amount" step="0.01" min="{{ $product->current_price + 0.01 }}">
            <button type="submit">Place Bid</button>
        </form>
    @else
        <p>Please <a href="{{ route('login') }}">login</a> to place a bid.</p>
    @endif
@endsection
