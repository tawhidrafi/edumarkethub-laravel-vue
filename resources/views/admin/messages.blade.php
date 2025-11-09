@extends('admin.layouts.app')

@section('title', 'Admin Messages')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4 text-center">All Messages</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Subject</th>
                        <th class="px-4 py-2">Message</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($messages as $message)
                        <tr>
                            <td class="px-4 py-2">#{{ $message->id }}</td>
                            <td class="px-4 py-2">{{ $message->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-2">{{ $message->name }}</td>
                            <td class="px-4 py-2">{{ $message->email }}</td>
                            <td class="px-4 py-2">{{ $message->subject }}</td>
                            <td class="px-4 py-2">{{ $message->message }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-2 text-center">No messages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection