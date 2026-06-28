<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Daftar Lahan Pertanian - TaniPantau</title>
<!-- AOS Animation CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;600&display=swap" rel="stylesheet"/>
<!-- Material Symbols -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
                    cyan: "#10b981",
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
    .transition-bento { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
</style>
</head>
<body class="font-sans antialiased text-midnight_text dark:text-white dark:bg-darkmode flex flex-col min-h-screen">
<script>
(function(){const s=localStorage.getItem('tanipantau-dark-mode');const h=document.documentElement;if(s==='true'){h.classList.add('dark')}else{h.classList.remove('dark')}if(!s){localStorage.setItem('tanipantau-dark-mode','false')}})();
</script>
<!-- TopNavBar -->
<header class="fixed top-0 z-50 w-full bg-white/90 backdrop-blur-md border-b border-border dark:bg-darkmode/90 dark:border-gray/30 transition-all shadow-sm">
    <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md flex items-center justify-between px-4 py-6 transition-all duration-300">
        <a href="/" class="flex items-center gap-2.5 text-primary font-heading font-bold text-2xl">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 32px;">eco</span>
            <span>Tani<span class="bg-primary text-white px-1.5 py-0.5 rounded ml-0.5 text-lg">Pantau</span></span>
        </a>
        <nav class="hidden lg:flex flex-grow items-center justify-center space-x-6 font-medium">
            <a href="/" class="text-midnight_text dark:text-white hover:text-primary transition-colors">Beranda</a>
            <a href="/public/lahan" class="text-primary font-bold">Daftar Lahan</a>
            <a href="/public/artikel" class="text-midnight_text dark:text-white hover:text-primary transition-colors">Artikel</a>
        </nav>
        <div class="flex items-center space-x-4">
            <button onclick="toggleDarkMode()" class="p-2 rounded-full hover:bg-black/5 dark:hover:bg-white/10 transition-colors text-gray dark:text-white/70" title="Toggle Dark Mode">
                <span class="material-symbols-outlined dark:hidden">dark_mode</span>
                <span class="material-symbols-outlined hidden dark:inline">light_mode</span>
            </button>
            <a class="hidden lg:block bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary_hover transition duration-300 font-semibold" href="/login">Login</a>
        </div>
    </div>
</header>

<main class="flex-grow bg-light dark:bg-darkmode pt-36 pb-12">
    <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4">
        <!-- Page Header -->
        <div class="mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-midnight_text dark:text-white font-heading mb-4">Daftar Lahan Pertanian</h1>
            <p class="text-lg text-gray dark:text-gray/80 max-w-2xl">Pantau dan jelajahi area pertanian yang terdaftar dalam ekosistem TaniPantau. Temukan lahan dengan potensi komoditas terbaik.</p>
            
            <!-- Search & Filter Bar -->
            <div class="mt-8 flex flex-col md:flex-row gap-4 max-w-3xl">
                <div class="relative flex-grow">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray">search</span>
                    <input class="w-full py-3 pl-12 pr-4 rounded-xl border border-border dark:border-gray/30 focus:border-primary focus:ring-1 focus:ring-primary text-base bg-white dark:bg-darkmode dark:text-white transition-bento shadow-sm" placeholder="Cari nama lahan, petani, atau lokasi..." type="text"/>
                </div>
                <button class="bg-white dark:bg-darkmode text-midnight_text dark:text-white border border-border dark:border-gray/30 hover:border-primary px-6 py-3 rounded-xl font-medium transition-bento flex items-center justify-center gap-2 shadow-sm">
                    <span class="material-symbols-outlined">filter_list</span>
                    Filter
                </button>
            </div>
        </div>

        <!-- Grid Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="bg-white dark:bg-semidark rounded-2xl overflow-hidden shadow-lg border border-border dark:border-gray/20 transition hover:-translate-y-2 duration-300" data-aos="fade-up" data-aos-delay="100">
                <div class="relative h-60">
                    <img src="https://loremflickr.com/600/400/sawah,paddy/all?lock=10" class="w-full h-full object-cover" alt="Sawah">
                    <div class="absolute top-4 left-4">
                        <span class="bg-primary text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-md">AKTIF TANAM</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-midnight_text dark:text-white mb-2 font-heading">Sawah Blok A - Sumber Makmur</h3>
                    <p class="text-gray dark:text-gray/80 mb-4 flex items-center gap-2 font-medium">
                        <span class="material-symbols-outlined text-[18px]">person</span> Budi Santoso
                    </p>
                    <div class="flex justify-between items-center border-t border-border dark:border-gray/30 pt-4 mb-4">
                        <div>
                            <p class="text-xs text-gray dark:text-gray/80 font-bold uppercase tracking-wider mb-1">Komoditas</p>
                            <p class="text-primary font-bold text-lg">Padi Inpari 32</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray dark:text-gray/80 font-bold uppercase tracking-wider mb-1">Luas Area</p>
                            <p class="text-midnight_text dark:text-white font-bold text-lg">2.5 Hektar</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-2 pt-4 border-t border-border dark:border-gray/30">
                        <span class="text-sm font-medium text-gray dark:text-gray/80 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">location_on</span> Ds. Sukamaju
                        </span>
                        <a href="#" class="text-primary font-bold hover:text-primary_hover flex items-center gap-1 transition-colors">
                            Detail <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white dark:bg-semidark rounded-2xl overflow-hidden shadow-lg border border-border dark:border-gray/20 transition hover:-translate-y-2 duration-300" data-aos="fade-up" data-aos-delay="200">
                <div class="relative h-60">
                    <img src="https://loremflickr.com/600/400/corn,farm/all?lock=11" class="w-full h-full object-cover" alt="Jagung">
                    <div class="absolute top-4 left-4">
                        <span class="bg-yellow-500 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-md">PERLU PERHATIAN</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-midnight_text dark:text-white mb-2 font-heading">Ladang Jagung Timur</h3>
                    <p class="text-gray dark:text-gray/80 mb-4 flex items-center gap-2 font-medium">
                        <span class="material-symbols-outlined text-[18px]">person</span> Ahmad Dahlan
                    </p>
                    <div class="flex justify-between items-center border-t border-border dark:border-gray/30 pt-4 mb-4">
                        <div>
                            <p class="text-xs text-gray dark:text-gray/80 font-bold uppercase tracking-wider mb-1">Komoditas</p>
                            <p class="text-yellow-600 font-bold text-lg">Jagung Manis</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray dark:text-gray/80 font-bold uppercase tracking-wider mb-1">Luas Area</p>
                            <p class="text-midnight_text dark:text-white font-bold text-lg">1.2 Hektar</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-2 pt-4 border-t border-border dark:border-gray/30">
                        <span class="text-sm font-medium text-gray dark:text-gray/80 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">location_on</span> Ds. Karanganyar
                        </span>
                        <a href="#" class="text-primary font-bold hover:text-primary_hover flex items-center gap-1 transition-colors">
                            Detail <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white dark:bg-semidark rounded-2xl overflow-hidden shadow-lg border border-border dark:border-gray/20 transition hover:-translate-y-2 duration-300" data-aos="fade-up" data-aos-delay="300">
                <div class="relative h-60">
                    <img src="https://loremflickr.com/600/400/soybean,field/all?lock=12" class="w-full h-full object-cover" alt="Kedelai">
                    <div class="absolute top-4 left-4">
                        <span class="bg-primary text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-md">AKTIF TANAM</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-midnight_text dark:text-white mb-2 font-heading">Kebun Kedelai Lestari</h3>
                    <p class="text-gray dark:text-gray/80 mb-4 flex items-center gap-2 font-medium">
                        <span class="material-symbols-outlined text-[18px]">person</span> Siti Aminah
                    </p>
                    <div class="flex justify-between items-center border-t border-border dark:border-gray/30 pt-4 mb-4">
                        <div>
                            <p class="text-xs text-gray dark:text-gray/80 font-bold uppercase tracking-wider mb-1">Komoditas</p>
                            <p class="text-primary font-bold text-lg">Kedelai</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray dark:text-gray/80 font-bold uppercase tracking-wider mb-1">Luas Area</p>
                            <p class="text-midnight_text dark:text-white font-bold text-lg">3.0 Hektar</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-2 pt-4 border-t border-border dark:border-gray/30">
                        <span class="text-sm font-medium text-gray dark:text-gray/80 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">location_on</span> Ds. Tani Jaya
                        </span>
                        <a href="#" class="text-primary font-bold hover:text-primary_hover flex items-center gap-1 transition-colors">
                            Detail <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white dark:bg-semidark rounded-2xl overflow-hidden shadow-lg border border-border dark:border-gray/20 transition hover:-translate-y-2 duration-300" data-aos="fade-up" data-aos-delay="400">
                <div class="relative h-60 bg-gray/10 dark:bg-gray/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-6xl text-gray/40">landscape</span>
                    <div class="absolute top-4 left-4">
                        <span class="bg-gray text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-md">TERBENGKALAI</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-midnight_text dark:text-white mb-2 font-heading">Petak Kosong B-12</h3>
                    <p class="text-gray dark:text-gray/80 mb-4 flex items-center gap-2 font-medium">
                        <span class="material-symbols-outlined text-[18px]">person</span> Koperasi Unit Desa
                    </p>
                    <div class="flex justify-between items-center border-t border-border dark:border-gray/30 pt-4 mb-4">
                        <div>
                            <p class="text-xs text-gray dark:text-gray/80 font-bold uppercase tracking-wider mb-1">Komoditas</p>
                            <p class="text-gray dark:text-gray/80 font-bold text-lg">- Kosong -</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray dark:text-gray/80 font-bold uppercase tracking-wider mb-1">Luas Area</p>
                            <p class="text-midnight_text dark:text-white font-bold text-lg">0.8 Hektar</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-2 pt-4 border-t border-border dark:border-gray/30">
                        <span class="text-sm font-medium text-gray dark:text-gray/80 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">location_on</span> Ds. Karanganyar
                        </span>
                        <a href="#" class="text-primary font-bold hover:text-primary_hover flex items-center gap-1 transition-colors">
                            Detail <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-16" data-aos="fade-up">
            <nav class="flex items-center gap-2">
                <button class="w-10 h-10 rounded-lg flex items-center justify-center text-gray dark:text-gray/80 hover:bg-border dark:hover:bg-gray/20 transition-colors disabled:opacity-50" disabled="">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button class="w-10 h-10 rounded-lg bg-primary text-white font-bold shadow-md transition-bento">1</button>
                <button class="w-10 h-10 rounded-lg text-midnight_text dark:text-white hover:bg-border dark:hover:bg-gray/20 font-medium transition-colors">2</button>
                <button class="w-10 h-10 rounded-lg text-midnight_text dark:text-white hover:bg-border dark:hover:bg-gray/20 font-medium transition-colors">3</button>
                <span class="w-10 h-10 flex items-center justify-center text-gray dark:text-gray/80">...</span>
                <button class="w-10 h-10 rounded-lg text-midnight_text dark:text-white hover:bg-border dark:hover:bg-gray/20 font-medium transition-colors">12</button>
                <button class="w-10 h-10 rounded-lg flex items-center justify-center text-midnight_text dark:text-white hover:bg-border dark:hover:bg-gray/20 transition-colors">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </nav>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="relative z-10 bg-[#0b0f19] text-white">
    <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md pt-20 pb-10 px-6 lg:px-4">
        <div class="grid grid-cols-12 gap-8 lg:gap-4 mb-16">
            <div class="lg:col-span-4 col-span-12 flex flex-col">
                <a class="mb-6 flex items-center gap-2.5 text-primary font-heading font-bold text-3xl" href="/">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 36px;">eco</span>
                    <span>Tani<span class="bg-primary text-white px-1.5 py-0.5 rounded ml-0.5">Pantau</span></span>
                </a>
                <p class="text-gray text-base leading-relaxed max-w-sm mb-6">Platform enterprise terpadu untuk monitoring dan manajemen lahan pertanian di seluruh Indonesia.</p>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary transition-colors"><span class="material-symbols-outlined text-sm">share</span></a>
                    <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary transition-colors"><span class="material-symbols-outlined text-sm">public</span></a>
                </div>
            </div>
            <div class="lg:col-span-8 col-span-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="w-full">
                    <h4 class="mb-6 text-xl font-bold font-heading text-white">Navigasi</h4>
                    <ul class="space-y-4">
                        <li><a href="/" class="text-gray hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="/public/lahan" class="text-gray hover:text-white transition-colors">Daftar Lahan</a></li>
                        <li><a href="/public/artikel" class="text-gray hover:text-white transition-colors">Artikel</a></li>
                        <li><a href="#" class="text-gray hover:text-white transition-colors">Kalkulator Panen</a></li>
                    </ul>
                </div>
                <div class="w-full">
                    <h4 class="mb-6 text-xl font-bold font-heading text-white">Bantuan</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray hover:text-white transition-colors">Panduan Petani</a></li>
                        <li><a href="#" class="text-gray hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="text-gray hover:text-white transition-colors">Pusat Resolusi</a></li>
                        <li><a href="#" class="text-gray hover:text-white transition-colors">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div class="w-full">
                    <h4 class="mb-6 text-xl font-bold font-heading text-white">Kontak Kami</h4>
                    <ul class="space-y-4 text-gray">
                        <li class="flex items-start gap-3"><span class="material-symbols-outlined text-primary mt-1">location_on</span> Jl. Agraria Nusantara No. 42, Jawa Timur</li>
                        <li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary">call</span> +62 811 2233 4455</li>
                        <li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary">mail</span> info@tanipantau.id</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray text-sm">© 2026 TaniPantau. Dikembangkan untuk Pertanian Indonesia.</p>
        </div>
    </div>
</footer>

<!-- AOS Animation Script -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Dark Mode Toggle
    function toggleDarkMode() {
        const html = document.documentElement;
        html.classList.toggle('dark');
        localStorage.setItem('tanipantau-dark-mode', html.classList.contains('dark'));
    }

    // Initialize AOS
    AOS.init({
        once: true,
        offset: 50,
        duration: 800,
        easing: 'ease-in-out-cubic',
    });
    
    // Navbar background blur on scroll
    window.addEventListener('scroll', function() {
        const header = document.querySelector('header');
        const inner = header.querySelector('.container');
        if (window.scrollY > 10) {
            header.classList.add('shadow-md');
            inner.classList.remove('py-6');
            inner.classList.add('py-3');
        } else {
            header.classList.remove('shadow-md');
            inner.classList.add('py-6');
            inner.classList.remove('py-3');
        }
    });
</script>
</body>
</html>
