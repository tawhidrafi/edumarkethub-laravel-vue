@extends('user.layouts.app')

@section('content')
    <main class="container mx-auto px-4 py-10">
        <section class="courses-section">
            <!-- Header -->
            <div class="text-center mb-12">
                <h6 class="text-sm text-gray-500 uppercase tracking-wide mb-2">My Library</h6>
                <h1 class="text-4xl font-bold text-gray-800">Uploaded Courses</h1>
            </div>

            <!-- Courses Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse ($courses as $course)
                    <div
                        class="bg-white rounded-lg shadow hover:shadow-2xl transition duration-300 flex flex-col overflow-hidden group">
                        <a href="{{ url('/courses/detail', $course->id) }}" class="relative">
                            <!-- Cover Image -->
                            <img src="{{ asset('courses/assets/img/' . $course->cover_image) }}" alt="{{ $course->name }}"
                                class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">

                            <!-- Overlay on hover -->
                            <div
                                class="absolute inset-0 bg-black bg-opacity-25 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center">
                                <span class="text-white font-semibold text-lg px-4 py-2 bg-green-600 rounded">View Course</span>
                            </div>

                            <!-- Price Badge -->
                            @if($course->price > 0)
                                <span class="absolute top-3 right-3 bg-yellow-400 text-gray-800 font-bold px-3 py-1 rounded shadow">
                                    ${{ $course->price }}
                                </span>
                            @else
                                <span class="absolute top-3 right-3 bg-green-500 text-white font-bold px-3 py-1 rounded shadow">
                                    Free
                                </span>
                            @endif
                        </a>

                        <!-- Compact Course Info -->
                        <div class="p-4 flex flex-col gap-1">
                            <h2 class="text-lg font-semibold text-gray-800 truncate">{{ $course->name }}</h2>
                            <p class="text-gray-500 text-sm truncate">{{ ucfirst($course->level) }} • {{ $course->language }}
                            </p>

                            <div class="flex justify-between items-center mt-2 text-sm text-gray-500">
                                <span class="font-medium text-green-600">You</span>
                                <span
                                    class="bg-gray-100 px-2 py-1 rounded text-gray-700 text-xs">{{ $course->duration ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center col-span-full text-gray-500 mt-10 text-lg">
                        You haven't uploaded any courses yet.
                    </p>
                @endforelse
            </div>
        </section>
    </main>

@endsection