<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Mail\test;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function create(){
        return view('contact');
    }

    public function store(Request $request){
        $data = array();
        $data['errors'] = [];
        $data['success'] = 0;
        $rules = [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'email|required',
            'subject' => 'required|min:5',
            'message' => 'required'
        ];
        $validated = Validator::make($request->all(),$rules);
        if($validated->fails()){
            $data['errors']['fname'] = $validated->errors()->first('fname');
            $data['errors']['lname'] = $validated->errors()->first('lname');
            $data['errors']['email'] = $validated->errors()->first('email');
            $data['errors']['subject'] = $validated->errors()->first('subject');
            $data['errors']['message'] = $validated->errors()->first('message');
        }else {
            $atts = $validated->validated();

            Contact::create($atts);

            Mail::to('01124099182alihssn@gmail.com')->send(new ContactMail(
                $atts['fname'],
                $atts['lname'],
                $atts['email'],
                $atts['subject'],
                $atts['message']));

                $data['success'] = 1;
                $data['message'] = 'Thank you for contacting with us';
        }

        //return redirect()->route('contact.create')->with('success','Your message have been sent successfly');
        return response()->json($data);
    }
}
