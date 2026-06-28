@extends('layouts.app')

@section('title', 'Dashboard Petugas - TaniPantau')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #mapPetugas { height: 400px; border-radius: 0.5rem; z-index: 0; }
    .cluster-marker { background: var(--bs-primary, #16A34A); color: #fff; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 12px; border: 2px solid #fff; box-shadow: 0 2px 6px rgba(0,0,0,0.2); }
</style>
@endpush

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-6">
        <div class="md:col-span-12 lg:col-span-8">
            <div class="bg-primary text-white rounded-[0.5rem] shadow-primary relative overflow-hidden h-full">
                <div class="flex flex-col sm:flex-row items-center sm:items-stretch h-full">
                    <div class="p-6 sm:w-2/3 flex flex-col justify-center relative z-10">
                        <h5 class="text-[1.125rem] font-medium text-white mb-3">Selamat Datang, {{ auth()->user()->name }}! 🌾</h5>
                        <p class="text-[0.9375rem] mb-4 text-white/90 leading-relaxed">
                            Anda bertanggung jawab atas <span class="font-bold text-white">{{ $totalPetani }}</span> petani dengan <span class="font-bold text-white">{{ $totalLahan }}</span> lahan.
                            Catat kunjungan dan pantau perkembangan lahan binaan Anda.
                        </p>
                        <div>
                            <a href="{{ route('petugas.kunjungan.create') }}"
                                class="inline-block px-4 py-1.5 rounded-[0.375rem] bg-white dark:bg-dark-card text-primary text-[13px] font-semibold hover:bg-white/90 transition-all shadow-sm">Catat Kunjungan Baru</a>
                        </div>
                    </div>
                    <div class="sm:w-1/3 flex items-end justify-center sm:justify-end pb-0 sm:pr-6 mt-4 sm:mt-0 relative h-32 sm:h-auto pointer-events-none z-0">
                        <span class="material-symbols-outlined text-white/20 text-[120px] absolute -bottom-6 -right-6"
                            style="font-variation-settings: 'FILL' 1;">assignment</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:col-span-12 lg:col-span-4">
            <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-6 h-full flex flex-col justify-between relative overflow-hidden">
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <h6 class="text-[14px] font-semibold text-heading dark:text-dark-heading mb-1">Kunjungan Hari Ini</h6>
                        <p class="text-[12px] text-muted dark:text-dark-muted">Total kunjungan Anda</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-info/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-info text-[24px]" style="font-variation-settings: 'FILL' 1;">today</span>
                    </div>
                </div>
                <div class="mt-4 relative z-10">
                    <h3 class="text-[2.25rem] font-bold text-heading dark:text-dark-heading m-0 leading-tight">{{ $totalKunjungan }}</h3>
                    <p class="text-[13px] font-medium text-body dark:text-dark-body mt-1">
                        @if($totalKunjungHariIni > 0)
                            <span class="text-success">{{ $totalKunjungHariIni }} hari ini</span>
                        @else
                            Belum ada kunjungan hari ini
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-6">
        <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-[0.375rem] bg-success/10 text-success flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">groups</span>
                </div>
            </div>
            <span class="block text-[13px] font-medium text-heading dark:text-dark-heading mb-1">Petani Binaan</span>
            <h3 class="text-[1.5rem] font-semibold text-heading dark:text-dark-heading m-0">{{ $totalPetani }}</h3>
            <small class="text-success font-medium flex items-center gap-1 mt-1"><span class="material-symbols-outlined text-[14px]">circle</span> Binaan</small>
        </div>

        <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-[0.375rem] bg-info/10 text-info flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">landscape</span>
                </div>
            </div>
            <span class="block text-[13px] font-medium text-heading dark:text-dark-heading mb-1">Lahan Binaan</span>
            <h3 class="text-[1.5rem] font-semibold text-heading dark:text-dark-heading m-0">{{ $totalLahan }}</h3>
            <small class="text-info font-medium flex items-center gap-1 mt-1"><span class="material-symbols-outlined text-[14px]">circle</span> Tanggung jawab</small>
        </div>

        <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-[0.375rem] bg-primary/10 text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">assignment</span>
                </div>
            </div>
            <span class="block text-[13px] font-medium text-heading dark:text-dark-heading mb-1">Total Kunjungan</span>
            <h3 class="text-[1.5rem] font-semibold text-heading dark:text-dark-heading m-0">{{ $totalKunjungan }}</h3>
            <small class="text-success font-medium flex items-center gap-1 mt-1"><span class="material-symbols-outlined text-[14px]">circle</span> Tercatat</small>
        </div>

        <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-[0.375rem] bg-danger/10 text-danger flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">warning</span>
                </div>
            </div>
            <span class="block text-[13px] font-medium text-heading dark:text-dark-heading mb-1">Lahan Perlu Tindakan</span>
            <h3 class="text-[1.5rem] font-semibold text-heading dark:text-dark-heading m-0">{{ $lahanPerluTindakan }}</h3>
            <small class="text-danger font-medium flex items-center gap-1 mt-1"><span class="material-symbols-outlined text-[14px]">circle</span> Perlu perhatian</small>
        </div>

        <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-[0.375rem] bg-warning/10 text-warning flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">today</span>
                </div>
            </div>
            <span class="block text-[13px] font-medium text-heading dark:text-dark-heading mb-1">Kunjungan Hari Ini</span>
            <h3 class="text-[1.5rem] font-semibold text-heading dark:text-dark-heading m-0">{{ $totalKunjungHariIni }}</h3>
            <small class="text-warning font-medium flex items-center gap-1 mt-1"><span class="material-symbols-outlined text-[14px]">circle</span> {{ $totalKunjungHariIni > 0 ? 'Produktif' : 'Belum ada' }}</small>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6">
        <div class="lg:col-span-7">
            <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card">
                <div class="px-6 py-4 border-b border-border dark:border-dark-border">
                    <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading m-0">Peta Lahan Binaan</h5>
                </div>
                <div class="p-4">
                    <div id="mapPetugas"></div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5">
            <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card">
                <div class="px-6 py-4 border-b border-border dark:border-dark-border flex justify-between items-center">
                    <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading m-0">Petani Binaan</h5>
                    <span class="text-[12px] font-medium text-muted dark:text-dark-muted">{{ $totalPetani }} petani</span>
                </div>
                <div class="overflow-y-auto max-h-[400px]">
                    @forelse($petani as $p)
                    <div class="border-b border-border dark:border-dark-border">
                        <div class="px-6 py-3 bg-[#f9f9f9] dark:bg-dark-surface flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($p->nama_petani) }}&background=16A34A&color=fff&rounded=true" class="w-8 h-8 rounded-full" alt="">
                            <div class="flex-1 min-w-0">
                                <div class="font-medium text-heading dark:text-dark-heading text-[14px]">{{ $p->nama_petani }}</div>
                                <div class="text-[12px] text-muted dark:text-dark-muted">{{ $p->desa->nama ?? '-' }}, {{ $p->kecamatan->nama ?? '-' }} · {{ $p->lahan->count() }} lahan</div>
                            </div>
                        </div>
                        @foreach($p->lahan as $l)
                        <div class="px-6 py-2.5 pl-14 border-t border-border/50 dark:border-dark-border/50 hover:bg-slate-50 dark:hover:bg-dark-border/20 transition-colors flex items-center justify-between">
                            <div class="flex-1 min-w-0">
                                <div class="font-medium text-heading dark:text-dark-heading text-[13px] truncate">{{ $l->nama_lahan }}</div>
                                <div class="text-[11px] text-muted dark:text-dark-muted">
                                    {{ ucfirst($l->komoditas) }} · {{ number_format($l->luas_lahan, 1) }} Ha
                                    @if($l->latitude && $l->longitude)
                                        · <a href="https://www.google.com/maps?q={{ $l->latitude }},{{ $l->longitude }}" target="_blank" class="text-primary hover:underline">Buka Maps</a>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-2 ml-3 flex-shrink-0">
                                @php
                                    $faseColors = ['persiapan' => 'bg-secondary/10 text-secondary', 'tanam' => 'bg-info/10 text-info', 'pemeliharaan' => 'bg-warning/10 text-warning', 'panen' => 'bg-success/10 text-success'];
                                    $color = $faseColors[$l->status_fase] ?? 'bg-secondary/10 text-secondary';
                                @endphp
                                <span class="px-2 py-0.5 rounded-[0.25rem] {{ $color }} text-[11px] font-medium whitespace-nowrap">{{ ucfirst($l->status_fase) }}</span>
                                @if($l->kunjungan->count() === 0)
                                    <span class="px-2 py-0.5 rounded-[0.25rem] bg-danger/10 text-danger text-[11px] font-medium whitespace-nowrap">Baru</span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @empty
                    <div class="px-6 py-8 text-center text-muted dark:text-dark-muted">Belum ada petani yang ditugaskan.</div>
                    @endforelse
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
        const lahanWithCoords = lahanData.filter(l => l.latitude && l.longitude);

        if (lahanWithCoords.length > 0) {
            const map = L.map('mapPetugas').setView([lahanWithCoords[0].latitude, lahanWithCoords[0].longitude], 11);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            lahanWithCoords.forEach(function(l) {
                const faseColors = { persiapan: '#8592a3', tanam: '#03c3ec', pemeliharaan: '#e69a00', panen: '#56b82a' };
                const color = faseColors[l.status_fase] || '#8592a3';

                const icon = L.divIcon({
                    className: 'custom-marker',
                    html: '<div style="background:' + color + ';color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:12px;border:2px solid #fff;box-shadow:0 2px 6px rgba(0,0,0,0.2);">'
                        + (l.komoditas === 'padi' ? '🌾' : l.komoditas === 'jagung' ? '🌽' : '🥬') + '</div>',
                    iconSize: [28, 28],
                    iconAnchor: [14, 14]
                });

                const marker = L.marker([l.latitude, l.longitude], { icon }).addTo(map);
                marker.bindPopup(
                    '<b>' + l.nama_lahan + '</b><br>' +
                    (l.petani ? l.petani.nama_petani : '-') + '<br>' +
                    'Fase: <b>' + l.status_fase + '</b><br>' +
                    '<a href="https://www.google.com/maps?q=' + l.latitude + ',' + l.longitude + '" target="_blank" style="color:#16A34A;">Buka Google Maps</a>'
                );
            });

            if (lahanWithCoords.length > 1) {
                const group = L.featureGroup(lahanWithCoords.map(l => L.marker([l.latitude, l.longitude])));
                map.fitBounds(group.getBounds().pad(0.2));
            }
        } else {
            document.getElementById('mapPetugas').innerHTML =
                '<div class="flex items-center justify-center h-full text-muted dark:text-dark-muted">Tidak ada data koordinat lahan.</div>';
        }
    });
</script>
@endpush
