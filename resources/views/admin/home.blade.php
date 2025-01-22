<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Penjemputan Siswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eef5ff;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            padding-top: 60px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            background-color: #004c99; /* Biru tua */
        }
        .sidebar h3 {
            color: #ffffff;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .nav-link {
            color: #ffffff;
            transition: all 0.3s ease;
        }
        .nav-link:hover, .nav-link.active {
            background-color: #0066cc; /* Biru cerah */
            color: #ffffff;
        }
        .profile-btn {
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 5px 15px;
            display: flex;
            align-items: center;
        }
        .profile-btn img {
            border-radius: 50%;
            margin-right: 10px;
            width: 30px;
            height: 30px;
            object-fit: cover;
        }
        .profile-btn span {
            font-size: 14px;
            color: #333;
        }
        .dropdown-menu {
            min-width: 150px;
        }
        .navbar-right {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="position-sticky">
                    <div class="text-center mb-4">
                        <h3 class="text-white">Pickup System</h3>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('face-detection') ? 'active' : '' }}" href="{{ route('face-detection') }}">
                                <i class="bi bi-camera-fill me-2"></i> Face Detection
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('face-detection-list') ? 'active' : '' }}" href="{{ route('face-detection-list') }}">
                                <i class="bi bi-list-ul me-2"></i> List Face Detection
                            </a>
                        </li>
                        <!-- Penambahan Menu Baru -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('students') ? 'active' : '' }}" href="{{ route('students.index') }}">
                                <i class="bi bi-people-fill me-2"></i> Siswa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('classes') ? 'active' : '' }}" href="{{ route('classes.index') }}">
                                <i class="bi bi-building me-2"></i> Kelas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('schools') ? 'active' : '' }}" href="{{ route('schools.index') }}">
                                <i class="bi bi-mortarboard me-2"></i> Sekolah
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('pickupstudents') ? 'active' : '' }}" href="{{ route('pickupstudents.index') }}">
                                <i class="bi bi-person-check-fill me-2"></i> Pickup Student
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('pickups') ? 'active' : '' }}" href="{{ route('pickups.index') }}">
                                <i class="bi bi-truck me-2"></i> Penjemput
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Konten Utama -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <!-- Navbar atas (Profil) -->
                <div class="d-flex justify-content-end align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <div class="navbar-right">
                        <!-- Profil Pengguna -->
                        <div class="dropdown">
                            <button class="btn profile-btn dropdown-toggle" type="button" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('images/profil.jpg') }}" alt="Profile">
                                <span>{{ auth()->user()?->name ?? 'Guest' }}</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- <!-- Page Title -->
                <h1 class="h2">@yield('page_title', 'Dashboard')</h1> --}}

                <!-- Content Section -->
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS dan Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    


</body>
</html> 
