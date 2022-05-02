<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function ContactForm(Request $request) {
        $request->validate([
            'first_name' => ['required', 'min:2', 'max:255'],
            'last_name' => ['required', 'min:2', 'max:255'],
            'email' => ['required', 'email'],
            'message' => ['required'],
            'rodo_consent' => ['required'],
            'marketing_consent' => ['required']
        ]);

        Contact::create($request->all());

        Mail::send('emails.contact-email', array(
            'full_name' => $request->get('first_name') . " " . $request->get('last_name'),
            'email' => $request->get('email'),
            'bodyMessage' => $request->get('message'),
        ), function($message) use ($request){
            $message->from($request->email);
            $message->to('pastuszek24@gmail.com', 'Marcin Pastuszek')->subject('Nowa wiadomość od Klienta.');
        });
        return response()->json(['success' => 'The email has been sent.']);
    }
}
