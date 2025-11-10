@extends('user.layouts.app')

@section('content')
    <main class="container mx-auto px-4 py-10">
        <section class="payment-section">
            <div class="max-w-4xl mx-auto flex flex-col md:flex-row gap-6">

                <!-- Course Summary -->
                <aside class="payment-summary flex-1 bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="font-bold text-lg mb-3">Course Summary</h3>
                    <img src="{{ asset('courses/assets/img/' . $course->cover_image) }}" alt="{{ $course->name }}"
                        class="summary-image mb-3 rounded-lg object-cover w-full h-48">
                    <h4 class="summary-title font-semibold text-lg mb-1">{{ $course->name }}</h4>
                    <p class="summary-author text-gray-600 mb-2">By {{ $course->user->name }}</p>
                    <p class="summary-price font-bold text-blue-600">${{ number_format($course->price, 2) }}</p>
                </aside>

                <!-- Payment Form -->
                <div class="payment-form flex-1 bg-white p-6 rounded-xl shadow-lg">
                    @if(session('error'))
                        <div class="bg-red-100 text-red-700 border border-red-300 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 border border-green-300 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(auth()->user() && auth()->user()->id === $course->user_id)
                        <div class="bg-yellow-50 border border-yellow-300 p-4 rounded mb-4 text-yellow-700">
                            You cannot pay for your own course.
                        </div>
                    @else
                        <form method="POST" action="{{ route('course.payment.submit', $course) }}">
                            @csrf

                            <h3 class="font-bold mb-4 text-lg">bKash Payment Instructions</h3>
                            <div class="bkash-info-box mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 rounded">
                                <p><strong>bKash Number:</strong>
                                    <span class="bkash-number text-pink-600 font-semibold">
                                        {{ $course->user->bkash_num ?? 'N/A' }}
                                    </span>
                                </p>
                                <p>Send exactly <strong>${{ number_format($course->price, 2) }}</strong> to the number above.
                                </p>
                                <p>After sending, enter your transaction ID below.</p>
                            </div>

                            <!-- Phone -->
                            <div class="mb-4">
                                <label for="phone" class="block font-medium mb-1">Phone Number</label>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                                @error('phone')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Transaction ID -->
                            <div class="mb-4">
                                <label for="trxid" class="block font-medium mb-1">Transaction ID</label>
                                <input type="text" name="trxid" id="trxid" value="{{ old('trxid') }}" required
                                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                                @error('trxid')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                                Submit Payment Review
                            </button>
                        </form>
                    @endif

                </div>

            </div>
        </section>
    </main>
@endsection