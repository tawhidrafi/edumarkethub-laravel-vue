<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use App\Models\RegistrationFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Course $course)
    {
        $user = Auth::user();

        // Check if registration fee approved
        $feeApproved = RegistrationFee::where('user_id', $user->id)
            ->where('status', 'approved')
            ->exists();

        if (!$feeApproved) {
            return redirect()->route('registration.fee')
                ->with('error', 'You must pay the registration fee first.');
        }

        return view('user.payment', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $user = Auth::user();

        // Check registration fee again
        $feeApproved = RegistrationFee::where('user_id', $user->id)
            ->where('status', 'approved')
            ->exists();

        if (!$feeApproved) {
            return redirect()->route('registration.fee')
                ->with('error', 'You must pay the registration fee first.');
        }

        $request->validate([
            'phone' => 'required|string|max:20',
            'trxid' => 'required|string|max:255',
        ]);

        Payment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'phone' => $request->phone,
            'trxid' => $request->trxid,
            'status' => 'pending',
        ]);

        return redirect()->route('courses.detail', $course->id)
            ->with('success', 'Payment submitted successfully. Awaiting approval.');
    }
}
