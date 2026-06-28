@extends('layouts.app')

@section('title', 'Peta Lahan - TaniPantau')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #mapManajer { height: 600px; border-radius: 0.5rem; z-index: 0; }
    .petugas-marker { border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 12px; border: 2px solid #fff; box-shadow: 0 2px 6px rgba(0,0,0,0.2); color: #fff; }
    .legend-item { display: flex; align-items: center; gap: 8px; padding: 4px 0; font-size: 13px; }
    .legend-color { width: 14px; height: 14px; border-radius: 50%; flex-shrink: 0; }
</style>
@endpush

@section('content')
    <div class="flex flex-col gap-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-[1.5rem] font-bold text-heading dark:text-dark-heading m-0">Peta Sebaran Lahan</h1>
                <p class="text-[0.9375rem] text-muted dark:text-dark-muted m-0 mt-1">Visualisasi sebaran lahan berdasarkan petugas lapang.</p>
            </div>
            <div class="flex items-center gap-3">
                <select id="filterPetugas" class="border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[14px] text-heading dark:text-dark-heading bg-white dark:bg-dark-card appearance-none focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all" style="background-image:url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 12 12%22><path fill=%22%2364748b%22 d=%22M6 8L1 3h10z%22/></svg>');background-repeat:no-repeat;background-position:right 10px center;padding-right:32px;min-width:180px;">
                    <option value="">Semua Petugas</option>
                    @foreach($petugas as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
                <a href="{{ route('manajer.lahan') }}" class="border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[14px] text-heading dark:text-dark-heading bg-white dark:bg-dark-card hover:bg-slate-50 dark:hover:bg-dark-border/30 transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">list</span>
                    Tabel
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-9">
                <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card">
                    <div class="p-4">
                        <div id="mapManajer"></div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-3">
                <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card">
                    <div class="px-5 py-4 border-b border-border dark:border-dark-border">
                        <h5 class="text-[15px] font-medium text-heading dark:text-dark-heading m-0">Legenda Petugas</h5>
                    </div>
                    <div class="p-5" id="legendContainer">
                        @php
                            $colors = ['#16A34A', '#2563EB', '#DC2626', '#D97706', '#7C3AED', '#0891B2', '#DB2777', '#65A30D'];
                        @endphp
                        @forelse($petugas as $i => $p)
                            <div class="legend-item" data-petugas-id="{{ $p->id }}">
                                <div class="legend-color" style="background:{{ $colors[$i % count($colors)] }}"></div>
                                <span>{{ $p->name }}</span>
                                <span class="text-[12px] text-muted dark:text-dark-muted ml-auto" id="count-{{ $p->id }}"></span>
                            </div>
                        @empty
                            <p class="text-muted dark:text-dark-muted text-[13px]">Belum ada petugas.</p>
                        @endforelse
                        <div class="legend-item border-t border-border dark:border-dark-border mt-3 pt-3">
                            <div class="legend-color" style="background:#94A3B8"></div>
                            <span class="text-muted dark:text-dark-muted">Belum ditugaskan</span>
                            <span class="text-[12px] text-muted dark:text-dark-muted ml-auto" id="count-unassigned"></span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card mt-6">
                    <div class="px-5 py-4 border-b border-border dark:border-dark-border">
                        <h5 class="text-[15px] font-medium text-heading dark:text-dark-heading m-0">Ringkasan</h5>
                    </div>
                    <div class="p-5 space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-[13px] text-body dark:text-dark-body">Total Lahan</span>
                            <span class="text-[15px] font-semibold text-heading dark:text-dark-heading">{{ $lahan->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[13px] text-body dark:text-dark-body">Dengan Koordinat</span>
                            <span class="text-[15px] font-semibold text-heading dark:text-dark-heading">{{ $lahan->whereNotNull('latitude')->whereNotNull('longitude')->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[13px] text-body dark:text-dark-body">Ditugaskan</span>
                            <span class="text-[15px] font-semibold text-heading dark:text-dark-heading">{{ $lahan->whereNotNull('petugas_id')->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[13px] text-body dark:text-dark-body">Belum Ditugaskan</span>
                            <span class="text-[15px] font-semibold text-danger">{{ $lahan->whereNull('petugas_id')->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lahanData = @json($lahan);
        const petugasData = @json($petugas);
        const colors = ['#16A34A', '#2563EB', '#DC2626', '#D97706', '#7C3AED', '#0891B2', '#DB2777', '#65A30D'];
        const petugasColorMap = {};
        petugasData.forEach((p, i) => { petugasColorMap[p.id] = colors[i % colors.length]; });

        const lahanWithCoords = lahanData.filter(l => l.latitude && l.longitude);
        const markers = [];

        function updateCounts() {
            const counts = {};
            let unassigned = 0;
            lahanData.forEach(l => {
                const pid = l.petugas_id;
                if (pid) { counts[pid] = (counts[pid] || 0) + 1; }
                else { unassigned++; }
            });
            petugasData.forEach(p => {
                const el = document.getElementById('count-' + p.id);
                if (el) el.textContent = '(' + (counts[p.id] || 0) + ')';
            });
            const ua = document.getElementById('count-unassigned');
            if (ua) ua.textContent = '(' + unassigned + ')';
        }
        updateCounts();

        if (lahanWithCoords.length > 0) {
            const map = L.map('mapManajer').setView([lahanWithCoords[0].latitude, lahanWithCoords[0].longitude], 11);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            lahanWithCoords.forEach(function(l) {
                const petugasId = l.petugas_id;
                const color = petugasId && petugasColorMap[petugasId] ? petugasColorMap[petugasId] : '#94A3B8';

                const icon = L.divIcon({
                    className: '',
                    html: '<div class="petugas-marker" style="background:' + color + ';">'
                        + (l.komoditas === 'padi' ? '🌾' : l.komoditas === 'jagung' ? '🌽' : '🥬') + '</div>',
                    iconSize: [28, 28],
                    iconAnchor: [14, 14]
                });

                const marker = L.marker([l.latitude, l.longitude], { icon }).addTo(map);
                marker.petugasId = petugasId;
                markers.push(marker);

                const petugasName = l.petugas ? l.petugas.name : 'Belum ditugaskan';
                marker.bindPopup(
                    '<div style="min-width:180px;">' +
                    '<b style="font-size:15px;">' + l.nama_lahan + '</b><br>' +
                    '<span style="font-size:13px;color:#64748b;">' + (l.petani ? l.petani.nama_petani : '-') + '</span><br>' +
                    '<span style="font-size:13px;">Fase: <b>' + l.status_fase.charAt(0).toUpperCase() + l.status_fase.slice(1) + '</b></span><br>' +
                    '<span style="font-size:13px;">Petugas: <b>' + petugasName + '</b></span><br><br>' +
                    '<a href="https://www.google.com/maps?q=' + l.latitude + ',' + l.longitude + '" target="_blank" style="color:#16A34A;font-size:13px;">Buka Google Maps</a>' +
                    '</div>'
                );
            });

            if (lahanWithCoords.length > 1) {
                const group = L.featureGroup(lahanWithCoords.map(l => L.marker([l.latitude, l.longitude])));
                map.fitBounds(group.getBounds().pad(0.15));
            }

            document.getElementById('filterPetugas').addEventListener('change', function() {
                const val = this.value;
                markers.forEach(function(m) {
                    if (!val) {
                        map.addLayer(m);
                    } else {
                        if (m.petugasId == val) {
                            map.addLayer(m);
                        } else {
                            map.removeLayer(m);
                        }
                    }
                });
            });
        } else {
            document.getElementById('mapManajer').innerHTML =
                '<div class="flex items-center justify-center h-full text-muted dark:text-dark-muted">Tidak ada data koordinat lahan.</div>';
        }
    });
</script>
@endpush