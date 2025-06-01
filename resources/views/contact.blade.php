@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Contact Us</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <p>If you have any questions or inquiries, feel free to reach out to us using the form below or through our contact details.</p>

    <div class="row">
        <div class="col-md-6">
            <h2>Contact Form</h2>
            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>

        <div class="col-md-6">
            <h2>Contact Information</h2>
            <p><strong>Email:</strong> support@onlineauctionsystem.com.np</p>
            <p><strong>Phone:</strong> +977 980-1523050 </p>
            <p><strong>Address:</strong> Jawalakhel, Lalitpur </p>
        </div>
    </div>
</div>
@endsection