@extends('layouts.app')
@section('title', 'All Courses')
@section('content')

    <section class="text-center mb-12">
        <h6 class="uppercase tracking-widest text-gray-500 font-semibold">Our Courses</h6>
        <h1 class="text-4xl font-bold text-gray-900 mt-2">Available Courses</h1>
    </section>

    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($courses as $course)
            <a href="{{ route('courses.show', $course->id) }}"
                class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition transform hover:-translate-y-1">
                <img src="{{ asset('storage/' . $course->cover_image) }}" alt="{{ $course->name }}"
                    class="w-full h-52 object-cover border-b-4 border-blue-500">

                <div class="bg-gray-900 text-white p-5 flex flex-col justify-between h-40">
                    <h5 class="font-semibold text-lg text-center mb-3">{{ $course->name }}</h5>
                    <div class="flex justify-between text-gray-400 text-sm border-t border-gray-700 pt-2">
                        <span>{{ $course->user->name }}</span>
                        <span class="text-gray-200 font-semibold">${{ number_format($course->price, 2) }}</span>
                    </div>
                </div>
            </a>
        @empty
            <p class="text-gray-500 col-span-full text-center">No courses found.</p>
        @endforelse
    </div>

@endsection