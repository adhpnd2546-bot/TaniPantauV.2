<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>TaniPantau - Sistem Monitoring Lahan Pertanian</title>
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
    /* Mimicking the custom CSS logic of the theme */
    .history-bg {
        background-color: #f8fafc;
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxyZWN0IHdpZHRoPSI4IiBoZWlnaHQ9IjgiIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMCI+PC9yZWN0PjxjaXJjbGUgY3g9IjEiIGN5PSIxIiByPSIxIiBmaWxsPSIjMDA2YjJjIiBmaWxsLW9wYWNpdHk9IjAuMSI+PC9jaXJjbGU+PC9zdmc+');
    }
    .dark .history-bg {
        background-color: #0f172a;
    }
    .estate-summary-bg {
        background: linear-gradient(180deg, transparent 50%, #f8fafc 50%);
    }
    .dark .estate-summary-bg {
        background: linear-gradient(180deg, transparent 50%, #1e293b 50%);
    }
    .transition-bento { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    @keyframes float-slow {
        0%, 100% { transform: translateY(0) scale(1) rotate(0deg); }
        50% { transform: translateY(-20px) scale(1.05) rotate(5deg); }
    }
    .animate-float-slow { animation: float-slow 8s ease-in-out infinite; }
    .animate-float-slower { animation: float-slow 12s ease-in-out infinite reverse; }
</style>
</head>
<body class="font-sans antialiased text-midnight_text dark:text-white dark:bg-darkmode overflow-x-hidden w-full relative">
<script>
(function(){const s=localStorage.getItem('tanipantau-dark-mode');const h=document.documentElement;if(s==='true'){h.classList.add('dark')}else{h.classList.remove('dark')}if(!s){localStorage.setItem('tanipantau-dark-mode','false')}})();
</script>
<!-- TopNavBar -->
<header class="fixed top-0 z-50 w-full bg-white/90 backdrop-blur-md border-b border-border dark:bg-darkmode/90 dark:border-gray/30 transition-all shadow-sm">
    <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md flex items-center justify-between px-4 py-4 md:py-6 transition-all duration-300">
        <a href="/" class="flex items-center gap-2 text-primary font-heading font-bold text-xl md:text-2xl">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 28px;">eco</span>
            <span>Tani<span class="bg-primary text-white px-1.5 py-0.5 rounded ml-0.5 text-sm md:text-lg">Pantau</span></span>
        </a>
        <!-- Desktop Nav -->
        <nav class="hidden lg:flex flex-grow items-center justify-center space-x-6 font-medium">
            <a href="#" class="text-primary font-bold">Beranda</a>
            <a href="/public/lahan" class="text-midnight_text dark:text-white hover:text-primary transition-colors">Daftar Lahan</a>
            <a href="/public/artikel" class="text-midnight_text dark:text-white hover:text-primary transition-colors">Artikel</a>
        </nav>
        <div class="flex items-center space-x-2 sm:space-x-4">
            <button onclick="toggleDarkMode()" class="p-2 rounded-full hover:bg-black/5 dark:hover:bg-white/10 transition-colors text-gray dark:text-white/70" title="Toggle Dark Mode">
                <span class="material-symbols-outlined dark:hidden">dark_mode</span>
                <span class="material-symbols-outlined hidden dark:inline">light_mode</span>
            </button>
            <a class="block bg-primary text-white px-3 sm:px-6 py-1.5 sm:py-2 rounded-lg hover:bg-primary_hover transition duration-300 font-semibold text-xs sm:text-base" href="/login">Login</a>
            <!-- Mobile Menu Toggle -->
            <button id="mobileMenuBtn" class="lg:hidden p-2 rounded-full hover:bg-black/5 dark:hover:bg-white/10 transition-colors text-gray dark:text-white/70" onclick="toggleMobileMenu()" aria-label="Menu">
                <span class="material-symbols-outlined" id="menuIcon">menu</span>
            </button>
        </div>
    </div>
    <!-- Mobile Nav -->
    <div id="mobileMenu" class="lg:hidden hidden bg-white dark:bg-darkmode border-t border-border dark:border-gray/30 px-4 py-4 space-y-3">
        <a href="#" class="block text-primary font-bold py-2">Beranda</a>
        <a href="/public/lahan" class="block text-midnight_text dark:text-white hover:text-primary transition-colors py-2">Daftar Lahan</a>
        <a href="/public/artikel" class="block text-midnight_text dark:text-white hover:text-primary transition-colors py-2">Artikel</a>
    </div>
</header>

<main>
    <!-- Hero Section -->
    <section class="relative pt-32 md:pt-44 pb-0 dark:bg-darklight overflow-x-hidden">
        
        <!-- Hero Background: Ultra-Modern Liquid Glass Mesh -->
        <div class="absolute inset-0 w-full h-full z-0 pointer-events-none overflow-hidden bg-[#f0fdf4] dark:bg-[#020a05]">
            
            <!-- Dynamic Liquid Orbs -->
            <div class="absolute inset-0">
                <!-- Orb 1 (Primary Green) -->
                <div class="absolute -top-[20%] -left-[10%] w-[800px] h-[800px] bg-primary opacity-50 dark:opacity-40 rounded-full mix-blend-multiply dark:mix-blend-screen" style="animation: spin 25s linear infinite; transform-origin: 60% 60%;"></div>
                
                <!-- Orb 2 (SkyBlue/Cyan) -->
                <div class="absolute top-[10%] right-[-10%] w-[700px] h-[700px] bg-skyBlue opacity-50 dark:opacity-40 rounded-full mix-blend-multiply dark:mix-blend-screen" style="animation: spin 30s linear infinite reverse; transform-origin: 40% 60%;"></div>
                
                <!-- Orb 3 (Warm Accent) -->
                <div class="absolute -bottom-[20%] left-[20%] w-[900px] h-[900px] bg-[#a3e635] opacity-40 dark:opacity-30 rounded-full mix-blend-multiply dark:mix-blend-screen" style="animation: spin 35s linear infinite; transform-origin: 50% 40%;"></div>
            </div>

            <!-- Heavy Glass Morphism Overlay (Melts the colors into liquid) -->
            <div class="absolute inset-0 bg-white/50 dark:bg-black/40 backdrop-blur-[80px]"></div>

            <!-- Premium Crisp Noise Texture (Modern Grain) -->
            <div class="absolute inset-0 opacity-[0.35] dark:opacity-[0.25] mix-blend-overlay" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.85%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E');"></div>
            
            <!-- Bottom fade to blend with next section smoothly -->
            <div class="absolute inset-x-0 bottom-0 h-40 bg-gradient-to-t from-herobg dark:from-darklight to-transparent"></div>
        </div>

        <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-4 relative z-10">
            <div class="grid lg:grid-cols-12 grid-cols-1 gap-4">
                <div class="flex flex-col col-span-6 justify-center items-start" data-aos="fade-right">
                    <div class="mb-6 md:mb-8">
                        <h1 class="text-3xl sm:text-4xl md:text-[50px] leading-[1.2] text-midnight_text dark:text-white font-bold font-heading">Temukan Lahan <br/><span class="text-primary">Pertanian Terbaik</span></h1>
                    </div>
                    <div class="w-full">
                        <div class="flex gap-1 bg-transparent">
                            <button class="px-5 md:px-9 py-2 md:py-3 text-sm md:text-xl font-medium rounded-t-md focus:outline-none bg-white dark:bg-darkmode text-midnight_text dark:text-white border-b-2 border-primary">Cari Lahan</button>
                            <button class="px-5 md:px-9 py-2 md:py-3 text-sm md:text-xl font-medium rounded-t-md focus:outline-none text-gray bg-white bg-opacity-50 dark:text-white dark:bg-darkmode dark:bg-opacity-50 border-b-2 border-transparent">Lokasi</button>
                        </div>
                        <div class="bg-white dark:bg-transparent rounded-b-lg rounded-tr-lg">
                            <div class="bg-white dark:bg-darkmode rounded-b-lg rounded-tr-lg shadow-lg p-4 sm:p-6 md:p-8 md:pb-10">
                                <div class="relative rounded-lg border-0 my-2">
                                    <div class="relative flex items-center">
                                        <div class="absolute left-0 p-3 md:p-4">
                                            <span class="material-symbols-outlined text-gray">location_on</span>
                                        </div>
                                        <input type="text" placeholder="Masukkan nama desa atau kecamatan" class="py-3 md:py-5 pr-3 pl-10 md:pl-14 w-full rounded-lg text-sm md:text-base text-black border border-border dark:text-white dark:border-gray/30 focus:border-primary focus:ring-1 focus:ring-primary focus-visible:outline-none dark:bg-[#0f172a] transition-colors" value=""/>
                                    </div>
                                </div>
                                <div class="mt-4 md:mt-6 flex flex-col gap-3 md:gap-4">
                                    <div class="flex flex-col sm:flex-row gap-2 md:gap-4 w-full">
                                        <button class="flex-1 py-2 md:py-4 text-sm md:text-xl px-3 md:px-8 bg-primary text-white font-medium rounded-lg hover:bg-primary_hover transition duration-300">Cari Sekarang</button>
                                        <button class="flex-1 py-2 md:py-4 text-sm md:text-xl px-3 md:px-8 bg-skyBlue/80 dark:bg-skyBlue/80 dark:hover:bg-skyBlue border border-transparent text-white font-medium rounded-lg hover:bg-skyBlue transition duration-300 text-nowrap">Pencarian Lanjut</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col justify-start mt-8 mb-12 gap-3">
                        <div class="flex space-x-2" data-aos="fade-left">
                            <span class="material-symbols-outlined text-yellow-400" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-yellow-400" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-yellow-400" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-yellow-400" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined text-yellow-400" style="font-variation-settings: 'FILL' 1;">star</span>
                        </div>
                        <div data-aos="fade-left">
                            <p class="text-lg dark:text-white text-midnight_text font-medium">4.9/5 <span class="text-gray font-normal">- dari 1.250+ Petani</span></p>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:flex col-span-6 relative z-10 justify-end items-center" data-aos="fade-left" data-aos-duration="1000">
                    <div class="relative w-full max-w-md -mt-32">
                        <!-- Glassmorphic Container -->
                        <div class="relative bg-white/30 dark:bg-darkmode/30 backdrop-blur-2xl border border-white/60 dark:border-white/10 rounded-2xl p-4 shadow-2xl">
                            <img alt="heroimage" class="w-full h-auto rounded-xl object-cover shadow-inner" src="{{ asset('images/hero-sawah.png') }}"/>
                            
                            <!-- Floating Glass Widget 1 -->
                            <div class="absolute -left-6 top-16 bg-white dark:bg-darklight rounded-2xl p-3 shadow-2xl border border-gray/10 dark:border-white/5 flex items-center gap-3 animate-bounce" style="animation-duration: 3s;">
                                <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined" style="font-size: 24px;">eco</span>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray uppercase tracking-wider">Kualitas Lahan</p>
                                    <p class="text-sm font-bold text-midnight_text dark:text-white">Sangat Subur</p>
                                </div>
                            </div>
                            
                            <!-- Floating Glass Widget 2 -->
                            <div class="absolute -right-4 bottom-12 bg-white dark:bg-darklight rounded-2xl p-3 shadow-2xl border border-gray/10 dark:border-white/5 flex items-center gap-3 animate-bounce" style="animation-duration: 4s; animation-delay: 1s;">
                                <div class="w-10 h-10 rounded-full bg-skyBlue/20 flex items-center justify-center text-skyBlue">
                                    <span class="material-symbols-outlined" style="font-size: 24px;">trending_up</span>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray uppercase tracking-wider">Potensi Panen</p>
                                    <p class="text-sm font-bold text-midnight_text dark:text-white">+24% Bulan Ini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Discover Properties (Lahan Unggulan) -->
    <section class="bg-light dark:bg-semidark py-16 md:py-24 flex justify-center items-center">
        <div class="lg:max-w-screen-xl md:max-w-screen-md mx-auto container px-4">
            <h2 class="text-4xl font-bold mb-12 text-midnight_text dark:text-white font-heading" data-aos="fade-up">Lahan Unggulan Kami</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white dark:bg-darkmode rounded-xl overflow-hidden shadow-lg border border-border dark:border-gray/20 transition hover:-translate-y-2 duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative h-60">
                        <img src="https://loremflickr.com/600/400/sawah,paddy/all?lock=2" class="w-full h-full object-cover" alt="Sawah">
                        <div class="absolute top-4 left-4">
                            <span class="bg-primary text-white text-xs font-bold px-3 py-1 rounded">Aktif Tanam</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-midnight_text dark:text-white mb-2 font-heading">Sawah Blok A1 Suka Maju</h3>
                        <p class="text-gray mb-4 flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">location_on</span> Ds. Suka Maju, Kec. Nglegok</p>
                        <div class="flex justify-between items-center border-t border-border dark:border-gray/30 pt-4">
                            <div class="text-primary font-bold text-lg">Padi Inpari</div>
                            <div class="text-gray font-medium">2.5 Hektar</div>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="bg-white dark:bg-darkmode rounded-xl overflow-hidden shadow-lg border border-border dark:border-gray/20 transition hover:-translate-y-2 duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative h-60">
                        <img src="https://loremflickr.com/600/400/sawah,paddy/all?lock=3" class="w-full h-full object-cover" alt="Jagung">
                        <div class="absolute top-4 left-4">
                            <span class="bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded">Masa Panen</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-midnight_text dark:text-white mb-2 font-heading">Ladang Jagung Makmur</h3>
                        <p class="text-gray mb-4 flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">location_on</span> Ds. Tani Makmur, Garum</p>
                        <div class="flex justify-between items-center border-t border-border dark:border-gray/30 pt-4">
                            <div class="text-yellow-600 font-bold text-lg">Jagung Manis</div>
                            <div class="text-gray font-medium">1.8 Hektar</div>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="bg-white dark:bg-darkmode rounded-xl overflow-hidden shadow-lg border border-border dark:border-gray/20 transition hover:-translate-y-2 duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative h-60">
                        <img src="https://loremflickr.com/600/400/sawah,paddy/all?lock=4" class="w-full h-full object-cover" alt="Sayuran">
                        <div class="absolute top-4 left-4">
                            <span class="bg-skyBlue text-white text-xs font-bold px-3 py-1 rounded">Persiapan</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-midnight_text dark:text-white mb-2 font-heading">Kebun Sayur Lestari</h3>
                        <p class="text-gray mb-4 flex items-center gap-1"><span class="material-symbols-outlined text-[18px]">location_on</span> Ds. Sumber Rejo, Talun</p>
                        <div class="flex justify-between items-center border-t border-border dark:border-gray/30 pt-4">
                            <div class="text-skyBlue font-bold text-lg">Hortikultura</div>
                            <div class="text-gray font-medium">3.0 Hektar</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Why Choose Us -->
    <section class="py-16 md:py-24 bg-light dark:bg-darkmode border-y border-border dark:border-gray/20">
        <div class="container px-4 lg:max-w-screen-xl md:max-w-screen-md mx-auto flex flex-col md:flex-row justify-between items-center gap-8 md:gap-12">
            <div class="flex-1 w-full" data-aos="fade-right">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                    <img alt="Mengapa Memilih Kami" class="w-full h-64 sm:h-80 md:h-[500px] object-cover" src="https://loremflickr.com/800/500/sawah,paddy/all?lock=5"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex flex-col justify-end p-8">
                        <div class="bg-primary/90 backdrop-blur text-white p-6 rounded-xl border border-white/20 inline-block w-max mb-4 shadow-lg" data-aos="fade-up" data-aos-delay="200">
                            <p class="text-4xl font-bold font-heading mb-1">100%</p>
                            <p class="text-white/80 font-medium">Akurasi Data Panen</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1" data-aos="fade-left">
                <div class="lg:pl-12 flex flex-col justify-center h-full">
                    <p class="text-primary font-bold tracking-widest text-sm uppercase mb-3" data-aos="fade-left">Keunggulan Sistem</p>
                    <h2 class="mb-8 text-4xl font-bold text-midnight_text dark:text-white font-heading leading-tight" data-aos="fade-left">Mengapa Petani Memilih TaniPantau?</h2>
                    <ul class="space-y-6">
                        <li class="flex items-start gap-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary flex-shrink-0 mt-1">
                                <span class="material-symbols-outlined">analytics</span>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-midnight_text dark:text-white mb-2">Monitoring Real-Time</h4>
                                <p class="text-gray leading-relaxed">Pantau perkembangan fase lahan pertanian secara aktual dengan pembaruan data langsung dari petugas lapangan.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary flex-shrink-0 mt-1">
                                <span class="material-symbols-outlined">monitoring</span>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-midnight_text dark:text-white mb-2">Prediksi Panen Akurat</h4>
                                <p class="text-gray leading-relaxed">Dilengkapi dengan kalkulator cerdas yang membantu mengestimasi hasil panen berdasarkan histori data komoditas.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary flex-shrink-0 mt-1">
                                <span class="material-symbols-outlined">security</span>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-midnight_text dark:text-white mb-2">Manajemen Terpadu</h4>
                                <p class="text-gray leading-relaxed">Kelola seluruh aspek mulai dari data profil petani, riwayat lahan, hingga laporan panen dalam satu ekosistem yang aman.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Kalkulator Potensi Panen -->
    <section class="py-16 md:py-24 bg-gradient-to-br from-emerald-50 to-white dark:from-darkmode dark:to-[#0a1a0f]">
        <div class="container px-4 lg:max-w-screen-xl md:max-w-screen-md mx-auto">
            <div class="text-center mb-8 md:mb-14" data-aos="fade-down">
                <p class="text-primary font-bold tracking-widest text-xs md:text-sm uppercase mb-3">Kalkulator Pertanian</p>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-midnight_text dark:text-white font-heading leading-tight mb-3 md:mb-4">Simulasi Potensi Panen</h2>
                <p class="text-gray max-w-2xl mx-auto text-sm md:text-lg">Estimasi hasil panen dan potensi pendapatan berdasarkan luas lahan dan jenis komoditas.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-10 items-center">
                <div class="bg-white dark:bg-semidark rounded-2xl shadow-xl border border-border dark:border-gray/20 p-4 sm:p-6 md:p-8" data-aos="fade-right">
                    <h3 class="text-lg md:text-xl font-bold text-midnight_text dark:text-white mb-4 md:mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">tune</span>
                    Atur Parameter
                    </h3>

                    <div class="space-y-4 md:space-y-6">
                        <div>
                            <label class="text-sm font-medium text-midnight_text dark:text-white mb-2 flex justify-between">
                                <span>Luas Lahan</span>
                                <span class="text-primary font-bold" id="luasValue">1.0 Ha</span>
                            </label>
                            <input type="range" id="luasSlider" min="0.1" max="10" step="0.1" value="1" class="w-full accent-primary">
                            <div class="flex justify-between text-xs text-gray mt-1">
                                <span>0.1 Ha</span>
                                <span>10 Ha</span>
                            </div>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-midnight_text dark:text-white mb-2 block">Jenis Komoditas</label>
                            <select id="komoditasSelect" class="w-full border border-border dark:border-dark-border rounded-lg px-4 py-3 text-[15px] text-midnight_text dark:text-white bg-white dark:bg-darkmode focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
                                <option value="padi">Padi</option>
                                <option value="jagung">Jagung</option>
                                <option value="kedelai">Kedelai</option>
                                <option value="cabai">Cabai</option>
                                <option value="bawang_merah">Bawang Merah</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-midnight_text dark:text-white mb-2 flex justify-between">
                                <span>Perkiraan Harga (Rp/kg)</span>
                                <span class="text-primary font-bold" id="hargaValue">Rp 5.500</span>
                            </label>
                            <input type="range" id="hargaSlider" min="1000" max="20000" step="500" value="5500" class="w-full accent-primary">
                            <div class="flex justify-between text-xs text-gray mt-1">
                                <span>Rp 1.000</span>
                                <span>Rp 20.000</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-semidark rounded-2xl shadow-xl border border-border dark:border-gray/20 p-4 sm:p-6 md:p-8" data-aos="fade-left">
                    <h3 class="text-lg md:text-xl font-bold text-midnight_text dark:text-white mb-4 md:mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">bar_chart</span>
                    Hasil Estimasi
                    </h3>

                    <div class="space-y-4 md:space-y-6">
                        <div class="bg-primary/5 dark:bg-primary/10 rounded-xl p-4 md:p-6 text-center border border-primary/10">
                            <p class="text-xs md:text-sm text-gray mb-1">Estimasi Hasil Panen</p>
                            <p class="text-3xl md:text-4xl font-bold text-primary font-heading" id="hasilPanen">0<span class="text-xl md:text-2xl"> ton</span></p>
                        </div>

                        <div class="grid grid-cols-2 gap-3 md:gap-4">
                            <div class="bg-white dark:bg-darkmode rounded-xl p-3 md:p-4 border border-border dark:border-gray/20 text-center">
                                <span class="material-symbols-outlined text-primary text-xl md:text-2xl">inventory_2</span>
                                <p class="text-[10px] md:text-xs text-gray mt-1">Produktivitas</p>
                                <p class="text-sm md:text-lg font-bold text-midnight_text dark:text-white" id="produktivitas">0<span class="text-[10px] md:text-xs text-gray"> ton/ha</span></p>
                            </div>
                            <div class="bg-white dark:bg-darkmode rounded-xl p-3 md:p-4 border border-border dark:border-gray/20 text-center">
                                <span class="material-symbols-outlined text-yellow-600 text-xl md:text-2xl">payments</span>
                                <p class="text-[10px] md:text-xs text-gray mt-1">Potensi Pendapatan</p>
                                <p class="text-sm md:text-lg font-bold text-midnight_text dark:text-white" id="pendapatan">Rp 0</p>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-primary/10 to-emerald-500/10 rounded-xl p-3 md:p-4 border border-primary/20">
                            <p class="text-[10px] md:text-xs text-gray mb-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs md:text-sm">info</span>
                            Berdasarkan rata-rata produktivitas nasional
                            </p>
                            <div class="w-full bg-gray-200 dark:bg-gray/30 rounded-full h-1.5 md:h-2 mt-2 overflow-hidden">
                                <div class="bg-primary h-1.5 md:h-2 rounded-full transition-all" id="progressBar" style="width:0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const produktivitasData = {
            padi: { tonPerHa: 5.2, label: 'Padi' },
            jagung: { tonPerHa: 6.8, label: 'Jagung' },
            kedelai: { tonPerHa: 1.5, label: 'Kedelai' },
            cabai: { tonPerHa: 8.0, label: 'Cabai' },
            bawang_merah: { tonPerHa: 10.0, label: 'Bawang Merah' },
        };

        function hitungEstimasi() {
            const luas = parseFloat(document.getElementById('luasSlider').value);
            const komoditas = document.getElementById('komoditasSelect').value;
            const harga = parseInt(document.getElementById('hargaSlider').value);
            const data = produktivitasData[komoditas];
            const hasilTon = luas * data.tonPerHa;
            const pendapatan = hasilTon * 1000 * harga;

            document.getElementById('luasValue').textContent = luas.toFixed(1) + ' Ha';
            document.getElementById('hargaValue').textContent = 'Rp ' + harga.toLocaleString('id-ID');
            document.getElementById('hasilPanen').innerHTML = hasilTon.toFixed(1) + '<span class="text-2xl"> ton</span>';
            document.getElementById('produktivitas').innerHTML = data.tonPerHa.toFixed(1) + '<span class="text-xs text-gray"> ton/ha</span>';
            document.getElementById('pendapatan').textContent = 'Rp ' + pendapatan.toLocaleString('id-ID');
            document.getElementById('progressBar').style.width = Math.min((hasilTon / 50) * 100, 100) + '%';
        }

        document.getElementById('luasSlider').addEventListener('input', hitungEstimasi);
        document.getElementById('komoditasSelect').addEventListener('change', hitungEstimasi);
        document.getElementById('hargaSlider').addEventListener('input', hitungEstimasi);
        hitungEstimasi();
    </script>

    <!-- History / Perjalanan -->
    <section class="history-bg">
        <div class="container lg:max-w-screen-xl md:max-w-screen-md mx-auto grid grid-cols-1 lg:grid-cols-12 py-20 md:py-40 gap-8 md:gap-12">
            <div class="col-span-1 lg:col-span-7 px-4" data-aos="fade-right">
                <p class="text-2xl sm:text-3xl md:text-4xl text-midnight_text dark:text-white mb-4 md:mb-6 font-bold font-heading leading-tight">Perjalanan TaniPantau <br/>Menjadi Solusi Agraria No.1</p>
                <p class="mb-6 md:mb-10 text-gray text-base md:text-lg leading-relaxed max-w-2xl">Dikembangkan dengan dedikasi tinggi untuk menjembatani teknologi modern dengan kearifan pertanian lokal. Selama bertahun-tahun, TaniPantau terus berevolusi dari sekadar aplikasi pencatatan menjadi platform cerdas yang memberdayakan ribuan petani di seluruh nusantara untuk mencapai hasil panen maksimal.</p>
                <a class="inline-block text-base md:text-xl font-semibold px-6 md:px-9 py-3 md:py-4 border-2 border-primary text-primary hover:text-white hover:bg-primary rounded-lg transition-colors" href="#">Pelajari Lebih Lanjut</a>
            </div>
            <div class="lg:block col-span-1 lg:col-span-5 flex justify-center lg:justify-end px-4" data-aos="fade-left">
                <div class="bg-white dark:bg-darkmode p-6 md:p-8 max-w-sm w-full border-[4px] md:border-[6px] border-primary rounded-2xl shadow-2xl relative transform lg:-rotate-3 transition-transform hover:rotate-0 duration-500">
                    <span class="material-symbols-outlined absolute -top-6 md:-top-8 -right-6 md:-right-8 text-skyBlue text-4xl md:text-6xl opacity-50" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                    <p class="mb-8 md:mb-12 text-xl md:text-2xl text-midnight_text dark:text-white font-bold font-heading">PLATFORM PERTANIAN TERBAIK</p>
                    <div class="flex justify-between items-end border-t border-border dark:border-gray/20 pt-6">
                        <div>
                            <p class="text-gray font-medium mb-1 uppercase tracking-wider text-xs md:text-sm">Pengalaman</p>
                            <p class="text-5xl md:text-[72px] leading-[1] text-primary font-bold font-heading drop-shadow-md">10<span class="text-2xl md:text-4xl">+</span></p>
                        </div>
                        <div class="pb-2">
                            <span class="material-symbols-outlined text-5xl md:text-[64px] text-gray/30">spa</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="px-4 md:px-0 py-16 md:py-24 dark:bg-darkmode border-t border-border dark:border-gray/20">
        <div class="container lg:max-w-screen-xl md:max-w-screen-md mx-auto flex flex-col-reverse md:flex-row items-center justify-between gap-8 md:gap-12">
            <div class="flex-1 w-full flex justify-center" data-aos="fade-right">
                <div class="relative w-full max-w-sm md:max-w-md">
                    <div class="absolute inset-0 bg-primary/10 rounded-full blur-3xl transform scale-110"></div>
                    <img alt="Testimonial Petani" class="relative z-10 rounded-3xl w-full object-cover shadow-2xl border-4 border-white dark:border-semidark h-64 sm:h-80 md:h-[500px]" src="https://loremflickr.com/600/600/sawah,paddy/all?lock=6"/>
                    <!-- Overlay Badge -->
                    <div class="absolute -bottom-4 md:-bottom-6 -right-2 md:-right-6 bg-white dark:bg-semidark p-3 md:p-4 rounded-xl shadow-xl z-20 flex items-center gap-2 md:gap-3 border border-border">
                        <span class="material-symbols-outlined text-yellow-500 text-2xl md:text-3xl" style="font-variation-settings: 'FILL' 1;">star</span>
                        <div>
                            <p class="font-bold text-sm md:text-base text-midnight_text dark:text-white">Rating 4.9</p>
                            <p class="text-[10px] md:text-xs text-gray">Berdasarkan ulasan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1" data-aos="fade-left">
                <span class="material-symbols-outlined text-5xl md:text-[80px] text-primary/20 mb-4 md:mb-6 rotate-180" style="font-variation-settings: 'FILL' 1;">format_quote</span>
                <p class="text-lg sm:text-xl md:text-3xl text-midnight_text dark:text-white mb-6 md:mb-10 font-heading leading-tight">"Sejak menggunakan sistem TaniPantau, manajemen lahan kelompok tani kami menjadi jauh lebih rapi. Pendataan hasil panen jadi transparan dan mudah diakses oleh semua anggota kapan saja."</p>
                <div>
                    <p class="text-xl md:text-2xl font-bold text-primary font-heading">H. Sudirman</p>
                    <p class="text-gray text-base md:text-lg font-medium mt-1">Ketua Kelompok Tani Makmur Jaya</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <div class="dark:bg-darkmode pt-10 pb-20">
        <div class="estate-summary-bg">
            <div class="bg-primary container lg:max-w-screen-xl md:max-w-screen-md mx-auto px-8 rounded-2xl shadow-2xl relative overflow-hidden">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPjxyZWN0IHdpZHRoPSI4IiBoZWlnaHQ9IjgiIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMCI+PC9yZWN0PjxjaXJjbGUgY3g9IjEiIGN5PSIxIiByPSIxIiBmaWxsPSIjZmZmZmZmIiBmaWxsLW9wYWNpdHk9IjAuMSI+PC9jaXJjbGU+PC9zdmc+')]"></div>
                <div class="grid grid-cols-1 sm:grid-cols-3 relative z-10 divide-y sm:divide-y-0 sm:divide-x divide-white/20">
                    <div class="flex flex-col justify-center items-center py-10 md:py-16 px-4 group" data-aos="fade-right">
                        <p class="text-4xl md:text-[64px] leading-[1.2] font-heading font-bold text-white mb-2 drop-shadow-md group-hover:scale-110 transition-transform">99%</p>
                        <p class="text-lg md:text-2xl text-white/90 font-medium">Petani Terbantu</p>
                    </div>
                    <div class="flex flex-col justify-center items-center py-10 md:py-16 px-4 group" data-aos="fade-up">
                        <p class="text-4xl md:text-[64px] leading-[1.2] font-heading font-bold text-white mb-2 drop-shadow-md group-hover:scale-110 transition-transform">2.5K</p>
                        <p class="text-lg md:text-2xl text-white/90 font-medium">Hektar Dikelola</p>
                    </div>
                    <div class="flex flex-col justify-center items-center py-10 md:py-16 px-4 group" data-aos="fade-left">
                        <p class="text-4xl md:text-[64px] leading-[1.2] font-heading font-bold text-white mb-2 drop-shadow-md group-hover:scale-110 transition-transform">15+</p>
                        <p class="text-lg md:text-2xl text-white/90 font-medium">Kabupaten Aktif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog / Articles -->
    <section class="flex flex-col dark:bg-darkmode px-4 md:px-0 py-16 md:py-24 bg-light">
        <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md px-0">
            <div class="items-center mb-8 md:mb-16 flex flex-col justify-center" data-aos="fade-up">
                <p class="text-primary font-bold tracking-widest text-xs md:text-sm uppercase mb-3">Wawasan Agrikultur</p>
                <h2 class="text-2xl sm:text-3xl md:text-4xl text-midnight_text dark:text-white text-center font-bold font-heading">Artikel Pertanian Terbaru</h2>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-12">
                <!-- Blog 1 -->
                <div class="w-full" data-aos="fade-up" data-aos-delay="0" data-aos-duration="1000">
                    <a class="flex flex-col md:flex-row gap-4 md:gap-6 group bg-white dark:bg-semidark p-4 rounded-2xl shadow-sm hover:shadow-xl transition-all border border-border dark:border-gray/20" href="#">
                        <div class="overflow-hidden rounded-xl flex-shrink-0 md:w-48 h-48 md:h-48 relative">
                            <img alt="Blog 1" class="transition-transform duration-700 group-hover:scale-110 w-full h-full object-cover" src="https://loremflickr.com/400/300/sawah,paddy/all?lock=7"/>
                            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                        </div>
                        <div class="flex-1 flex flex-col justify-center py-2 md:pr-4">
                            <div>
                                <span class="inline-block px-2 md:px-3 py-1 bg-skyBlue/10 text-skyBlue text-[10px] md:text-xs font-bold rounded-full mb-2 md:mb-3 uppercase tracking-wider">Teknologi</span>
                                <span class="text-xs md:text-base font-medium text-gray ml-1 md:ml-2">12 Okt 2026</span>
                                <h3 class="mt-2 text-base md:text-2xl font-bold font-heading text-midnight_text dark:text-white group-hover:text-primary transition-colors leading-tight">Pemanfaatan Drone untuk Pemetaan Lahan Pertanian</h3>
                            </div>
                            <p class="block mt-3 md:mt-4 text-sm md:text-base text-primary font-semibold flex items-center gap-1 group-hover:gap-2 transition-all">Baca Selengkapnya <span class="material-symbols-outlined text-sm">arrow_forward</span></p>
                        </div>
                    </a>
                </div>
                <!-- Blog 2 -->
                <div class="w-full" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                    <a class="flex flex-col md:flex-row gap-4 md:gap-6 group bg-white dark:bg-semidark p-4 rounded-2xl shadow-sm hover:shadow-xl transition-all border border-border dark:border-gray/20" href="#">
                        <div class="overflow-hidden rounded-xl flex-shrink-0 md:w-48 h-48 md:h-48 relative">
                            <img alt="Blog 2" class="transition-transform duration-700 group-hover:scale-110 w-full h-full object-cover" src="https://loremflickr.com/400/300/sawah,paddy/all?lock=8"/>
                            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                        </div>
                        <div class="flex-1 flex flex-col justify-center py-2 md:pr-4">
                            <div>
                                <span class="inline-block px-2 md:px-3 py-1 bg-yellow-500/10 text-yellow-600 text-[10px] md:text-xs font-bold rounded-full mb-2 md:mb-3 uppercase tracking-wider">Panduan</span>
                                <span class="text-xs md:text-base font-medium text-gray ml-1 md:ml-2">05 Okt 2026</span>
                                <h3 class="mt-2 text-base md:text-2xl font-bold font-heading text-midnight_text dark:text-white group-hover:text-primary transition-colors leading-tight">Strategi Menghadapi Perubahan Iklim pada Musim Tanam</h3>
                            </div>
                            <p class="block mt-3 md:mt-4 text-sm md:text-base text-primary font-semibold flex items-center gap-1 group-hover:gap-2 transition-all">Baca Selengkapnya <span class="material-symbols-outlined text-sm">arrow_forward</span></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<!-- Footer -->
<footer class="relative z-10 bg-[#0b0f19] text-white">
    <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md pt-12 md:pt-20 pb-10 px-4 md:px-6 lg:px-4">
        <div class="grid grid-cols-12 gap-6 md:gap-8 lg:gap-4 mb-10 md:mb-16">
            <div class="lg:col-span-4 col-span-12 flex flex-col">
                <a class="mb-4 md:mb-6 flex items-center gap-2.5 text-primary font-heading font-bold text-2xl md:text-3xl" href="/">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 28px;">eco</span>
                    <span>Tani<span class="bg-primary text-white px-1.5 py-0.5 rounded ml-0.5">Pantau</span></span>
                </a>
                <p class="text-gray text-sm md:text-base leading-relaxed max-w-sm mb-4 md:mb-6">Platform enterprise terpadu untuk monitoring dan manajemen lahan pertanian di seluruh Indonesia.</p>
                <div class="flex gap-3">
                    <a href="#" class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary transition-colors"><span class="material-symbols-outlined text-xs md:text-sm">share</span></a>
                    <a href="#" class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary transition-colors"><span class="material-symbols-outlined text-xs md:text-sm">public</span></a>
                </div>
            </div>
            <div class="lg:col-span-8 col-span-12 grid grid-cols-2 md:grid-cols-3 gap-6 md:gap-8">
                <div class="w-full">
                    <h4 class="mb-4 md:mb-6 text-lg md:text-xl font-bold font-heading text-white">Navigasi</h4>
                    <ul class="space-y-3 md:space-y-4">
                        <li><a href="/" class="text-gray text-sm md:text-base hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="/public/lahan" class="text-gray text-sm md:text-base hover:text-white transition-colors">Daftar Lahan</a></li>
                        <li><a href="/public/artikel" class="text-gray text-sm md:text-base hover:text-white transition-colors">Artikel</a></li>
                        <li><a href="#" class="text-gray text-sm md:text-base hover:text-white transition-colors">Kalkulator Panen</a></li>
                    </ul>
                </div>
                <div class="w-full">
                    <h4 class="mb-4 md:mb-6 text-lg md:text-xl font-bold font-heading text-white">Bantuan</h4>
                    <ul class="space-y-3 md:space-y-4">
                        <li><a href="#" class="text-gray text-sm md:text-base hover:text-white transition-colors">Panduan Petani</a></li>
                        <li><a href="#" class="text-gray text-sm md:text-base hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="text-gray text-sm md:text-base hover:text-white transition-colors">Pusat Resolusi</a></li>
                        <li><a href="#" class="text-gray text-sm md:text-base hover:text-white transition-colors">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div class="w-full col-span-2 md:col-span-1">
                    <h4 class="mb-4 md:mb-6 text-lg md:text-xl font-bold font-heading text-white">Kontak Kami</h4>
                    <ul class="space-y-3 md:space-y-4 text-gray text-sm md:text-base">
                        <li class="flex items-start gap-3"><span class="material-symbols-outlined text-primary mt-1">location_on</span> Jl. Agraria Nusantara No. 42, Jawa Timur</li>
                        <li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary">call</span> +62 811 2233 4455</li>
                        <li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary">mail</span> info@tanipantau.id</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="border-t border-white/10 pt-6 md:pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray text-xs md:text-sm text-center md:text-left">© 2026 TaniPantau. Dikembangkan untuk Pertanian Indonesia.</p>
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
    
    // Mobile Menu Toggle
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        const icon = document.getElementById('menuIcon');
        menu.classList.toggle('hidden');
        icon.textContent = menu.classList.contains('hidden') ? 'menu' : 'close';
    }

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
