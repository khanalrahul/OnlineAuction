<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'subject' => 'required|max:255',
            'message' => 'required',
        ]);

        // Process form data (e.g., send email)
        // Here, we are just returning a success message for simplicity.
        // You can extend this to actually send an email.
        
        return back()->with('status', 'Thank you for your message! We will get back to you soon.');
    }
}
