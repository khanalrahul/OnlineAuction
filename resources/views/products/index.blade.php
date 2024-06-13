@extends('layouts.app') // Assuming you have a layout file named 'app.blade.php'

@section('title', 'Product Listings')

@section('content')
    <h1>Product Listings</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>
    
    @if ($products->isEmpty())
        <p>No products found.</p>
    @else
        <ul class="list-group">
            @foreach ($products as $product)
                <li class="list-group-item">
                    <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a> - 
                    Current Price: ${{ $product->price }}
                </li>
            @endforeach
        </ul>
    @endif
@endsection
