<?php
require_once 'includes/api.php';
require_once 'includes/header.php';

$kecamatanList = apiGet('/kecamatan');
$kecamatanList = is_array($kecamatanList) ? $kecamatanList : [];

$statsData = apiGet('/statistik');
if (!empty($statsData)) {
    $totalPetani = $statsData['total_petani'] ?? 0;
    $totalLahan = $statsData['total_lahan'] ?? 0;
    $totalKunjungan = $statsData['total_kunjungan'] ?? 0;
    $lahanPerluTindakan = $statsData['lahan_perlu_tindakan'] ?? 0;
} else {
    $petani = apiGet('/petani?per_page=1'); $lahan = apiGet('/lahan?per_page=1'); $kunjungan = apiGet('/kunjungan');
    $totalPetani = is_array($petani) ? (isset($petani['total']) ? $petani['total'] : count($petani)) : 0;
    $totalLahan = is_array($lahan) ? (isset($lahan['total']) ? $lahan['total'] : count($lahan)) : 0;
    $totalKunjungan = is_array($kunjungan) ? count($kunjungan) : 0;
    $lahanPerluTindakan = 0;
}

$apiResponse = apiGet('/lahan?per_page=9999');
$allLahan = [];
if (is_array($apiResponse)) {
    $allLahan = isset($apiResponse['data']) ? $apiResponse['data'] : $apiResponse;
}
if (!is_array($allLahan)) $allLahan = [];

$commoditiesCount = [];
$statusCount = [];
foreach ($allLahan as $l) {
    if (!empty($l['komoditas'])) $commoditiesCount[$l['komoditas']] = ($commoditiesCount[$l['komoditas']] ?? 0) + 1;
    if (!empty($l['status_fase'])) $statusCount[ucfirst($l['status_fase'])] = ($statusCount[ucfirst($l['status_fase'])] ?? 0) + 1;
}
arsort($commoditiesCount); arsort($statusCount);
$maxCom = !empty($commoditiesCount) ? max($commoditiesCount) : 1;
$maxSt = !empty($statusCount) ? max($statusCount) : 1;
?>
<div class="hero-wrap text-white text-center">
    <div class="container">
        <div class="hero-icon"><span class="material-symbols-outlined" style="font-variation-settings:'FILL'1;font-size:48px;color:#22c55e;">eco</span></div>
        <h1 class="text-white fw-bold mb-2" style="font-size: 2.75rem;letter-spacing:-0.03em;">Tani<span style="display:inline-block;background:#22c55e;color:white;padding:2px 12px;border-radius:6px;margin-left:4px;">Pantau</span></h1>
        <p class="text-white/80 mb-5 mx-auto" style="max-width: 520px; font-size: 1.1rem;">Portal Monitoring Lahan Pertanian dan Kunjungan Petugas Lapangan</p>
        <a href="#statistik" class="btn btn-light rounded-pill px-5 fw-bold text-primary">
            <i class="bi bi-arrow-down me-2"></i> Lihat Ringkasan
        </a>
    </div>
</div>

<!-- Keunggulan -->
<section class="py-5 position-relative overflow-hidden section-bg">
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-25" style="background-image:url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2319854a' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E&quot;);"></div>
    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="position-relative rounded-4 overflow-hidden shadow-lg">
                    <img src="https://loremflickr.com/600/400/sawah,paddy/all?lock=5" alt="TaniPantau" class="w-100" style="height:420px;object-fit:cover;" onerror="this.style.display='none'">
                    <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background:linear-gradient(transparent,rgba(0,0,0,0.7));">
                        <div class="accuracy-badge p-3 rounded-3 d-inline-block shadow">
                            <div class="fw-bold lh-1" style="font-size:2.2rem;">100%</div>
                            <div class="small fw-semibold accuracy-label">Akurasi Data Panen</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <p class="text-success fw-bold text-uppercase small mb-2 d-inline-flex align-items-center gap-2" style="letter-spacing:0.1em;">
                    <span class="d-inline-block rounded-circle bg-success" style="width:6px;height:6px;"></span>
                    Keunggulan Sistem
                </p>
                <h2 class="fw-bold mb-4 dark-heading" style="font-size:1.85rem;">Mengapa Petani Memilih TaniPantau?</h2>
                <p class="text-muted mb-4" style="font-size:0.95rem;">Platform monitoring pertanian terintegrasi yang membantu petani dan penyuluh dalam mengelola lahan secara digital.</p>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex gap-3 p-3 rounded-3 border border-success border-opacity-10 feature-box shadow-sm transition-hover" style="cursor:default;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 inline-primary-bg" style="width:44px;height:44px;border-radius:10px;">
                            <span class="material-symbols-outlined" style="color:#16a34a;font-variation-settings:'FILL'1;font-size:24px;">radar</span>
                        </div>
                        <div><div class="fw-bold dark-heading" style="font-size:0.9rem;">Monitoring Real-Time</div><div class="text-muted small">Pantau perkembangan lahan secara langsung dari dashboard.</div></div>
                    </div>
                    <div class="d-flex gap-3 p-3 rounded-3 border border-success border-opacity-10 feature-box shadow-sm transition-hover" style="cursor:default;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 inline-blue-bg" style="width:44px;height:44px;border-radius:10px;">
                            <span class="material-symbols-outlined" style="color:#2563eb;font-size:24px;">grain</span>
                        </div>
                        <div><div class="fw-bold dark-heading" style="font-size:0.9rem;">Prediksi Panen Akurat</div><div class="text-muted small">Data fase tanam membantu estimasi waktu panen.</div></div>
                    </div>
                    <div class="d-flex gap-3 p-3 rounded-3 border border-success border-opacity-10 feature-box shadow-sm transition-hover" style="cursor:default;">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 inline-amber-bg" style="width:44px;height:44px;border-radius:10px;">
                            <span class="material-symbols-outlined" style="color:#d97706;font-size:24px;">group_work</span>
                        </div>
                        <div><div class="fw-bold dark-heading" style="font-size:0.9rem;">Manajemen Terpadu</div><div class="text-muted small">Kelola petani dan petugas dalam satu platform.</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tentang -->
<section id="tentang" class="pt-0" style="margin-top: -20px;">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="card p-5 h-100 border-0 shadow-sm" style="border-radius:16px;">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="inline-primary-bg" style="width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;">
                            <span class="material-symbols-outlined" style="font-variation-settings:'FILL'1;font-size:24px;color:#16a34a;">eco</span>
                        </div>
                        <h3 class="fw-bold m-0" style="font-size:1.5rem;color:var(--heading);">Tentang TaniPantau</h3>
                    </div>
                    <p class="text-muted mb-4" style="font-size:0.9375rem;line-height:1.7;">Platform monitoring lahan pertanian terpadu yang menghubungkan petugas lapangan, admin, dan masyarakat dalam satu ekosistem digital untuk mendukung produktivitas pertanian berkelanjutan.</p>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-3">
                                <div class="inline-blue-bg" style="width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="bi bi-people-fill" style="color:#2563eb;font-size:1rem;"></i></div>
                                <div><div class="fw-bold dark-heading" style="font-size:0.875rem;">Data Petani</div><div class="text-muted" style="font-size:0.75rem;">Manajemen profil dan riwayat</div></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-3">
                                <div class="inline-primary-bg" style="width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="bi bi-geo-alt-fill" style="color:#16a34a;font-size:1rem;"></i></div>
                                <div><div class="fw-bold dark-heading" style="font-size:0.875rem;">Pemetaan Lahan</div><div class="text-muted" style="font-size:0.75rem;">Lokasi dan monitoring</div></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-3">
                                <div class="inline-amber-bg" style="width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="bi bi-journal-check" style="color:#d97706;font-size:1rem;"></i></div>
                                <div><div class="fw-bold dark-heading" style="font-size:0.875rem;">Kunjungan</div><div class="text-muted" style="font-size:0.75rem;">Catatan lapangan realtime</div></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-3">
                                <div class="inline-pink-bg" style="width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i class="bi bi-graph-up-arrow" style="color:#db2777;font-size:1rem;"></i></div>
                                <div><div class="fw-bold dark-heading" style="font-size:0.875rem;">Analitik</div><div class="text-muted" style="font-size:0.75rem;">Data dan statistik akurat</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="card p-5 h-100 border-0 shadow-sm" style="border-radius:16px;background:linear-gradient(135deg,#064e3b,#059669);">
                    <div class="text-center text-white">
                        <span class="material-symbols-outlined" style="font-size:48px;color:#86efac;">analytics</span>
                        <h4 class="text-white fw-bold mt-3 mb-2">Monitoring Real-Time</h4>
                        <p class="text-white/80 mb-4" style="font-size:0.875rem;">Pantau perkembangan fase lahan pertanian dengan pembaruan data langsung dari petugas lapangan.</p>
                        <div class="d-flex justify-content-center gap-4">
                            <div class="text-center">
                                <div class="fw-bold text-white" style="font-size:1.5rem;" id="totalPetaniHero">0</div>
                                <div class="text-white/70" style="font-size:0.75rem;">Petani</div>
                            </div>
                            <div class="text-center">
                                <div class="fw-bold text-white" style="font-size:1.5rem;" id="totalLahanHero">0</div>
                                <div class="text-white/70" style="font-size:0.75rem;">Lahan</div>
                            </div>
                            <div class="text-center">
                                <div class="fw-bold text-white" style="font-size:1.5rem;" id="totalKunjunganHero">0</div>
                                <div class="text-white/70" style="font-size:0.75rem;">Kunjungan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('totalPetaniHero').textContent = '<?= $totalPetani ?>';
    document.getElementById('totalLahanHero').textContent = '<?= $totalLahan ?>';
    document.getElementById('totalKunjunganHero').textContent = '<?= $totalKunjungan ?>';
});
</script>

<section id="statistik">
    <div class="container" style="margin-top: -40px;">
        <div class="row g-3">
            <div class="col-6 col-md-3 fade-in" style="animation-delay: 0.05s;">
                <div class="stat-box">
                    <div class="stat-icon green"><i class="bi bi-people-fill"></i></div>
                    <div class="num"><?= $totalPetani ?></div>
                    <div class="label">Total Petani</div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-in" style="animation-delay: 0.1s;">
                <div class="stat-box">
                    <div class="stat-icon blue"><i class="bi bi-geo-alt-fill"></i></div>
                    <div class="num"><?= $totalLahan ?></div>
                    <div class="label">Total Lahan</div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-in" style="animation-delay: 0.15s;">
                <div class="stat-box">
                    <div class="stat-icon amber"><i class="bi bi-journal-check"></i></div>
                    <div class="num"><?= $totalKunjungan ?></div>
                    <div class="label">Total Kunjungan</div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-in" style="animation-delay: 0.2s;">
                <div class="stat-box">
                    <div class="stat-icon red"><i class="bi bi-exclamation-triangle-fill"></i></div>
                    <div class="num"><?= $lahanPerluTindakan ?></div>
                    <div class="label">Perlu Tindakan</div>
                </div>
            </div>
        </div>
        <div class="text-end mt-3">
            <small class="text-muted"><i class="bi bi-clock me-1"></i>Data per <?= date('d F Y H:i') ?></small>
        </div>
    </div>
</section>

<?php if ($commoditiesCount || $statusCount): ?>
<section class="pt-0">
    <div class="container">
        <div class="row g-4">
            <?php if ($commoditiesCount): ?>
            <div class="col-md-6">
                <div class="card p-4 h-100">
                    <h5 class="fw-bold mb-4 d-flex align-items-center gap-2" style="color:var(--heading);"><i class="bi bi-bar-chart-fill text-primary"></i>Komoditas</h5>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach (array_slice($commoditiesCount, 0, 5) as $name => $count): ?>
                        <div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-semibold dark-heading" style="font-size:0.875rem;"><?= htmlspecialchars(ucfirst($name)) ?></span>
                                <span class="text-muted" style="font-size:0.8125rem;"><?= $count ?> lahan</span>
                            </div>
                            <div class="progress-bar-custom"><div class="fill bg-primary" style="width: <?= max(5, ($count/$maxCom)*100) ?>%;"></div></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if ($statusCount): ?>
            <div class="col-md-6">
                <div class="card p-4 h-100">
                    <h5 class="fw-bold mb-4 d-flex align-items-center gap-2" style="color:var(--heading);"><i class="bi bi-pie-chart-fill text-primary"></i>Status Fase</h5>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach (array_slice($statusCount, 0, 5) as $name => $count): ?>
                        <div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-semibold dark-heading" style="font-size:0.875rem;"><?= htmlspecialchars($name) ?></span>
                                <span class="text-muted" style="font-size:0.8125rem;"><?= $count ?> lahan</span>
                            </div>
                            <div class="progress-bar-custom"><div class="fill bg-info" style="width: <?= max(5, ($count/$maxSt)*100) ?>%;"></div></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<!-- Monitoring Lahan Pertanian (Peta & Daftar) -->
<section id="lahan-monitoring" class="py-5 bg-light dark:bg-dark-bg border-top border-secondary-subtle border-opacity-10">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold dark-heading" style="font-size:2rem;">Monitoring Lahan Pertanian</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">Cari dan filter lokasi lahan pertanian di seluruh wilayah pemantauan kami secara interaktif.</p>
        </div>

        <!-- Filter Panel -->
        <div class="card p-4 border-0 shadow-sm mb-4" style="border-radius:16px;">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label text-muted fw-semibold fs-7 mb-1">Cari Lahan atau Petani</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 border-secondary-subtle">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control border-start-0 border-secondary-subtle fs-7" placeholder="Ketik nama lahan atau petani...">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted fw-semibold fs-7 mb-1">Kecamatan</label>
                    <select id="kecamatanSelect" class="form-select border-secondary-subtle fs-7">
                        <option value="">Semua Kecamatan</option>
                        <?php foreach ($kecamatanList as $k): ?>
                            <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['nama']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2.5 col-sm-6">
                    <label class="form-label text-muted fw-semibold fs-7 mb-1">Komoditas</label>
                    <select id="komoditasSelect" class="form-select border-secondary-subtle fs-7">
                        <option value="">Semua Komoditas</option>
                        <option value="padi">Padi</option>
                        <option value="jagung">Jagung</option>
                        <option value="hortikultura">Hortikultura</option>
                    </select>
                </div>
                <div class="col-md-2.5 col-sm-6">
                    <label class="form-label text-muted fw-semibold fs-7 mb-1">Status Fase</label>
                    <select id="faseSelect" class="form-select border-secondary-subtle fs-7">
                        <option value="">Semua Fase</option>
                        <option value="persiapan">Persiapan</option>
                        <option value="tanam">Tanam</option>
                        <option value="pemeliharaan">Pemeliharaan</option>
                        <option value="panen">Panen</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Map & List Split Layout -->
        <div class="row g-4">
            <!-- Left Side: Interactive Map -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm overflow-hidden h-100" style="border-radius:16px; min-height: 480px;">
                    <div id="map" style="width: 100%; height: 100%; min-height: 480px; z-index: 1;"></div>
                </div>
            </div>

            <!-- Right Side: Lands List -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm d-flex flex-column h-100" style="border-radius:16px; min-height: 480px;">
                    <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2">
                        <h5 class="fw-bold m-0 dark-heading" style="font-size:1.1rem;">
                            Daftar Lahan (<span id="matchCount">0</span>)
                        </h5>
                    </div>
                    <div class="card-body p-0 overflow-y-auto flex-grow-1" id="landsListContainer" style="max-height: 420px;">
                        <!-- JS populated cards -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Detail Land Modal -->
<div class="modal fade" id="landDetailModal" tabindex="-1" aria-labelledby="landDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow" style="border-radius:16px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold dark-heading" id="landDetailModalLabel">Detail Lahan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3" id="modalBodyContent">
                <!-- JS populated detail content -->
            </div>
        </div>
    </div>
</div>

<style>
    .hover-bg {
        transition: background-color 0.2s ease-in-out;
    }
    .hover-bg:hover {
        background-color: var(--primary-light) !important;
    }
    .fs-7 { font-size: 0.8125rem !important; }
    .fs-8 { font-size: 0.75rem !important; }
    [data-bs-theme="dark"] .bg-light-subtle { background-color: rgba(255, 255, 255, 0.05) !important; }
</style>

<script>
const lands = <?= json_encode($allLahan) ?>;
const apiBaseUrl = '<?= API_BASE_URL ?>';

let map;
let markersLayer;

function loadDetail(url) {
    return fetch(url).then(res => {
        if (!res.ok) throw new Error('Response not OK');
        return res.json();
    });
}

document.addEventListener('DOMContentLoaded', () => {
    // 1. Initialize Map
    let mapCenter = [-8.5069, 115.2625]; // Ubud fallback
    
    // Find first valid coordinates
    for (let l of lands) {
        if (l.latitude && l.longitude) {
            mapCenter = [parseFloat(l.latitude), parseFloat(l.longitude)];
            break;
        }
    }
    
    map = L.map('map').setView(mapCenter, 12);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    
    markersLayer = L.layerGroup().addTo(map);
    
    // 2. Add Event Listeners for Filters
    document.getElementById('searchInput').addEventListener('input', filterLands);
    document.getElementById('kecamatanSelect').addEventListener('change', filterLands);
    document.getElementById('komoditasSelect').addEventListener('change', filterLands);
    document.getElementById('faseSelect').addEventListener('change', filterLands);
    
    // Initial Filter / Load
    filterLands();
});

function filterLands() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    const kecamatan = document.getElementById('kecamatanSelect').value;
    const komoditas = document.getElementById('komoditasSelect').value;
    const fase = document.getElementById('faseSelect').value;
    
    const filtered = lands.filter(l => {
        const matchSearch = !search || 
            (l.nama_lahan && l.nama_lahan.toLowerCase().includes(search)) || 
            (l.petani && l.petani.nama && l.petani.nama.toLowerCase().includes(search));
            
        const matchKecamatan = !kecamatan || 
            (l.petani && String(l.petani.kecamatan_id) === String(kecamatan));
            
        const matchKomoditas = !komoditas || 
            (l.komoditas && l.komoditas.toLowerCase() === komoditas.toLowerCase());
            
        const matchFase = !fase || 
            (l.status_fase && l.status_fase.toLowerCase() === fase.toLowerCase());
            
        return matchSearch && matchKecamatan && matchKomoditas && matchFase;
    });
    
    document.getElementById('matchCount').textContent = filtered.length;
    
    // Update Map Markers
    markersLayer.clearLayers();
    
    const bounds = [];
    
    // Populate List & Markers
    const container = document.getElementById('landsListContainer');
    container.innerHTML = '';
    
    if (filtered.length === 0) {
        container.innerHTML = `
            <div class="text-center py-5 text-muted">
                <i class="bi bi-geo-alt-fill fs-2 d-block mb-2"></i>
                Tidak ada lahan yang cocok.
            </div>
        `;
        return;
    }
    
    filtered.forEach(l => {
        // Create list item card
        const card = document.createElement('div');
        card.className = 'p-3 border-bottom border-secondary-subtle border-opacity-10 hover-bg transition-all cursor-pointer';
        
        let badgeColor = 'bg-secondary';
        if (l.status_fase === 'persiapan') badgeColor = 'bg-warning text-dark';
        else if (l.status_fase === 'tanam') badgeColor = 'bg-info text-dark';
        else if (l.status_fase === 'pemeliharaan') badgeColor = 'bg-success';
        else if (l.status_fase === 'panen') badgeColor = 'bg-success';
        
        card.innerHTML = `
            <div class="d-flex justify-content-between align-items-start mb-1">
                <h6 class="fw-bold m-0 dark-heading fs-7">${l.nama_lahan || '-'}</h6>
                <span class="badge ${badgeColor} text-capitalize fs-8">${l.status_fase || '-'}</span>
            </div>
            <div class="text-muted fs-8 mb-2">
                <i class="bi bi-person-fill me-1"></i>${l.petani ? l.petani.nama : '-'}
                <span class="mx-1">•</span>
                <i class="bi bi-geo-alt-fill me-1"></i>${l.petani && l.petani.kecamatan ? l.petani.kecamatan : '-'}
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <span class="badge bg-light text-success border border-success-subtle fs-8 text-uppercase">${l.komoditas || '-'}</span>
                <small class="text-muted fs-8"><i class="bi bi-arrows-fullscreen me-1"></i>${l.luas_lahan ?? '-'} Ha</small>
            </div>
        `;
        
        card.addEventListener('click', () => showLandDetail(l.id));
        container.appendChild(card);
        
        // Add map marker if coords are valid
        if (l.latitude && l.longitude) {
            const lat = parseFloat(l.latitude);
            const lng = parseFloat(l.longitude);
            bounds.push([lat, lng]);
            
            const marker = L.marker([lat, lng]).addTo(markersLayer);
            marker.bindPopup(`
                <div style="font-family: 'Inter', sans-serif;">
                    <h6 class="fw-bold mb-1">${l.nama_lahan || '-'}</h6>
                    <p class="text-muted mb-2 fs-7">Petani: ${l.petani ? l.petani.nama : '-'}</p>
                    <button onclick="showLandDetail(${l.id})" class="btn btn-success btn-sm w-100 rounded-pill py-1 fs-8 text-white">Lihat Detail</button>
                </div>
            `);
        }
    });
    
    // Fit map bounds if there are markers
    if (bounds.length > 0) {
        map.fitBounds(bounds, { padding: [50, 50], maxZoom: 15 });
    }
}

function showLandDetail(id) {
    const modalElement = document.getElementById('landDetailModal');
    let modal = bootstrap.Modal.getInstance(modalElement);
    if (!modal) {
        modal = new bootstrap.Modal(modalElement);
    }
    const contentContainer = document.getElementById('modalBodyContent');
    
    contentContainer.innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `;
    modal.show();
    
    // Fetch details via proxy (same-origin, no CORS), fallback ke API langsung
    loadDetail(`api-proxy.php?endpoint=/lahan/${id}`)
        .catch(() => loadDetail(`${apiBaseUrl}/lahan/${id}`))
        .then(res => {
            const data = res.data || res;
            let badgeColor = 'bg-secondary';
            if (data.status_fase === 'persiapan') badgeColor = 'bg-warning text-dark';
            else if (data.status_fase === 'tanam') badgeColor = 'bg-info text-dark';
            else if (data.status_fase === 'pemeliharaan') badgeColor = 'bg-success';
            else if (data.status_fase === 'panen') badgeColor = 'bg-success';
            
            let kunjunganHtml = '';
            if (data.kunjungan_lahans && data.kunjungan_lahans.length > 0) {
                data.kunjungan_lahans.forEach(k => {
                    let kBadge = 'bg-success text-white';
                    if (k.kondisi_lahan === 'cukup') kBadge = 'bg-warning text-dark';
                    else if (k.kondisi_lahan === 'buruk') kBadge = 'bg-danger text-white';
                    
                    let tlBadge = 'bg-success text-white';
                    if (k.status_tindak_lanjut === 'perlu_pemantauan') tlBadge = 'bg-warning text-dark';
                    else if (k.status_tindak_lanjut === 'perlu_tindakan') tlBadge = 'bg-danger text-white';
                    
                    let imageHtml = '';
                    if (k.foto) {
                        let cleanFotoUrl = k.foto;
                        if (!cleanFotoUrl.startsWith('http')) {
                            cleanFotoUrl = `<?= BACKEND_URL ?>/${cleanFotoUrl}`;
                        }
                        imageHtml = `
                            <div class="mt-2">
                                <a href="${cleanFotoUrl}" target="_blank">
                                    <img src="${cleanFotoUrl}" class="rounded shadow-sm" style="max-height: 120px; object-fit: cover;">
                                </a>
                            </div>
                        `;
                    }
                    
                    const kDate = new Date(k.tanggal_kunjungan).toLocaleDateString('id-ID', {
                        day: 'numeric', month: 'short', year: 'numeric'
                    });
                    
                    kunjunganHtml += `
                        <div class="p-3 border border-secondary-subtle border-opacity-10 rounded-3 mb-2 bg-light bg-opacity-50">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold fs-7 text-dark">${kDate}</span>
                                <div>
                                    <span class="badge ${kBadge} text-capitalize fs-8">${k.kondisi_lahan}</span>
                                    <span class="badge ${tlBadge} text-capitalize fs-8">${k.status_tindak_lanjut.replace('_', ' ')}</span>
                                </div>
                            </div>
                            <p class="mb-1 text-muted fs-7" style="line-height:1.4;">${k.catatan_lapangan || 'Tidak ada catatan.'}</p>
                            <small class="text-muted d-block fs-8"><i class="bi bi-person me-1"></i>Petugas: ${k.petugas || 'Tidak diketahui'}</small>
                            ${imageHtml}
                        </div>
                    `;
                });
            } else {
                kunjunganHtml = `<div class="text-center py-4 text-muted fs-7">Belum ada riwayat kunjungan.</div>`;
            }
            
            contentContainer.innerHTML = `
                <div class="row g-4">
                    <div class="col-md-5">
                        <div class="p-3 border border-secondary-subtle border-opacity-10 rounded-3 h-100 bg-light bg-opacity-25">
                            <h6 class="fw-bold mb-3 dark-heading" style="font-size:0.95rem;">Informasi Lahan</h6>
                            <table class="table table-sm table-borderless m-0 fs-7">
                                <tr>
                                    <td class="text-muted py-1 ps-0" width="100">Nama Lahan</td>
                                    <td class="fw-semibold text-dark py-1 pe-0">${data.nama_lahan}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted py-1 ps-0">Petani</td>
                                    <td class="fw-semibold text-dark py-1 pe-0">${data.petani ? data.petani.nama : '-'}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted py-1 ps-0">Kecamatan</td>
                                    <td class="fw-semibold text-dark py-1 pe-0">${data.petani && data.petani.kecamatan ? data.petani.kecamatan : '-'}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted py-1 ps-0">Komoditas</td>
                                    <td class="fw-semibold py-1 pe-0 text-success text-capitalize">${data.komoditas}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted py-1 ps-0">Luas Lahan</td>
                                    <td class="fw-semibold text-dark py-1 pe-0">${data.luas_lahan} Ha</td>
                                </tr>
                                <tr>
                                    <td class="text-muted py-1 ps-0">Fase Tanam</td>
                                    <td class="py-1 pe-0"><span class="badge ${badgeColor} text-capitalize">${data.status_fase}</span></td>
                                </tr>
                                <tr>
                                    <td class="text-muted py-1 ps-0">Koordinat</td>
                                    <td class="fw-semibold text-dark py-1 pe-0">${data.latitude || '-'}, ${data.longitude || '-'}</td>
                                </tr>
                            </table>
                            ${data.google_maps_link ? `
                                <a href="${data.google_maps_link}" target="_blank" class="btn btn-outline-success btn-sm w-100 mt-4 rounded-pill">
                                    <i class="bi bi-map me-1"></i> Buka Google Maps
                                </a>
                            ` : ''}
                        </div>
                    </div>
                    <div class="col-md-7">
                        <h6 class="fw-bold mb-3 dark-heading" style="font-size:0.95rem;">Riwayat Kunjungan Petugas</h6>
                        <div class="overflow-y-auto pe-1" style="max-height: 280px;">
                            ${kunjunganHtml}
                        </div>
                    </div>
                </div>
            `;
        })
        .catch(err => {
            contentContainer.innerHTML = `<div class="text-danger py-4 text-center">Gagal memuat detail lahan.</div>`;
        });
}
</script>

<?php require_once 'includes/footer.php'; ?>