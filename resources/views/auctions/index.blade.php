@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">My Auction Listings</h1>

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
                <th>Starting Bid (NRS)</th>
                <th>Ends At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($auctions as $auction)
            <tr>
                <td>{{ $auction->item }}</td>
                <td>{{ Str::limit($auction->description, 50) }}</td>
                <td>{{ number_format($auction->starting_bid, 2) }}</td>
                <td>{{ $auction->ends_at->format('M d, Y H:i') }}</td>
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
            @empty
            <tr>
                <td colspan="5" class="text-center">No auctions found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#auctionsTable').DataTable();
    });
</script>
@endsection
