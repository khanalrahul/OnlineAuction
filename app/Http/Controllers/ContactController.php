<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Mail\ContactFormNotification;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        try {
            $recipient = 'khanalrahul79@gmail.com';
            $mail = Mail::to($recipient);
            
            // For debugging - remove in production
            Log::info('Attempting to send email to: '.$recipient);
            
            // Actually send and get response
            $mail->send(new ContactFormNotification($validated));
            
            // Verify the email was really sent
            if (count(Mail::failures()) > 0) {
                throw new \Exception('Email failed to send to: '.implode(', ', Mail::failures()));
            }
            
            Log::info('Email successfully sent to: '.$recipient);
            return back()->with('success', 'Thank you! Your message has been sent.');
            
        } catch (\Exception $e) {
            Log::error('Email send failed: '.$e->getMessage());
            return back()->with('error', 
                'We received your message but encountered an issue sending confirmation. '.
                'Our team has been notified and will contact you soon.');
        }
    }
}
