@extends('layouts.app')

@section('title', 'Manajemen Petani - TaniPantau')

@section('content')
                
                <!-- Page Header -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div>
                        <h4 class="text-[1.25rem] font-medium text-heading mb-1">Daftar Petani</h4>
                        <p class="text-[0.9375rem] text-body m-0">Kelola data petani, kelompok tani, lokasi, dan status keaktifan.</p>
                    </div>
                    <button class="bg-primary hover:bg-primary-hover text-white text-[15px] font-medium py-2 px-4 rounded-[0.375rem] flex items-center gap-2 transition-all shadow-primary">
                        <span class="material-symbols-outlined text-[20px]">person_add</span>
                        Tambah Petani
                    </button>
                </div>

                <!-- Filters Card -->
                <div class="bg-white rounded-[0.5rem] shadow-card mb-6 p-5">
                    <div class="flex flex-col md:flex-row items-end gap-4">
                        
                        <!-- Search -->
                        <div class="flex flex-col w-full md:flex-1">
                            <label class="text-[12px] font-medium text-heading mb-1.5 uppercase tracking-wide">Pencarian</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-muted text-[18px]">search</span>
                                <input type="text" placeholder="Cari Nama Petani atau NIK..." class="w-full pl-10 pr-4 py-2 border border-border rounded-[0.375rem] text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all">
                            </div>
                        </div>
                        
                        <!-- Desa / Kecamatan -->
                        <div class="flex flex-col w-full md:w-48">
                            <label class="text-[12px] font-medium text-heading mb-1.5 uppercase tracking-wide">Desa / Kecamatan</label>
                            <select class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all">
                                <option value="">Semua Wilayah</option>
                                <option value="desa_a">Suka Maju</option>
                                <option value="desa_b">Tani Makmur</option>
                                <option value="desa_c">Sumber Rejo</option>
                            </select>
                        </div>
                        
                        <!-- Status -->
                        <div class="flex flex-col w-full md:w-40">
                            <label class="text-[12px] font-medium text-heading mb-1.5 uppercase tracking-wide">Status</label>
                            <select class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-body focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all">
                                <option value="">Semua</option>
                                <option value="active">Aktif</option>
                                <option value="inactive">Non-Aktif</option>
                                <option value="pending">Menunggu</option>
                            </select>
                        </div>

                        <!-- Action -->
                        <div class="w-full md:w-auto">
                            <button class="w-full md:w-auto border border-border hover:bg-black/5 text-heading font-medium text-[15px] py-2 px-4 rounded-[0.375rem] transition-colors flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-[20px]">filter_list</span>
                                Filter
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Data Table Card -->
                <div class="bg-white rounded-[0.5rem] shadow-card">
                    
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[900px]">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase w-12 text-center">#</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Nama Petani</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">NIK</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Desa / Kecamatan</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Total Lahan</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Status</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase text-right w-24">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-[14px] text-body">
                                
                                <!-- Row 1 -->
                                <tr class="hover:bg-black/[0.02] transition-colors group">
                                    <td class="px-6 py-4 border-b border-border text-muted text-center">1</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name=Budi+S&background=random&rounded=true" class="w-9 h-9 rounded-full" alt="Budi">
                                            <div>
                                                <div class="font-medium text-heading">Budi Santoso</div>
                                                <div class="text-[12px] text-muted">Kelompok Tani Makmur</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border font-mono text-[13px] tracking-wide">3501020304050001</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="font-medium text-heading">Suka Maju</div>
                                        <div class="text-[12px] text-muted">Kec. Nglegok</div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px] text-muted">landscape</span>
                                            2.5 Ha
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-3 py-1 rounded-[0.25rem] bg-primary/10 text-primary text-[12px] font-medium">Aktif</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">visibility</span></button>
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                            <button class="text-muted hover:text-danger transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 2 -->
                                <tr class="hover:bg-black/[0.02] transition-colors group">
                                    <td class="px-6 py-4 border-b border-border text-muted text-center">2</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name=Siti+M&background=random&rounded=true" class="w-9 h-9 rounded-full" alt="Siti">
                                            <div>
                                                <div class="font-medium text-heading">Siti Maryam</div>
                                                <div class="text-[12px] text-muted">Kelompok Tani Sejahtera</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border font-mono text-[13px] tracking-wide">3501020304050002</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="font-medium text-heading">Suka Maju</div>
                                        <div class="text-[12px] text-muted">Kec. Nglegok</div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px] text-muted">landscape</span>
                                            1.8 Ha
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-3 py-1 rounded-[0.25rem] bg-warning/10 text-warning text-[12px] font-medium">Menunggu</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">visibility</span></button>
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                            <button class="text-muted hover:text-danger transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 3 -->
                                <tr class="hover:bg-black/[0.02] transition-colors group">
                                    <td class="px-6 py-4 border-b border-border text-muted text-center">3</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name=Haji+M&background=random&rounded=true" class="w-9 h-9 rounded-full" alt="Haji">
                                            <div>
                                                <div class="font-medium text-heading">Haji Maman</div>
                                                <div class="text-[12px] text-muted">Ketua Gapoktan</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border font-mono text-[13px] tracking-wide">3501020304050003</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="font-medium text-heading">Sumber Rejo</div>
                                        <div class="text-[12px] text-muted">Kec. Ponggok</div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px] text-muted">landscape</span>
                                            4.0 Ha
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-3 py-1 rounded-[0.25rem] bg-primary/10 text-primary text-[12px] font-medium">Aktif</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">visibility</span></button>
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                            <button class="text-muted hover:text-danger transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 4 -->
                                <tr class="hover:bg-black/[0.02] transition-colors group">
                                    <td class="px-6 py-4 border-b border-border text-muted text-center">4</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name=Tarjo&background=random&rounded=true" class="w-9 h-9 rounded-full" alt="Tarjo">
                                            <div>
                                                <div class="font-medium text-heading">Tarjo Kusumo</div>
                                                <div class="text-[12px] text-muted">Petani Mandiri</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border font-mono text-[13px] tracking-wide">3501020304050004</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="font-medium text-heading">Tani Makmur</div>
                                        <div class="text-[12px] text-muted">Kec. Udanawu</div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[16px] text-muted">landscape</span>
                                            1.2 Ha
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-3 py-1 rounded-[0.25rem] bg-secondary/10 text-secondary text-[12px] font-medium">Non-Aktif</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">visibility</span></button>
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                            <button class="text-muted hover:text-danger transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <span class="text-[13px] text-muted">Menampilkan 1 hingga 4 dari 85 Petani</span>
                        <div class="flex items-center gap-1">
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] border border-border text-muted hover:bg-black/5 transition-colors disabled:opacity-50" disabled>
                                <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                            </button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] bg-primary text-white font-medium text-[13px] shadow-primary">1</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] text-body hover:bg-black/5 transition-colors font-medium text-[13px]">2</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] text-body hover:bg-black/5 transition-colors font-medium text-[13px]">3</button>
                            <span class="w-8 h-8 flex items-center justify-center text-muted text-[13px]">...</span>
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] text-body hover:bg-black/5 transition-colors font-medium text-[13px]">12</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] border border-border text-muted hover:bg-black/5 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                            </button>
                        </div>
                    </div>

                </div>

@endsection
