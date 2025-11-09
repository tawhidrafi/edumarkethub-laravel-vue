@extends('admin.layouts.app')

@section('title', 'All Users')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6 text-center">All Registered Users</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Registered</th>
                        <th class="px-4 py-2">Enrolled</th>
                        <th class="px-4 py-2">Uploaded</th>
                        <th class="px-4 py-2">Paid ($)</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->registered_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-2">{{ $user->enrolled }}</td>
                            <td class="px-4 py-2">{{ $user->uploaded }}</td>
                            <td class="px-4 py-2">{{ $user->paid }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-2 text-center">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection