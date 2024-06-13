@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h1>Product Listings</h1>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>
                        <ul class="list-group">
                            @foreach($products as $product)
                                <li class="list-group-item">
                                    <a href="{{ route('products.show', $product->id) }}">
                                        {{ $product->name }} - Current Price: ${{ $product->current_price }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
