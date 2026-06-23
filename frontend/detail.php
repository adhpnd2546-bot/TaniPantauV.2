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

$id = $_GET['id'] ?? null;
if (!$id || !ctype_digit($id)) {
    echo "<div class='container mt-5'><div class='alert alert-danger border-0'><i class='bi bi-exclamation-triangle-fill me-2'></i>ID Lahan tidak valid! <a href='index.php' class='alert-link'>Kembali</a></div></div>";
    require_once 'includes/footer.php'; exit;
}

$lahan = apiGet('/lahan/' . $id);

if (empty($lahan) || !isset($lahan['id'])) {
    echo "<div class='container mt-5'><div class='card p-5 text-center'><i class='bi bi-inbox text-muted' style='font-size:3rem'></i><h5 class='fw-bold mt-3'>Lahan tidak ditemukan</h5><a href='index.php' class='btn btn-primary mt-3'>Kembali</a></div></div>";
    require_once 'includes/footer.php'; exit;
}

$hasLocation = !empty($lahan['latitude']) && !empty($lahan['longitude']);

$landVisits = [];
if (!empty($lahan['kunjungan_lahans']) && is_array($lahan['kunjungan_lahans'])) {
    $landVisits = $lahan['kunjungan_lahans'];
} else {
    $allVisits = apiGet('/kunjungan');
    if (is_array($allVisits)) foreach ($allVisits as $v) {
        if (($v['lahan_id'] ?? 0) == $lahan['id']) $landVisits[] = $v;
    }
}
usort($landVisits, fn($a, $b) => strtotime($b['tanggal_kunjungan'] ?? 0) - strtotime($a['tanggal_kunjungan'] ?? 0));

$faseColors = ['persiapan'=>'badge-persiapan','tanam'=>'badge-tanam','pemeliharaan'=>'badge-pemeliharaan','panen'=>'badge-panen'];
function stBadge($s) { return match(true) { $s==='aman' => 'bg-success', $s==='perlu_pemantauan' => 'bg-warning text-dark', $s==='perlu_tindakan' => 'bg-danger', default => 'bg-secondary' }; }
function stLabel($s) { return match(true) { $s==='aman' => 'Aman', $s==='perlu_pemantauan' => 'Pantau', $s==='perlu_tindakan' => 'Tindakan', default => ucfirst($s) }; }
?>
<div class="container py-4">
    <a href="index.php" class="btn btn-soft btn-sm mb-4">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>

    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="detail-card h-100">
                <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
                    <div>
                        <h4 class="fw-bold mb-2"><?= htmlspecialchars($lahan['nama_lahan']) ?></h4>
                        <?php if (!empty($lahan['belum_dikunjungi'])): ?>
                            <span class="badge bg-danger d-inline-flex align-items-center gap-1"><i class="bi bi-exclamation-circle"></i> Belum pernah dikunjungi</span>
                        <?php endif; ?>
                    </div>
                    <span class="fase-badge <?= $faseColors[strtolower($lahan['status_fase'] ?? '')] ?? 'bg-secondary' ?>">
                        <?= htmlspecialchars($lahan['status_fase'] ?? '-') ?>
                    </span>
                </div>
                <div class="row g-2 mb-4">
                    <div class="col-4"><div class="info-chip"><div class="chip-label">Komoditas</div><div class="chip-value text-capitalize"><?= htmlspecialchars($lahan['komoditas'] ?? '-') ?></div></div></div>
                    <div class="col-4"><div class="info-chip"><div class="chip-label">Luas</div><div class="chip-value"><?= htmlspecialchars($lahan['luas_lahan'] ?? '-') ?> Ha</div></div></div>
                    <div class="col-4"><div class="info-chip"><div class="chip-label">Tanam</div><div class="chip-value"><?= !empty($lahan['tanggal_tanam']) ? date('d M Y', strtotime($lahan['tanggal_tanam'])) : '-' ?></div></div></div>
                </div>
                <hr class="my-3">
                <h5 class="fw-bold mb-3 d-flex align-items-center gap-2"><i class="bi bi-person-fill text-primary"></i>Data Petani</h5>
                <div class="row g-2">
                    <div class="col-sm-6"><span class="text-muted" style="font-size:0.8125rem;">Nama</span><div class="fw-semibold text-dark"><?= htmlspecialchars($lahan['petani']['nama'] ?? '-') ?></div></div>
                    <div class="col-sm-6"><span class="text-muted" style="font-size:0.8125rem;">Kecamatan</span><div class="fw-semibold text-dark"><?= htmlspecialchars($lahan['petani']['kecamatan'] ?? '-') ?></div></div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="detail-card h-100">
                <h5 class="fw-bold mb-3 d-flex align-items-center gap-2"><i class="bi bi-geo-alt-fill text-primary"></i>Lokasi</h5>
                <?php if ($hasLocation): ?>
                    <div id="map" class="rounded-3 mb-3" style="height:180px;border:1px solid var(--border);"></div>
                    <div class="info-chip"><div class="chip-label">Koordinat</div><div class="chip-value" style="font-size:0.8125rem;"><?= number_format((float)$lahan['latitude'],6) ?>, <?= number_format((float)$lahan['longitude'],6) ?></div></div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var lat = <?= json_encode((float)$lahan['latitude']) ?>, lng = <?= json_encode((float)$lahan['longitude']) ?>;
                            var map = L.map('map', { zoomControl: false, scrollWheelZoom: false }).setView([lat, lng], 14);
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy;' }).addTo(map);
                            L.marker([lat, lng]).addTo(map).bindPopup("<b><?= htmlspecialchars($lahan['nama_lahan']) ?></b>");
                        });
                    </script>
                <?php else: ?>
                    <div class="text-center py-4 bg-light rounded-3"><i class="bi bi-map text-muted" style="font-size:2rem;"></i><p class="text-muted small mt-2 mb-0">Koordinat tidak tersedia</p></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="detail-card mb-4">
        <h4 class="fw-bold mb-0 d-flex align-items-center gap-2"><i class="bi bi-journal-text text-primary"></i>Riwayat Kunjungan</h4>
        <hr class="my-3">
        <?php if (empty($landVisits)): ?>
            <div class="text-center py-5"><i class="bi bi-clock-history text-muted" style="font-size:2.5rem;"></i><p class="text-muted mt-2 mb-0">Belum ada riwayat kunjungan untuk lahan ini.</p></div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table">
                    <thead><tr>
                        <th>Tanggal</th><th>Petugas</th><th>Kondisi</th><th>Catatan</th><th>Foto</th><th>Status</th>
                    </tr></thead>
                    <tbody>
                        <?php foreach ($landVisits as $v): ?>
                        <tr>
                            <td class="fw-semibold text-dark text-nowrap"><?= date('d M Y', strtotime($v['tanggal_kunjungan'] ?? '')) ?></td>
                            <td><i class="bi bi-person-fill text-muted me-1"></i><?= htmlspecialchars($v['petugas'] ?? 'Sistem') ?></td>
                            <td class="text-capitalize"><?= htmlspecialchars($v['kondisi_lahan'] ?? '-') ?></td>
                            <td style="max-width:180px;"><span class="d-inline-block text-truncate w-100"><?= htmlspecialchars($v['catatan_lapangan'] ?? '-') ?></span></td>
                            <td><?php if (!empty($v['foto'])): ?><a href="<?= htmlspecialchars($v['foto']) ?>" target="_blank"><img src="<?= htmlspecialchars($v['foto']) ?>" alt="" class="rounded" style="width:44px;height:44px;object-fit:cover;border:1px solid var(--border);"></a><?php else: ?><span class="text-muted">-</span><?php endif; ?></td>
                            <td><span class="badge-sm <?= stBadge(strtolower($v['status_tindak_lanjut'] ?? '')) ?>"><?= stLabel(strtolower($v['status_tindak_lanjut'] ?? '')) ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>
