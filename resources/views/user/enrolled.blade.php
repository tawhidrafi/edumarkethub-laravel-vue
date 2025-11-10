@extends('user.layouts.app')

@section('content')
    <main class="container mx-auto px-4 py-10">

        <!-- Page Header -->
        <div class="text-center mb-12">
            <h6 class="uppercase text-gray-500 tracking-widest mb-2">My Library</h6>
            <h1 class="text-4xl font-bold text-gray-800">Enrolled Courses</h1>
        </div>

        <!-- Courses Grid -->
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse ($courses as $course)
                <a href="{{ url('/courses/' . $course['id']) }}"
                    class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1 overflow-hidden group">


                    <!-- Course Image -->
                    <div class="relative h-52 w-full overflow-hidden">
                        <img src="{{ asset('courses/assets/img/' . $course['cover_image']) }}" alt="{{ $course['name'] }}"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">

                        <!-- Price Badge -->
                        @if(isset($course['price']) && $course['price'] > 0)
                            <span class="absolute top-3 right-3 bg-yellow-400 text-gray-900 font-bold px-3 py-1 rounded shadow">
                                ${{ number_format($course['price'], 2) }}
                            </span>
                        @else
                            <span class="absolute top-3 right-3 bg-green-500 text-white font-bold px-3 py-1 rounded shadow">
                                Free
                            </span>
                        @endif
                    </div>

                    <!-- Course Info -->
                    <div class="p-4 bg-gray-900 text-white flex flex-col justify-between">
                        <h5 class="text-lg font-semibold mb-2 text-center truncate">{{ $course['name'] }}</h5>

                        <div class="flex justify-between text-sm text-gray-300 mb-2">
                            <span>{{ $course['author_name'] }}</span>
                            <span>Progress: {{ $course['progress'] ?? 0 }}%</span>
                        </div>

                        <!-- Progress Bar -->
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $course['progress'] ?? 0 }}%"></div>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-center text-gray-500 col-span-full text-lg mt-10">
                    You haven’t enrolled in any courses yet.
                </p>
            @endforelse
        </div>

    </main>
@endsection