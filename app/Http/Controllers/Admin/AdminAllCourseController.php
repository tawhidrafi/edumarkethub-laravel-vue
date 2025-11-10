<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;

class AdminAllCourseController extends Controller
{
    //
    public function index()
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
}
