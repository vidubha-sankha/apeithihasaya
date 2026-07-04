<?php

namespace App\Http\Controllers;

use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(protected ActivityLogger $logger) {}

    /**
     * Show the contact form view.
     */
    public function show(): View
    {
        return view('contact');
    }

    /**
     * Handle the contact form submission.
     */
    public function submit(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Log the message submission activity
        $this->logger->log(
            'contact_submission',
            "Contact form submitted by {$request->input('name')} <{$request->input('email')}>"
        );

        return back()->with('success', 'Your message has been sent successfully. We will get back to you shortly!');
    }
}
