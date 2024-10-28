@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Create New Auction</h1>

    <form action="{{ route('auctions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="item" class="form-label">Item</label>
            <input type="text" class="form-control" id="item" name="item" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="starting_bid" class="form-label">Starting Bid (रु.)</label>
            <input type="number" class="form-control" id="starting_bid" name="starting_bid" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="ends_at" class="form-label">Ends At</label>
            <input type="datetime-local" class="form-control" id="ends_at" name="ends_at" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Auction</button>
    </form>
</div>
@endsection
