@extends('layouts.app')

@section('title', 'About - EduMarketHub')

@section('content')
    <main class="bg-gray-50 text-gray-800">

        {{-- Introduction Section --}}
        <section class="bg-blue-50 border-l-8 border-blue-500 py-16 px-6">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-4xl font-bold mb-6">
                    Welcome to <span class="text-blue-600">EduMarketHub</span>
                </h2>
                <p class="text-lg leading-relaxed text-gray-700">
                    EduMarketHub is an innovative platform designed to empower educators and learners worldwide.
                    Our mission is to provide a marketplace where anyone can sell and buy high-quality educational
                    materials.
                    Whether you’re an educator looking to monetize your expertise or a learner searching for affordable,
                    top-notch resources, EduMarketHub makes learning accessible for everyone.
                </p>
            </div>
        </section>

        {{-- How It Works Section --}}
        <section class="py-20 bg-white">
            <div class="max-w-5xl mx-auto px-6">
                <h2 class="text-4xl font-bold text-gray-900 mb-12 text-center">How It Works</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <article tabindex="0"
                        class="bg-gray-50 border-l-4 border-blue-600 p-6 rounded-lg shadow hover:shadow-lg transition focus:outline-none focus:ring-4 focus:ring-blue-300">
                        <h3 class="text-2xl font-semibold text-blue-600 mb-3">Step 1: Sign Up</h3>
                        <p class="text-gray-700">
                            Register on the platform for free and gain access to a world of educational resources.
                        </p>
                    </article>

                    <article tabindex="0"
                        class="bg-gray-50 border-l-4 border-blue-600 p-6 rounded-lg shadow hover:shadow-lg transition focus:outline-none focus:ring-4 focus:ring-blue-300">
                        <h3 class="text-2xl font-semibold text-blue-600 mb-3">Step 2: Upload Content</h3>
                        <p class="text-gray-700">
                            Educators can upload courses, study notes, or any learning materials to sell.
                        </p>
                    </article>

                    <article tabindex="0"
                        class="bg-gray-50 border-l-4 border-blue-600 p-6 rounded-lg shadow hover:shadow-lg transition focus:outline-none focus:ring-4 focus:ring-blue-300">
                        <h3 class="text-2xl font-semibold text-blue-600 mb-3">Step 3: Browse and Buy</h3>
                        <p class="text-gray-700">
                            Learners can browse through various courses, read reviews, and buy materials to enhance their
                            knowledge.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        {{-- Contact Section --}}
        <section class="bg-green-50 border-l-8 border-green-600 py-16 px-6">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Contact Us</h2>
                <p class="text-lg text-gray-700">
                    If you have any questions, feel free to reach out to us at
                    <a href="mailto:support@edumarkethub.com"
                        class="text-green-600 font-semibold hover:underline focus:outline-none focus:ring-2 focus:ring-green-400">
                        support@edumarkethub.com
                    </a>.
                </p>
            </div>
        </section>

    </main>
@endsection