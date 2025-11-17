<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    // Update user profile  
    public function update(Request $request)
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
