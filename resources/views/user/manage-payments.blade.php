@extends('user.layouts.app')

@section('content')
    <main class="container mx-auto px-4 py-10">
        <section class="admin-payments-section">
            <h2 class="text-2xl font-bold text-center mb-6">Manage Course Payments</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                @if($courses->isEmpty())
                    <p class="text-center text-gray-500">You don't have any courses yet.</p>
                @elseif($payments->isEmpty())
                    <p class="text-center text-gray-500">No pending payments for your courses.</p>
                @else
                    <table class="min-w-full bg-white rounded shadow">
                        <thead class="bg-blue-600 text-white text-left">
                            <tr>
                                <th class="px-4 py-2">Course</th>
                                <th class="px-4 py-2">Buyer</th>
                                <th class="px-4 py-2">Phone</th>
                                <th class="px-4 py-2">Transaction ID</th>
                                <th class="px-4 py-2">Date</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-2">{{ $courses[$payment->course_id] ?? 'N/A' }}</td>
                                    <td class="px-4 py-2">{{ $payment->user->name }}</td>
                                    <td class="px-4 py-2">{{ $payment->phone }}</td>
                                    <td class="px-4 py-2">{{ $payment->trxid }}</td>
                                    <td class="px-4 py-2">{{ $payment->created_at->format('d M Y') }}</td>
                                    <td class="px-4 py-2 flex gap-2">
                                        <form method="POST" class="inline">
                                            @csrf
                                            <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                                            <button type="submit" name="action" value="approve"
                                                class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">Approve</button>
                                            <button type="submit" name="action" value="reject"
                                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </section>
    </main>
@endsection