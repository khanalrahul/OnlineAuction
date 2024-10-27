@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Auction</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('auctions.update', $auction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="item" class="form-label">Item</label>
            <input type="text" class="form-control" id="item" name="item" value="{{ old('item', $auction->item) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $auction->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="starting_bid" class="form-label">Starting Bid</label>
            <input type="number" class="form-control" id="starting_bid" name="starting_bid" value="{{ old('starting_bid', $auction->starting_bid) }}" required>
        </div>

        <div class="mb-3">
            <label for="ends_at" class="form-label">Ends At</label>
            <input type="datetime-local" class="form-control" id="ends_at" name="ends_at" value="{{ old('ends_at', \Carbon\Carbon::parse($auction->ends_at)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Auction</button>
    </form>
</div>
@endsection
