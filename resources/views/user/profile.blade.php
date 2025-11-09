@extends('layouts.app')

@section('content')
    <main class="container mx-auto px-4 py-10">
        <section class="profile-section max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold mb-6">My Profile</h2>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 border border-green-300 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded shadow flex flex-col md:flex-row gap-6">
                <!-- Profile Image -->
                <div class="shrink-0">
                    <img src="{{ $user->profile_image ? asset('storage/profile/' . $user->profile_image) : asset('assets/img/default.jpg') }}"
                        alt="User Avatar" class="w-32 h-32 object-cover rounded-full">
                </div>

                <!-- Profile Info / Edit Form -->
                <div class="flex-1">
                    <!-- View Mode -->
                    <div class="view-mode">
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Bkash Number:</strong> {{ $user->bkash_num ?? 'Not yet submitted' }}</p>
                        <button id="toggleEditBtn"
                            class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-bold">
                            <i class="fas fa-edit"></i> Edit Profile
                        </button>
                    </div>

                    <!-- Edit Mode -->
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                        class="edit-mode hidden mt-4 bg-gray-50 p-4 rounded shadow">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block font-semibold mb-1">Name:</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                class="w-full border rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block font-semibold mb-1">Email:</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                class="w-full border rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label for="bkash_num" class="block font-semibold mb-1">Bkash Number:</label>
                            <input type="tel" name="bkash_num" id="bkash_num"
                                value="{{ old('bkash_num', $user->bkash_num) }}" class="w-full border rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label for="profile_image" class="block font-semibold mb-1">Profile Picture:</label>
                            <input type="file" name="profile_image" id="profile_image" class="w-full">
                        </div>

                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-bold">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script>
        const toggleBtn = document.getElementById('toggleEditBtn');
        const viewMode = document.querySelector('.view-mode');
        const editMode = document.querySelector('.edit-mode');

        toggleBtn.addEventListener('click', () => {
            viewMode.classList.add('hidden');
            editMode.classList.remove('hidden');
        });
    </script>
@endsection