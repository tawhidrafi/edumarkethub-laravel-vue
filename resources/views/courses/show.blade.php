@extends('layouts.app')
@section('title', $course->name)
@section('content')

    <section class="bg-gray-50 py-12">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-10">
            <!-- LEFT CONTENT -->
            <div class="bg-white shadow rounded-lg flex-1 p-6">
                <h6 class="uppercase text-gray-500 text-sm mb-2">Course Detail</h6>
                <h1 class="text-3xl font-bold mb-6">{{ $course->name }}</h1>

                <div class="rounded-lg overflow-hidden mb-6">
                    <img src="{{ asset('storage/' . $course->cover_image) }}" class="w-full h-72 object-cover" />
                </div>

                <p class="text-gray-600 leading-relaxed mb-6">{{ $course->details }}</p>

                @if ($isOwner)
                    <div>
                        <h3 class="text-xl font-semibold text-blue-600 mb-2">Your Uploaded Course</h3>
                        <p><strong>Total Copies Sold:</strong> {{ $totalSales }}</p>
                        <p><strong>Total Revenue:</strong> ${{ number_format($totalRevenue, 2) }}</p>
                    </div>

                @elseif ($hasAccess)
                    <div>
                        <h3 class="text-xl font-semibold text-blue-600 mb-2">Download Your Files</h3>
                        <a href="{{ asset('storage/' . $course->course_file) }}" download
                            class="bg-green-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-green-700">
                            Download Course Files (.zip)
                        </a>
                    </div>

                @elseif ($hasPendingPayment)
                    <div class="bg-yellow-50 border border-yellow-300 rounded-md p-4 text-yellow-800">
                        <h3 class="font-semibold">Payment Pending</h3>
                        <p>Your payment is waiting for approval from the course owner.</p>
                    </div>

                @elseif (!Auth::check())
                    <div>
                        <h3 class="text-xl font-semibold text-blue-600 mb-2">Ready to Learn?</h3>
                        <p class="text-gray-600 mb-4">This course includes lifetime access, community feedback, and updates.
                        </p>
                        <a href="{{ route('login') }}"
                            class="bg-yellow-400 text-gray-900 px-4 py-2 rounded-md font-semibold hover:bg-yellow-500">
                            Log In to Buy
                        </a>
                    </div>

                @else
                    <div>
                        <h3 class="text-xl font-semibold text-blue-600 mb-2">Buy This Course</h3>
                        <p class="mb-4">Price: ${{ $course->price }}. After payment and approval, you'll get download
                            access.</p>
                        <a href="{{ route('payment.create', ['course_id' => $course->id]) }}"
                            class="bg-yellow-400 text-gray-900 px-4 py-2 rounded-md font-semibold hover:bg-yellow-500">
                            Proceed to Payment
                        </a>
                    </div>
                @endif
            </div>

            <!-- RIGHT SIDEBAR -->
            <aside class="bg-blue-600 text-white rounded-lg p-6 w-full md:w-80 shadow-md">
                <h3 class="text-xl font-bold border-b border-blue-400 pb-3 mb-4">Course Features</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between border-b border-blue-400 pb-2">
                        <dt>Creator</dt>
                        <dd>{{ $course->user->name }}</dd>
                    </div>
                    <div class="flex justify-between border-b border-blue-400 pb-2">
                        <dt>Lectures</dt>
                        <dd>{{ $course->lectures }}</dd>
                    </div>
                    <div class="flex justify-between border-b border-blue-400 pb-2">
                        <dt>Duration</dt>
                        <dd>{{ $course->duration }}</dd>
                    </div>
                    <div class="flex justify-between border-b border-blue-400 pb-2">
                        <dt>Skill Level</dt>
                        <dd>{{ $course->level }}</dd>
                    </div>
                    <div class="flex justify-between border-b border-blue-400 pb-2">
                        <dt>Language</dt>
                        <dd>{{ $course->language }}</dd>
                    </div>
                </dl>

                <div class="bg-blue-500 text-center rounded-md py-3 mt-6 font-semibold">
                    Course Price: ${{ $course->price }}
                </div>
            </aside>
        </div>
    </section>
@endsection