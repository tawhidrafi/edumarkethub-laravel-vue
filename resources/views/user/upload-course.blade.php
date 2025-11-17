@extends('user.layouts.app')

@section('content')
    <main class="container mx-auto px-4 py-10">
        <section class="upload-course-section max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-8">Upload New Course / Note</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-center font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('upload.course.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-medium text-gray-700 mb-2">Course Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-2">Category</label>
                        <input type="text" name="category" value="{{ old('category') }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                        @error('category') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-2">Cover Image</label>
                        <div class="flex items-center gap-4">
                            <label for="image"
                                class="cursor-pointer bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition duration-300">
                                Choose File
                            </label>
                            <span id="image-name"
                                class="text-gray-600">{{ old('image') ? old('image') : 'No file chosen' }}</span>
                        </div>
                        <input type="file" name="image" id="image" class="hidden"
                            onchange="document.getElementById('image-name').textContent = this.files[0].name">
                        @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-2">Type</label>
                        <select name="type"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                            <option value="">Select Type</option>
                            <option value="course" {{ old('type') == 'course' ? 'selected' : '' }}>Course</option>
                            <option value="note" {{ old('type') == 'note' ? 'selected' : '' }}>Note</option>
                        </select>
                        @error('type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-2">Duration</label>
                        <input type="text" name="duration" value="{{ old('duration') }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                        @error('duration') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-2">Skill Level</label>
                        <input type="text" name="level" value="{{ old('level') }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2"
                            placeholder="Beginner / Intermediate / Expert">
                        @error('level') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-2">No. of Lectures</label>
                        <input type="number" name="lectures" value="{{ old('lectures') }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                        @error('lectures') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-2">Language</label>
                        <input type="text" name="language" value="{{ old('language') }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                        @error('language') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-2">Price ($)</label>
                        <input type="number" name="price" value="{{ old('price') }}" min="0"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-2">
                        @error('price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-2">Course File (.zip)</label>
                        <div class="flex items-center gap-4">
                            <label for="file"
                                class="cursor-pointer bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-md transition duration-300">
                                Choose File
                            </label>
                            <span id="file-name"
                                class="text-gray-600">{{ old('file') ? old('file') : 'No file chosen' }}</span>
                        </div>
                        <input type="file" name="file" id="file" class="hidden"
                            onchange="document.getElementById('file-name').textContent = this.files[0].name">
                        @error('file') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-2">Details</label>
                    <textarea name="details" rows="5"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-4 py-3">{{ old('details') }}</textarea>
                    @error('details') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="text-center">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300">
                        Upload Course
                    </button>
                </div>
            </form>
        </section>
    </main>

@endsection