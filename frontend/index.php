<?php
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

require_once 'includes/api.php';
require_once 'includes/auth.php';

if (!isLoggedIn() || getUserRole() !== 'manajer') {
    header('Location: login.php');
    exit;
}

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

$filterKomoditas = $_GET['komoditas'] ?? '';
$filterFase = $_GET['status_fase'] ?? '';
$filterKecamatan = $_GET['kecamatan'] ?? '';
$filterBelumDikunjungi = $_GET['belum_dikunjungi'] ?? '';

$apiUrl = '/lahan?per_page=9999';
$params = [];
if ($filterKomoditas) $params[] = 'komoditas=' . urlencode($filterKomoditas);
if ($filterFase) $params[] = 'status_fase=' . urlencode($filterFase);
if ($filterKecamatan) $params[] = 'kecamatan=' . urlencode($filterKecamatan);
if (count($params)) $apiUrl .= '&' . implode('&', $params);

$apiResponse = apiGet($apiUrl);
$allLahan = [];
if (is_array($apiResponse)) {
    $allLahan = isset($apiResponse['data']) ? $apiResponse['data'] : $apiResponse;
}
if (!is_array($allLahan)) $allLahan = [];

if ($filterBelumDikunjungi === '1') {
    $allLahan = array_filter($allLahan, fn($l) => !empty($l['belum_dikunjungi']));
}

$commoditiesCount = [];
$statusCount = [];
foreach ($allLahan as $l) {
    if (!empty($l['komoditas'])) $commoditiesCount[$l['komoditas']] = ($commoditiesCount[$l['komoditas']] ?? 0) + 1;
    if (!empty($l['status_fase'])) $statusCount[ucfirst($l['status_fase'])] = ($statusCount[ucfirst($l['status_fase'])] ?? 0) + 1;
}
arsort($commoditiesCount); arsort($statusCount);
$maxCom = !empty($commoditiesCount) ? max($commoditiesCount) : 1;
$maxSt = !empty($statusCount) ? max($statusCount) : 1;

$searchQuery = $_GET['search'] ?? '';
$filteredLahan = $allLahan;
if (!empty($searchQuery)) {
    $searchLower = strtolower($searchQuery);
    $filteredLahan = array_filter($allLahan, fn($l) =>
        strpos(strtolower($l['nama_lahan'] ?? ''), $searchLower) !== false ||
        strpos(strtolower($l['petani']['nama'] ?? ''), $searchLower) !== false ||
        strpos(strtolower($l['petani']['kecamatan'] ?? ''), $searchLower) !== false
    );
}
$isSearching = !empty($searchQuery);
$searchCount = count($filteredLahan);

$perPage = 10;
$totalFiltered = count($filteredLahan);
$totalPages = max(1, ceil($totalFiltered / $perPage));
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
if ($page > $totalPages) $page = $totalPages;
$pagedLahan = array_slice($filteredLahan, ($page - 1) * $perPage, $perPage);

function faseColor($s) { return match(strtolower($s)) { 'persiapan' => 'badge-persiapan', 'tanam' => 'badge-tanam', 'pemeliharaan' => 'badge-pemeliharaan', 'panen' => 'badge-panen', default => 'badge-persiapan' }; }
function stBadge($s) { return match(true) { $s==='aman' => 'badge-aman', $s==='perlu_pemantauan' => 'badge-pantau', $s==='perlu_tindakan' => 'badge-tindakan', default => 'badge-secondary' }; }
function stLabel($s) { return match(true) { $s==='aman' => 'Aman', $s==='perlu_pemantauan' => 'Pantau', $s==='perlu_tindakan' => 'Tindakan', default => ucfirst($s) }; }
?>
<div class="hero-wrap text-white text-center">
    <div class="container">
        <div class="hero-icon"><span class="material-symbols-outlined" style="font-variation-settings:'FILL'1;font-size:48px;color:#22c55e;">eco</span></div>
        <h1 class="text-white fw-bold mb-2" style="font-size: 2.75rem;letter-spacing:-0.03em;">Tani<span style="display:inline-block;background:#22c55e;color:white;padding:2px 12px;border-radius:6px;margin-left:4px;">Pantau</span></h1>
        <p class="text-white/80 mb-5 mx-auto" style="max-width: 520px; font-size: 1.1rem;">Dashboard Monitoring Lahan Pertanian dan Kunjungan Petugas Lapangan</p>
        <a href="#statistik" class="btn btn-light rounded-pill px-5 fw-bold text-primary">
            <i class="bi bi-arrow-down me-2"></i> Lihat Ringkasan
        </a>
    </div>
</div>

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
                    <div class="stat-icon" style="background:#fee2e2;color:#dc2626;"><i class="bi bi-exclamation-triangle-fill"></i></div>
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
                    <h5 class="fw-bold mb-4 d-flex align-items-center gap-2"><i class="bi bi-bar-chart-fill text-primary"></i>Komoditas</h5>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach (array_slice($commoditiesCount, 0, 5) as $name => $count): ?>
                        <div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-semibold text-dark" style="font-size:0.875rem;"><?= htmlspecialchars(ucfirst($name)) ?></span>
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
                    <h5 class="fw-bold mb-4 d-flex align-items-center gap-2"><i class="bi bi-pie-chart-fill text-primary"></i>Status Fase</h5>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach (array_slice($statusCount, 0, 5) as $name => $count): ?>
                        <div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-semibold text-dark" style="font-size:0.875rem;"><?= htmlspecialchars($name) ?></span>
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
</section>
<?php endif; ?>

<section id="data-lahan" class="pt-0">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold m-0 d-flex align-items-center gap-2"><i class="bi bi-view-list text-primary"></i>Daftar Lahan</h3>
            <span class="text-muted" style="font-size:0.8125rem;"><?= $totalFiltered ?> lahan</span>
        </div>

        <form method="GET" action="#data-lahan" class="filter-card mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-semibold" style="font-size:0.75rem;">CARI</label>
                    <input type="text" class="form-control form-control-sm" name="search" placeholder="Nama lahan / petani / desa..." value="<?= htmlspecialchars($searchQuery) ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold" style="font-size:0.75rem;">KOMODITAS</label>
                    <select name="komoditas" class="form-select form-select-sm">
                        <option value="">Semua</option>
                        <option value="padi" <?= $filterKomoditas === 'padi' ? 'selected' : '' ?>>Padi</option>
                        <option value="jagung" <?= $filterKomoditas === 'jagung' ? 'selected' : '' ?>>Jagung</option>
                        <option value="hortikultura" <?= $filterKomoditas === 'hortikultura' ? 'selected' : '' ?>>Hortikultura</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold" style="font-size:0.75rem;">FASE</label>
                    <select name="status_fase" class="form-select form-select-sm">
                        <option value="">Semua</option>
                        <option value="persiapan" <?= $filterFase === 'persiapan' ? 'selected' : '' ?>>Persiapan</option>
                        <option value="tanam" <?= $filterFase === 'tanam' ? 'selected' : '' ?>>Tanam</option>
                        <option value="pemeliharaan" <?= $filterFase === 'pemeliharaan' ? 'selected' : '' ?>>Pemeliharaan</option>
                        <option value="panen" <?= $filterFase === 'panen' ? 'selected' : '' ?>>Panen</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold" style="font-size:0.75rem;">KECAMATAN</label>
                    <select name="kecamatan" class="form-select form-select-sm">
                        <option value="">Semua</option>
                        <?php foreach ($kecamatanList as $k): ?>
                            <option value="<?= $k['id'] ?>" <?= $filterKecamatan == $k['id'] ? 'selected' : '' ?>><?= htmlspecialchars($k['nama']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="belum_dikunjungi" value="1" id="filterBlm" <?= $filterBelumDikunjungi === '1' ? 'checked' : '' ?>>
                            <label class="form-check-label fw-semibold" for="filterBlm" style="font-size:0.8125rem;">Belum dikunjungi</label>
                        </div>
                        <button class="btn btn-primary btn-sm flex-shrink-0" type="submit"><i class="bi bi-funnel me-1"></i> Filter</button>
                        <a href="index.php#data-lahan" class="btn btn-outline-secondary btn-sm flex-shrink-0"><i class="bi bi-x-lg"></i></a>
                    </div>
                </div>
            </div>
        </form>

        <?php if ($isSearching): ?>
        <div class="alert alert-info border-0 d-flex align-items-center gap-2 py-2 px-4" style="border-radius:8px;font-size:0.875rem;">
            <i class="bi bi-info-circle-fill"></i>
            <?php if ($searchCount > 0): ?>
                Ditemukan <strong><?= $searchCount ?></strong> data untuk "<strong><?= htmlspecialchars($searchQuery) ?></strong>".
            <?php else: ?>
                Tidak ditemukan data untuk "<strong><?= htmlspecialchars($searchQuery) ?></strong>".
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php if (empty($pagedLahan)): ?>
            <?php if (!$isSearching): ?>
            <div class="card p-5 text-center">
                <i class="bi bi-inbox text-muted" style="font-size:3rem;"></i>
                <h5 class="fw-bold mt-3">Belum ada data lahan</h5>
                <p class="text-muted mb-0">Data lahan akan muncul setelah diinput oleh Admin atau Petugas.</p>
            </div>
            <?php endif; ?>
        <?php else: ?>
        <div class="row g-3">
            <?php foreach ($pagedLahan as $l): ?>
            <div class="col-md-6 col-lg-4 fade-in">
                <div class="card-lahan h-100">
                    <div class="body">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <?php if (!empty($l['belum_dikunjungi'])): ?>
                                <span class="badge bg-danger" style="font-size:0.625rem;padding:2px 8px;"><i class="bi bi-exclamation-circle me-1"></i>Baru</span>
                            <?php endif; ?>
                            <span class="fase-badge <?= faseColor($l['status_fase'] ?? '') ?>"><?= htmlspecialchars($l['status_fase'] ?? '-') ?></span>
                        </div>
                        <h5 class="fw-bold mb-3" style="font-size:0.9375rem;color:#0f172a;line-height:1.3;"><?= htmlspecialchars($l['nama_lahan']) ?></h5>
                        <div style="display:flex;flex-direction:column;gap:5px;margin-bottom:16px;">
                            <div style="display:flex;align-items:center;gap:8px;font-size:0.8125rem;color:#475569;">
                                <i class="bi bi-person-fill" style="width:14px;text-align:center;color:#94a3b8;"></i>
                                <span><?= htmlspecialchars($l['petani']['nama'] ?? '-') ?></span>
                            </div>
                            <div style="display:flex;align-items:center;gap:8px;font-size:0.8125rem;color:#475569;">
                                <i class="bi bi-basket-fill" style="width:14px;text-align:center;color:#94a3b8;"></i>
                                <span><?= htmlspecialchars(ucfirst($l['komoditas'] ?? '-')) ?></span>
                            </div>
                            <div style="display:flex;align-items:center;gap:8px;font-size:0.8125rem;color:#475569;">
                                <i class="bi bi-box" style="width:14px;text-align:center;color:#94a3b8;"></i>
                                <span><?= htmlspecialchars($l['luas_lahan'] ?? '-') ?> Ha</span>
                            </div>
                        </div>
                        <a href="detail.php?id=<?= $l['id'] ?>" class="btn btn-outline-primary w-100" style="padding:7px 12px;font-size:0.8125rem;border-radius:6px;">
                            Detail <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if ($totalPages > 1): ?>
        <nav class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>#data-lahan"><i class="bi bi-chevron-left"></i></a>
                </li>
                <?php
                $rangeStart = max(1, $page - 2);
                $rangeEnd = min($totalPages, $page + 2);
                if ($rangeStart > 1): ?>
                <li class="page-item"><a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => 1])) ?>#data-lahan">1</a></li>
                <?php if ($rangeStart > 2): ?><li class="page-item disabled"><span class="page-link">...</span></li><?php endif; ?>
                <?php endif; ?>
                <?php for ($i = $rangeStart; $i <= $rangeEnd; $i++): ?>
                <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                    <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>#data-lahan"><?= $i ?></a>
                </li>
                <?php endfor; ?>
                <?php if ($rangeEnd < $totalPages): ?>
                <?php if ($rangeEnd < $totalPages - 1): ?><li class="page-item disabled"><span class="page-link">...</span></li><?php endif; ?>
                <li class="page-item"><a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $totalPages])) ?>#data-lahan"><?= $totalPages ?></a></li>
                <?php endif; ?>
                <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>#data-lahan"><i class="bi bi-chevron-right"></i></a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<?php
$kunjungan = apiGet('/kunjungan');
$kunjungan = is_array($kunjungan) ? array_slice($kunjungan, 0, 5) : [];
if (!empty($kunjungan)):
?>
<section id="kunjungan" class="pt-0">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="fw-bold m-0 d-flex align-items-center gap-2"><i class="bi bi-clock-history text-primary"></i>Kunjungan Terbaru</h3>
            <span class="text-muted" style="font-size:0.8125rem;"><?= count($kunjungan) ?> kunjungan</span>
        </div>
        <div class="row g-3">
            <?php
            $kondisiIcon = ['baik'=>'bi-emoji-smile','cukup'=>'bi-emoji-neutral','buruk'=>'bi-emoji-frown'];
            $kondisiColor = ['baik'=>'#16a34a','cukup'=>'#d97706','buruk'=>'#dc2626'];
            ?>
            <?php foreach ($kunjungan as $v): ?>
            <div class="col-md-6 col-lg-4 fade-in">
                <a href="detail.php?id=<?= $v['lahan_id'] ?>" class="text-decoration-none">
                    <div class="card-visit h-100">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <span class="visit-date">
                                    <span class="day"><?= date('d', strtotime($v['tanggal_kunjungan'] ?? '')) ?></span>
                                    <span class="month"><?= date('M', strtotime($v['tanggal_kunjungan'] ?? '')) ?></span>
                                </span>
                                <div>
                                    <div class="fw-bold text-dark" style="font-size:0.9375rem;"><?= htmlspecialchars($v['nama_lahan'] ?? '-') ?></div>
                                    <div class="text-muted" style="font-size:0.75rem;"><i class="bi bi-person-fill me-1"></i><?= htmlspecialchars($v['petugas'] ?? '-') ?></div>
                                </div>
                            </div>
                            <span class="badge-sm <?= stBadge(strtolower($v['status_tindak_lanjut'] ?? '')) ?>"><?= stLabel(strtolower($v['status_tindak_lanjut'] ?? '')) ?></span>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="kondisi-badge" style="background:<?= $kondisiColor[strtolower($v['kondisi_lahan'] ?? '')] ?? '#64748b' ?>10;color:<?= $kondisiColor[strtolower($v['kondisi_lahan'] ?? '')] ?? '#64748b' ?>;border-color:<?= $kondisiColor[strtolower($v['kondisi_lahan'] ?? '')] ?? '#64748b' ?>30;">
                                <i class="bi <?= $kondisiIcon[strtolower($v['kondisi_lahan'] ?? '')] ?? 'bi-dash' ?> me-1"></i>
                                <?= htmlspecialchars(ucfirst($v['kondisi_lahan'] ?? '-')) ?>
                            </span>
                            <?php if (!empty($v['catatan_lapangan'])): ?>
                            <span class="text-muted" style="font-size:0.75rem;"><i class="bi bi-chat-dots me-1"></i>Ada catatan</span>
                            <?php endif; ?>
                            <?php if (!empty($v['foto'])): ?>
                            <span class="text-muted" style="font-size:0.75rem;"><i class="bi bi-camera me-1"></i>Ada foto</span>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($v['catatan_lapangan'])): ?>
                        <div class="visit-note"><?= htmlspecialchars($v['catatan_lapangan']) ?></div>
                        <?php endif; ?>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="index.php#data-lahan" class="btn btn-soft btn-sm"><i class="bi bi-arrow-right me-1"></i> Lihat Semua Lahan</a>
        </div>
    </div>
</section>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>
