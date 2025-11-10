<?php

namespace App\Http\Controllers;

use App\Models\RegistrationFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationFeeController extends Controller
{
    //
    public function index()
    {
        return view('user.pay-reg-fee');
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
            'trxid' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        RegistrationFee::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'trxid' => $request->trxid,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Registration payment submitted successfully!');
    }
}