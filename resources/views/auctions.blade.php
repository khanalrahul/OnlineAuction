@extends('layouts.app')

@section('title', 'Auctions')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h1>Auctions</h1>
                    </div>
                    <div class="card-body">
                        <p>Welcome to our Auctions page!</p>
                        <p>List of ongoing auctions:</p>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="#">Auction Item 1</a>
                            </li>
                            <li class="list-group-item">
                                <a href="#">Auction Item 2</a>
                            </li>
                            <!-- Add more items as needed -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
