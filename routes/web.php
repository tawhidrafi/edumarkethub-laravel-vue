<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RegistrationFeeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');


Route::get('/all-courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');


Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/enrolled', [UserController::class, 'enrolledCourses'])->name('user.enrolled');
    Route::get('/uploaded', [UserController::class, 'uploadedCourses'])->name('user.uploaded');
    Route::get('/upload-course', [UserController::class, 'showUploadForm'])->name('upload.course.form');
    Route::post('/upload-course', [UserController::class, 'storeCourse'])->name('upload.course.store');
    Route::get('/manage-payments', [UserController::class, 'managePayments'])->name('user.manage-payments');
    Route::post('/manage-payments', [UserController::class, 'updatePaymentStatus'])->name('user.manage-payments.update');
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile.show');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/pay-registration-fee', [UserController::class, 'showRegFeeForm'])->name('registration.fee');
    Route::post('/pay-registration-fee', [UserController::class, 'submitRegFee'])->name('registration.fee.submit');
    Route::get('/course/{course}/payment', [UserController::class, 'showPaymentForm'])->name('course.payment');
    Route::post('/course/{course}/payment', [UserController::class, 'submitPayment'])->name('course.payment.submit');
});

// Admin login/logout (if you haven’t already)
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login.post');
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Protected routes for authenticated admins
    Route::middleware('auth.admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Additional admin pages
        Route::get('courses', [AdminController::class, 'allCourses'])->name('admin.courses');
        Route::get('users', [AdminController::class, 'allUsers'])->name('admin.users');
        Route::get('fees', [AdminController::class, 'fees'])->name('admin.fees');
        Route::post('fees/{id}/approve', [AdminController::class, 'approveFee'])->name('admin.fees.approve');
        Route::post('fees/{id}/reject', [AdminController::class, 'rejectFee'])->name('admin.fees.reject');
        Route::get('messages', [AdminController::class, 'messages'])->name('admin.messages');
    });
});