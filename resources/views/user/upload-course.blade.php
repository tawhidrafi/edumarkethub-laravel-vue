@extends('layouts.app')

@section('content')
    <main class="container mx-auto px-4 py-10">
        <section class="upload-course-section max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-center mb-6">Upload New Course / Note</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('upload.course.store') }}" method="POST" enctype="multipart/form-data"
                class="bg-white p-6 rounded shadow space-y-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium mb-1">Course Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2">
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Category</label>
                        <input type="text" name="category" value="{{ old('category') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('category') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Cover Image</label>
                        <input type="file" name="image" class="w-full">
                        @error('image') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Type</label>
                        <select name="type" class="w-full border rounded px-3 py-2">
                            <option value="">Select Type</option>
                            <option value="course" {{ old('type') == 'course' ? 'selected' : '' }}>Course</option>
                            <option value="note" {{ old('type') == 'note' ? 'selected' : '' }}>Note</option>
                        </select>
                        @error('type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Duration</label>
                        <input type="text" name="duration" value="{{ old('duration') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('duration') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Skill Level</label>
                        <input type="text" name="level" value="{{ old('level') }}" class="w-full border rounded px-3 py-2"
                            placeholder="Beginner / Intermediate / Expert">
                        @error('level') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium mb-1">No. of Lectures</label>
                        <input type="number" name="lectures" value="{{ old('lectures') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('lectures') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Language</label>
                        <input type="text" name="language" value="{{ old('language') }}"
                            class="w-full border rounded px-3 py-2">
                        @error('language') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Price ($)</label>
                        <input type="number" name="price" value="{{ old('price') }}" min="0"
                            class="w-full border rounded px-3 py-2">
                        @error('price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-medium mb-1">Course File (.zip)</label>
                        <input type="file" name="file" class="w-full">
                        @error('file') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block font-medium mb-1">Details</label>
                    <textarea name="details" rows="4"
                        class="w-full border rounded px-3 py-2">{{ old('details') }}</textarea>
                    @error('details') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded font-semibold hover:bg-blue-700 transition">
                    Upload Course
                </button>
            </form>
        </section>
    </main>
@endsection