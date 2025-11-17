@extends('user.layouts.app')

@section('content')
    <main class="container mx-auto px-4 py-10">
        <section class="profile-section max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold mb-6 text-center">My Profile</h2>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 border border-green-300 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col md:flex-row gap-6">
                <!-- Profile Image -->
                <div class="shrink-0 flex flex-col items-center gap-4">
                    <img src="{{ $user->profile_image ? asset('storage/profile/' . $user->profile_image) : asset('assets/img/default.jpg') }}"
                        alt="Avatar" class="w-32 h-32 object-cover rounded-full">


                    <label for="profile_image"
                        class="cursor-pointer bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition duration-300 text-sm">
                        Change Photo
                    </label>
                    <span id="profile-filename" class="text-gray-600 text-sm">No file chosen</span>
                </div>

                <!-- Profile Info / Edit Form -->
                <div class="flex-1">
                    <!-- View Mode -->
                    <div class="view-mode space-y-2">
                        <p><strong class="text-gray-700">Name:</strong> {{ $user->name }}</p>
                        <p><strong class="text-gray-700">Email:</strong> {{ $user->email }}</p>
                        <p><strong class="text-gray-700">Bkash Number:</strong>
                            {{ $user->bkash_num ?? 'Not yet submitted' }}</p>
                        <button id="toggleEditBtn"
                            class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold shadow-md transition duration-300">
                            <i class="fas fa-edit mr-1"></i> Edit Profile
                        </button>
                    </div>

                    <!-- Edit Mode -->
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                        class="edit-mode hidden mt-4 space-y-4 bg-gray-50 p-6 rounded-lg shadow-inner">
                        @csrf

                        <div>
                            <label for="name" class="block font-semibold mb-1">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                        </div>

                        <div>
                            <label for="email" class="block font-semibold mb-1">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                        </div>

                        <div>
                            <label for="bkash_num" class="block font-semibold mb-1">Bkash Number</label>
                            <input type="tel" name="bkash_num" id="bkash_num"
                                value="{{ old('bkash_num', $user->bkash_num) }}"
                                class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                        </div>

                        <div>
                            <label for="profile_image" class="cursor-pointer ...">Change Photo</label>

                            <input type="file" name="profile_image" id="profile_image" class="hidden" accept="image/*"
                                onchange="previewProfile(this)">

                        </div>

                        <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold shadow-md transition duration-300">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Toggle edit mode
        const toggleBtn = document.getElementById('toggleEditBtn');
        const viewMode = document.querySelector('.view-mode');
        const editMode = document.querySelector('.edit-mode');

        toggleBtn.addEventListener('click', () => {
            viewMode.classList.add('hidden');
            editMode.classList.remove('hidden');
        });

        // Profile picture preview
        const profileInput = document.getElementById('profile_image');
        const profilePreview = document.getElementById('profile-preview');
        const profileFilename = document.getElementById('profile-filename');

        function previewProfile(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    profilePreview.src = e.target.result;
                    profileFilename.textContent = input.files[0].name;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection