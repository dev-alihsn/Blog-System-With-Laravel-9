<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Mail\test;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create(){
        return view('contact');
    }

    public function store(Request $request){

        $atts = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'email|required',
            'subject' => 'required|min:5',
            'message' => 'required|min:10|max:300'
        ]);

        Contact::create($atts);

        Mail::to('01124099182alihssn@gmail.com')->send(new ContactMail(
            $atts['fname'],
            $atts['lname'],
            $atts['email'],
            $atts['subject'],
            $atts['message']));

        return redirect()->route('contact.create')->with('success','Your message have been sent successfly');
    }
}
