@extends('layouts.app')

@section('title', $title . ' - TaniPantau')

@section('content')
<div class="max-w-3xl mx-auto w-full">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.lahan.index') }}" class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-dark-border/30 transition-colors text-heading dark:text-dark-heading">
            <span class="material-symbols-outlined text-[24px]">arrow_back</span>
        </a>
        <div>
            <h4 class="text-[1.25rem] font-medium text-heading dark:text-dark-heading mb-1">{{ $title }}</h4>
            <p class="text-[0.9375rem] text-body dark:text-dark-body m-0">Lengkapi formulir di bawah dengan data lahan yang benar.</p>
        </div>
    </div>

    <form action="{{ $lahan ? route('admin.lahan.update', $lahan->id) : route('admin.lahan.store') }}" method="POST" class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-6 sm:p-8" x-data="{ lat: '{{ old('latitude', $lahan->latitude ?? '') }}', lng: '{{ old('longitude', $lahan->longitude ?? '') }}' }">
        @csrf
        @if($lahan) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="petani_id">Petani <span class="text-danger">*</span></label>
                <select id="petani_id" name="petani_id" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card" required>
                    <option value="">Pilih Petani...</option>
                    @foreach($petani as $p)
                        <option value="{{ $p->id }}" {{ old('petani_id', $lahan->petani_id ?? '') == $p->id ? 'selected' : '' }}>{{ $p->nama_petani }} ({{ $p->desa->nama ?? '-' }})</option>
                    @endforeach
                </select>
                @error('petani_id') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="nama_lahan">Nama Lahan <span class="text-danger">*</span></label>
                <input type="text" id="nama_lahan" name="nama_lahan" value="{{ old('nama_lahan', $lahan->nama_lahan ?? '') }}" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card" required>
                @error('nama_lahan') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="komoditas">Komoditas <span class="text-danger">*</span></label>
                <select id="komoditas" name="komoditas" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card" required>
                    <option value="padi" {{ old('komoditas', $lahan->komoditas ?? '') == 'padi' ? 'selected' : '' }}>Padi</option>
                    <option value="jagung" {{ old('komoditas', $lahan->komoditas ?? '') == 'jagung' ? 'selected' : '' }}>Jagung</option>
                    <option value="hortikultura" {{ old('komoditas', $lahan->komoditas ?? '') == 'hortikultura' ? 'selected' : '' }}>Hortikultura</option>
                </select>
                @error('komoditas') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="luas_lahan">Luas Lahan (Ha) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" id="luas_lahan" name="luas_lahan" value="{{ old('luas_lahan', $lahan->luas_lahan ?? '') }}" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card" required>
                @error('luas_lahan') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col md:col-span-2">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5">Lokasi (Klik pada peta) <span class="text-muted dark:text-dark-muted font-normal">*</span></label>
                <div id="mapPicker" class="w-full h-[300px] rounded-[0.375rem] border border-border dark:border-dark-border mb-2"></div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="latitude">Latitude</label>
                        <input type="text" id="latitude" name="latitude" x-model="lat" value="{{ old('latitude', $lahan->latitude ?? '') }}" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card font-mono" readonly>
                        @error('latitude') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                    </div>
                    <div>
                        <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="longitude">Longitude</label>
                        <input type="text" id="longitude" name="longitude" x-model="lng" value="{{ old('longitude', $lahan->longitude ?? '') }}" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card font-mono" readonly>
                        @error('longitude') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="tanggal_tanam">Tanggal Tanam</label>
                <input type="date" id="tanggal_tanam" name="tanggal_tanam" value="{{ old('tanggal_tanam', $lahan->tanggal_tanam ?? date('Y-m-d')) }}" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white">
                @error('tanggal_tanam') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="status_fase">Status Fase <span class="text-danger">*</span></label>
                <select id="status_fase" name="status_fase" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card" required>
                    <option value="persiapan" {{ old('status_fase', $lahan->status_fase ?? '') == 'persiapan' ? 'selected' : '' }}>Persiapan</option>
                    <option value="tanam" {{ old('status_fase', $lahan->status_fase ?? '') == 'tanam' ? 'selected' : '' }}>Tanam</option>
                    <option value="pemeliharaan" {{ old('status_fase', $lahan->status_fase ?? '') == 'pemeliharaan' ? 'selected' : '' }}>Pemeliharaan</option>
                    <option value="panen" {{ old('status_fase', $lahan->status_fase ?? '') == 'panen' ? 'selected' : '' }}>Panen</option>
                </select>
                @error('status_fase') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-border dark:border-dark-border">
            <a href="{{ route('admin.lahan.index') }}" class="px-5 py-2 bg-white dark:bg-dark-card border border-border dark:border-dark-border rounded-[0.375rem] text-[14px] text-heading dark:text-dark-heading font-medium hover:bg-slate-100 dark:hover:bg-dark-border/30 transition-colors">Batal</a>
            <button type="submit" class="px-5 py-2 bg-primary text-white rounded-[0.375rem] text-[14px] font-medium hover:bg-primary-hover transition-colors shadow-primary">
                {{ $lahan ? 'Perbarui' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
@push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const defaultLat = {{ old('latitude', $lahan->latitude ?? -7.56000000) }};
        const defaultLng = {{ old('longitude', $lahan->longitude ?? 112.75000000) }};

        const map = L.map('mapPicker').setView([defaultLat, defaultLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker = null;
        if (defaultLat && defaultLng) {
            marker = L.marker([defaultLat, defaultLng]).addTo(map);
        }

        map.on('click', function(e) {
            const lat = e.latlng.lat.toFixed(6);
            const lng = e.latlng.lng.toFixed(6);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }
        });
    });
</script>
@endpush

@endsection
