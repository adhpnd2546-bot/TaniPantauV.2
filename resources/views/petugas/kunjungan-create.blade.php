@extends('layouts.app')

@section('title', 'Input Kunjungan Lahan - TaniPantau')

@push('styles')
    <style>
        /* Custom File Input Styling */
        .file-drop-zone {
            border: 2px dashed #d9dee3; /* border */
            transition: all 0.2s ease-in-out;
        }
        .file-drop-zone:hover {
            border-color: #16A34A; /* primary */
            background-color: rgba(22, 163, 74, 0.05); /* primary/5 */
        }
        
        /* Radio Tab Styling */
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
                    <!-- Page Header -->
                    <div class="mb-6">
                        <h4 class="text-[1.25rem] font-medium text-heading mb-1">Input Kunjungan Lahan Baru</h4>
                        <p class="text-[0.9375rem] text-body m-0">Catat hasil inspeksi lapangan secara real-time untuk analisis lebih lanjut.</p>
                    </div>

                    <!-- Sneat Form Container -->
                    <form class="bg-white rounded-[0.5rem] shadow-card border border-border/50 overflow-hidden">
                        
                        <!-- Form Section 1: Lokasi & Waktu -->
                        <div class="p-6 sm:p-8 border-b border-border/50">
                            <h5 class="text-[1.125rem] font-medium text-heading flex items-center gap-2 mb-6 m-0">
                                <span class="material-symbols-outlined text-primary text-[22px]">location_on</span>
                                Lokasi & Waktu
                            </h5>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Select Lahan -->
                                <div class="flex flex-col">
                                    <label class="text-[13px] font-medium text-heading mb-1.5" for="lahan">Pilih Lahan <span class="text-danger">*</span></label>
                                    <select class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all" id="lahan">
                                        <option disabled selected value="">Pilih lokasi lahan...</option>
                                        <option value="l1">Blok A - Lahan Padi Ciherang</option>
                                        <option value="l2">Blok B - Jagung Hibrida</option>
                                        <option value="l3">Blok C - Kebun Sayur Organik</option>
                                        <option value="l4">Blok D - Area Pembibitan</option>
                                    </select>
                                </div>
                                
                                <!-- Date Tanggal Kunjungan -->
                                <div class="flex flex-col">
                                    <label class="text-[13px] font-medium text-heading mb-1.5" for="tanggal">Tanggal Kunjungan <span class="text-danger">*</span></label>
                                    <input class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all" id="tanggal" type="date" value="2023-10-27" />
                                </div>
                            </div>
                        </div>

                        <!-- Form Section 2: Observasi -->
                        <div class="p-6 sm:p-8 border-b border-border/50 bg-[#f8f8f9]">
                            <h5 class="text-[1.125rem] font-medium text-heading flex items-center gap-2 mb-6 m-0">
                                <span class="material-symbols-outlined text-primary text-[22px]">visibility</span>
                                Hasil Observasi
                            </h5>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Select Kondisi Lahan -->
                                <div class="flex flex-col">
                                    <label class="text-[13px] font-medium text-heading mb-1.5" for="kondisi">Kondisi Lahan Umum <span class="text-danger">*</span></label>
                                    <select class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white" id="kondisi">
                                        <option disabled selected value="">Pilih kondisi...</option>
                                        <option value="baik">Baik (Pertumbuhan normal, hama minimal)</option>
                                        <option value="cukup">Cukup (Perlu sedikit perhatian)</option>
                                        <option value="buruk">Buruk (Kritis, butuh tindakan segera)</option>
                                    </select>
                                </div>
                                
                                <!-- Status Tindak Lanjut (Radio Tabs) -->
                                <div class="flex flex-col">
                                    <label class="text-[13px] font-medium text-heading mb-1.5">Status Tindak Lanjut <span class="text-danger">*</span></label>
                                    <div class="flex gap-2 h-10">
                                        <label class="flex-1 cursor-pointer relative">
                                            <input checked class="radio-tab-input peer sr-only" name="status" type="radio" value="aman" />
                                            <div class="radio-tab-label w-full h-full flex items-center justify-center rounded-[0.375rem] border border-border text-body font-medium text-[14px] transition-colors hover:bg-black/5 bg-white">
                                                Aman
                                            </div>
                                        </label>
                                        <label class="flex-1 cursor-pointer relative">
                                            <input class="radio-tab-input peer sr-only" name="status" type="radio" value="pantau" />
                                            <div class="radio-tab-label-warning w-full h-full flex items-center justify-center rounded-[0.375rem] border border-border text-body font-medium text-[14px] transition-colors hover:bg-black/5 bg-white">
                                                Pantau
                                            </div>
                                        </label>
                                        <label class="flex-1 cursor-pointer relative">
                                            <input class="radio-tab-input peer sr-only" name="status" type="radio" value="tindak" />
                                            <div class="radio-tab-label-danger w-full h-full flex items-center justify-center rounded-[0.375rem] border border-border text-body font-medium text-[14px] transition-colors hover:bg-black/5 bg-white">
                                                Tindak
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Catatan Lapangan -->
                            <div class="flex flex-col">
                                <label class="text-[13px] font-medium text-heading mb-1.5" for="catatan">Catatan Lapangan</label>
                                <textarea class="w-full border border-border rounded-[0.375rem] p-3 text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white resize-y min-h-[100px]" id="catatan" placeholder="Deskripsikan temuan spesifik (hama, penyakit, kondisi tanah, dll)..."></textarea>
                            </div>
                        </div>

                        <!-- Form Section 3: Dokumentasi -->
                        <div class="p-6 sm:p-8">
                            <h5 class="text-[1.125rem] font-medium text-heading flex items-center gap-2 mb-6 m-0">
                                <span class="material-symbols-outlined text-primary text-[22px]">photo_camera</span>
                                Dokumentasi
                            </h5>
                            
                            <!-- File Drag & Drop -->
                            <div class="file-drop-zone rounded-[0.5rem] p-8 flex flex-col items-center justify-center text-center cursor-pointer bg-[#fafafa]">
                                <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-4 text-primary">
                                    <span class="material-symbols-outlined text-[32px]">cloud_upload</span>
                                </div>
                                <p class="text-[15px] text-heading font-medium mb-1">Pilih foto atau tarik ke area ini</p>
                                <p class="text-[13px] text-muted mb-4">Mendukung format JPG, PNG maksimal 5MB per file.</p>
                                <button class="px-4 py-2 bg-white border border-border rounded-[0.375rem] text-[14px] text-body font-medium hover:text-primary hover:border-primary transition-colors shadow-sm" type="button">
                                    Browse Files
                                </button>
                                <input accept="image/jpeg, image/png" class="hidden" multiple type="file" />
                            </div>
                        </div>

                        <!-- Form Actions Footer -->
                        <div class="px-6 py-4 border-t border-border/50 bg-[#f9f9f9] flex justify-end gap-3">
                            <button class="px-5 py-2 bg-white border border-border rounded-[0.375rem] text-[14px] text-heading font-medium hover:bg-black/5 transition-colors shadow-sm" type="button">
                                Batal
                            </button>
                            <button class="px-5 py-2 bg-primary text-white rounded-[0.375rem] text-[14px] font-medium hover:bg-primary-hover transition-colors shadow-primary flex items-center gap-2" type="submit">
                                <span class="material-symbols-outlined text-[18px]">check</span>
                                Simpan Laporan
                            </button>
                        </div>
                        
                    </form>
                    
                    <div class="h-6"></div> <!-- Bottom padding -->
                </div>

@endsection
