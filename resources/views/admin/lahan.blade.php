@extends('layouts.app')

@section('title', 'Manajemen Lahan - TaniPantau')

@section('content')
                
                <!-- Page Header -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div>
                        <h4 class="text-[1.25rem] font-medium text-heading mb-1">Daftar Lahan Pertanian</h4>
                        <p class="text-[0.9375rem] text-body m-0">Kelola dan pantau seluruh area pertanian terdaftar.</p>
                    </div>
                    <button class="bg-primary hover:bg-primary-hover text-white text-[15px] font-medium py-2 px-4 rounded-[0.375rem] flex items-center gap-2 transition-all shadow-primary">
                        <span class="material-symbols-outlined text-[20px]">add</span>
                        Tambah Lahan
                    </button>
                </div>

                <!-- Filters Card -->
                <div class="bg-white rounded-[0.5rem] shadow-card mb-6 p-5">
                    <h5 class="text-[1rem] font-medium text-heading mb-4">Filter Data</h5>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 xl:grid-cols-5 gap-4">
                        
                        <!-- Komoditas -->
                        <div class="flex flex-col">
                            <label class="text-[12px] font-medium text-heading mb-1.5 uppercase tracking-wide">Komoditas</label>
                            <select class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all">
                                <option value="">Semua Komoditas</option>
                                <option value="padi">Padi</option>
                                <option value="jagung">Jagung</option>
                                <option value="kedelai">Kedelai</option>
                            </select>
                        </div>
                        
                        <!-- Fase -->
                        <div class="flex flex-col">
                            <label class="text-[12px] font-medium text-heading mb-1.5 uppercase tracking-wide">Fase</label>
                            <select class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all">
                                <option value="">Semua Fase</option>
                                <option value="persiapan">Persiapan Lahan</option>
                                <option value="tanam">Masa Tanam</option>
                                <option value="vegetatif">Vegetatif</option>
                                <option value="panen">Masa Panen</option>
                            </select>
                        </div>
                        
                        <!-- Kecamatan -->
                        <div class="flex flex-col">
                            <label class="text-[12px] font-medium text-heading mb-1.5 uppercase tracking-wide">Kecamatan</label>
                            <select class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all">
                                <option value="">Semua Kecamatan</option>
                                <option value="kec-a">Sukamakmur</option>
                                <option value="kec-b">Tani Jaya</option>
                            </select>
                        </div>
                        
                        <!-- Petugas -->
                        <div class="flex flex-col">
                            <label class="text-[12px] font-medium text-heading mb-1.5 uppercase tracking-wide">Petugas</label>
                            <select class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all">
                                <option value="">Semua Petugas</option>
                                <option value="pet-1">Budi Santoso</option>
                                <option value="pet-2">Siti Aminah</option>
                            </select>
                        </div>

                        <!-- Action -->
                        <div class="flex flex-col justify-end">
                            <button class="w-full border border-border hover:bg-black/5 text-heading font-medium text-[15px] py-2 px-4 rounded-[0.375rem] transition-colors flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">filter_list</span>
                                Filter
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Data Table Card -->
                <div class="bg-white rounded-[0.5rem] shadow-card">
                    
                    <!-- Table Header Actions (Optional) -->
                    <div class="px-6 py-4 border-b border-border flex justify-between items-center">
                        <h5 class="text-[1.125rem] font-medium text-heading m-0">128 Lahan Terdaftar</h5>
                        <div class="flex items-center gap-2">
                            <button class="text-muted hover:text-primary transition-colors p-1"><span class="material-symbols-outlined text-[20px]">refresh</span></button>
                            <button class="text-muted hover:text-primary transition-colors p-1"><span class="material-symbols-outlined text-[20px]">download</span></button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[800px]">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase w-16">#</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Nama Lahan</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Petani</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Komoditas</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Luas (Ha)</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Fase</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase text-center w-24">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-[14px] text-body">
                                
                                <!-- Row 1 -->
                                <tr class="hover:bg-black/[0.02] transition-colors">
                                    <td class="px-6 py-4 border-b border-border text-muted">1</td>
                                    <td class="px-6 py-4 border-b border-border font-medium text-heading">Blok A1 - Sukamakmur</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-2">
                                            <img src="https://ui-avatars.com/api/?name=Ahmad+R&background=random&rounded=true" class="w-7 h-7 rounded-full" alt="Ahmad">
                                            Ahmad Ridwan
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border text-heading">Padi IR64</td>
                                    <td class="px-6 py-4 border-b border-border">2.5</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-3 py-1 rounded-[0.25rem] bg-info/10 text-info text-[12px] font-medium">Masa Tanam</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.lahan.detail') }}" class="text-muted hover:text-primary transition-colors flex items-center justify-center p-1"><span class="material-symbols-outlined text-[18px]">edit</span></a>
                                            <button class="text-muted hover:text-danger transition-colors flex items-center justify-center p-1"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 2 -->
                                <tr class="hover:bg-black/[0.02] transition-colors">
                                    <td class="px-6 py-4 border-b border-border text-muted">2</td>
                                    <td class="px-6 py-4 border-b border-border font-medium text-heading">Blok B2 - Tani Jaya</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-2">
                                            <img src="https://ui-avatars.com/api/?name=Siti+M&background=random&rounded=true" class="w-7 h-7 rounded-full" alt="Siti">
                                            Siti Maryam
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border text-heading">Jagung Manis</td>
                                    <td class="px-6 py-4 border-b border-border">1.8</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-3 py-1 rounded-[0.25rem] bg-warning/10 text-warning text-[12px] font-medium">Vegetatif</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.lahan.detail') }}" class="text-muted hover:text-primary transition-colors flex items-center justify-center p-1"><span class="material-symbols-outlined text-[18px]">edit</span></a>
                                            <button class="text-muted hover:text-danger transition-colors flex items-center justify-center p-1"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 3 -->
                                <tr class="hover:bg-black/[0.02] transition-colors">
                                    <td class="px-6 py-4 border-b border-border text-muted">3</td>
                                    <td class="px-6 py-4 border-b border-border font-medium text-heading">Blok C3 - Sumber Air</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-2">
                                            <img src="https://ui-avatars.com/api/?name=Haji+M&background=random&rounded=true" class="w-7 h-7 rounded-full" alt="Haji">
                                            Haji Maman
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border text-heading">Padi Ciherang</td>
                                    <td class="px-6 py-4 border-b border-border">4.0</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-3 py-1 rounded-[0.25rem] bg-secondary/10 text-secondary text-[12px] font-medium">Persiapan</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.lahan.detail') }}" class="text-muted hover:text-primary transition-colors flex items-center justify-center p-1"><span class="material-symbols-outlined text-[18px]">edit</span></a>
                                            <button class="text-muted hover:text-danger transition-colors flex items-center justify-center p-1"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 4 -->
                                <tr class="hover:bg-black/[0.02] transition-colors">
                                    <td class="px-6 py-4 border-b border-border text-muted">4</td>
                                    <td class="px-6 py-4 border-b border-border font-medium text-heading">Blok D4 - Lembah Hijau</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-primary/20 text-primary flex items-center justify-center text-[10px] font-bold">KT</div>
                                            Koperasi Tani
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border text-heading">Kedelai</td>
                                    <td class="px-6 py-4 border-b border-border">3.2</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-3 py-1 rounded-[0.25rem] bg-success/10 text-success text-[12px] font-medium">Masa Panen</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.lahan.detail') }}" class="text-muted hover:text-primary transition-colors flex items-center justify-center p-1"><span class="material-symbols-outlined text-[18px]">edit</span></a>
                                            <button class="text-muted hover:text-danger transition-colors flex items-center justify-center p-1"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 5 -->
                                <tr class="hover:bg-black/[0.02] transition-colors">
                                    <td class="px-6 py-4 text-muted">5</td>
                                    <td class="px-6 py-4 font-medium text-heading">Blok E5 - Bukit Sari</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-info/20 text-info flex items-center justify-center text-[10px] font-bold">DM</div>
                                            Desa Mandiri
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-heading">Padi IR64</td>
                                    <td class="px-6 py-4">5.5</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-[0.25rem] bg-info/10 text-info text-[12px] font-medium">Masa Tanam</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="text-muted hover:text-primary transition-colors"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                            <button class="text-muted hover:text-danger transition-colors"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-border flex flex-col sm:flex-row items-center justify-between gap-4">
                        <span class="text-[13px] text-muted">Menampilkan 1 hingga 5 dari 128 Lahan</span>
                        <div class="flex items-center gap-1">
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] border border-border text-muted hover:bg-black/5 transition-colors disabled:opacity-50" disabled>
                                <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                            </button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] bg-primary text-white font-medium text-[13px] shadow-primary">1</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] text-body hover:bg-black/5 transition-colors font-medium text-[13px]">2</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] text-body hover:bg-black/5 transition-colors font-medium text-[13px]">3</button>
                            <span class="w-8 h-8 flex items-center justify-center text-muted text-[13px]">...</span>
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] text-body hover:bg-black/5 transition-colors font-medium text-[13px]">26</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] border border-border text-muted hover:bg-black/5 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                            </button>
                        </div>
                    </div>

                </div>

@endsection
