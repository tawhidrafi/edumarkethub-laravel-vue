@props(['hideLogoAndButton' => false])

<header class="flex items-center justify-between bg-white py-4 px-8 border-b border-gray-200">

    {{-- Logo --}}
    @if(!$hideLogoAndButton)
    <div class="text-2xl text-blue-600 font-bold flex items-center gap-2">
        <i class="fa fa-book-reader"></i> EduMarketHub
    </div>
    @endif

    {{-- Navigation Links --}}
    <nav class="flex gap-6 items-center">
        <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
        <a href="{{ route('about') }}" class="hover:text-blue-600 transition">About</a>
        <a href="{{ route('courses.index') }}" class="hover:text-blue-600 transition">Courses</a>
        <a href="{{ route('contact.show') }}" class="hover:text-blue-600 transition">Contact</a>
    </nav>

    {{-- Join Us Button --}}
    @if(!$hideLogoAndButton)
    <a href="{{ route('register') }}"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition font-semibold">
        Join Us
    </a>
    @endif

</header>
