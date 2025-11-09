@extends('admin.layouts.app')

@section('content')
    <div class="p-6">

        <h2 class="text-3xl font-bold text-blue-600 mb-8">Admin Dashboard</h2>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-blue-50 rounded-lg p-5 shadow flex items-center gap-4">
                <i class="fas fa-users text-blue-600 text-4xl"></i>
                <div>
                    <p class="text-gray-600">Total Users</p>
                    <p class="text-2xl font-bold">{{ $totalUsers }}</p>
                </div>
            </div>
            <div class="bg-green-50 rounded-lg p-5 shadow flex items-center gap-4">
                <i class="fas fa-book text-green-600 text-4xl"></i>
                <div>
                    <p class="text-gray-600">Total Courses</p>
                    <p class="text-2xl font-bold">{{ $totalCourses }}</p>
                </div>
            </div>
            <div class="bg-yellow-50 rounded-lg p-5 shadow flex items-center gap-4">
                <i class="fas fa-dollar-sign text-yellow-600 text-4xl"></i>
                <div>
                    <p class="text-gray-600">Total Payments</p>
                    <p class="text-2xl font-bold">${{ number_format($totalPayments, 2) }}</p>
                </div>
            </div>
            <div class="bg-red-50 rounded-lg p-5 shadow flex items-center gap-4">
                <i class="fas fa-chart-line text-red-600 text-4xl"></i>
                <div>
                    <p class="text-gray-600">Active Users</p>
                    <p class="text-2xl font-bold">{{ $activeUsers }}</p>
                </div>
            </div>
        </div>

        {{-- Recent Users --}}
        <div>
            <h3 class="text-xl font-semibold mb-4 text-blue-600">Recent Users</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left">Name</th>
                            <th class="py-2 px-4 text-left">Email</th>
                            <th class="py-2 px-4 text-left">Registered</th>
                            <th class="py-2 px-4 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentUsers as $user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $user->name }}</td>
                                <td class="py-2 px-4">{{ $user->email }}</td>
                                <td class="py-2 px-4">{{ $user->registered_at->format('Y-m-d') }}</td>
                                <td class="py-2 px-4">
                                    <span
                                        class="px-2 py-1 rounded-full text-sm {{ $user->status == 'active' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection