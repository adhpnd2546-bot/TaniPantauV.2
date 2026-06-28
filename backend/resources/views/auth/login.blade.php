<!DOCTYPE html>
<html lang="id" class="">
<head>
    <script>
    (function(){
        var s=localStorage.getItem('tanipantau-dark-mode');
        var h=document.documentElement;
        if(s==='true'){
            h.classList.add('dark');
        } else {
            h.classList.remove('dark');
        }
    })();
    </script>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Login - TaniPantau</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#006b2c",
                        primary_hover: "#005a25",
                        skyBlue: "#3dbd74",
                        midnight_text: "#131b2e",
                        gray: "#64748b",
                        darkmode: "#0f172a",
                        darklight: "#1e293b",
                        herobg: "#f0fdf4",
                        border: "#e2e8f0",
                        semidark: "#1e293b",
                        light: "#f8fafc"
                    },
                    fontFamily: {
                        sans: ["Plus Jakarta Sans", "sans-serif"],
                        heading: ["Inter", "sans-serif"]
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom SweetAlert2 Progress Bars */
        .swal-error-popup .swal2-timer-progress-bar {
            background-color: #ef4444 !important; /* Bright Red */
        }
        .swal-success-popup .swal2-timer-progress-bar {
            background-color: #22c55e !important; /* Bright Green */
        }
        .swal-error-popup, .swal-success-popup {
            padding: 10px 16px !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            font-weight: 600 !important;
            font-size: 14px !important;
        }
        .dark .swal2-popup { background: #1e293b !important; border-color: #334155 !important; }
        .dark .swal2-title { color: #f1f5f9 !important; }

        /* Custom Autofill Styles for Light/Dark Mode */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 1000px #ffffff inset !important;
            -webkit-text-fill-color: #131b2e !important;
            transition: background-color 5000s ease-in-out 0s;
        }
        .dark input:-webkit-autofill,
        .dark input:-webkit-autofill:hover,
        .dark input:-webkit-autofill:focus,
        .dark input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 1000px #1e293b inset !important;
            -webkit-text-fill-color: #ffffff !important;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
</head>

<body class="font-sans antialiased text-midnight_text dark:text-white dark:bg-darkmode min-h-screen flex">
    
    <!-- Left Panel: Graphic & Context (Immersive Floating UI over Majestic Landscape) -->
    <div class="hidden lg:flex lg:w-7/12 relative overflow-hidden items-center justify-center p-12">
        
        <!-- Majestic Background Image -->
        <div class="absolute inset-0 bg-cover bg-center transform scale-105" style="background-image: url('{{ asset('images/fresh-sawah.png') }}');"></div>
        
        <!-- Deep Elegant Overlay -->
        <div class="absolute inset-0 bg-emerald-950/40 dark:bg-black/60 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/90 via-emerald-900/40 to-transparent dark:from-black/90"></div>

        <!-- Main Typography (Center/Bottom Left Aligned) -->
        <div class="relative z-10 w-full max-w-2xl mt-auto pb-12">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 mb-6">
                <span class="w-2 h-2 rounded-full bg-[#a3e635] animate-pulse"></span>
                <span class="text-white/90 text-xs font-bold uppercase tracking-widest">TaniPantau v2.0</span>
            </div>
            <h1 class="font-heading font-bold text-5xl text-white tracking-tight leading-[1.1] mb-5 drop-shadow-xl">
                Masa Depan <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#a3e635] to-emerald-300">Agrikultur</span>,<br>Ada di Tangan Anda.
            </h1>
            <p class="text-white/80 text-lg max-w-md leading-relaxed font-medium drop-shadow-md">
                Pantau ribuan hektar lahan, analitik tanah, dan cuaca dalam satu ekosistem cerdas yang indah.
            </p>
        </div>

        <!-- Floating UI Widgets (Spacial Interface Concept) -->
        
        <!-- Floating Weather Widget (Top Right) -->
        <div class="absolute top-16 right-16 w-64 bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-5 shadow-[0_20px_40px_rgba(0,0,0,0.2)] transform rotate-2 hover:rotate-0 hover:-translate-y-2 transition-all duration-500 cursor-default">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-amber-400 text-2xl">light_mode</span>
                    <span class="text-white font-semibold text-sm">Cerah</span>
                </div>
                <span class="text-white/60 text-xs">Ubud, Bali</span>
            </div>
            <div class="flex items-end gap-2">
                <span class="text-4xl font-heading font-bold text-white">28°</span>
                <span class="text-white/60 text-sm mb-1">C</span>
            </div>
            <div class="mt-4 flex gap-2">
                <div class="h-1 flex-1 bg-white/20 rounded-full overflow-hidden"><div class="h-full bg-amber-400 w-3/4"></div></div>
                <span class="text-white/50 text-[10px] font-bold">UV TINGGI</span>
            </div>
        </div>

        <!-- Floating Soil Widget (Center Left) -->
        <div class="absolute top-[18%] left-12 w-56 bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-5 shadow-[0_20px_40px_rgba(0,0,0,0.2)] transform -rotate-3 hover:rotate-0 hover:-translate-y-2 transition-all duration-500 cursor-default">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-full bg-blue-500/20 border border-blue-400/30 flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-300 text-xl">water_drop</span>
                </div>
                <div>
                    <p class="text-white/60 text-[10px] font-bold uppercase tracking-wider">Tanah Zona A</p>
                    <p class="text-white font-bold text-sm">Kelembapan</p>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-2xl font-bold text-white">68%</span>
                <span class="px-2 py-1 bg-emerald-500/20 text-emerald-300 text-[10px] font-bold rounded-lg border border-emerald-500/20">Optimal</span>
            </div>
        </div>

        <!-- Floating Notification (Bottom Right) -->
        <div class="absolute bottom-32 right-8 bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-4 shadow-[0_20px_40px_rgba(0,0,0,0.2)] flex items-center gap-4 hover:-translate-y-1 transition-all duration-500 cursor-default">
            <div class="relative flex h-3 w-3">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#a3e635] opacity-75"></span>
              <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
            </div>
            <div>
                <p class="text-white text-sm font-bold">Irigasi Otomatis Aktif</p>
                <p class="text-white/60 text-xs">Sektor Utara • Menyiram...</p>
            </div>
        </div>

    </div>

    <!-- Right Panel: Login Form Area (Ultra Clean & Aesthetic) -->
    <div class="w-full lg:w-5/12 bg-white dark:bg-darkmode flex flex-col justify-center px-8 py-12 sm:px-16 lg:px-24 relative overflow-y-auto z-20">
        
        <div class="w-full max-w-[360px] mx-auto">
            <!-- Back Link -->
            <a class="inline-flex items-center gap-2 text-[13px] font-medium text-gray-400 dark:text-dark-muted hover:text-gray-900 dark:hover:text-dark-heading transition-colors mb-12" href="{{ config('app.frontend_url') }}">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                Kembali
            </a>
            
            <!-- Dark Mode Toggle (top right) -->
            <div class="absolute top-6 right-6">
                <button onclick="toggleDarkMode()" class="p-2 rounded-full hover:bg-black/5 dark:hover:bg-white/10 transition-colors text-gray dark:text-white/70" title="Toggle Dark Mode">
                    <span class="material-symbols-outlined dark:hidden">dark_mode</span>
                    <span class="material-symbols-outlined hidden dark:inline">light_mode</span>
                </button>
            </div>
            
            <!-- Mobile Logo -->
            <div class="flex lg:hidden items-center gap-2 mb-10">
                <div class="w-8 h-8 rounded bg-emerald-500/10 dark:bg-primary/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-emerald-600 dark:text-primary text-[18px]" style="font-variation-settings: 'FILL' 1;">grass</span>
                </div>
                <span class="font-medium text-lg tracking-tight text-gray-900 dark:text-dark-heading">TaniPantau</span>
            </div>
            
            <!-- Form Header -->
            <div class="mb-8">
                <h2 class="text-[28px] font-semibold tracking-tight text-gray-900 dark:text-dark-heading mb-2">Masuk ke akun Anda</h2>
                <p class="text-[15px] text-gray-500 dark:text-dark-body">Masukkan detail Anda di bawah ini untuk melanjutkan.</p>
            </div>
            
            <!-- Login Form -->
            <form id="loginForm" action="{{ route('login') }}" class="space-y-5" method="POST">
                @csrf
                <!-- Input: Email/Username -->
                <div class="space-y-2">
                    <label class="block text-[13px] font-medium text-gray-700 dark:text-dark-body" for="email">Email</label>
                    <input class="block w-full px-4 py-2.5 bg-white dark:bg-darklight border border-gray-200 dark:border-dark-border rounded-lg text-[15px] text-midnight_text dark:text-white placeholder-gray-400 dark:placeholder-dark-muted focus:bg-white dark:focus:bg-darklight focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 transition-all focus-visible:outline-none @error('email') border-red-500 @enderror" id="email" name="email" placeholder="nama@perusahaan.com" required="" type="email" />
                    @error('email') <p class="text-[13px] text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                
                <!-- Input: Password -->
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label class="block text-[13px] font-medium text-gray-700 dark:text-dark-body" for="password">Kata Sandi</label>
                        <a class="text-[13px] text-gray-500 dark:text-dark-muted hover:text-gray-900 dark:hover:text-dark-heading transition-colors" href="{{ route('password.request') }}">Lupa sandi?</a>
                    </div>
                    <div class="relative">
                        <input class="block w-full px-4 py-2.5 pr-10 bg-white dark:bg-darklight border border-gray-200 dark:border-dark-border rounded-lg text-[15px] text-midnight_text dark:text-white placeholder-gray-400 dark:placeholder-dark-muted focus:bg-white dark:focus:bg-darklight focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 transition-all focus-visible:outline-none @error('password') border-red-500 @enderror" id="password" name="password" placeholder="••••••••" required="" type="password" />
                        <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-dark-muted hover:text-gray-700 dark:hover:text-dark-heading transition-colors">
                            <span id="eyeIcon" class="material-symbols-outlined text-[20px]">visibility</span>
                        </button>
                        @error('password') <p class="text-[13px] text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                
                <!-- Submit Button -->
                <button class="w-full py-2.5 px-4 mt-6 bg-primary hover:bg-primary_hover text-white rounded-lg font-medium text-[15px] shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" type="submit">
                    Lanjutkan
                </button>
            </form>
            

        </div>
    </div>

    <script>
        function toggleDarkMode() {
            const html = document.documentElement;
            html.classList.toggle('dark');
            localStorage.setItem('tanipantau-dark-mode', html.classList.contains('dark'));
        }
        function togglePassword() {
            const p = document.getElementById('password');
            const e = document.getElementById('eyeIcon');
            if (p.type === 'password') { p.type = 'text'; e.textContent = 'visibility_off'; }
            else { p.type = 'password'; e.textContent = 'visibility'; }
        }
    </script>
    
    @if(session('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                title: "{{ session('error') }}",
                background: '#fef2f2',
                color: '#991b1b',
                customClass: {
                    popup: 'swal-error-popup'
                },
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
        });
    </script>
    @endif
</body>
</html>
