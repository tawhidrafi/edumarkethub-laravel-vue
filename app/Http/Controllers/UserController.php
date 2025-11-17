<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class UserController extends Controller
{
    public function index()
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
}