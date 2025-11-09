@extends('layouts.app')

@section('content')
    <main class="container">
        <section class="dashboard-overview">
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Member Since</h3>
                    <p><strong>{{ $member_since }}</strong></p>
                </div>
                <div class="stat-card">
                    <h3>Courses Bought</h3>
                    <p><strong>{{ $courses_bought }}</strong></p>
                </div>
                <div class="stat-card">
                    <h3>Courses Sold</h3>
                    <p><strong>{{ $courses_sold }}</strong></p>
                </div>
                <div class="stat-card">
                    <h3>Total Earnings</h3>
                    <p><strong>${{ number_format($total_earnings, 2) }}</strong></p>
                </div>
                <div class="stat-card">
                    <h3>Total Expenses</h3>
                    <p><strong>${{ number_format($total_expenses, 2) }}</strong></p>
                </div>
            </div>

            <section class="dashboard-section dashboard-shortcuts">
                <h2>Quick Shortcuts</h2>
                <div class="shortcut-grid">
                    <a href="{{ route('user.uploadCourse') }}" class="shortcut-btn">
                        <i class="fas fa-upload"></i> Upload Course
                    </a>
                    <a href="{{ route('user.enrolled') }}" class="shortcut-btn">
                        <i class="fas fa-book"></i> My Courses
                    </a>
                    <a href="{{ route('user.profile') }}" class="shortcut-btn">
                        <i class="fas fa-user"></i> Edit Profile
                    </a>
                    <a href="{{ route('contact') }}" class="shortcut-btn">
                        <i class="fas fa-headset"></i> Contact Admin
                    </a>
                </div>
            </section>
        </section>
    </main>
@endsection