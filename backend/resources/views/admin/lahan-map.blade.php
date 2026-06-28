@extends('layouts.app')

@section('title', 'Peta Lahan - TaniPantau')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #mapAdmin { height: 600px; border-radius: 0.5rem; z-index: 0; }
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
                <a href="{{ route('admin.lahan.index') }}" class="border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[14px] text-heading dark:text-dark-heading bg-white dark:bg-dark-card hover:bg-slate-50 dark:hover:bg-dark-border/30 transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">list</span>
                    Tabel
                </a>
                <a href="{{ route('admin.lahan.create') }}" class="bg-primary hover:bg-primary-hover text-white text-[14px] font-medium py-2 px-4 rounded-[0.375rem] flex items-center gap-2 transition-all shadow-primary">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Lahan
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-9">
                <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card">
                    <div class="p-4">
                        <div id="mapAdmin"></div>
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

    {{-- Assign Modal --}}
    <div id="assignModal" class="fixed inset-0 z-[100] flex items-center justify-center hidden bg-black/40">
        <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <div class="px-6 py-4 border-b border-border dark:border-dark-border flex items-center justify-between">
                <h5 class="text-[16px] font-semibold text-heading dark:text-dark-heading m-0">Assign Petugas</h5>
                <button onclick="closeAssignModal()" class="text-muted dark:text-dark-muted hover:text-heading transition-colors p-1">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
            <form id="assignForm" class="p-6">
                <input type="hidden" name="lahan_id" id="assignLahanId">
                <div class="mb-4">
                    <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5 block">Lahan</label>
                    <p id="assignLahanName" class="text-[15px] text-body dark:text-dark-body m-0 font-medium"></p>
                </div>
                <div class="mb-6">
                    <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5 block" for="assignPetugasId">Petugas Lapang</label>
                    <select id="assignPetugasId" name="petugas_id" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card">
                        <option value="">-- Tidak ditugaskan --</option>
                        @foreach($petugas as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center gap-3 justify-end">
                    <button type="button" onclick="closeAssignModal()" class="px-4 py-2 border border-border dark:border-dark-border rounded-[0.375rem] text-[14px] text-heading dark:text-dark-heading hover:bg-slate-50 dark:hover:bg-dark-border/30 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-primary hover:bg-primary-hover text-white rounded-[0.375rem] text-[14px] font-medium transition-all shadow-primary flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">save</span>
                        Simpan
                    </button>
                </div>
            </form>
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
        const markerMap = {};

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
            const map = L.map('mapAdmin').setView([lahanWithCoords[0].latitude, lahanWithCoords[0].longitude], 11);

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
                marker.lahanId = l.id;
                marker.petugasId = petugasId;
                markers.push(marker);
                markerMap[l.id] = marker;

                const petugasName = l.petugas ? l.petugas.name : 'Belum ditugaskan';
                marker.bindPopup(
                    '<div style="min-width:200px;">' +
                    '<b style="font-size:15px;">' + l.nama_lahan + '</b><br>' +
                    '<span style="font-size:13px;color:#64748b;">' + (l.petani ? l.petani.nama_petani : '-') + '</span><br>' +
                    '<span style="font-size:13px;">Fase: <b>' + l.status_fase.charAt(0).toUpperCase() + l.status_fase.slice(1) + '</b></span><br>' +
                    '<span style="font-size:13px;">Petugas: <b>' + petugasName + '</b></span><br><br>' +
                    '<div style="display:flex;gap:6px;">' +
                    '<a href="{{ url('admin/lahan') }}/' + l.id + '" style="flex:1;text-align:center;padding:6px 12px;background:#16A34A;color:#fff;border-radius:6px;font-size:13px;text-decoration:none;font-weight:500;">Detail</a>' +
                    '<button onclick="openAssignModal(' + l.id + ',\'' + l.nama_lahan.replace(/'/g, "\\'") + '\',' + (l.petugas_id || 'null') + ')" style="flex:1;text-align:center;padding:6px 12px;background:#f1f5f9;color:#1e293b;border:1px solid #e2e8f0;border-radius:6px;font-size:13px;cursor:pointer;font-weight:500;">Assign</button>' +
                    '</div>' +
                    '</div>'
                );
            });

            if (lahanWithCoords.length > 1) {
                const group = L.featureGroup(lahanWithCoords.map(l => L.marker([l.latitude, l.longitude])));
                map.fitBounds(group.getBounds().pad(0.15));
            }

            // Filter petugas
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
            document.getElementById('mapAdmin').innerHTML =
                '<div class="flex items-center justify-center h-full text-muted dark:text-dark-muted">Tidak ada data koordinat lahan.</div>';
        }
    });

    function openAssignModal(lahanId, lahanName, currentPetugasId) {
        document.getElementById('assignLahanId').value = lahanId;
        document.getElementById('assignLahanName').textContent = lahanName;
        document.getElementById('assignPetugasId').value = currentPetugasId || '';
        document.getElementById('assignModal').classList.remove('hidden');
    }

    function closeAssignModal() {
        document.getElementById('assignModal').classList.add('hidden');
    }

    document.getElementById('assignForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);

        fetch('{{ route('admin.lahan.assign') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                closeAssignModal();
                location.reload();
            }
        });
    });

    document.getElementById('assignModal').addEventListener('click', function(e) {
        if (e.target === this) closeAssignModal();
    });
</script>
@endpush