<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Online Auction</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Bootstrap and custom styles -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .contact-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .form-control:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            border-color: #007bff;
        }
        .btn-custom {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            background: #343a40;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <div class="contact-container">
        <h2 class="text-center mb-4">Contact Us</h2>
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('contact.submit') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group mb-3">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="form-group mb-3">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-custom btn-block">Submit</button>
        </form>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Online Auction. All rights reserved.
    </div>

    <script src="{{ asset('js/app.js') }}"></script> <!-- Bootstrap and custom scripts -->
</body>
</html>
