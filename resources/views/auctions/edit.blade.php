@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    .auction-form-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        padding: 2.5rem 2rem;
        max-width: 540px;
        margin: 2rem auto;
        animation: fadeInDown 0.8s;
    }
    .auction-form-card label {
        font-weight: 600;
        color: #2d3748;
    }
    .auction-form-card input, .auction-form-card textarea, .auction-form-card select {
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        transition: border-color 0.2s;
    }
    .auction-form-card input:focus, .auction-form-card textarea:focus {
        border-color: #3182ce;
        box-shadow: 0 0 0 2px #bee3f8;
    }
    .auction-form-card .btn-primary {
        background: linear-gradient(90deg, #3182ce 0%, #63b3ed 100%);
        border: none;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: background 0.2s, transform 0.2s;
    }
    .auction-form-card .btn-primary:hover {
        background: linear-gradient(90deg, #2563eb 0%, #4299e1 100%);
        transform: translateY(-2px) scale(1.03);
        box-shadow: 0 6px 24px rgba(49,130,206,0.12);
    }
    .form-hint {
        font-size: 0.95em;
        color: #718096;
    }
</style>

<div class="auction-form-card animate__animated animate__fadeInDown">
    <h1 class="mb-4 text-center" style="color:#3182ce;">Edit Auction</h1>
    <form action="{{ route('auctions.update', $auction->id) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="item" class="form-label">Item Name</label>
            <input type="text" class="form-control" id="item" name="item" value="{{ old('item', $auction->item) }}" required autofocus>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $auction->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="category" required>
                <option value="">Select category</option>
                <option {{ old('category', $auction->category) == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                <option {{ old('category', $auction->category) == 'Collectibles' ? 'selected' : '' }}>Collectibles</option>
                <option {{ old('category', $auction->category) == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                <option {{ old('category', $auction->category) == 'Home & Living' ? 'selected' : '' }}>Home & Living</option>
                <option {{ old('category', $auction->category) == 'Art' ? 'selected' : '' }}>Art</option>
                <option {{ old('category', $auction->category) == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="starting_bid" class="form-label">Starting Bid <span style="color:#3182ce;">(रु.)</span></label>
            <input type="number" class="form-control" id="starting_bid" name="starting_bid" min="1" step="0.01" value="{{ old('starting_bid', $auction->starting_bid) }}" required>
            <div class="form-hint">Minimum bid amount to start the auction.</div>
        </div>
        <div class="mb-3">
            <label for="ends_date" class="form-label">End Date</label>
            <input type="date" class="form-control" id="ends_date" required>
        </div>
        <div class="mb-3">
            <label for="ends_time" class="form-label">End Time</label>
            <input type="time" class="form-control" id="ends_time" required>
            <div class="form-hint">Set the date and time when the auction should end.</div>
        </div>
        <input type="hidden" name="ends_at" id="ends_at">
        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-primary btn-lg animate__animated animate__pulse animate__infinite">Update Auction</button>
        </div>
    </form>
</div>

<script>
    // Pre-fill date and time fields from auction's ends_at
    window.addEventListener('DOMContentLoaded', function() {
        @php
            $endsAt = old('ends_at', $auction->ends_at ? $auction->ends_at->format('Y-m-d\TH:i') : '');
        @endphp
        let endsAt = "{{ $endsAt }}";
        if (endsAt) {
            let [date, time] = endsAt.split('T');
            document.getElementById('ends_date').value = date;
            document.getElementById('ends_time').value = time ? time.slice(0,5) : '';
        }
        updateEndsAt();
    });

    function updateEndsAt() {
        const date = document.getElementById('ends_date').value;
        const time = document.getElementById('ends_time').value;
        if(date && time) {
            document.getElementById('ends_at').value = date + 'T' + time;
        }
    }
    document.getElementById('ends_date').addEventListener('change', updateEndsAt);
    document.getElementById('ends_time').addEventListener('change', updateEndsAt);
</script>
@endsection