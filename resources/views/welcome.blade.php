@extends('layouts.app')

@section('title', 'Home - EduMarketHub')

@section('content')

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-600 to-indigo-600">
        <div class="container mx-auto px-4 py-32 flex flex-col md:flex-row items-center gap-10">
            <!-- Text -->
            <div class="flex-1 text-center md:text-left space-y-6">
                <h1 class="text-5xl md:text-6xl font-bold text-white leading-tight animate-fade-in">Learn Anytime, Anywhere
                </h1>
                <p class="text-lg md:text-xl text-white opacity-80 animate-fade-in-delay">Discover courses from top
                    instructors and share knowledge with the world. Grow your skills and your career.</p>
                <div class="flex justify-center md:justify-start gap-4 mt-6 animate-fade-in-delay">
                    <a href="{{ route('courses.index') }}"
                        class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg font-bold transition shadow-lg">Browse
                        Courses</a>
                    <a href="{{ route('register') }}"
                        class="border border-white text-white hover:bg-white hover:text-gray-900 px-6 py-3 rounded-lg font-bold transition shadow-lg">Join
                        Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-4 text-center">
            <h6 class="uppercase tracking-widest text-gray-500 mb-2">Why Choose Us?</h6>
            <h2 class="text-4xl font-bold text-gray-900 mb-12">Unlock Your Potential with EduMarketHub</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div
                        class="w-16 h-16 flex items-center justify-center bg-blue-600 text-white rounded-full mx-auto mb-4 text-2xl">
                        <i class="fa fa-graduation-cap"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Expert Instructors</h3>
                    <p class="text-gray-600">Learn from highly qualified professionals with years of industry experience and
                        real-world projects.</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div
                        class="w-16 h-16 flex items-center justify-center bg-green-500 text-white rounded-full mx-auto mb-4 text-2xl">
                        <i class="fa fa-certificate"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Certifications</h3>
                    <p class="text-gray-600">Earn internationally recognized certificates to boost your resume and
                        professional credibility.</p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">
                    <div
                        class="w-16 h-16 flex items-center justify-center bg-yellow-400 text-white rounded-full mx-auto mb-4 text-2xl">
                        <i class="fa fa-laptop"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Learn Anywhere</h3>
                    <p class="text-gray-600">Access high-quality courses on any device, anytime. Learning has never been
                        easier or more flexible.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-4 text-center mb-12">
            <h6 class="uppercase tracking-widest text-gray-500 mb-2">Testimonials</h6>
            <h2 class="text-4xl font-bold text-gray-900">What Our Students Say</h2>
        </div>

        <div class="container mx-auto px-4 grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-2xl transition transform hover:-translate-y-2">
                <p class="text-gray-700 mb-4">"EduMarketHub helped me land my dream job! The courses are top-notch."</p>
                <div class="font-semibold text-gray-900">Jane Doe</div>
                <div class="text-gray-500 text-sm">Software Engineer</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-2xl transition transform hover:-translate-y-2">
                <p class="text-gray-700 mb-4">"The instructors are amazing and the platform is very easy to use."</p>
                <div class="font-semibold text-gray-900">John Smith</div>
                <div class="text-gray-500 text-sm">Data Analyst</div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-2xl transition transform hover:-translate-y-2">
                <p class="text-gray-700 mb-4">"I love learning at my own pace. Highly recommended!"</p>
                <div class="font-semibold text-gray-900">Mary Johnson</div>
                <div class="text-gray-500 text-sm">UI/UX Designer</div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center justify-between gap-6">
            <h2 class="text-3xl md:text-4xl font-bold">Start Learning Today!</h2>
            <a href="{{ route('register') }}"
                class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 px-6 py-3 rounded-lg font-bold transition shadow-lg">Join
                Now</a>
        </div>
    </section>

@endsection