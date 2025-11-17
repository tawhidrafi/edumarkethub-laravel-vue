<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduMarketHub Admin</title>
    @vite('resources/css/app.css') {{-- Tailwind CSS --}}
</head>

<body class="bg-gray-100 min-h-screen">

    <header class="flex items-center justify-between bg-white py-4 px-8 border-b border-gray-200 shadow">
        <!-- Logo / Title -->
        <div class="text-2xl text-green-600 font-bold flex items-center gap-2">
            <i class="fas fa-user-shield"></i> Admin Panel
        </div>

        <!-- Navigation Links -->
        <nav class="flex gap-6 items-center">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-green-600 transition">Dashboard</a>
            <a href="{{ route('admin.courses') }}" class="hover:text-green-600 transition">All Courses</a>
            <a href="{{ route('admin.users') }}" class="hover:text-green-600 transition">All Users</a>
            <a href="{{ route('admin.fees') }}" class="hover:text-green-600 transition">Registration Fees</a>
            <a href="{{ route('admin.messages') }}" class="hover:text-green-600 transition">Messages</a>

            <!-- Logout Button Styled Like a Link -->
            <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                @csrf
                <button type="submit"
                    class="text-red-600 font-semibold bg-transparent border-0 cursor-pointer hover:underline transition">
                    Logout
                </button>
            </form>
        </nav>
    </header>


    <main class="container mx-auto mt-6">
        @yield('content')
    </main>

</body>

</html>