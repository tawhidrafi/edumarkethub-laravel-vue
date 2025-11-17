<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Hash;
use Illuminate\Http\Request;
use Session;

class AdminAuthController extends Controller
{
    // login form
    public function showLogin()
    {
        return view('admin.login');
    }

    // login
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

    // Logout
    public function logout()
    {
        Session::forget(['admin_id', 'admin_name']);
        return redirect()->route('admin.login');
    }
}
