<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Artikel Pertanian - TaniPantau</title>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;600&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
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
<header class="fixed top-0 z-50 w-full bg-white/90 backdrop-blur-md border-b border-border dark:bg-darkmode/90 dark:border-gray/30 transition-all shadow-sm">
    <div class="container mx-auto lg:max-w-screen-xl md:max-w-screen-md flex items-center justify-between px-4 py-6 transition-all duration-300">
        <a href="/" class="flex items-center gap-2.5 text-primary font-heading font-bold text-2xl">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1; font-size: 32px;">eco</span>
            <span>Tani<span class="bg-primary text-white px-1.5 py-0.5 rounded ml-0.5 text-lg">Pantau</span></span>
        </a>
        <nav class="hidden lg:flex flex-grow items-center justify-center space-x-6 font-medium">
            <a href="/" class="text-midnight_text dark:text-white hover:text-primary transition-colors">Beranda</a>
            <a href="/public/lahan" class="text-midnight_text dark:text-white hover:text-primary transition-colors">Daftar Lahan</a>
            <a href="/public/artikel" class="text-primary font-bold">Artikel</a>
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
        <div class="mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-midnight_text dark:text-white font-heading mb-4">Artikel Pertanian</h1>
            <p class="text-lg text-gray dark:text-gray/80 max-w-2xl">Wawasan, tips, dan informasi terkini seputar dunia pertanian dan agrikultur di Indonesia.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Artikel 1 -->
            <article class="bg-white dark:bg-semidark rounded-2xl overflow-hidden shadow-lg border border-border dark:border-gray/20 transition hover:-translate-y-2 duration-300" data-aos="fade-up" data-aos-delay="100">
                <div class="relative h-56">
                    <img src="https://loremflickr.com/600/400/agriculture,farming/all?lock=20" class="w-full h-full object-cover" alt="Artikel">
                    <div class="absolute top-4 left-4">
                        <span class="bg-primary text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-md">TEKNOLOGI</span>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray dark:text-gray/80 mb-2">12 Juni 2026</p>
                    <h3 class="text-2xl font-bold text-midnight_text dark:text-white mb-3 font-heading">Pemanfaatan Drone untuk Pemetaan Lahan Pertanian</h3>
                    <p class="text-gray dark:text-gray/80 leading-relaxed mb-4">Teknologi drone semakin terjangkau dan mampu memberikan data akurat untuk monitoring kesehatan tanaman, irigasi, dan estimasi hasil panen.</p>
                    <a href="#" class="text-primary font-bold hover:text-primary_hover flex items-center gap-1 transition-colors">
                        Baca Selengkapnya <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </article>

            <!-- Artikel 2 -->
            <article class="bg-white dark:bg-semidark rounded-2xl overflow-hidden shadow-lg border border-border dark:border-gray/20 transition hover:-translate-y-2 duration-300" data-aos="fade-up" data-aos-delay="200">
                <div class="relative h-56">
                    <img src="https://loremflickr.com/600/400/soil,planting/all?lock=21" class="w-full h-full object-cover" alt="Artikel">
                    <div class="absolute top-4 left-4">
                        <span class="bg-yellow-500 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-md">PANDUAN</span>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray dark:text-gray/80 mb-2">5 Juni 2026</p>
                    <h3 class="text-2xl font-bold text-midnight_text dark:text-white mb-3 font-heading">Strategi Menghadapi Perubahan Iklim pada Musim Tanam</h3>
                    <p class="text-gray dark:text-gray/80 leading-relaxed mb-4">Petani perlu beradaptasi dengan pola cuaca yang berubah. Pelajari teknik dan jadwal tanam yang tepat untuk meminimalkan risiko gagal panen.</p>
                    <a href="#" class="text-primary font-bold hover:text-primary_hover flex items-center gap-1 transition-colors">
                        Baca Selengkapnya <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </article>

            <!-- Artikel 3 -->
            <article class="bg-white dark:bg-semidark rounded-2xl overflow-hidden shadow-lg border border-border dark:border-gray/20 transition hover:-translate-y-2 duration-300" data-aos="fade-up" data-aos-delay="300">
                <div class="relative h-56">
                    <img src="https://loremflickr.com/600/400/organic,farm/all?lock=22" class="w-full h-full object-cover" alt="Artikel">
                    <div class="absolute top-4 left-4">
                        <span class="bg-skyBlue text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-md">ORGANIK</span>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray dark:text-gray/80 mb-2">28 Mei 2026</p>
                    <h3 class="text-2xl font-bold text-midnight_text dark:text-white mb-3 font-heading">Pertanian Organik: Peluang dan Tantangan di Era Modern</h3>
                    <p class="text-gray dark:text-gray/80 leading-relaxed mb-4">Permintaan produk organik terus meningkat. Simak bagaimana petani bisa beralih ke metode organik secara bertahap dan menguntungkan.</p>
                    <a href="#" class="text-primary font-bold hover:text-primary_hover flex items-center gap-1 transition-colors">
                        Baca Selengkapnya <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </article>

            <!-- Artikel 4 -->
            <article class="bg-white dark:bg-semidark rounded-2xl overflow-hidden shadow-lg border border-border dark:border-gray/20 transition hover:-translate-y-2 duration-300" data-aos="fade-up" data-aos-delay="400">
                <div class="relative h-56">
                    <img src="https://loremflickr.com/600/400/irrigation,water/all?lock=23" class="w-full h-full object-cover" alt="Artikel">
                    <div class="absolute top-4 left-4">
                        <span class="bg-primary text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-md">INFRASTRUKTUR</span>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray dark:text-gray/80 mb-2">20 Mei 2026</p>
                    <h3 class="text-2xl font-bold text-midnight_text dark:text-white mb-3 font-heading">Sistem Irigasi Cerdas untuk Efisiensi Air di Lahan Kering</h3>
                    <p class="text-gray dark:text-gray/80 leading-relaxed mb-4">Irigasi tetes dan sensor kelembapan tanah membantu petani menghemat air hingga 40% sekaligus meningkatkan produktivitas tanaman.</p>
                    <a href="#" class="text-primary font-bold hover:text-primary_hover flex items-center gap-1 transition-colors">
                        Baca Selengkapnya <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>
            </article>
        </div>

        <div class="flex justify-center mt-16" data-aos="fade-up">
            <nav class="flex items-center gap-2">
                <button class="w-10 h-10 rounded-lg flex items-center justify-center text-gray dark:text-gray/80 hover:bg-border dark:hover:bg-gray/20 transition-colors disabled:opacity-50" disabled>
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button class="w-10 h-10 rounded-lg bg-primary text-white font-bold shadow-md transition-bento">1</button>
                <button class="w-10 h-10 rounded-lg text-midnight_text dark:text-white hover:bg-border dark:hover:bg-gray/20 font-medium transition-colors">2</button>
                <button class="w-10 h-10 rounded-lg text-midnight_text dark:text-white hover:bg-border dark:hover:bg-gray/20 font-medium transition-colors">3</button>
                <button class="w-10 h-10 rounded-lg flex items-center justify-center text-midnight_text dark:text-white hover:bg-border dark:hover:bg-gray/20 transition-colors">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </nav>
        </div>
    </div>
</main>

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
            <p class="text-gray text-sm">&copy; 2026 TaniPantau. Dikembangkan untuk Pertanian Indonesia.</p>
        </div>
    </div>
</footer>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    function toggleDarkMode() {
        const html = document.documentElement;
        html.classList.toggle('dark');
        localStorage.setItem('tanipantau-dark-mode', html.classList.contains('dark'));
    }
    AOS.init({
        once: true,
        offset: 50,
        duration: 800,
        easing: 'ease-in-out-cubic',
    });
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
