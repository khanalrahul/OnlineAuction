@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
    }
    .dashboard-title {
        font-weight: 700;
        letter-spacing: 1px;
        background: linear-gradient(90deg, #6366f1, #06b6d4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: fadeInDown 1s;
    }
    .search-bar {
        border-radius: 30px;
        border: 2px solid #6366f1;
        box-shadow: 0 2px 8px rgba(99,102,241,0.1);
        transition: box-shadow 0.3s;
    }
    .search-bar:focus {
        box-shadow: 0 4px 16px rgba(6,182,212,0.15);
        border-color: #06b6d4;
    }
    .auction-card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(99,102,241,0.08);
        transition: transform 0.2s, box-shadow 0.2s;
        background: linear-gradient(135deg, #fff 80%, #e0e7ff 100%);
        animation: fadeInUp 0.7s;
    }
    .auction-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 8px 32px rgba(6,182,212,0.18);
    }
    .card-title a {
        color: #6366f1;
        transition: color 0.2s;
    }
    .card-title a:hover {
        color: #06b6d4;
        text-decoration: underline;
    }
    .badge-owner {
        background: linear-gradient(90deg, #6366f1, #06b6d4);
        color: #fff;
        font-size: 0.85rem;
        border-radius: 12px;
        padding: 0.3em 0.8em;
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px);}
        to { opacity: 1; transform: translateY(0);}
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px);}
        to { opacity: 1; transform: translateY(0);}
    }
</style>
<div class="container py-5">
    <h2 class="dashboard-title mb-4 text-center">Dashboard - Available Listings</h2>
    
    @if ($auctions->isEmpty())
        <div class="alert alert-info text-center shadow-sm">No listings available from other users.</div>
    @else
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <input type="text" id="searchBar" class="form-control search-bar" placeholder="🔍 Search items, owners, bids...">
            </div>
        </div>
        <div class="row g-4" id="auctionContainer">
            @foreach($auctions as $auction)
                <div class="col-md-4 auction-item">
                    <div class="card auction-card h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-2">
                                <a href="{{ route('auctions.show', $auction->id) }}">
                                    {{ $auction->item }}
                                </a>
                            </h5>
                            <p class="card-text flex-grow-1">{{ Str::limit($auction->description, 100) }}</p>
                            <div class="mb-2">
                                <span class="fw-semibold text-primary">Starting Bid:</span>
                                <span class="text-dark">रु. {{ number_format($auction->starting_bid, 2) }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="fw-semibold text-info">Current Bid:</span>
                                <span class="text-dark">रु. {{ number_format($auction->current_bid ?? $auction->starting_bid, 2) }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="fw-semibold text-success">Ends At:</span>
                                <span class="text-dark">{{ $auction->ends_at?->format('Y-m-d H:i:s') ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="badge badge-owner">
                                    <i class="bi bi-person-circle"></i> {{ $auction->user->name }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@push('scripts')
<!-- Optionally include Bootstrap Icons for user icon -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchBar = document.getElementById('searchBar');
        const auctionItems = document.querySelectorAll('.auction-item');

        searchBar.addEventListener('input', function() {
            const searchTerm = this.value.trim().toLowerCase();
            auctionItems.forEach(function(item) {
                // Search in item name, description, owner, and bids
                const text = item.innerText.toLowerCase();
                if (text.includes(searchTerm)) {
                    item.style.display = '';
                    item.classList.add('animate__animated', 'animate__fadeIn');
                } else {
                    item.style.display = 'none';
                    item.classList.remove('animate__animated', 'animate__fadeIn');
                }
            });
        });
    });
</script>
<!-- Animate.css for smooth fade-in (optional, can remove if not wanted) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endpush
