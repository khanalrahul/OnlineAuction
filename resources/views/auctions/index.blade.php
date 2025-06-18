@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <h1 class="mb-0 text-primary fw-bold">
            <i class="bi bi-gavel"></i> My Auction Listings
        </h1>
        <div class="d-flex flex-column flex-md-row gap-2 align-items-md-center">
            <form action="{{ route('auctions.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search auctions..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="bi bi-search"></i>
                </button>
            </form>
            <a href="{{ route('auctions.create') }}" class="btn btn-gradient shadow-sm px-4 py-2 ms-md-3">
                <i class="bi bi-plus-circle"></i> Add New Auction
            </a>
        </div>
    </div>

    @if (Auth::check())
        @if (session('success'))
            <div class="alert alert-success animate__animated animate__fadeInDown">
                {{ session('success') }}
            </div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @forelse($auctions as $auction)
            <div class="col d-flex align-items-stretch">
                <div class="card auction-card shadow-sm h-100 border-0 animate__animated animate__fadeInUp w-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-gradient fw-bold mb-2">
                            <i class="bi bi-box-seam"></i> {{ $auction->item }}
                        </h5>
                        <p class="card-text text-muted mb-3" title="{{ $auction->description }}">
                            {{ Str::limit($auction->description, 60) }}
                        </p>
                        <div class="mb-2">
                            <span class="badge bg-success bg-gradient fs-6">
                                <i class="bi bi-currency-rupee"></i> {{ number_format($auction->starting_bid, 2) }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <span class="badge bg-info text-dark">
                                <i class="bi bi-clock"></i>
                                {{ $auction->ends_at?->format('M d, Y H:i') ?? 'N/A' }}
                            </span>
                        </div>
                        <div class="mt-auto d-flex gap-2">
                            <a href="{{ route('auctions.show', $auction->id) }}" class="btn btn-outline-primary btn-sm shadow-sm" data-bs-toggle="tooltip" title="View Auction">
                                <i class="bi bi-eye"></i> <span class="d-none d-md-inline">View</span>
                            </a>
                            <a href="{{ route('auctions.edit', $auction->id) }}" class="btn btn-outline-warning btn-sm shadow-sm" data-bs-toggle="tooltip" title="Edit Auction">
                                <i class="bi bi-pencil"></i> <span class="d-none d-md-inline">Edit</span>
                            </a>
                            <form action="{{ route('auctions.destroy', $auction->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm shadow-sm" onclick="return confirm('Are you sure?')" data-bs-toggle="tooltip" title="Delete Auction">
                                    <i class="bi bi-trash"></i> <span class="d-none d-md-inline">Delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center animate__animated animate__fadeIn">
                    No auctions found. <a href="{{ route('auctions.create') }}">Create your first auction!</a>
                </div>
            </div>
            @endforelse
        </div>
    @else
        <div class="alert alert-warning text-center animate__animated animate__fadeInDown">
            <h3>Please log in or register to access your auction listings.</h3>
            <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
            @endif
        </div>
    @endif
</div>

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    .btn-gradient {
        background: linear-gradient(90deg, #4e54c8 0%, #8f94fb 100%);
        color: #fff;
        border: none;
        transition: box-shadow 0.2s;
    }
    .btn-gradient:hover {
        box-shadow: 0 4px 20px rgba(78,84,200,0.2);
        color: #fff;
    }
    .text-gradient {
        background: linear-gradient(90deg, #4e54c8 0%, #8f94fb 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .auction-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .auction-card:hover {
        transform: translateY(-5px) scale(1.03);
        box-shadow: 0 8px 32px rgba(78,84,200,0.15);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>
@endpush

@endsection
