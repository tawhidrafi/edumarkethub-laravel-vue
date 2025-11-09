@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 text-center">All Payments</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Date</th>
                        <th class="px-4 py-2 text-left">User</th>
                        <th class="px-4 py-2 text-left">User ID</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($fees as $fee)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2">#{{ $fee->id }}</td>
                            <td class="px-4 py-2">{{ $fee->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-2">{{ $fee->user->name }}</td>
                            <td class="px-4 py-2">#{{ $fee->user->id }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 rounded-full text-sm font-semibold 
                                                @if($fee->status == 'approved') bg-green-200 text-green-800 
                                                @elseif($fee->status == 'pending') bg-yellow-200 text-yellow-800 
                                                @else bg-red-200 text-red-800 @endif">
                                    {{ ucfirst($fee->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 flex gap-2">
                                @if($fee->status == 'pending')
                                    <form action="{{ route('admin.fees.approve', $fee->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.fees.reject', $fee->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Reject</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-2 text-center">No payment records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection