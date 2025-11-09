<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Show all courses
    public function index()
    {
        $courses = Course::with('user')
            ->orderByDesc('created_at')
            ->get();

        return view('courses.index', compact('courses'));
    }

    // Show single course
    public function show($id)
    {
        $course = Course::with('user')->findOrFail($id);
        $user = Auth::user();

        $isOwner = $user && $course->user_id === $user->id;
        $hasAccess = false;
        $hasPendingPayment = false;
        $totalSales = Payment::where('course_id', $course->id)
            ->where('status', 'approved')
            ->count();
        $totalRevenue = $totalSales * $course->price;

        if ($user && !$isOwner) {
            $approved = Payment::where([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'status' => 'approved',
            ])->exists();

            $pending = Payment::where([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'status' => 'pending',
            ])->exists();

            $hasAccess = $approved;
            $hasPendingPayment = $pending;
        }

        return view('courses.show', compact(
            'course',
            'isOwner',
            'hasAccess',
            'hasPendingPayment',
            'totalSales',
            'totalRevenue'
        ));
    }
}
