<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 15px; text-align: center; }
        .content { padding: 20px; background-color: #fff; border: 1px solid #dee2e6; }
        .footer { margin-top: 20px; text-align: center; font-size: 0.9em; color: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Form Submission</h2>
        </div>
        
        <div class="content">
            <p><strong>Name:</strong> {{ $formData['name'] }}</p>
            <p><strong>Email:</strong> {{ $formData['email'] }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $formData['message'] }}</p>
            
            <p>Submitted at: {{ now()->format('Y-m-d H:i:s') }}</p>
        </div>
        
        <div class="footer">
            <p>This is an automated notification from {{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>