<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Admin\AdminRegistrationFeeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAllUserController;
use App\Http\Controllers\Admin\AdminAllCourseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegistrationFeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCourseController;
use App\Http\Controllers\UserEarningController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;

// Public routes
Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// User authentication routes
Route::get('/register', [UserAuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserAuthController::class, 'register']);
Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserAuthController::class, 'login']);
Route::post('/logout', [UserAuthController::class, 'destroy'])->name('logout');

// 
Route::get('/all-courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');

// Protected user routes
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('dashboard');
    // routes for course management
    Route::get('/enrolled', [UserCourseController::class, 'showEnrolledCourses'])->name('user.enrolled');
    Route::get('/uploaded', [UserCourseController::class, 'showUploadedCourses'])->name('user.uploaded');
    Route::get('/upload-course', [UserCourseController::class, 'showUploadForm'])->name('upload.course.form');
    Route::post('/upload-course', [UserCourseController::class, 'store'])->name('upload.course.store');
    // routes for managing earnings
    Route::get('/manage-payments', [UserEarningController::class, 'index'])->name('user.manage-payments');
    Route::post('/manage-payments', [UserEarningController::class, 'update'])->name('user.manage-payments.update');
    // USER PROFILE ROUTES
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.show');
    Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    // Registration fee routes
    Route::get('/pay-registration-fee', [RegistrationFeeController::class, 'index'])->name('registration.fee');
    Route::post('/pay-registration-fee', [RegistrationFeeController::class, 'store'])->name('registration.fee.submit');
    //
    Route::get('/course/{course}/payment', [PaymentController::class, 'index'])->name('course.payment');
    Route::post('/course/{course}/payment', [PaymentController::class, 'store'])->name('course.payment.submit');
});

Route::prefix('admin')->group(function () {
    // Admin login/logout (if you haven’t already)
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    // Protected routes for authenticated admins
    Route::middleware('auth.admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
        // Additional admin pages
        Route::get('courses', [AdminAllCourseController::class, 'index'])->name('admin.courses');
        Route::get('users', [AdminAllUserController::class, 'index'])->name('admin.users');
        Route::get('messages', [AdminController::class, 'messages'])->name('admin.messages');
        // Registration fees Admin Routes
        Route::get('reg-fees', [AdminRegistrationFeeController::class, 'fees'])->name('admin.fees');
        Route::post('reg-fees/{id}/approve', [AdminRegistrationFeeController::class, 'approveFee'])->name('admin.fees.approve');
        Route::post('reg-fees/{id}/reject', [AdminRegistrationFeeController::class, 'rejectFee'])->name('admin.fees.reject');
    });
});