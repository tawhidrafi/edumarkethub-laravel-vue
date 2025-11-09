<header>
    <div class="navbar user-navbar container">
        <div class="navbar-left logo">
            <h1><i class="fa fa-book-reader"></i> EduMarketHub</h1>
        </div>
        <nav class="navbar-right nav-links">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/about') }}">About</a>
            <a href="{{ route('courses.index') }}">Courses</a>
            <a href="{{ url('/contact') }}">Contact</a>
        </nav>
    </div>

    <div class="navbar admin-navbar container">
        <div class="navbar-left logo admin-welcome">
            <h1>Welcome, {{ Auth::user()->name }}</h1>
        </div>
        <nav class="navbar-center nav-links">
            <a href="{{ route('user.dashboard') }}">Dashboard</a>
            <a href="{{ route('user.enrolled') }}">My Courses</a>
            <a href="{{ route('user.uploaded') }}">Uploaded Courses</a>
            <a href="{{ route('user.uploadCourse') }}">Upload Course</a>
            <a href="{{ route('user.payments') }}">Earnings</a>
            <a href="{{ route('user.profile') }}">My Profile</a>
        </nav>
        <div class="navbar-right">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="join-btn logout-btn">Log Out</button>
            </form>
        </div>
    </div>
</header>