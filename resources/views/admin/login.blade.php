<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-6">Admin Login</h1>
        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            @error('username')
                <div class="text-red-500 mb-2">{{ $message }}</div>
            @enderror
            <div class="mb-4">
                <label class="block mb-1">Username</label>
                <input type="text" name="username" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block mb-1">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>
</body>

</html>