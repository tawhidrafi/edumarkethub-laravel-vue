<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    // Show all courses
    // app/Http/Controllers/CourseController.php

    public function index()
    {
        $courses = Course::with('user')
            ->latest()
            ->paginate(perPage: 10);

        return view('courses.index', compact('courses'));
    }

    // Show single course
    public function show(Course $course)
    {
        $user = Auth::user();
        $isOwner = $user && $course->user_id === $user->id;
        $hasAccess = false;
        $hasPendingPayment = false;

        $totalSales = Payment::where('course_id', $course->id)
            ->where('status', 'approved')
            ->count();

        $totalRevenue = $totalSales * ($course->price ?? 0);

        $students = Payment::with('user')
            ->where('course_id', $course->id)
            ->where('status', 'approved')
            ->get();

        if ($user && !$isOwner) {
            $payment = Payment::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->latest()
                ->first();

            if ($payment) {
                $hasAccess = $payment->status === 'approved';
                $hasPendingPayment = $payment->status === 'pending';
            }
        }

        return view('courses.show', compact(
            'course',
            'isOwner',
            'hasAccess',
            'hasPendingPayment',
            'totalSales',
            'totalRevenue',
            'students'
        ));
    }

}
