@extends('layouts.app')

@section('content')
    <main class="container mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="text-center mb-10">
            <h6 class="uppercase text-gray-500 tracking-widest mb-2">My Library</h6>
            <h1 class="text-3xl font-bold text-gray-800">Enrolled Courses</h1>
        </div>

        <!-- Courses Grid -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($courses as $course)
                <a href="{{ url('/courses/detail', $course['id']) }}"
                    class="bg-white rounded-xl shadow hover:shadow-lg transform hover:-translate-y-1 transition overflow-hidden">
                    <!-- Course Image -->
                    <img src="{{ asset('courses/assets/img/' . $course['cover_image']) }}" alt="{{ $course['name'] }}"
                        class="w-full h-52 object-cover border-b-4 border-blue-500">

                    <!-- Course Info -->
                    <div class="p-4 bg-gray-900 text-white flex flex-col justify-between">
                        <h5 class="text-lg font-semibold mb-2 text-center">{{ $course['name'] }}</h5>
                        <div class="flex justify-between text-sm text-gray-300">
                            <span>{{ $course['author_name'] }}</span>
                            <span>Progress: --%</span>
                        </div>

                        <!-- Optional Progress Bar -->
                        <div class="w-full bg-gray-700 rounded-full h-2 mt-3">
                            <div class="bg-blue-500 h-2 rounded-full" style="width:0%"></div>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-center text-gray-500 col-span-full">You haven’t enrolled in any courses yet.</p>
            @endforelse
        </div>
    </main>
@endsection