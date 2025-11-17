@extends('user.layouts.app')

@section('content')
    <main class="container mx-auto px-4 py-10">
        <section class="payment-section">
            <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">
                <header class="text-center mb-6">
                    <h2 class="text-2xl font-bold mb-2">Complete Your Registration</h2>
                    <p class="text-gray-600">Please follow the steps below to complete your payment via bKash.</p>
                </header>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 border border-red-300 px-4 py-3 rounded mb-4">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="payment-content flex flex-col md:flex-row gap-6">
                    <!-- Payment Instructions -->
                    <div class="flex-1 bg-yellow-100 p-6 rounded border-l-4 border-yellow-500">
                        <h3 class="font-bold mb-2">bKash Payment Instructions</h3>
                        <p><strong>bKash Number:</strong> <span class="text-pink-600 font-semibold">01213-251436</span></p>
                        <p>Send exactly <strong>৳ 3000 TK</strong> to the number above.</p>
                        <p>After sending, enter your transaction ID below.</p>
                    </div>

                    <!-- Payment Form -->
                    <div class="flex-1 bg-white p-6 rounded shadow">
                        <form method="POST" action="{{ route('registration.fee.submit') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="phone" class="block font-medium mb-1">Phone Number</label>
                                <input type="tel" name="phone" id="phone" required
                                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                            </div>

                            <div class="mb-4">
                                <label for="trxid" class="block font-medium mb-1">bKash Transaction ID</label>
                                <input type="text" name="trxid" id="trxid" required
                                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                            </div>

                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                                Submit Payment Review
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection