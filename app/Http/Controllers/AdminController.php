<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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

        if ($admin && $request->password === $admin->password) { // replace with Hash::check if hashed
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
}
