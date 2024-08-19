<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactFormController extends Controller
{
    public function show()
    {
        return view('contact.show');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Sla het contactformulier op in de database
        $contactForm = ContactForm::create($request->all());

        // Verstuur een e-mail naar de beheerders
        Mail::to(config('mail.admin_email'))->send(new ContactFormMail($contactForm));

        return redirect()->route('contact.show')->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
