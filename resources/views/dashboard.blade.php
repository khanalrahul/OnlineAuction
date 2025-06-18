@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard - Available Listings</h2>
    
    @if ($auctions->isEmpty())
        <p>No listings available from other users.</p>
    @else
        <input type="text" id="searchBar" class="form-control mb-4" placeholder="Search items...">
        
        <div class="row" id="auctionContainer">
            @foreach($auctions as $auction)
                <div class="col-md-4 mb-4 auction-item">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('auctions.show', $auction->id) }}" class="text-decoration-none">
                                    {{ $auction->item }}
                                </a>
                            </h5>
                            <p class="card-text">{{ Str::limit($auction->description, 100) }}</p>
                            <p><strong>Starting Bid:</strong> रु. {{ number_format($auction->starting_bid, 2) }}</p>
                            <p><strong>Current Bid:</strong> रु. {{ number_format($auction->current_bid ?? $auction->starting_bid, 2) }}</p>
                            <p><strong>Ends At:</strong> {{ $auction->ends_at?->format('Y-m-d H:i:s') ?? 'N/A' }}</p>
                            <p><strong>Owner:</strong> {{ $auction->user->name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('searchBar').addEventListener('input', function() {
        let searchTerm = this.value.toLowerCase();
        let auctionItems = document.querySelectorAll('.auction-item');

        auctionItems.forEach(function(item) {
            let itemText = item.innerText.toLowerCase();
            item.style.display = itemText.includes(searchTerm) ? 'block' : 'none';
        });
    });
</script>
@endpush
