@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $auction->item }}</h1>
    <p>{{ $auction->description }}</p>
    <p><strong>Starting Bid:</strong> NPR {{ number_format($auction->starting_bid, 2) }}</p>
    <p><strong>Current Bid:</strong> 
        @if($auction->current_bid)
            <span class="text-success">{{ number_format($auction->current_bid, 2) }}</span>
        @else
            NPR {{ number_format($auction->starting_bid, 2) }}
        @endif
    </p>
    <p><strong>Auction Ends In:</strong> <span id="countdown"></span></p>

    @auth
        @if(now()->lt($auction->ends_at))
            <form action="{{ route('auctions.bid', $auction) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="bid_amount">Place Your Bid</label>
                    <input type="number" name="bid_amount" id="bid_amount" class="form-control" 
                        min="{{ ($auction->current_bid ?? $auction->starting_bid) + 1 }}" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit Bid</button>
            </form>
        @else
            <p><strong>This auction has ended.</strong></p>
        @endif
    @endauth   

    @guest
        <p><a href="{{ route('login') }}">Log in</a> to place a bid.</p>
    @endguest

    <h3>Previous Bids</h3>
    <table id="bidsTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Bidder Name</th>
                <th>Bid Amount (NPR)</th>
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
                        <td>{{ $bid->user->name }}</td>
                        <td @if($bid->amount == $auction->current_bid) class="text-success" @endif>{{ number_format($bid->amount, 2) }}</td>
                        <td>{{ $bid->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

<script>
    const endTime = new Date("{{ $auction->ends_at }}").getTime();
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

        document.getElementById("countdown").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
    }, 1000);
</script>
@endsection
