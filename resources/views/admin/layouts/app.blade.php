<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduMarketHub Admin</title>
    @vite('resources/css/app.css') {{-- Tailwind CSS --}}
</head>

<body class="bg-gray-100 min-h-screen">

    <header class="bg-white shadow">
        <div class="container mx-auto flex justify-between items-center p-4">
            <h1 class="text-2xl font-bold text-green-600">Welcome, Admin</h1>
            <nav class="space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-green-600">Dashboard</a>
                <a href="{{ route('admin.courses.index') }}" class="text-gray-700 hover:text-green-600">All Courses</a>
                <a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:text-green-600">All Users</a>
                <a href="{{ route('admin.fees.index') }}" class="text-gray-700 hover:text-green-600">Registration
                    Fees</a>
                <a href="{{ route('admin.messages.index') }}" class="text-gray-700 hover:text-green-600">Messages</a>
                <a href="{{ route('admin.logout') }}" class="text-red-600 font-bold">Logout</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-6">
        @yield('content')
    </main>

</body>

</html>