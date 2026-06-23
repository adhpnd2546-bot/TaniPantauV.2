<!DOCTYPE html>
<html lang="id" class="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>@yield('title', 'Sneat - TaniPantau')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    fontFamily: {
                        public: ['"Public Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: '#16A34A',
                        'primary-hover': '#15803D',
                        secondary: '#8592a3',
                        success: '#71dd37',
                        danger: '#ff3e1d',
                        warning: '#ffab00',
                        info: '#03c3ec',
                        dark: '#233446',
                        body: '#697a8d',
                        heading: '#566a7f',
                        muted: '#a1acb8',
                        background: '#f5f5f9',
                        border: '#d9dee3',
                        'dark-surface': '#1e293b',
                        'dark-border': '#334155',
                        'dark-body': '#94a3b8',
                        'dark-heading': '#f1f5f9',
                        'dark-muted': '#64748b',
                        'dark-bg': '#0f172a',
                        'dark-card': '#1e293b',
                    },
                    boxShadow: {
                        card: '0 2px 6px 0 rgba(67, 89, 113, 0.12)',
                        'card-dark': '0 2px 6px 0 rgba(0, 0, 0, 0.3)',
                        sm: '0 0.125rem 0.25rem rgba(161, 172, 184, 0.4)',
                        primary: '0 2px 4px 0 rgba(22, 163, 74, 0.4)',
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #d9dee3; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #b4bdc6; }
        .dark ::-webkit-scrollbar-thumb { background: #334155; }
        .dark ::-webkit-scrollbar-thumb:hover { background: #475569; }

        .dark .swal2-popup {
            background: #1e293b !important;
            border-color: #334155 !important;
        }
        .dark .swal2-title {
            color: #f1f5f9 !important;
        }
        .dark .swal2-html-container {
            color: #94a3b8 !important;
        }
    </style>
    
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    @stack('styles')
</head>

<body class="bg-background dark:bg-dark-bg text-body dark:text-dark-body font-public antialiased overflow-hidden" x-data="{ sidebarOpen: false }">
    
    <!-- Dark Mode Init Script -->
    <script>
        (function() {
            const stored = localStorage.getItem('tanipantau-dark-mode');
            const html = document.documentElement;
            if (stored === 'true' || (!stored && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                html.classList.add('dark');
            } else {
                html.classList.remove('dark');
            }
        })();
    </script>
    
    <!-- Layout Wrapper -->
    <div class="flex h-screen w-full relative">
        
        <!-- Sidebar Overlay (Mobile) -->
        <div x-show="sidebarOpen" 
             x-transition.opacity.duration.300ms
             class="fixed inset-0 bg-dark/50 dark:bg-black/60 z-40 lg:hidden" 
             @click="sidebarOpen = false" x-cloak>
        </div>

        <!-- Sidebar Start -->
        @if(auth()->user()?->role === 'petugas')
            @include('layouts.partials.sidebar-petugas')
        @else
            @include('layouts.partials.sidebar-admin')
        @endif
        <!-- Sidebar End -->

        <!-- Layout Page Start -->
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden relative">
            
            <!-- Floating Navbar Start -->
            @include('layouts.partials.navbar')
            <!-- Floating Navbar End -->

            <!-- Content Area Start -->
            <main class="flex-grow overflow-y-auto px-4 sm:px-6 pb-6 pt-2">
                @yield('content')
            </main>
            <!-- Content Area End -->
        </div>
        <!-- Layout Page End -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.addEventListener('pageshow', function(e) { if (e.persisted) window.location.reload(); });
    </script>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
    <script>
        function toggleDarkMode() {
            const html = document.documentElement;
            html.classList.toggle('dark');
            localStorage.setItem('tanipantau-dark-mode', html.classList.contains('dark'));
        }
        function confirmLogout() {
            Swal.fire({
                title: 'Yakin ingin keluar?',
                text: "Sesi Anda akan diakhiri.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#16A34A',
                cancelButtonColor: '#ff3e1d',
                confirmButtonText: 'Ya, Keluar!',
                cancelButtonText: 'Batal',
                customClass: {
                    title: 'font-public text-[18px] text-heading dark:text-dark-heading',
                    popup: 'font-public rounded-[0.5rem] shadow-card dark:shadow-card-dark border border-border dark:border-dark-border',
                    confirmButton: 'rounded-[0.375rem]',
                    cancelButton: 'rounded-[0.375rem]'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
    <style>
        .swal-success-popup .swal2-timer-progress-bar {
            background-color: #22c55e !important;
        }
        .swal-success-popup {
            padding: 10px 16px !important;
            font-family: 'Public Sans', sans-serif !important;
            font-weight: 600 !important;
            font-size: 14px !important;
        }
    </style>
    
    @stack('scripts')
</body>
</html>
