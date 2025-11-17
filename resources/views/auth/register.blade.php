@extends('layouts.app')

@section('title', 'Register - EduMarketHub')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h1 class="text-2xl font-bold text-center mb-6">Create an Account</h1>

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="name" class="block mb-1 font-medium">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your full name" required>
                </div>

                <div>
                    <label for="email" class="block mb-1 font-medium">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter your email" required>
                </div>

                <div>
                    <label for="password" class="block mb-1 font-medium">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Create a password" required>
                </div>

                <div>
                    <label for="password_confirmation" class="block mb-1 font-medium">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Confirm your password" required>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition font-semibold">
                    Register
                </button>
            </form>

            <p class="mt-4 text-center text-gray-600 text-sm">
                Already have an account?
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login here</a>
            </p>
        </div>
    </div>
@endsection