<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('seo')
    <title>@yield('title', config('app.name', 'Portfolio'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="site-body">

    <!-- ====== NAVBAR ====== -->
    <nav class="site-navbar" id="siteNav">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="site-navbar__logo" title="Home">vm</a>

        <!-- Menu (center) -->
        <ul class="site-navbar__menu" id="siteNavMenu">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('home') }}#services">Services</a></li>
            <li><a href="{{ route('home') }}#about">About</a></li>
            <li><a href="{{ route('home') }}#skills">Skills</a></li>
            <li><a href="{{ route('home') }}#work">Projects</a></li>
        </ul>

        <!-- Right side -->
        <div class="site-navbar__cta">
            <!-- Live visitor badge -->
            <span class="live-badge" id="liveVisitorBadge" style="display: none;">
                <span class="dot"></span>
                <span id="liveVisitorCount">0</span> Live
            </span>

            <a href="{{ route('home') }}#contact" class="btn-talk">Let's Talk</a>

            <!-- Mobile toggle -->
            <button class="site-navbar__toggle" id="navToggle" aria-label="Toggle menu">
                <i class="bi bi-list"></i>
            </button>
        </div>
    </nav>

    <!-- ====== MAIN CONTENT ====== -->
    <main>
        @yield('content')
    </main>

    <!-- ====== FOOTER ====== -->
    <footer class="site-footer">
        <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </footer>

    <script>
        // Mobile nav toggle
        document.getElementById('navToggle')?.addEventListener('click', () => {
            document.getElementById('siteNavMenu')?.classList.toggle('open');
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('siteNav');
            if (window.scrollY > 20) {
                nav?.classList.add('scrolled');
            } else {
                nav?.classList.remove('scrolled');
            }
        });

        // Close menu on link click
        document.querySelectorAll('.site-navbar__menu a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('siteNavMenu')?.classList.remove('open');
            });
        });
    </script>
</body>
</html>
