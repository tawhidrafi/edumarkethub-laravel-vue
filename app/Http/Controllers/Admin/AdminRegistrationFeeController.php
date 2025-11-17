<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegistrationFee;

class AdminRegistrationFeeController extends Controller
{
    //
    public function fees()
    {
        $fees = RegistrationFee::with('user')->orderByDesc('created_at')->get();
        return view('admin.fees', compact('fees'));
    }

    public function approveFee($id)
    {
        $fee = RegistrationFee::findOrFail($id);
        $fee->status = 'approved';
        $fee->save();

        return redirect()->route('admin.fees')->with('success', 'Payment approved.');
    }

    public function rejectFee($id)
    {
        $fee = RegistrationFee::findOrFail($id);
        $fee->status = 'rejected';
        $fee->save();

        return redirect()->route('admin.fees')->with('success', 'Payment rejected.');
    }
}
