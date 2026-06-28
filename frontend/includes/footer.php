<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL'1;font-size:24px;">eco</span>
                    <span class="fw-bold" style="font-size:1.1rem;color:white;letter-spacing:-0.03em;">Tani<span style="display:inline-block;background:#22c55e;color:white;padding:0 6px;border-radius:3px;margin-left:2px;">Pantau</span></span>
                </div>
                <p class="mb-0" style="max-width:360px;">Sistem monitoring lahan pertanian dan kunjungan petugas lapangan untuk mendukung produktivitas pertanian berkelanjutan.</p>
            </div>
            <div class="col-md-3">
                <h6 class="text-white fw-semibold mb-3" style="font-size:0.8125rem;">Akses Cepat</h6>
                <div class="d-flex flex-column gap-1">
                    <a href="index.php" class="text-white-50 text-decoration-none" style="font-size:0.8125rem;">Beranda</a>
                    <a href="index.php#statistik" class="text-white-50 text-decoration-none" style="font-size:0.8125rem;">Statistik</a>
                </div>
            </div>
            <div class="col-md-3">
                <h6 class="text-white fw-semibold mb-3" style="font-size:0.8125rem;">Tentang</h6>
                <div style="font-size:0.75rem;line-height:1.8;">
                    <div>TaniPantau adalah portal monitoring lahan pertanian dan kunjungan petugas lapangan.</div>
                </div>
            </div>
        </div>
        <hr class="my-4" style="border-color:rgba(255,255,255,0.1);">
        <div class="text-center">
            <p class="mb-0">&copy; 2026 TaniPantau. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>
function toggleDarkMode() {
    var h = document.documentElement;
    var theme = h.getAttribute('data-bs-theme');
    var newTheme = theme === 'dark' ? 'light' : 'dark';
    h.setAttribute('data-bs-theme', newTheme);
    localStorage.setItem('tanipantau-dark-mode', newTheme === 'dark');
    var icon = document.getElementById('darkModeIcon');
    if (icon) icon.className = newTheme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-fill';
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var s = localStorage.getItem('tanipantau-dark-mode');
    var icon = document.getElementById('darkModeIcon');
    if (s === 'true' && icon) icon.className = 'bi bi-sun-fill';
});
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, offset: 50, duration: 600, easing: 'ease-in-out-cubic' });
</script>
</body>
</html>