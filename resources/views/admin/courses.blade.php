@extends('admin.layouts.app')

@section('title', 'All Courses')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6 text-center">All Courses</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Category</th>
                        <th class="px-4 py-2">Type</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Creator</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Price ($)</th>
                        <th class="px-4 py-2">Enrolled</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($courses as $course)
                        <tr>
                            <td class="px-4 py-2">#C{{ $course->id }}</td>
                            <td class="px-4 py-2">{{ $course->category }}</td>
                            <td class="px-4 py-2">{{ ucfirst($course->type) }}</td>
                            <td class="px-4 py-2">{{ $course->name }}</td>
                            <td class="px-4 py-2">{{ $course->creator->name }}</td>
                            <td class="px-4 py-2">{{ $course->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-2">{{ $course->price }}</td>
                            <td class="px-4 py-2">{{ $course->enrolled }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-2 text-center">No courses found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection