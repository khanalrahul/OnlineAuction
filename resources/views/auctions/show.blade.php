@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
    }
    .auction-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        padding: 2.5rem 2rem;
        margin-top: 2rem;
        animation: fadeInUp 0.8s cubic-bezier(.39,.575,.565,1.000);
    }
    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(40px);}
        100% { opacity: 1; transform: translateY(0);}
    }
    .auction-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #4f46e5;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
        animation: fadeIn 1s;
    }
    .auction-desc {
        font-size: 1.2rem;
        color: #374151;
        margin-bottom: 1.5rem;
        animation: fadeIn 1.2s;
    }
    .auction-details {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        margin-bottom: 2rem;
        animation: fadeIn 1.4s;
    }
    .auction-detail {
        background: #f1f5f9;
        border-radius: 12px;
        padding: 1.2rem 1.5rem;
        min-width: 220px;
        flex: 1;
        text-align: center;
        box-shadow: 0 2px 8px rgba(79,70,229,0.07);
        transition: transform 0.2s;
    }
    .auction-detail:hover {
        transform: scale(1.04);
        box-shadow: 0 4px 16px rgba(79,70,229,0.13);
    }
    .auction-detail strong {
        color: #6366f1;
        font-size: 1.1rem;
    }
    #countdown {
        font-weight: bold;
        color: #16a34a;
        font-size: 1.2rem;
        letter-spacing: 1px;
        animation: pulse 1.5s infinite;
    }
    @keyframes pulse {
        0% { color: #16a34a; }
        50% { color: #22d3ee; }
        100% { color: #16a34a; }
    }
    .bid-form {
        background: linear-gradient(90deg, #6366f1 0%, #22d3ee 100%);
        border-radius: 12px;
        padding: 2rem 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 12px rgba(34,211,238,0.08);
        animation: fadeIn 1.6s;
    }
    .bid-form label {
        color: #fff;
        font-weight: 600;
    }
    .bid-form input[type="number"] {
        border-radius: 8px;
        border: none;
        padding: 0.6rem 1rem;
        margin-top: 0.5rem;
        width: 100%;
        font-size: 1.1rem;
    }
    .bid-form button {
        background: #fff;
        color: #6366f1;
        font-weight: 700;
        border: none;
        border-radius: 8px;
        padding: 0.7rem 2.2rem;
        margin-top: 1.2rem;
        transition: background 0.2s, color 0.2s;
    }
    .bid-form button:hover {
        background: #6366f1;
        color: #fff;
    }
    .table-animated {
        animation: fadeIn 1.8s;
        background: #f8fafc;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(99,102,241,0.07);
    }
    .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: #e0e7ff;
    }
    .winner-card {
        background: linear-gradient(90deg, #22d3ee 0%, #6366f1 100%);
        color: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 16px rgba(34,211,238,0.13);
        padding: 2rem 1.5rem;
        margin-top: 2.5rem;
        animation: fadeIn 2s;
    }
    .winner-card h3 {
        font-weight: 800;
        letter-spacing: 1px;
    }
    .badge-live {
        background: #16a34a;
        color: #fff;
        border-radius: 8px;
        padding: 0.3rem 0.8rem;
        font-size: 1rem;
        margin-left: 0.7rem;
        animation: pulse 1.5s infinite;
    }
    .badge-ended {
        background: #ef4444;
        color: #fff;
        border-radius: 8px;
        padding: 0.3rem 0.8rem;
        font-size: 1rem;
        margin-left: 0.7rem;
    }
    .auction-meta {
        margin-bottom: 1.5rem;
        color: #64748b;
        font-size: 1rem;
    }
</style>

<div class="container">
    <div class="auction-card">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <div>
                <span class="auction-meta">
                    <i class="bi bi-clock-history"></i>
                    Listed on: {{ $auction->created_at->format('M d, Y H:i') }}
                </span>
            </div>
            <div>
                @if(now()->lt($auction->ends_at))
                    <span class="badge-live">LIVE</span>
                @else
                    <span class="badge-ended">ENDED</span>
                @endif
            </div>
        </div>
        <h1 class="auction-title">{{ $auction->item }}</h1>
        <p class="auction-desc">{{ $auction->description }}</p>
        <div class="auction-details">
            <div class="auction-detail">
                <strong>Starting Bid</strong>
                <div>रु. {{ number_format($auction->starting_bid, 2) }}</div>
            </div>
            <div class="auction-detail">
                <strong>Current Bid</strong>
                <div>
                    @if($auction->current_bid)
                        <span class="text-success" style="font-size:1.3rem;">{{ number_format($auction->current_bid, 2) }}</span>
                    @else
                        रु. {{ number_format($auction->starting_bid, 2) }}
                    @endif
                </div>
            </div>
            <div class="auction-detail">
                <strong>Auction Ends In</strong>
                <div><span id="countdown"></span></div>
            </div>
            <div class="auction-detail">
                <strong>Total Bids</strong>
                <div>{{ $bids->count() }}</div>
            </div>
        </div>

        @auth
            @if(now()->lt($auction->ends_at))
                <form action="{{ route('auctions.bid', $auction) }}" method="POST" class="bid-form">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="bid_amount">Place Your Bid</label>
                        <input type="number" name="bid_amount" id="bid_amount" class="form-control"
                            min="{{ ($auction->current_bid ?? $auction->starting_bid) + 1 }}" required>
                    </div>
                    <button type="submit">Submit Bid</button>
                </form>
            @else
                <div class="alert alert-warning mt-3" role="alert" style="animation: fadeIn 1.7s;">
                    <strong>This auction has ended.</strong>
                </div>
            @endif
        @endauth

        @guest
            <div class="alert alert-info mt-3" style="animation: fadeIn 1.7s;">
                <a href="{{ route('login') }}" class="text-primary fw-bold">Log in</a> to place a bid.
            </div>
        @endguest

        <h3 class="mt-5 mb-3" style="color:#4f46e5; font-weight:700; letter-spacing:1px; animation: fadeIn 1.9s;">Previous Bids</h3>
        <div class="table-responsive table-animated">
            <table id="bidsTable" class="table table-striped table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Bidder Name</th>
                        <th>Bid Amount (रु.)</th>
                        <th>Bid Date</th>
                    </tr>
                </thead>
                <tbody>
                    @if($bids->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center">No bids have been placed for this auction yet.</td>
                        </tr>
                    @else
                        @foreach($bids as $bid)
                            <tr>
                                <td>
                                    <i class="bi bi-person-circle text-primary"></i>
                                    {{ $bid->user->name }}
                                    @if($bid->user_id == $auction->user_id)
                                        <span class="badge bg-info ms-2">Seller</span>
                                    @endif
                                </td>
                                <td @if($bid->amount == $auction->current_bid) class="text-success fw-bold" @endif>
                                    {{ number_format($bid->amount, 2) }}
                                    @if($bid->amount == $auction->current_bid)
                                        <span class="badge bg-success ms-2">Highest</span>
                                    @endif
                                </td>
                                <td>{{ $bid->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        @if(now()->gt($auction->ends_at))
            <div class="winner-card">
                <h3 class="text-center mb-3">Winner</h3>
                @if($bids->isNotEmpty())
                    @php
                        $winningBid = $bids->sortByDesc('amount')->first();
                    @endphp
                    <p><strong>Name:</strong> {{ $winningBid->user->name }}</p>
                    <p><strong>Winning Bid:</strong> रु. {{ number_format($winningBid->amount, 2) }}</p>
                    <p><strong>Bid Placed At:</strong> {{ $winningBid->created_at->format('M d, Y H:i') }}</p>
                    <p><strong>Contact:</strong> {{ $winningBid->user->email ?? 'N/A' }}</p>
                @else
                    <p class="text-center">No bidders for this auction.</p>
                @endif
            </div>
        @endif

        <div class="mt-5" style="animation: fadeIn 2.2s;">
            <h4 style="color:#6366f1; font-weight:600;">Auction Details</h4>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Item Name:</strong> {{ $auction->item }}</li>
                <li class="list-group-item"><strong>Description:</strong> {{ $auction->description }}</li>
                <li class="list-group-item"><strong>Category:</strong> {{ $auction->category ?? 'N/A' }}</li>
                <li class="list-group-item"><strong>Seller:</strong> {{ $auction->user->name ?? 'N/A' }}</li>
                <li class="list-group-item"><strong>Start Date:</strong> {{ $auction->created_at->format('M d, Y H:i') }}</li>
                <li class="list-group-item"><strong>End Date:</strong> {{ $auction->ends_at->format('M d, Y H:i') }}</li>
                <li class="list-group-item"><strong>Status:</strong>
                    @if(now()->lt($auction->ends_at))
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Ended</span>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    const endTime = new Date("{{ $auction->ends_at?->toIso8601String() ?? '' }}").getTime();
    const timerInterval = setInterval(() => {
        const now = new Date().getTime();
        const distance = endTime - now;

        if (distance < 0) {
            clearInterval(timerInterval);
            document.getElementById("countdown").innerHTML = "Auction ended";
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("countdown").innerHTML =
            (days > 0 ? days + "d " : "") +
            (hours > 0 ? hours + "h " : "") +
            (minutes > 0 ? minutes + "m " : "") +
            seconds + "s ";
    }, 1000);
</script>
@endsection
