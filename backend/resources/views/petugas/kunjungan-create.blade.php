@extends('layouts.app')

@section('title', 'Input Kunjungan Lahan - TaniPantau')

@push('styles')
    <style>
        .file-drop-zone {
            border: 2px dashed #d9dee3;
            transition: all 0.2s ease-in-out;
        }
        .file-drop-zone:hover {
            border-color: #16A34A;
            background-color: rgba(22, 163, 74, 0.05);
        }
        .radio-tab-input:checked + .radio-tab-label {
            background-color: #16A34A;
            color: #ffffff;
            border-color: #16A34A;
        }
        .radio-tab-input:checked + .radio-tab-label-warning {
            background-color: #ffab00;
            color: #ffffff;
            border-color: #ffab00;
        }
        .radio-tab-input:checked + .radio-tab-label-danger {
            background-color: #ff3e1d;
            color: #ffffff;
            border-color: #ff3e1d;
        }
    </style>
@endpush

@section('content')
    @if(session('success'))
    <div class="mb-4 px-4 py-3 bg-success/10 border border-success/20 text-success rounded-[0.5rem] text-[14px] font-medium flex items-center justify-between">
        <span>{{ session('success') }}</span>
        <a href="{{ route('petugas.kunjungan.index') }}" class="text-success font-semibold underline hover:no-underline">Lihat Riwayat</a>
    </div>
    @endif

    <div class="max-w-4xl mx-auto w-full">
        <div class="mb-6">
            <h4 class="text-[1.25rem] font-medium text-heading dark:text-dark-heading mb-1">Input Kunjungan Lahan Baru</h4>
            <p class="text-[0.9375rem] text-body dark:text-dark-body m-0">Catat hasil inspeksi lapangan secara real-time.</p>
        </div>

        <form action="{{ route('petugas.kunjungan.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card border border-border/50 dark:border-dark-border/50 overflow-hidden">
            @csrf

            <div class="p-6 sm:p-8 border-b border-border/50 dark:border-dark-border/50">
                <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading flex items-center gap-2 mb-6 m-0">
                    <span class="material-symbols-outlined text-primary text-[22px]">location_on</span>
                    Lokasi & Waktu
                </h5>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="lahan_id">Pilih Lahan <span class="text-danger">*</span></label>
                        <select name="lahan_id" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card" required>
                            <option disabled selected value="">Pilih lokasi lahan...</option>
                            @foreach($lahan as $l)
                                <option value="{{ $l->id }}">{{ $l->nama_lahan }} - {{ $l->petani->nama_petani ?? '' }} ({{ ucfirst($l->komoditas) }})</option>
                            @endforeach
                        </select>
                        @error('lahan_id') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="tanggal_kunjungan">Tanggal Kunjungan <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_kunjungan" value="{{ date('Y-m-d') }}" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card" required>
                        @error('tanggal_kunjungan') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                    </div>
                </div>
            </div>

            <div class="p-6 sm:p-8 border-b border-border/50 dark:border-dark-border/50 bg-[#f8f8f9] dark:bg-dark-surface">
                <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading flex items-center gap-2 mb-6 m-0">
                    <span class="material-symbols-outlined text-primary text-[22px]">visibility</span>
                    Hasil Observasi
                </h5>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="flex flex-col">
                        <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="status_fase">Status Fase Lahan <span class="text-danger">*</span></label>
                        <select name="status_fase" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card" required>
                            <option disabled selected value="">Pilih fase saat ini...</option>
                            <option value="persiapan">Persiapan</option>
                            <option value="tanam">Tanam</option>
                            <option value="pemeliharaan">Pemeliharaan</option>
                            <option value="panen">Panen</option>
                        </select>
                        @error('status_fase') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="kondisi_lahan">Kondisi Lahan <span class="text-danger">*</span></label>
                        <select name="kondisi_lahan" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card" required>
                            <option disabled selected value="">Pilih kondisi...</option>
                            <option value="baik">Baik (Pertumbuhan normal, hama minimal)</option>
                            <option value="cukup">Cukup (Perlu sedikit perhatian)</option>
                            <option value="buruk">Buruk (Kritis, butuh tindakan segera)</option>
                        </select>
                        @error('kondisi_lahan') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5">Status Tindak Lanjut <span class="text-danger">*</span></label>
                        <div class="flex gap-2 h-10">
                            <label class="flex-1 cursor-pointer relative">
                                <input checked class="radio-tab-input peer sr-only" name="status_tindak_lanjut" type="radio" value="aman" />
                                <div class="radio-tab-label w-full h-full flex items-center justify-center rounded-[0.375rem] border border-border dark:border-dark-border text-body dark:text-dark-body font-medium text-[14px] transition-colors hover:bg-slate-100 dark:hover:bg-dark-border/30 bg-white dark:bg-dark-card">Aman</div>
                            </label>
                            <label class="flex-1 cursor-pointer relative">
                                <input class="radio-tab-input peer sr-only" name="status_tindak_lanjut" type="radio" value="perlu_pemantauan" />
                                <div class="radio-tab-label-warning w-full h-full flex items-center justify-center rounded-[0.375rem] border border-border dark:border-dark-border text-body dark:text-dark-body font-medium text-[14px] transition-colors hover:bg-slate-100 dark:hover:bg-dark-border/30 bg-white dark:bg-dark-card">Pantau</div>
                            </label>
                            <label class="flex-1 cursor-pointer relative">
                                <input class="radio-tab-input peer sr-only" name="status_tindak_lanjut" type="radio" value="perlu_tindakan" />
                                <div class="radio-tab-label-danger w-full h-full flex items-center justify-center rounded-[0.375rem] border border-border dark:border-dark-border text-body dark:text-dark-body font-medium text-[14px] transition-colors hover:bg-slate-100 dark:hover:bg-dark-border/30 bg-white dark:bg-dark-card">Tindak</div>
                            </label>
                        </div>
                        @error('status_tindak_lanjut') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="flex flex-col">
                    <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="catatan_lapangan">Catatan Lapangan</label>
                    <textarea name="catatan_lapangan" rows="3" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] p-3 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card resize-y" placeholder="Deskripsikan temuan spesifik (hama, penyakit, kondisi tanah, dll)..."></textarea>
                    @error('catatan_lapangan') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="p-6 sm:p-8">
                <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading flex items-center gap-2 mb-6 m-0">
                    <span class="material-symbols-outlined text-primary text-[22px]">photo_camera</span>
                    Dokumentasi
                </h5>

                <div class="file-drop-zone rounded-[0.5rem] p-8 flex flex-col items-center justify-center text-center cursor-pointer bg-[#fafafa] dark:bg-dark-surface dark:border-dark-border">
                    <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-4 text-primary">
                        <span class="material-symbols-outlined text-[32px]">cloud_upload</span>
                    </div>
                    <p class="text-[15px] text-heading dark:text-dark-heading font-medium mb-1">Pilih foto atau tarik ke area ini</p>
                    <p class="text-[13px] text-muted dark:text-dark-muted mb-4">Mendukung format JPG, PNG maksimal 5MB.</p>
                    <input type="file" name="foto" accept="image/jpeg,image/png" class="block mx-auto text-[14px] text-muted dark:text-dark-muted file:mr-4 file:py-2 file:px-4 file:rounded-[0.375rem] file:border-0 file:text-[14px] file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer" />
                    @error('foto') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="px-6 py-4 border-t border-border/50 dark:border-dark-border/50 bg-[#f9f9f9] dark:bg-dark-surface flex justify-end gap-3">
                <a href="{{ route('petugas.kunjungan.index') }}" class="px-5 py-2 bg-white dark:bg-dark-card border border-border dark:border-dark-border rounded-[0.375rem] text-[14px] text-heading dark:text-dark-heading font-medium hover:bg-slate-100 dark:hover:bg-dark-border/30 transition-colors shadow-sm inline-block text-center no-underline">Batal</a>
                <button type="submit" class="px-5 py-2 bg-primary text-white rounded-[0.375rem] text-[14px] font-medium hover:bg-primary-hover transition-colors shadow-primary flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">check</span>
                    Simpan Laporan
                </button>
            </div>
        </form>
    </div>
@endsection
