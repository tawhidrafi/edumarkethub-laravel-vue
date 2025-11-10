<?php

namespace App\Http\Controllers;

use App\Models\RegistrationFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Payment;
use App\Models\User;
use Storage;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Member since
        $member_since = $user->registered_at ? $user->registered_at->format('d M Y') : null;

        // Courses bought
        $bought_data = Payment::join('courses', 'payments.course_id', '=', 'courses.id')
            ->where('payments.user_id', $user->id)       // clarify table
            ->where('payments.status', 'approved')      // clarify table
            ->selectRaw('COUNT(payments.id) as total, SUM(courses.price) as total_spent')
            ->first();

        $courses_bought = $bought_data->total ?? 0;
        $total_expenses = $bought_data->total_spent ?? 0;

        // Courses sold
        $sold_data = Payment::join('courses', 'payments.course_id', '=', 'courses.id')
            ->where('courses.user_id', $user->id)      // clarify table
            ->where('payments.status', 'approved')
            ->selectRaw('COUNT(payments.id) as total_sales, SUM(courses.price) as earnings')
            ->first();

        $courses_sold = $sold_data->total_sales ?? 0;
        $total_earnings = $sold_data->earnings ?? 0;

        return view('user.dashboard', compact(
            'member_since',
            'courses_bought',
            'total_expenses',
            'courses_sold',
            'total_earnings'
        ));
    }

    public function enrolledCourses()
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

    public function uploadedCourses()
    {
        $user = Auth::user(); // currently logged-in user

        $courses = Course::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.uploaded', compact('courses'));
    }

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

    public function storeCourse(Request $request)
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

    public function managePayments()
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

    public function updatePayment(Request $request)
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

        return redirect()->route('payments.manage')->with('success', 'Payment status updated.');
    }

    public function showRegFeeForm()
    {
        return view('user.pay-reg-fee');
    }

    public function submitRegFee(Request $request)
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

    public function showPaymentForm(Course $course)
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

    public function submitPayment(Request $request, Course $course)
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

    public function showProfile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bkash_num' => 'nullable|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->bkash_num = $request->bkash_num;

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/profile', $filename);
            $user->profile_image = $filename;
        }


        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}

