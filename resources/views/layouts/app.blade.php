<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'InApp Inventory') }}</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('inapp/dist/assets/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('inapp/dist/assets/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('inapp/dist/assets/images/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('inapp/dist/assets/site.webmanifest') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Scripts & Styles -->
    <script type="module" crossorigin src="{{ asset('inapp/dist/assets/js/main.js') }}"></script>
    <link rel="stylesheet" crossorigin href="{{ asset('inapp/dist/assets/css/main.css') }}">

    <!-- Vite (if needed for custom scripts) -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body>
    <div id="overlay" class="overlay"></div>

    <!-- TOPBAR -->
    @include('layouts.navbar')

    <!-- SIDEBAR -->
    @include('layouts.sidebar')

    <!-- MAIN CONTENT -->
    <main id="content" class="content py-10">
        <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4">
                <i class="ti ti-check me-2"></i> {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm mb-4">
                <i class="ti ti-alert-circle me-2"></i> {{ session('error') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm mb-4">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @yield('content')

            <div class="row">
                <div class="col-12">
                    <footer class="text-center py-2 mt-6 text-secondary ">
                        <p class="mb-0">Copyright © 2026 {{ config('app.name') }}. Developed by <a href="#"
                                target="_blank" class="text-primary">CodesCandy</a></p>
                    </footer>
                </div>
            </div>
        </div>
    </main>

    <!-- Custom Scripts to fix Sidebar Toggle and Active Links -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const topbar = document.getElementById('topbar');
            const toggleBtn = document.getElementById('toggleBtn');
            const mobileBtn = document.getElementById('mobileBtn');
            const overlay = document.getElementById('overlay');

            // Desktop Toggle
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    content.classList.toggle('full');
                    topbar.classList.toggle('full');
                });
            }

            // Mobile Toggle
            if (mobileBtn) {
                mobileBtn.addEventListener('click', function() {
                    sidebar.classList.add('mobile-show');
                    overlay.classList.add('show');
                });
            }

            // Overlay Click (to hide mobile sidebar)
            if (overlay) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('mobile-show');
                    overlay.classList.remove('show');
                });
            }

            // Fix for active class being stripped by main.js
            // We re-apply the active class after a short delay to override main.js logic
            setTimeout(() => {
                const currentPath = window.location.pathname;
                document.querySelectorAll('.sidebar .nav-link').forEach(link => {
                    if (link.href === window.location.href || link.getAttribute('href') === currentPath) {
                        link.classList.add('active');
                    }
                });
            }, 100);
        });
    </script>
    @stack('scripts')
</body>

</html>