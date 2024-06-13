@extends('layouts.app')

@section('title', 'Create New Product')

@section('content')
    <h1>Create New Product</h1>

    <form method="POST" action="{{ route('products.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" min="0" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
@endsection
