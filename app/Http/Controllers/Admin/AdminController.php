<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Message;
use App\Models\Payment;
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

    public function showMessages()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('admin.messages', compact('messages'));
    }
}
