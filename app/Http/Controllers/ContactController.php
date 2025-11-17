<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        Message::create($validated);

        return redirect()->route('contact.show')->with('success', 'Your message has been sent successfully!');
    }
}
