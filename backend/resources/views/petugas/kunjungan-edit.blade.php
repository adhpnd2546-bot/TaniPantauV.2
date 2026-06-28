@extends('layouts.app')

@section('title', 'Edit Kunjungan Lahan - TaniPantau')

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
    <div class="max-w-4xl mx-auto w-full">
        <div class="mb-6">
            <h4 class="text-[1.25rem] font-medium text-heading dark:text-dark-heading mb-1">Edit Kunjungan Lahan</h4>
            <p class="text-[0.9375rem] text-body dark:text-dark-body m-0">Perbarui hasil inspeksi lapangan yang telah dicatat.</p>
        </div>

        <form action="{{ route('petugas.kunjungan.update', $kunjungan->id) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card border border-border/50 dark:border-dark-border/50 overflow-hidden">
            @csrf
            @method('PUT')

            <div class="p-6 sm:p-8 border-b border-border/50 dark:border-dark-border/50">
                <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading flex items-center gap-2 mb-6 m-0">
                    <span class="material-symbols-outlined text-primary text-[22px]">location_on</span>
                    Lokasi & Waktu
                </h5>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="lahan_id">Pilih Lahan <span class="text-danger">*</span></label>
                        <select name="lahan_id" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card" required>
                            @foreach($lahan as $l)
                                <option value="{{ $l->id }}" {{ $kunjungan->lahan_id == $l->id ? 'selected' : '' }}>
                                    {{ $l->nama_lahan }} - {{ $l->petani->nama_petani ?? '' }} ({{ ucfirst($l->komoditas) }})
                                </option>
                            @endforeach
                        </select>
                        @error('lahan_id') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="tanggal_kunjungan">Tanggal Kunjungan <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan', $kunjungan->tanggal_kunjungan) }}" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card" required>
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
                            @php
                                $selectedFase = old('status_fase', $kunjungan->lahan->status_fase ?? '');
                            @endphp
                            <option value="persiapan" {{ $selectedFase == 'persiapan' ? 'selected' : '' }}>Persiapan</option>
                            <option value="tanam" {{ $selectedFase == 'tanam' ? 'selected' : '' }}>Tanam</option>
                            <option value="pemeliharaan" {{ $selectedFase == 'pemeliharaan' ? 'selected' : '' }}>Pemeliharaan</option>
                            <option value="panen" {{ $selectedFase == 'panen' ? 'selected' : '' }}>Panen</option>
                        </select>
                        @error('status_fase') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="kondisi_lahan">Kondisi Lahan <span class="text-danger">*</span></label>
                        <select name="kondisi_lahan" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card" required>
                            <option value="baik" {{ old('kondisi_lahan', $kunjungan->kondisi_lahan) == 'baik' ? 'selected' : '' }}>Baik (Pertumbuhan normal, hama minimal)</option>
                            <option value="cukup" {{ old('kondisi_lahan', $kunjungan->kondisi_lahan) == 'cukup' ? 'selected' : '' }}>Cukup (Perlu sedikit perhatian)</option>
                            <option value="buruk" {{ old('kondisi_lahan', $kunjungan->kondisi_lahan) == 'buruk' ? 'selected' : '' }}>Buruk (Kritis, butuh tindakan segera)</option>
                        </select>
                        @error('kondisi_lahan') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                    </div>

                    <div class="flex flex-col">
                        <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5">Status Tindak Lanjut <span class="text-danger">*</span></label>
                        <div class="flex gap-2 h-10">
                            @php
                                $selectedTindak = old('status_tindak_lanjut', $kunjungan->status_tindak_lanjut);
                            @endphp
                            <label class="flex-1 cursor-pointer relative">
                                <input class="radio-tab-input peer sr-only" name="status_tindak_lanjut" type="radio" value="aman" {{ $selectedTindak == 'aman' ? 'checked' : '' }} />
                                <div class="radio-tab-label w-full h-full flex items-center justify-center rounded-[0.375rem] border border-border dark:border-dark-border text-body dark:text-dark-body font-medium text-[14px] transition-colors hover:bg-slate-100 dark:hover:bg-dark-border/30 bg-white dark:bg-dark-card">Aman</div>
                            </label>
                            <label class="flex-1 cursor-pointer relative">
                                <input class="radio-tab-input peer sr-only" name="status_tindak_lanjut" type="radio" value="perlu_pemantauan" {{ $selectedTindak == 'perlu_pemantauan' ? 'checked' : '' }} />
                                <div class="radio-tab-label-warning w-full h-full flex items-center justify-center rounded-[0.375rem] border border-border dark:border-dark-border text-body dark:text-dark-body font-medium text-[14px] transition-colors hover:bg-slate-100 dark:hover:bg-dark-border/30 bg-white dark:bg-dark-card">Pantau</div>
                            </label>
                            <label class="flex-1 cursor-pointer relative">
                                <input class="radio-tab-input peer sr-only" name="status_tindak_lanjut" type="radio" value="perlu_tindakan" {{ $selectedTindak == 'perlu_tindakan' ? 'checked' : '' }} />
                                <div class="radio-tab-label-danger w-full h-full flex items-center justify-center rounded-[0.375rem] border border-border dark:border-dark-border text-body dark:text-dark-body font-medium text-[14px] transition-colors hover:bg-slate-100 dark:hover:bg-dark-border/30 bg-white dark:bg-dark-card">Tindak</div>
                            </label>
                        </div>
                        @error('status_tindak_lanjut') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="flex flex-col">
                    <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="catatan_lapangan">Catatan Lapangan</label>
                    <textarea name="catatan_lapangan" rows="3" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] p-3 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card resize-y" placeholder="Deskripsikan temuan spesifik (hama, penyakit, kondisi tanah, dll)...">{{ old('catatan_lapangan', $kunjungan->catatan_lapangan) }}</textarea>
                    @error('catatan_lapangan') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="p-6 sm:p-8">
                <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading flex items-center gap-2 mb-6 m-0">
                    <span class="material-symbols-outlined text-primary text-[22px]">photo_camera</span>
                    Dokumentasi
                </h5>

                @if($kunjungan->foto)
                    @php
                        $fotoPath = $kunjungan->foto;
                        if (str_starts_with($fotoPath, 'uploads/')) {
                            $fotoUrl = url($fotoPath);
                        } else {
                            $fotoUrl = url('storage/' . $fotoPath);
                        }
                    @endphp
                    <div class="mb-4">
                        <p class="text-[13px] font-medium text-heading dark:text-dark-heading mb-2">Foto Saat Ini:</p>
                        <img src="{{ $fotoUrl }}" alt="Foto Kunjungan" class="w-48 h-32 rounded-[0.5rem] object-cover border border-border dark:border-dark-border">
                    </div>
                @endif

                <div class="file-drop-zone rounded-[0.5rem] p-8 flex flex-col items-center justify-center text-center cursor-pointer bg-[#fafafa] dark:bg-dark-surface dark:border-dark-border">
                    <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-4 text-primary">
                        <span class="material-symbols-outlined text-[32px]">cloud_upload</span>
                    </div>
                    <p class="text-[15px] text-heading dark:text-dark-heading font-medium mb-1">Pilih foto baru atau tarik ke area ini</p>
                    <p class="text-[13px] text-muted dark:text-dark-muted mb-4">Biarkan kosong jika tidak ingin mengubah foto. Maksimal 5MB.</p>
                    <input type="file" name="foto" accept="image/jpeg,image/png" class="block mx-auto text-[14px] text-muted dark:text-dark-muted file:mr-4 file:py-2 file:px-4 file:rounded-[0.375rem] file:border-0 file:text-[14px] file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer" />
                    @error('foto') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="px-6 py-4 border-t border-border/50 dark:border-dark-border/50 bg-[#f9f9f9] dark:bg-dark-surface flex justify-end gap-3">
                <a href="{{ route('petugas.kunjungan.index') }}" class="px-5 py-2 bg-white dark:bg-dark-card border border-border dark:border-dark-border rounded-[0.375rem] text-[14px] text-heading dark:text-dark-heading font-medium hover:bg-slate-100 dark:hover:bg-dark-border/30 transition-colors shadow-sm inline-block text-center no-underline">Batal</a>
                <button type="submit" class="px-5 py-2 bg-primary text-white rounded-[0.375rem] text-[14px] font-medium hover:bg-primary-hover transition-colors shadow-primary flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
