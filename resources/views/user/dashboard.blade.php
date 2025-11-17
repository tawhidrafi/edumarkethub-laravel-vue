@extends('user.layouts.app')

@section('content')
    <main class="container mx-auto px-6 py-10">
        <!-- Dashboard Overview -->
        <section class="dashboard-overview space-y-8">
            <!-- Stat Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                <div class="bg-gray-100 border-l-4 border-blue-600 rounded shadow p-5">
                    <h3 class="text-gray-700 font-semibold mb-2 text-sm">Member Since</h3>
                    <p class="text-blue-600 text-xl font-bold">{{ $member_since }}</p>
                </div>
                <div class="bg-gray-100 border-l-4 border-blue-600 rounded shadow p-5">
                    <h3 class="text-gray-700 font-semibold mb-2 text-sm">Courses Bought</h3>
                    <p class="text-blue-600 text-xl font-bold">{{ $courses_bought }}</p>
                </div>
                <div class="bg-gray-100 border-l-4 border-blue-600 rounded shadow p-5">
                    <h3 class="text-gray-700 font-semibold mb-2 text-sm">Courses Sold</h3>
                    <p class="text-blue-600 text-xl font-bold">{{ $courses_sold }}</p>
                </div>
                <div class="bg-gray-100 border-l-4 border-blue-600 rounded shadow p-5">
                    <h3 class="text-gray-700 font-semibold mb-2 text-sm">Total Earnings</h3>
                    <p class="text-blue-600 text-xl font-bold">${{ number_format($total_earnings, 2) }}</p>
                </div>
                <div class="bg-gray-100 border-l-4 border-blue-600 rounded shadow p-5">
                    <h3 class="text-gray-700 font-semibold mb-2 text-sm">Total Expenses</h3>
                    <p class="text-blue-600 text-xl font-bold">${{ number_format($total_expenses, 2) }}</p>
                </div>
            </div>

            <!-- Quick Shortcuts -->
            <section class="dashboard-section">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Quick Shortcuts</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('upload.course.form') }}"
                        class="flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded shadow transition duration-300">
                        <i class="fas fa-upload"></i> Upload Course
                    </a>
                    <a href="{{ route('user.enrolled') }}"
                        class="flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded shadow transition duration-300">
                        <i class="fas fa-book"></i> My Courses
                    </a>
                    <a href="{{ route('profile.show') }}"
                        class="flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded shadow transition duration-300">
                        <i class="fas fa-user"></i> Edit Profile
                    </a>
                    <a href="{{ route('contact.show') }}"
                        class="flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded shadow transition duration-300">
                        <i class="fas fa-headset"></i> Contact Admin
                    </a>
                </div>
            </section>
        </section>
    </main>
@endsection