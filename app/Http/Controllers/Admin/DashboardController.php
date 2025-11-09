<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Payment;

class DashboardController extends Controller
{
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
}
