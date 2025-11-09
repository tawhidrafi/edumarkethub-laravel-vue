@extends('layouts.app')

@section('content')
    <main class="container mx-auto px-4 py-10">
        <section class="courses-section">
            <!-- Header -->
            <div class="text-center mb-10">
                <h6 class="text-sm text-gray-500 uppercase tracking-wider mb-2">My Library</h6>
                <h1 class="text-3xl font-bold text-gray-800">Uploaded Courses</h1>
            </div>

            <!-- Courses Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($courses as $course)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300">
                        <a href="{{ url('/courses/detail', $course->id) }}">
                            <img src="{{ asset('courses/assets/img/' . $course->cover_image) }}" alt="{{ $course->name }}"
                                class="w-full h-48 object-cover rounded-t-lg">
                            <div class="p-4 bg-green-800 text-white rounded-b-lg flex flex-col justify-between h-40">
                                <h5 class="text-lg font-semibold mb-2">{{ $course->name }}</h5>
                                <div class="flex justify-between text-sm text-gray-200 mt-auto">
                                    <span>You</span>
                                    <span>{{ ucfirst($course->level) }} • {{ $course->language }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-center col-span-full text-gray-500 mt-10">
                        You haven't uploaded any courses yet.
                    </p>
                @endforelse
            </div>
        </section>
    </main>
@endsection