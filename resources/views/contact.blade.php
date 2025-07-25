@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="mb-4 text-center animate__animated animate__fadeInDown">Contact Us</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show animate__animated animate__shakeX" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <p class="text-center mb-5">If you have any questions or inquiries, feel free to reach out to us using the form below or through our contact details.</p>

    <div class="row justify-content-center">
        <div class="col-md-6 mb-4">
            <div class="card shadow-lg animate__animated animate__fadeInLeft">
                <div class="card-body">
                    <h2 class="card-title mb-4 text-primary">Contact Form</h2>
                    <form id="contactForm" action="{{ route('contact.submit') }}" method="POST" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror"
                                      id="message" name="message" rows="4" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button id="submitBtn" type="submit" class="btn btn-primary w-100">
                            <span id="btnText">Send Message</span>
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5 mb-4">
            <div class="card shadow-lg animate__animated animate__fadeInRight">
                <div class="card-body">
                    <h2 class="card-title mb-4 text-primary">Contact Information</h2>
                    <p><i class="bi bi-envelope-fill me-2"></i><strong>Email:</strong> info@auction.raahul.com.np</p>
                    <p><i class="bi bi-telephone-fill me-2"></i><strong>Phone:</strong> +977 980-1754057</p>
                    <p><i class="bi bi-geo-alt-fill me-2"></i><strong>Address:</strong> Jawalakhel, Lalitpur, Nepal</p>
                    <hr>
                    <div class="ratio ratio-16x9 rounded shadow-sm">
                        <iframe src="https://maps.google.com/maps?q=Jawalakhel%20Lalitpur&t=&z=15&ie=UTF8&iwloc=&output=embed"
                                frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>

<!-- Animate.css and Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

@push('scripts')
<script>
    // Auto-dismiss alerts after 5 seconds
    setTimeout(() => {
        let alert = document.querySelector('.alert');
        if(alert){
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000);

    // Show spinner on submit
    document.getElementById('contactForm').addEventListener('submit', function() {
        document.getElementById('btnText').classList.add('d-none');
        document.getElementById('btnSpinner').classList.remove('d-none');
    });
</script>
@endpush
@endsection