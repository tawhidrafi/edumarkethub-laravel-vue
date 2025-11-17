@extends('layouts.app')
@section('title', $course->name)

@section('content')
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-10 px-4 md:px-6">

            <!-- LEFT CONTENT -->
            <div class="bg-white shadow-lg rounded-2xl flex-1 p-8 transition hover:shadow-xl duration-300">

                <!-- Header -->
                <div class="mb-8">
                    <h6 class="uppercase tracking-wide text-gray-500 text-sm mb-2">Course Detail</h6>
                    <h1 class="text-4xl font-extrabold text-gray-900">{{ $course->name }}</h1>
                </div>

                <!-- Cover Image -->
                <div class="rounded-xl overflow-hidden mb-8">
                    <img src="{{ asset('courses/assets/img/' . $course->cover_image) }}" alt="{{ $course->name }}"
                        class="w-full h-72 object-cover" />
                </div>

                <!-- Course Description -->
                <div class="mb-10">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">About this course</h2>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $course->details ?? 'No description available for this course.' }}
                    </p>
                </div>

                <!-- Course Actions -->
                @if ($isOwner)
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
                        <h3 class="text-2xl font-semibold text-blue-700 mb-4">Your Uploaded Course</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">
                            <div class="text-center">
                                <p class="text-sm text-gray-500 uppercase">Total Sales</p>
                                <p class="text-2xl font-bold text-blue-600">{{ $totalSales }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-500 uppercase">Total Revenue</p>
                                <p class="text-2xl font-bold text-blue-600">${{ number_format($totalRevenue, 2) }}</p>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-gray-500 uppercase">Course Type</p>
                                <p class="text-2xl font-bold text-blue-600 capitalize">{{ $course->type }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Students Enrolled -->
                    <div class="mt-10">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Students Enrolled</h3>

                        @if ($students->isNotEmpty())
                            <div class="overflow-x-auto rounded-xl border border-gray-200">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Student Name</th>
                                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 bg-white">
                                        @foreach ($students as $index => $payment)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                                                <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                                    {{ $payment->user->name ?? 'Unknown' }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-600">{{ $payment->user->email ?? '-' }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-600">{{ $payment->created_at->format('M d, Y') }}
                                                </td>
                                                <td class="px-6 py-4 text-sm font-semibold text-gray-800">
                                                    ${{ number_format($payment->amount, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500 italic">No students have purchased this course yet.</p>
                        @endif
                    </div>

                @elseif ($hasAccess)
                    <div class="bg-green-50 border border-green-300 rounded-xl p-6">
                        <h3 class="text-2xl font-semibold text-green-700 mb-3">Access Granted</h3>
                        <p class="text-gray-700 mb-4">You now have full access to this course.</p>
                        <a href="{{ asset('courses/assets/file/' . $course->course_file) }}"
                            class="bg-green-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-green-700 transition"
                            download>Download Course</a>
                    </div>

                @elseif ($hasPendingPayment)
                    <div class="bg-yellow-50 border border-yellow-300 rounded-xl p-6">
                        <h3 class="font-semibold text-yellow-700 text-2xl mb-2">Payment Pending</h3>
                        <p class="text-gray-700">Your payment is awaiting approval from the course owner.</p>
                    </div>

                @elseif (!Auth::check())
                    <div class="bg-gray-100 border border-gray-300 rounded-xl p-6">
                        <h3 class="text-2xl font-semibold text-blue-600 mb-2">Ready to Learn?</h3>
                        <p class="text-gray-600 mb-4">
                            Log in to enroll and start learning. This course includes lifetime access, updates, and support.
                        </p>
                        <a href="{{ route('login') }}"
                            class="bg-yellow-400 text-gray-900 px-5 py-2 rounded-md font-semibold hover:bg-yellow-500 transition">
                            Log In to Buy
                        </a>
                    </div>

                @else
                    <div class="bg-gray-100 border border-gray-300 rounded-xl p-6">
                        <h3 class="text-2xl font-semibold text-blue-600 mb-2">Buy This Course</h3>
                        <p class="mb-4 text-gray-700">
                            Price: <strong>${{ number_format($course->price, 2) }}</strong><br>
                            Once paid and approved, you’ll gain access to all files.
                        </p>
                        <a href="{{ route('course.payment', ['course' => $course->id]) }}"
                            class="bg-yellow-400 text-gray-900 px-5 py-2 rounded-md font-semibold hover:bg-yellow-500 transition">
                            Proceed to Payment
                        </a>
                    </div>
                @endif
            </div>

            <!-- RIGHT SIDEBAR -->
            <aside class="bg-blue-700 text-white rounded-2xl p-6 w-full md:w-80 shadow-xl">
                <h3 class="text-xl font-bold border-b border-blue-500 pb-3 mb-4">Course Features</h3>

                <dl class="space-y-3">
                    <div class="flex justify-between border-b border-blue-500 pb-2">
                        <dt>Creator</dt>
                        <dd>{{ $course->user->name ?? 'Unknown' }}</dd>
                    </div>
                    <div class="flex justify-between border-b border-blue-500 pb-2">
                        <dt>Lectures</dt>
                        <dd>{{ $course->lectures ?? 'N/A' }}</dd>
                    </div>
                    <div class="flex justify-between border-b border-blue-500 pb-2">
                        <dt>Duration</dt>
                        <dd>{{ $course->duration ?? 'N/A' }}</dd>
                    </div>
                    <div class="flex justify-between border-b border-blue-500 pb-2">
                        <dt>Skill Level</dt>
                        <dd>{{ $course->level ?? 'N/A' }}</dd>
                    </div>
                    <div class="flex justify-between border-b border-blue-500 pb-2">
                        <dt>Language</dt>
                        <dd>{{ $course->language ?? 'N/A' }}</dd>
                    </div>
                </dl>

                <div class="bg-blue-600 text-center rounded-md py-3 mt-6 font-semibold shadow-inner">
                    Course Price: ${{ number_format($course->price, 2) }}
                </div>
            </aside>

        </div>
    </section>
@endsection