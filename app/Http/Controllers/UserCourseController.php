<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use App\Models\RegistrationFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCourseController extends Controller
{
    // Show enrolled courses
    public function showEnrolledCourses()
    {
        $user = Auth::user();

        $courses = Payment::with('course.user')
            ->where('user_id', $user->id)
            ->where('status', 'approved')
            ->get()
            ->map(function ($payment) {
                return [
                    'id' => $payment->course->id,
                    'name' => $payment->course->name,
                    'cover_image' => $payment->course->cover_image,
                    'author_name' => $payment->course->user->name,
                ];
            });

        return view('user.enrolled', compact('courses'));
    }

    // Show uploaded courses
    public function showUploadedCourses()
    {
        $user = Auth::user(); // currently logged-in user

        $courses = Course::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.uploaded', compact('courses'));
    }

    // Show upload course form
    public function showUploadForm()
    {
        $user = Auth::user();

        // Check if registration fee is approved
        $feeApproved = RegistrationFee::where('user_id', $user->id)
            ->where('status', 'approved')
            ->exists();

        if (!$feeApproved) {
            return redirect()->route('registration.fee');
        }

        return view('user.upload-course');
    }

    // Handle course upload
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'type' => 'required|in:course,note',
            'duration' => 'required|string|max:50',
            'level' => 'required|string|max:50',
            'lectures' => 'required|integer|min:1',
            'language' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'details' => 'required|string',
            'image' => 'required|image|max:2048',
            'file' => 'required|file|mimes:zip|max:51200', // max 50MB
        ]);

        $user = Auth::user();

        // Handle file uploads
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('courses/assets/img'), $imageName);

        $courseFileName = time() . '_' . $request->file('file')->getClientOriginalName();
        $request->file('file')->move(public_path('courses/assets/file'), $courseFileName);

        // Save course
        Course::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'category' => $request->category,
            'cover_image' => $imageName,
            'type' => $request->type,
            'duration' => $request->duration,
            'level' => $request->level,
            'lectures' => $request->lectures,
            'language' => $request->language,
            'price' => $request->price,
            'details' => $request->details,
            'course_file' => $courseFileName,
        ]);

        return redirect()->route('dashboard')->with('success', 'Course uploaded successfully!');
    }
}