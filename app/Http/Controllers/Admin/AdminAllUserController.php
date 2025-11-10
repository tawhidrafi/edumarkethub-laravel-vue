<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminAllUserController extends Controller
{
    //
    public function index()
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
