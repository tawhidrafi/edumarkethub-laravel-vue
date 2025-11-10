<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Course;
use App\Models\Message;
use App\Models\RegistrationFee;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)
            ->where('status', 'active')
            ->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('admin_id', $admin->id);
            Session::put('admin_name', $admin->name);
            return redirect()->route('admin.dashboard');

        }

        return back()->withErrors(['username' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Session::forget(['admin_id', 'admin_name']);
        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
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
