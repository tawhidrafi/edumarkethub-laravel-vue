@extends('layouts.app')

@section('title', 'Login - EduMarketHub')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4">
        <div class="w-full max-w-md bg-white rounded-xl shadow-md p-8">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Login to EduMarketHub</h1>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3"
                        placeholder="Enter your email" required>
                </div>

                <div>
                    <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-3"
                        placeholder="Enter your password" required>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition">
                    Login
                </button>
            </form>

            <div class="text-center mt-6">
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">
                    Don’t have an account? Register here
                </a>
            </div>
        </div>
    </div>
@endsection