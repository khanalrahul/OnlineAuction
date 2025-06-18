@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">My Auction Listings</h1>

    @if (Auth::check())
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('auctions.create') }}" class="btn btn-primary">Add New Auction</a>
        </div>

        <table id="auctionsTable" class="display">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Starting Bid (रु.)</th>
                    <th>Ends At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($auctions as $auction)
                <tr>
                    <td>{{ $auction->item }}</td>
                    <td>{{ Str::limit($auction->description, 50) }}</td>
                    <td>{{ number_format($auction->starting_bid, 2) }}</td>
                    <td>
                        {{ $auction->ends_at?->format('M d, Y H:i') ?? 'N/A' }}
                    </td>
                    <td>
                        <a href="{{ route('auctions.show', $auction->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('auctions.edit', $auction->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('auctions.destroy', $auction->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning text-center">
            <h3>Please log in or register to access your auction listings.</h3>
            <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
            @endif
        </div>
    @endif
</div>

<script>
    $(document).ready(function() {
        $('#auctionsTable').DataTable();
    });
</script>
@endsection
