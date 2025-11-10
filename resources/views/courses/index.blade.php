@extends('layouts.app')
@section('title', 'All Courses')

@section('content')
    <section class="container mx-auto px-4 py-10">
        <!-- Header -->
        <div class="text-center mb-12">
            <h6 class="uppercase tracking-widest text-gray-500 font-semibold mb-2">Our Courses</h6>
            <h1 class="text-4xl font-bold text-gray-900 mt-2">Available Courses</h1>
        </div>

        <!-- Courses Grid -->
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($courses as $course)
                <a href="{{ route('courses.show', $course->id) }}"
                    class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition transform hover:-translate-y-1">

                    <!-- Course Image -->
                    <div class="h-52 w-full overflow-hidden">
                        <img src="{{ $course->cover_image ? asset('storage/courses/' . $course->cover_image) : asset('assets/img/default-course.jpg') }}"
                            alt="{{ $course->name }}" class="w-full h-full object-cover">
                    </div>

                    <!-- Course Info -->
                    <div class="bg-gray-900 text-white p-5 flex flex-col justify-between h-40">
                        <h5 class="font-semibold text-lg mb-2">{{ $course->name }}</h5>
                        <p class="text-gray-300 text-sm mb-2">
                            By {{ $course->user->name ?? 'Unknown' }}
                        </p>
                        <div class="flex justify-between items-center text-gray-200 text-sm font-semibold">
                            <span>{{ ucfirst($course->level ?? 'Beginner') }}</span>
                            <span>${{ number_format($course->price ?? 0, 2) }}</span>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-gray-500 col-span-full text-center mt-10">No courses found.</p>
            @endforelse
        </div>
    </section>
@endsection