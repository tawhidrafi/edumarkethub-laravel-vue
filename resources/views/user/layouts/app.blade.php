<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduMarketHub User</title>
    @vite('resources/css/app.css') {{-- Tailwind CSS --}}
</head>

<body class="bg-gray-100 min-h-screen">
@include('components.nav', ['hideLogoAndButton' => true])
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center gap-4">
            <!-- Logo / Brand -->
            <div class="flex items-center gap-2 text-2xl font-bold text-blue-600">
                <i class="fa fa-book-reader"></i>
                <span>EduMarketHub</span>
            </div>

            <!-- Navigation Links -->
            <nav class="flex flex-wrap gap-4 md:gap-6 items-center">
                <a href="{{ route('dashboard') }}"
                    class="px-3 py-2 rounded hover:bg-blue-50 transition {{ request()->routeIs('dashboard') ? 'bg-blue-100 font-semibold' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('user.enrolled') }}"
                    class="px-3 py-2 rounded hover:bg-blue-50 transition {{ request()->routeIs('user.enrolled') ? 'bg-blue-100 font-semibold' : '' }}">
                    My Courses
                </a>
                <a href="{{ route('user.uploaded') }}"
                    class="px-3 py-2 rounded hover:bg-blue-50 transition {{ request()->routeIs('user.uploaded') ? 'bg-blue-100 font-semibold' : '' }}">
                    Uploaded Courses
                </a>
                <a href="{{ route('upload.course.form') }}"
                    class="px-3 py-2 rounded hover:bg-blue-50 transition {{ request()->routeIs('upload.course.form') ? 'bg-blue-100 font-semibold' : '' }}">
                    Upload Course
                </a>
                <a href="{{ route('user.manage-payments') }}"
                    class="px-3 py-2 rounded hover:bg-blue-50 transition {{ request()->routeIs('user.manage-payments*') ? 'bg-blue-100 font-semibold' : '' }}">
                    Earnings
                </a>
                <a href="{{ route('profile.show') }}"
                    class="px-3 py-2 rounded hover:bg-blue-50 transition {{ request()->routeIs('profile.show') ? 'bg-blue-100 font-semibold' : '' }}">
                    My Profile
                </a>
            </nav>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" class="mt-2 md:mt-0">
                @csrf
                <button type="submit"
                    class="px-4 py-2 rounded bg-red-600 text-white font-semibold hover:bg-red-700 transition">
                    Logout
                </button>
            </form>
        </div>
    </header>




    <main class="container mx-auto mt-6">
        @yield('content')
    </main>
@include('components.footer')
</body>

</html>