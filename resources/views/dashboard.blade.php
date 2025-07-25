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
        <div class="row justify-content-center mb-4 align-items-center">
            <div class="col-md-4 mb-2 mb-md-0">
                <select id="categoryFilter" class="form-select">
                    
                <?php
                    $categories = [
                        'Electronics',
                        'Collectibles',
                        'Fashion',
                        'Home & Living',
                        'Art',
                        'Other',
                    ];
                ?>
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 d-flex">
                <input type="text" id="searchBar" class="form-control search-bar me-2" placeholder="🔍 Search items, owners, bids...">
                <button id="searchBtn" class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
            </div>
        </div>
        <div class="row g-4" id="auctionContainer">
            @foreach($auctions as $auction)
                <div class="col-md-4 auction-item"
                     data-category="{{ $auction->category->id ?? '' }}"
                     data-item="{{ strtolower($auction->item) }}"
                     data-owner="{{ strtolower($auction->user->name) }}"
                     data-categoryname="{{ strtolower($auction->category->name ?? 'uncategorized') }}"
                     data-description="{{ strtolower($auction->description) }}">
                    <a href="{{ route('auctions.show', $auction->id) }}" class="text-decoration-none" style="color: inherit;">
                        <div class="card auction-card h-100 shadow-lg animate__animated animate__fadeInUp" style="transition: box-shadow 0.3s, transform 0.3s;">
                            @if($auction->image)
                                <img src="{{ asset('storage/' . $auction->image) }}" alt="{{ $auction->item }}" class="card-img-top rounded-top" style="height: 220px; object-fit: cover; border-bottom: 1px solid #e0e7ff;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 220px; border-bottom: 1px solid #e0e7ff;">
                                    <i class="bi bi-image" style="font-size: 3rem; color: #cbd5e1;"></i>
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge bg-gradient" style="background: linear-gradient(90deg,#06b6d4,#6366f1); color: #fff; font-size: 0.9rem; margin-right: 0.5em;">
                                        <i class="bi bi-tag"></i> {{ $auction->category->name ?? 'Uncategorized' }}
                                    </span>
                                    <span class="badge badge-owner ms-auto">
                                        <i class="bi bi-person-circle"></i> {{ $auction->user->name }}
                                    </span>
                                </div>
                                <h5 class="card-title mb-2 text-truncate" style="font-weight: 600;">
                                    {{ $auction->item }}
                                </h5>
                                <p class="card-text flex-grow-1 text-muted" style="min-height: 60px;">{{ Str::limit($auction->description, 90) }}</p>
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <span class="fw-semibold text-primary">Start:</span>
                                        <span class="text-dark">रु. {{ number_format($auction->starting_bid, 2) }}</span>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span class="fw-semibold text-info">Current:</span>
                                        <span class="text-dark">रु. {{ number_format($auction->current_bid ?? $auction->starting_bid, 2) }}</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-semibold text-success">
                                        <i class="bi bi-clock"></i>
                                        {{ $auction->ends_at?->format('Y-m-d H:i') ?? 'N/A' }}
                                    </span>
                                    <span class="badge bg-light border text-secondary" style="font-size: 0.85rem;">
                                        <i class="bi bi-gavel"> {{ $auction->category ?? 'Uncategorized' }} </i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchBar = document.getElementById('searchBar');
        const searchBtn = document.getElementById('searchBtn');
        const categoryFilter = document.getElementById('categoryFilter');
        const auctionItems = document.querySelectorAll('.auction-item');

        function filterAuctions() {
            const searchTerm = searchBar.value.trim().toLowerCase();
            const selectedCategory = categoryFilter.value;

            auctionItems.forEach(function(item) {
                const itemName = item.getAttribute('data-item');
                const owner = item.getAttribute('data-owner');
                const categoryName = item.getAttribute('data-categoryname');
                const description = item.getAttribute('data-description');
                const categoryId = item.getAttribute('data-category');

                // Search logic: match any field
                const matchesSearch = !searchTerm ||
                    itemName.includes(searchTerm) ||
                    owner.includes(searchTerm) ||
                    categoryName.includes(searchTerm) ||
                    description.includes(searchTerm);

                // Category logic
                const matchesCategory = !selectedCategory || categoryId === selectedCategory;

                if (matchesSearch && matchesCategory) {
                    item.style.display = '';
                    item.classList.add('animate__animated', 'animate__fadeIn');
                } else {
                    item.style.display = 'none';
                    item.classList.remove('animate__animated', 'animate__fadeIn');
                }
            });
        }

        searchBar.addEventListener('input', filterAuctions);
        searchBtn.addEventListener('click', function(e) {
            e.preventDefault();
            filterAuctions();
        });
        categoryFilter.addEventListener('change', filterAuctions);
    });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endpush
