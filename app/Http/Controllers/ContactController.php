<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:100',
            'email'        => 'required|email|max:150',
            'inquiry_type' => 'required|string',
            'message'      => 'required|string|max:3000',
        ]);

        $body = "New Contact Form Submission\n\n"
              . "Name: {$validated['name']}\n"
              . "Email: {$validated['email']}\n"
              . "Inquiry Type: {$validated['inquiry_type']}\n\n"
              . "Message:\n{$validated['message']}";

        Mail::raw($body, function ($mail) use ($validated) {
            $mail->to('engeniusdigitech@gmail.com')
                 ->replyTo($validated['email'], $validated['name'])
                 ->subject("EduNex Inquiry: {$validated['inquiry_type']} from {$validated['name']}");
        });

        return redirect()->route('contact')->with('success', 'Your message has been sent! We will get back to you within 1 business day.');
    }
}
