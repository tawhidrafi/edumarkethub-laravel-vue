<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserEarningController extends Controller
{
    // Show user earnings
    public function index()
    {
        $user = Auth::user();

        // Get all courses owned by the user
        $courses = Course::where('user_id', $user->id)->pluck('name', 'id');

        // Get pending payments for these courses
        $payments = Payment::with('user')
            ->whereIn('course_id', $courses->keys())
            ->where('status', 'pending')
            ->get();

        return view('user.manage-payments', compact('courses', 'payments'));
    }

    // Update payment status
    public function update(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'action' => 'required|in:approve,reject',
        ]);

        $user = Auth::user();
        $payment = Payment::findOrFail($request->payment_id);

        // Ensure payment belongs to a course owned by this user
        if ($payment->course->user_id !== $user->id) {
            return redirect()->back()->withErrors('Invalid payment.');
        }

        $payment->status = $request->action === 'approve' ? 'approved' : 'rejected';
        $payment->save();

        return redirect()->route('user.manage-payments')->with('success', 'Payment status updated.');
    }
}
