@extends('layouts.app')

@section('title', 'Contact Us - EduMarketHub')

@section('content')
    <main class="bg-gray-50 py-16 px-4">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-10">

            {{-- Contact Info --}}
            <div class="flex-1 bg-white p-8 rounded-2xl shadow-md space-y-8">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 flex items-center justify-center bg-blue-600 text-white rounded-lg text-xl">
                        <i class="fa fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold">Our Location</h4>
                        <p class="text-gray-600">Chandgaon, Chattogram, Bangladesh</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 flex items-center justify-center bg-gray-600 text-white rounded-lg text-xl">
                        <i class="fa fa-phone-alt"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold">Call Us</h4>
                        <p class="text-gray-600">+880 1234 141214</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 flex items-center justify-center bg-yellow-500 text-white rounded-lg text-xl">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold">Email Us</h4>
                        <p class="text-gray-600">contact@edumarkethub.com</p>
                    </div>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="flex-[1.5] bg-white p-10 rounded-2xl shadow-md">
                <h6 class="uppercase text-gray-500 text-sm mb-2">Need Help?</h6>
                <h1 class="text-3xl font-bold mb-8 text-gray-900">Send Us A Message</h1>

                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg border border-green-300">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="flex-1">
                            <input type="text" name="name" placeholder="Your Name"
                                class="w-full border-b-2 border-gray-300 focus:border-blue-500 py-2 outline-none bg-transparent"
                                value="{{ old('name') }}" required />
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex-1">
                            <input type="email" name="email" placeholder="Your Email"
                                class="w-full border-b-2 border-gray-300 focus:border-blue-500 py-2 outline-none bg-transparent"
                                value="{{ old('email') }}" required />
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <input type="text" name="subject" placeholder="Subject"
                            class="w-full border-b-2 border-gray-300 focus:border-blue-500 py-2 outline-none bg-transparent"
                            value="{{ old('subject') }}" required />
                        @error('subject')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <textarea name="message" rows="5" placeholder="Message"
                            class="w-full border-b-2 border-gray-300 focus:border-blue-500 py-2 outline-none bg-transparent resize-y"
                            required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </main>
@endsection