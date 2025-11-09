@extends('layouts.app')

@section('title', 'Home - EduMarketHub')

@section('content')

<!-- Hero Section -->
<section class="relative bg-cover bg-center" style="background-image: url('{{ asset('img/header.jpg') }}');">
    <div class="absolute inset-0 bg-black bg-opacity-60 flex flex-col justify-center items-center py-32 text-center">
        <h2 class="text-4xl md:text-5xl font-semibold text-white mb-4">Learn from home...</h2>
        <h2 class="text-4xl md:text-5xl font-semibold text-white mb-4">Share with others...</h2>
        <h2 class="text-4xl md:text-5xl font-semibold text-white">Learn with your friends...</h2>
    </div>
</section>

<!-- About Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto flex flex-col md:flex-row gap-10 items-center">
        <div class="flex-1">
            <img src="{{ asset('img/home-1.jpg') }}" alt="About Us" class="w-full h-full object-cover rounded-lg shadow-lg">
        </div>
        <div class="flex-1 space-y-4">
            <h6 class="uppercase text-gray-500 tracking-wider">About Us</h6>
            <h2 class="text-3xl md:text-4xl font-bold">First Choice For Online Education Anywhere</h2>
            <p class="text-gray-700 leading-relaxed">
                Tempor erat elitr at rebum... Amet erat amet et magna
            </p>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto flex flex-col md:flex-row gap-10 items-center">
        <!-- Features Text -->
        <div class="flex-1 space-y-8">
            <h6 class="uppercase text-gray-500 tracking-wider">Why Choose Us?</h6>
            <h2 class="text-3xl md:text-4xl font-bold">Why You Should Start Learning with Us?</h2>

            <div class="flex gap-4 items-start">
                <div class="w-16 h-16 flex items-center justify-center bg-blue-600 text-white rounded-lg text-2xl">
                    <i class="fa fa-graduation-cap"></i>
                </div>
                <div>
                    <h4 class="text-xl font-semibold">Skilled Instructors</h4>
                    <p class="text-gray-600">Labore rebum duo est Sit dolore eos sit tempor eos stet...</p>
                </div>
            </div>

            <div class="flex gap-4 items-start">
                <div class="w-16 h-16 flex items-center justify-center bg-gray-700 text-white rounded-lg text-2xl">
                    <i class="fa fa-certificate"></i>
                </div>
                <div>
                    <h4 class="text-xl font-semibold">International Certificate</h4>
                    <p class="text-gray-600">Labore rebum duo est Sit dolore eos sit tempor eos stet...</p>
                </div>
            </div>

            <div class="flex gap-4 items-start">
                <div class="w-16 h-16 flex items-center justify-center bg-yellow-400 text-white rounded-lg text-2xl">
                    <i class="fa fa-book-reader"></i>
                </div>
                <div>
                    <h4 class="text-xl font-semibold">Online Classes</h4>
                    <p class="text-gray-600">Labore rebum duo est Sit dolore eos sit tempor eos stet...</p>
                </div>
            </div>
        </div>

        <!-- Feature Image -->
        <div class="flex-1">
            <img src="{{ asset('img/home-2.jpg') }}" alt="Feature Image" class="w-full h-full object-cover rounded-lg shadow-lg">
        </div>
    </div>
</section>

@endsection
