@extends('layouts.app')

@section('title', 'Detail Lahan - TaniPantau')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.lahan.index') }}" class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-dark-border/30 transition-colors text-heading dark:text-dark-heading flex items-center justify-center">
                <span class="material-symbols-outlined text-[24px]">arrow_back</span>
            </a>
            <div>
                <h4 class="text-[1.25rem] font-medium text-heading dark:text-dark-heading mb-0">Detail Lahan: {{ $lahan->nama_lahan }}</h4>
                <p class="text-[0.875rem] text-muted dark:text-dark-muted m-0">ID: LHN-{{ str_pad($lahan->id, 4, '0', STR_PAD_LEFT) }} • Fase <span class="text-primary font-medium">{{ ucfirst($lahan->status_fase) }}</span></p>
            </div>
        </div>
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <a href="{{ route('admin.lahan.edit', $lahan->id) }}" class="flex-1 sm:flex-none bg-primary/10 text-primary hover:bg-primary hover:text-white transition-colors text-[14px] font-medium py-2 px-4 rounded-[0.375rem] flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">edit</span> Edit
            </a>
            <form action="{{ route('admin.lahan.destroy', $lahan->id) }}" method="POST" onsubmit="return confirm('Hapus lahan ini?')" class="inline">
                @csrf @method('DELETE')
                <button type="submit" class="flex-1 sm:flex-none bg-danger/10 text-danger hover:bg-danger hover:text-white transition-colors text-[14px] font-medium py-2 px-4 rounded-[0.375rem] flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">delete</span> Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6">
        <div class="lg:col-span-8 bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-6 flex flex-col">
            <div class="flex items-center gap-2 border-b border-border dark:border-dark-border pb-4 mb-5">
                <span class="material-symbols-outlined text-primary text-[22px]">info</span>
                <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading m-0">Informasi Umum</h5>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                <div>
                    <small class="text-[11px] font-semibold text-muted dark:text-dark-muted uppercase tracking-widest block mb-1">Nama Lahan</small>
                    <p class="text-[15px] font-medium text-heading dark:text-dark-heading m-0">{{ $lahan->nama_lahan }}</p>
                </div>
                <div>
                    <small class="text-[11px] font-semibold text-muted dark:text-dark-muted uppercase tracking-widest block mb-1">Pemilik / Petani</small>
                    <p class="text-[15px] font-medium text-primary m-0">{{ $lahan->petani->nama_petani ?? '-' }}</p>
                </div>
                <div>
                    <small class="text-[11px] font-semibold text-muted dark:text-dark-muted uppercase tracking-widest block mb-2">Komoditas</small>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-[0.25rem] bg-info/10 text-info text-[13px] font-medium">
                        <span class="material-symbols-outlined text-[14px]">grass</span>
                        {{ ucfirst($lahan->komoditas) }}
                    </span>
                </div>
                <div>
                    <small class="text-[11px] font-semibold text-muted dark:text-dark-muted uppercase tracking-widest block mb-1">Luas Lahan</small>
                    <p class="text-[15px] font-medium text-heading dark:text-dark-heading m-0">{{ number_format($lahan->luas_lahan, 1) }} Hektar</p>
                </div>
                <div>
                    <small class="text-[11px] font-semibold text-muted dark:text-dark-muted uppercase tracking-widest block mb-1">Tanggal Tanam</small>
                    <p class="text-[15px] font-medium text-heading dark:text-dark-heading m-0">{{ $lahan->tanggal_tanam ? \Carbon\Carbon::parse($lahan->tanggal_tanam)->format('d M Y') : '-' }}</p>
                </div>
                <div>
                    <small class="text-[11px] font-semibold text-muted dark:text-dark-muted uppercase tracking-widest block mb-1">Wilayah Administratif</small>
                    <p class="text-[15px] font-medium text-heading dark:text-dark-heading m-0">{{ $lahan->petani->desa->nama ?? '-' }}, Kec. {{ $lahan->petani->kecamatan->nama ?? '-' }}</p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card flex flex-col overflow-hidden h-full min-h-[300px]">
            <div class="p-4 border-b border-border dark:border-dark-border flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary text-[22px]">location_on</span>
                    <h5 class="text-[1rem] font-medium text-heading dark:text-dark-heading m-0">Lokasi</h5>
                </div>
            </div>
            <div class="relative flex-1 bg-background">
                @if($lahan->latitude && $lahan->longitude)
                <div id="map" style="width:100%;height:100%;min-height:300px;"></div>
                <div class="absolute bottom-3 left-3 right-3 bg-white/95 dark:bg-dark-card/95 backdrop-blur shadow-sm rounded border border-border dark:border-dark-border p-2 text-center text-[12px] font-medium text-heading dark:text-dark-heading">
                    {{ $lahan->latitude }}°, {{ $lahan->longitude }}°
                </div>
                @else
                <div class="flex items-center justify-center h-full">
                    <div class="text-center p-4">
                        <span class="material-symbols-outlined text-[48px] text-muted dark:text-dark-muted">map</span>
                        <p class="text-muted dark:text-dark-muted text-[14px] mt-2">Koordinat belum tersedia</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6">
        <div class="lg:col-span-7 bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-6">
            <div class="flex items-center gap-2 border-b border-border dark:border-dark-border pb-4 mb-6">
                <span class="material-symbols-outlined text-warning text-[22px]" style="font-variation-settings: 'FILL' 1;">psychiatry</span>
                <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading m-0">Fase Pertumbuhan</h5>
            </div>

            @php
                $fases = ['persiapan' => 0, 'tanam' => 1, 'pemeliharaan' => 2, 'panen' => 3];
                $currentIdx = $fases[$lahan->status_fase] ?? 0;
                $faseLabels = ['persiapan' => 'Persiapan', 'tanam' => 'Tanam', 'pemeliharaan' => 'Pemeliharaan', 'panen' => 'Panen'];
                $faseIcons = ['persiapan' => 'checklist', 'tanam' => 'ecs', 'pemeliharaan' => 'water_drop', 'panen' => 'agriculture'];
            @endphp

            <div class="relative w-full px-4 sm:px-8 pb-4">
                <div class="absolute top-5 left-[10%] right-[10%] h-[2px] bg-border z-0"></div>
                @if($currentIdx > 0)
                <div class="absolute top-5 left-[10%] w-[{{ $currentIdx * 25 }}%] h-[2px] bg-primary z-0"></div>
                @endif

                <div class="flex justify-between items-start relative z-10">
                    @foreach($faseLabels as $key => $label)
                        @php
                            $idx = $fases[$key];
                            $isDone = $idx < $currentIdx;
                            $isActive = $idx == $currentIdx;
                        @endphp
                        <div class="flex flex-col items-center gap-2 w-1/4 relative">
                            @if($isDone)
                                <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center shadow-primary">
                                    <span class="material-symbols-outlined text-[20px]">check</span>
                                </div>
                            @elseif($isActive)
                                <div class="w-10 h-10 rounded-full bg-white dark:bg-dark-card border-2 border-primary text-primary flex items-center justify-center shadow-sm z-10 ring-4 ring-primary/10">
                                    <div class="w-3.5 h-3.5 bg-primary rounded-full"></div>
                                </div>
                                <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-primary text-white text-[11px] font-bold px-2 py-1 rounded-[0.25rem] shadow-sm whitespace-nowrap">
                                    Saat Ini
                                </div>
                            @else
                                <div class="w-10 h-10 rounded-full bg-white dark:bg-dark-card border-2 border-border dark:border-dark-border text-muted dark:text-dark-muted flex items-center justify-center bg-background">
                                    <span class="material-symbols-outlined text-[20px]">radio_button_unchecked</span>
                                </div>
                            @endif
                            <span class="text-[13px] {{ $isActive ? 'font-bold text-primary' : ($isDone ? 'font-semibold text-heading dark:text-dark-heading' : 'font-medium text-muted dark:text-dark-muted') }} mt-1">{{ $label }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="lg:col-span-5 bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-6">
            <div class="flex items-center gap-2 border-b border-border dark:border-dark-border pb-4 mb-6">
                <span class="material-symbols-outlined text-info text-[22px]">fact_check</span>
                <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading m-0">Ringkasan Laporan</h5>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="bg-primary/5 rounded-[0.5rem] p-4 flex flex-col justify-center items-center text-center border border-primary/10">
                    <span class="text-[2rem] font-bold text-primary leading-none mb-1">{{ $lahan->kunjungan->count() }}</span>
                    <span class="text-[12px] font-medium text-muted dark:text-dark-muted uppercase tracking-wider">Total Kunjungan</span>
                </div>
                <div class="bg-background rounded-[0.5rem] p-4 flex flex-col justify-center border border-border dark:border-dark-border">
                    <small class="text-[11px] font-semibold text-muted dark:text-dark-muted uppercase tracking-widest block mb-1">Kunjungan Terakhir</small>
                    @php $lastKunjungan = $lahan->kunjungan->sortByDesc('tanggal_kunjungan')->first(); @endphp
                    <p class="text-[15px] font-semibold text-heading dark:text-dark-heading mb-2">{{ $lastKunjungan ? \Carbon\Carbon::parse($lastKunjungan->tanggal_kunjungan)->format('d M Y') : '-' }}</p>
                    @if($lastKunjungan)
                    <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-[0.25rem] {{ $lastKunjungan->kondisi_lahan === 'baik' ? 'bg-success/10 text-success' : ($lastKunjungan->kondisi_lahan === 'cukup' ? 'bg-warning/10 text-warning' : 'bg-danger/10 text-danger') }} text-[12px] font-medium w-fit">
                        <span class="material-symbols-outlined text-[14px]">check_circle</span>
                        {{ ucfirst($lastKunjungan->kondisi_lahan) }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card">
        <div class="px-6 py-5 border-b border-border dark:border-dark-border flex items-center justify-between">
            <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading m-0">Riwayat Kunjungan Petugas</h5>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Tanggal</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Petugas</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Kondisi</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Status Tindak Lanjut</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Catatan</th>
                    </tr>
                </thead>
                <tbody class="text-[14px] text-body dark:text-dark-body">
                    @forelse($lahan->kunjungan->sortByDesc('tanggal_kunjungan') as $k)
                    <tr class="hover:bg-slate-50 dark:hover:bg-dark-border/20 transition-colors">
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border font-medium text-heading dark:text-dark-heading">{{ \Carbon\Carbon::parse($k->tanggal_kunjungan)->format('d M Y') }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">{{ $k->petugas->name ?? '-' }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">
                            @php
                                $kondisiStyles = ['baik' => 'background:#71dd3720;color:#56b82a;', 'cukup' => 'background:#ffab0020;color:#e69a00;', 'buruk' => 'background:#ff3e1d20;color:#ff3e1d;'];
                            @endphp
                            <span class="px-2 py-1 rounded-[0.25rem] text-[12px] font-semibold inline-block" style="{{ $kondisiStyles[$k->kondisi_lahan] ?? 'background:#8592a315;color:#8592a3;' }}">{{ ucfirst($k->kondisi_lahan) }}</span>
                        </td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">
                            @php
                                $tindakStyles = ['aman' => 'background:#71dd3720;color:#56b82a;', 'perlu_pemantauan' => 'background:#ffab0020;color:#e69a00;', 'perlu_tindakan' => 'background:#ff3e1d20;color:#ff3e1d;'];
                                $tindakLabels = ['aman' => 'Aman', 'perlu_pemantauan' => 'Perlu Pemantauan', 'perlu_tindakan' => 'Perlu Tindakan'];
                            @endphp
                            <span class="px-2 py-1 rounded-[0.25rem] text-[12px] font-semibold inline-block" style="{{ $tindakStyles[$k->status_tindak_lanjut] ?? 'background:#8592a315;color:#8592a3;' }}">{{ $tindakLabels[$k->status_tindak_lanjut] ?? $k->status_tindak_lanjut }}</span>
                        </td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">
                            <span class="text-body dark:text-dark-body truncate max-w-[250px] block" title="{{ $k->catatan_lapangan }}">{{ $k->catatan_lapangan ? Str::limit($k->catatan_lapangan, 60) : '-' }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-8 text-center text-muted dark:text-dark-muted">Belum ada kunjungan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@if($lahan->latitude && $lahan->longitude)
<script>
    var map = L.map('map').setView([{{ $lahan->latitude }}, {{ $lahan->longitude }}], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);
    L.marker([{{ $lahan->latitude }}, {{ $lahan->longitude }}]).addTo(map)
        .bindPopup('<b>{{ $lahan->nama_lahan }}</b>');
</script>
@endif
@endpush
