<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel — Portfolio OS</title>
    <style>
        /* Admin color overrides — pure black base */
        [data-bs-theme="dark"] {
            --bs-body-bg: #000000;
            --bs-body-color: #e8e8f0;
            --bs-secondary-bg: #111111;
            --bs-tertiary-bg: #0a0a0a;
            --bs-border-color: rgba(255,255,255,0.05);
            --bs-primary: #6366f1;
        }
        .sidebar { background-color: #050505; }
        .nav-link.active-minimal {
            background-color: rgba(255,255,255,0.03);
            color: #ffffff !important;
            border-left: 3px solid #6366f1;
            border-radius: 0 8px 8px 0;
        }
        .nav-link { color: #a1a1aa; border-left: 3px solid transparent; transition: all 0.3s ease; }
        .nav-link:hover { color: #ffffff; background-color: rgba(255,255,255,0.02); }
    </style>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    @vite(['resources/scss/app.scss', 'resources/js/app.js', 'resources/js/dashboard.js'])
</head>
<body class="bg-body d-flex text-body">
    
    <!-- Sidebar -->
    <aside class="sidebar border-end border-secondary border-opacity-10 d-flex flex-column vh-100 flex-shrink-0" style="width: 280px; position: sticky; top: 0;" data-aos="fade-right" data-aos-duration="600">
        <div class="p-4 border-bottom border-secondary border-opacity-10 d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-white fs-5 fw-bold" style="letter-spacing: -0.5px;">
                vm<span class="text-primary">.os</span>
            </a>
            <a href="{{ route('home') }}" target="_blank" class="text-muted hover-white transition-all" title="View Site">
                <i class="bi bi-box-arrow-up-right"></i>
            </a>
        </div>
        
        <ul class="nav flex-column mb-auto py-3 px-2 gap-2">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active-minimal' : '' }} px-3 py-2 d-flex align-items-center">
                    <i class="bi bi-grid fs-5 me-3"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active-minimal' : '' }} px-3 py-2 d-flex align-items-center">
                    <i class="bi bi-kanban fs-5 me-3"></i> Projects
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active-minimal' : '' }} px-3 py-2 d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center"><i class="bi bi-envelope fs-5 me-3"></i> Messages</div>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.notifications.index') }}" class="nav-link {{ request()->routeIs('admin.notifications.*') ? 'active-minimal' : '' }} px-3 py-2 d-flex align-items-center">
                    <i class="bi bi-bell fs-5 me-3"></i> Notifications
                </a>
            </li>
        </ul>
        
        <div class="p-3 border-top border-secondary border-opacity-10">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ auth()->user()->avatar_url }}" alt="" width="32" height="32" class="rounded-circle me-2" style="object-fit: cover;">
                    <strong>{{ auth()->user()->name }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Sign out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-grow-1 d-flex flex-column min-vh-100 overflow-auto" data-aos="fade-in" data-aos-duration="1000">
        <header class="p-4 d-flex justify-content-between align-items-center border-bottom border-secondary border-opacity-10 bg-body sticky-top z-3" style="background: rgba(0,0,0,0.8) !important; backdrop-filter: blur(10px);">
            <h4 class="mb-0 fw-bold" style="letter-spacing: -0.5px;">@yield('header')</h4>
            
            <div class="d-flex align-items-center gap-3">
                <span class="badge bg-transparent border border-secondary border-opacity-25 text-secondary py-2 px-3 rounded-pill d-flex align-items-center">
                    <span class="bg-success rounded-circle me-2" style="width: 6px; height: 6px; box-shadow: 0 0 10px #10b981;"></span>
                    <span id="adminLiveVisitorCount" class="fw-bold me-1 text-white">0</span> online
                </span>
            </div>
        </header>

        <main class="p-4 p-md-5 flex-grow-1" style="background: radial-gradient(circle at top right, rgba(99,102,241,0.03), transparent 50%);">
            @if(session('success'))
                <div class="alert bg-transparent border border-success border-opacity-25 text-success alert-dismissible fade show rounded-4" role="alert" data-aos="fade-down">
                    <i class="bi bi-check-circle-fill me-2 opacity-75"></i> {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white opacity-50" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
