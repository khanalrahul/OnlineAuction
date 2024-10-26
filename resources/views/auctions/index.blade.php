@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ongoing Auctions</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Current Bid</th>
                    <th>Ends At</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($auctions as $auction)
                    <tr>
                        <td>{{ $auction->item }}</td>
                        <td>{{ $auction->description }}</td>
                        <td>{{ $auction->current_bid ?? $auction->starting_bid }}</td>
                        <td>{{ $auction->ends_at->format('Y-m-d H:i') }}</td>
                        <td><a href="{{ route('auctions.show', $auction) }}">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
