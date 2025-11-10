<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Message;
use App\Models\Payment;
use App\Models\RegistrationFee;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function index()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('status', 'active')->count();
        $totalCourses = Course::count();

        // Total approved payments
        $totalPayments = Payment::where('status', 'approved')
            ->join('courses', 'payments.course_id', '=', 'courses.id')
            ->sum('courses.price');

        $recentUsers = User::orderBy('registered_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'activeUsers',
            'totalCourses',
            'totalPayments',
            'recentUsers'
        ));
    }

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

    public function messages()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('admin.messages', compact('messages'));
    }

    public function allCourses()
    {
        $courses = Course::with('user') // Eager load creator
            ->withCount([
                'payments as enrolled' => function ($query) {
                    $query->where('status', 'approved');
                }
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.courses', compact('courses'));
    }

    public function allUsers()
    {
        $users = User::withCount([
            'courses as uploaded',
            'payments as enrolled' => function ($query) {
                $query->where('status', 'approved')->distinct('course_id');
            }
        ])
            ->with([
                'payments' => function ($query) {
                    $query->where('status', 'approved')->select('id', 'user_id', 'course_id');
                },
                'payments.course'
            ])
            ->get()
            ->map(function ($user) {
                $user->paid = $user->payments->sum(fn($p) => $p->course->price ?? 0);
                return $user;
            });

        return view('admin.users', compact('users'));
    }

}
