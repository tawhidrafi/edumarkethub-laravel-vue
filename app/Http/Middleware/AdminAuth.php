<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Check if admin session exists
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}