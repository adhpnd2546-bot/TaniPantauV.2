@extends('layouts.app')

@section('title', 'Detail Lahan - TaniPantau')

@section('content')
                
                <!-- Page Header & Actions -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.lahan') }}" class="p-2 rounded-full hover:bg-black/5 transition-colors text-heading flex items-center justify-center">
                            <span class="material-symbols-outlined text-[24px]">arrow_back</span>
                        </a>
                        <div>
                            <h4 class="text-[1.25rem] font-medium text-heading mb-0">Detail Lahan: Blok A1</h4>
                            <p class="text-[0.875rem] text-muted m-0">ID: LHN-2023-0042 • Status <span class="text-success font-medium">Aktif</span></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <button class="flex-1 sm:flex-none bg-primary/10 text-primary hover:bg-primary hover:text-white transition-colors text-[14px] font-medium py-2 px-4 rounded-[0.375rem] flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">edit</span> Edit
                        </button>
                        <button class="flex-1 sm:flex-none bg-danger/10 text-danger hover:bg-danger hover:text-white transition-colors text-[14px] font-medium py-2 px-4 rounded-[0.375rem] flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">delete</span> Hapus
                        </button>
                    </div>
                </div>

                <!-- First Row: Info & Map -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6">
                    
                    <!-- Card 1: Informasi Umum (8 cols) -->
                    <div class="lg:col-span-8 bg-white rounded-[0.5rem] shadow-card p-6 flex flex-col">
                        <div class="flex items-center gap-2 border-b border-border pb-4 mb-5">
                            <span class="material-symbols-outlined text-primary text-[22px]">info</span>
                            <h5 class="text-[1.125rem] font-medium text-heading m-0">Informasi Umum</h5>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-8">
                            <div>
                                <small class="text-[11px] font-semibold text-muted uppercase tracking-widest block mb-1">Nama Lahan</small>
                                <p class="text-[15px] font-medium text-heading m-0">Blok A1 - Sawah Irigasi</p>
                            </div>
                            <div>
                                <small class="text-[11px] font-semibold text-muted uppercase tracking-widest block mb-1">Pemilik / Petani</small>
                                <p class="text-[15px] font-medium text-primary flex items-center gap-1 cursor-pointer hover:underline m-0">
                                    Budi Santoso
                                    <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                                </p>
                            </div>
                            <div>
                                <small class="text-[11px] font-semibold text-muted uppercase tracking-widest block mb-2">Komoditas</small>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-[0.25rem] bg-info/10 text-info text-[13px] font-medium">
                                    <span class="material-symbols-outlined text-[14px]">grass</span>
                                    Padi (IR64)
                                </span>
                            </div>
                            <div>
                                <small class="text-[11px] font-semibold text-muted uppercase tracking-widest block mb-1">Luas Lahan</small>
                                <p class="text-[15px] font-medium text-heading m-0">2.5 Hektar <span class="text-muted font-normal text-[13px]">(25,000 m²)</span></p>
                            </div>
                            <div>
                                <small class="text-[11px] font-semibold text-muted uppercase tracking-widest block mb-1">Tanggal Mulai Tanam</small>
                                <p class="text-[15px] font-medium text-heading m-0">12 Oktober 2023</p>
                            </div>
                            <div>
                                <small class="text-[11px] font-semibold text-muted uppercase tracking-widest block mb-1">Wilayah Administratif</small>
                                <p class="text-[15px] font-medium text-heading m-0">Desa Sukamaju, Kec. Subang</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Lokasi Peta (4 cols) -->
                    <div class="lg:col-span-4 bg-white rounded-[0.5rem] shadow-card flex flex-col overflow-hidden h-full min-h-[300px]">
                        <div class="p-4 border-b border-border flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[22px]">location_on</span>
                                <h5 class="text-[1rem] font-medium text-heading m-0">Lokasi Peta</h5>
                            </div>
                            <button class="text-muted hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">fullscreen</span>
                            </button>
                        </div>
                        <div class="relative flex-1 bg-background">
                            <!-- Map Image Placeholder -->
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuB2pPk8yYf5jUzOigIwmQlP8Nk11mZUuttzCJi2E4GR-zOzJ2w4kF2Xn-IRwppfZVZPHHV665VCYWeVqVJ2dRcvbVWRysv6bOj3S3n5ON9gR5aaOs4czZmBoB3QanPHq9WQru9tZY8VDYJTY5V1HX7wus_gbV7Vx7f7gQ4T0HMtBJXqbaTvQ_AExOwjzNSrUoMc-DshfKbLxOntKDKh2_d-kbO6_YPTxhoQlSqkFF0aTMbSEJz1hhC6uEd7TkVexUGWA3Ia2sFtBmA" 
                                 alt="Map Placeholder" 
                                 class="absolute inset-0 w-full h-full object-cover">
                            <!-- Pin overlay -->
                            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center drop-shadow-md">
                                <div class="w-4 h-4 bg-primary rounded-full animate-pulse border-2 border-white shadow-[0_0_10px_rgba(22,163,74,0.8)]"></div>
                                <span class="material-symbols-outlined text-danger text-[36px] -mt-1" style="font-variation-settings: 'FILL' 1;">location_on</span>
                            </div>
                            <!-- Coordinate Badge -->
                            <div class="absolute bottom-3 left-3 right-3 bg-white/95 backdrop-blur shadow-sm rounded border border-border p-2 text-center text-[12px] font-medium text-heading">
                                -6.5684° S, 107.7589° E
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second Row: Stepper & Kunjungan -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6">
                    
                    <!-- Card 3: Status Fase Pertumbuhan (6 cols) -->
                    <div class="lg:col-span-7 bg-white rounded-[0.5rem] shadow-card p-6">
                        <div class="flex items-center gap-2 border-b border-border pb-4 mb-6">
                            <span class="material-symbols-outlined text-warning text-[22px]" style="font-variation-settings: 'FILL' 1;">psychiatry</span>
                            <h5 class="text-[1.125rem] font-medium text-heading m-0">Fase Pertumbuhan</h5>
                        </div>
                        
                        <!-- Stepper Component -->
                        <div class="relative w-full px-4 sm:px-8 pb-4">
                            <!-- Line Background -->
                            <div class="absolute top-5 left-[10%] right-[10%] h-[2px] bg-border z-0"></div>
                            <!-- Line Progress -->
                            <div class="absolute top-5 left-[10%] w-[35%] h-[2px] bg-primary z-0"></div>

                            <div class="flex justify-between items-start relative z-10">
                                
                                <!-- Step 1 (Done) -->
                                <div class="flex flex-col items-center gap-2 w-1/4">
                                    <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center shadow-primary">
                                        <span class="material-symbols-outlined text-[20px]">check</span>
                                    </div>
                                    <span class="text-[13px] font-semibold text-heading mt-1">Persiapan</span>
                                </div>
                                
                                <!-- Step 2 (Active) -->
                                <div class="flex flex-col items-center gap-2 w-1/4 relative">
                                    <div class="w-10 h-10 rounded-full bg-white border-2 border-primary text-primary flex items-center justify-center shadow-sm z-10 ring-4 ring-primary/10">
                                        <div class="w-3.5 h-3.5 bg-primary rounded-full"></div>
                                    </div>
                                    <!-- Tooltip -->
                                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-primary text-white text-[11px] font-bold px-2 py-1 rounded-[0.25rem] shadow-sm whitespace-nowrap">
                                        Saat Ini
                                    </div>
                                    <span class="text-[13px] font-bold text-primary mt-1">Tanam</span>
                                </div>

                                <!-- Step 3 (Pending) -->
                                <div class="flex flex-col items-center gap-2 w-1/4">
                                    <div class="w-10 h-10 rounded-full bg-white border-2 border-border text-muted flex items-center justify-center bg-background">
                                        <span class="material-symbols-outlined text-[20px]">water_drop</span>
                                    </div>
                                    <span class="text-[13px] font-medium text-muted mt-1">Vegetatif</span>
                                </div>

                                <!-- Step 4 (Pending) -->
                                <div class="flex flex-col items-center gap-2 w-1/4">
                                    <div class="w-10 h-10 rounded-full bg-white border-2 border-border text-muted flex items-center justify-center bg-background">
                                        <span class="material-symbols-outlined text-[20px]">agriculture</span>
                                    </div>
                                    <span class="text-[13px] font-medium text-muted mt-1">Panen</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Ringkasan Kunjungan (5 cols) -->
                    <div class="lg:col-span-5 bg-white rounded-[0.5rem] shadow-card p-6">
                        <div class="flex items-center gap-2 border-b border-border pb-4 mb-6">
                            <span class="material-symbols-outlined text-info text-[22px]">fact_check</span>
                            <h5 class="text-[1.125rem] font-medium text-heading m-0">Ringkasan Laporan</h5>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-primary/5 rounded-[0.5rem] p-4 flex flex-col justify-center items-center text-center border border-primary/10">
                                <span class="text-[2rem] font-bold text-primary leading-none mb-1">12</span>
                                <span class="text-[12px] font-medium text-muted uppercase tracking-wider">Total Kunjungan</span>
                            </div>
                            <div class="bg-background rounded-[0.5rem] p-4 flex flex-col justify-center border border-border">
                                <small class="text-[11px] font-semibold text-muted uppercase tracking-widest block mb-1">Kunjungan Terakhir</small>
                                <p class="text-[15px] font-semibold text-heading mb-2">02 Nov 2023</p>
                                <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-[0.25rem] bg-success/10 text-success text-[12px] font-medium w-fit">
                                    <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                    Normal
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Third Row: Riwayat Kunjungan Table -->
                <div class="bg-white rounded-[0.5rem] shadow-card">
                    <div class="px-6 py-5 border-b border-border flex items-center justify-between">
                        <h5 class="text-[1.125rem] font-medium text-heading m-0">Riwayat Kunjungan Petugas</h5>
                        <button class="bg-background hover:bg-black/5 text-body text-[13px] font-medium py-1.5 px-3 rounded-[0.375rem] border border-border transition-colors flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px]">filter_list</span> Filter
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[800px]">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Tanggal & Waktu</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Petugas</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Kondisi</th>
                                    <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Catatan & Lampiran</th>
                                </tr>
                            </thead>
                            <tbody class="text-[14px] text-body">
                                
                                <!-- Row 1 -->
                                <tr class="hover:bg-black/[0.02] transition-colors">
                                    <td class="px-6 py-4 border-b border-border font-medium text-heading">02 Nov 2023, 09:30</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-primary/20 text-primary flex items-center justify-center text-[10px] font-bold">AS</div>
                                            Ahmad Sobari
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-2 py-1 rounded-[0.25rem] bg-success/10 text-success text-[12px] font-medium">Normal</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-4">
                                            <span class="text-body truncate max-w-[200px]" title="Pertumbuhan bibit baik, air irigasi cukup.">Pertumbuhan bibit baik, air iri...</span>
                                            <button class="text-info hover:text-primary transition-colors flex items-center gap-1 text-[13px] font-medium">
                                                <span class="material-symbols-outlined text-[16px]">image</span> 2 Foto
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 2 -->
                                <tr class="hover:bg-black/[0.02] transition-colors">
                                    <td class="px-6 py-4 border-b border-border font-medium text-heading">26 Okt 2023, 14:15</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-warning/20 text-warning flex items-center justify-center text-[10px] font-bold">DW</div>
                                            Dwi Wulandari
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-2 py-1 rounded-[0.25rem] bg-warning/10 text-warning text-[12px] font-medium">Perhatian</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-4">
                                            <span class="text-body truncate max-w-[200px]" title="Ditemukan indikasi awal hama wereng di petak timur.">Ditemukan indikasi awal ham...</span>
                                            <button class="text-info hover:text-primary transition-colors flex items-center gap-1 text-[13px] font-medium">
                                                <span class="material-symbols-outlined text-[16px]">description</span> Detail
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 3 -->
                                <tr class="hover:bg-black/[0.02] transition-colors">
                                    <td class="px-6 py-4 border-b border-border font-medium text-heading">12 Okt 2023, 08:00</td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-full bg-primary/20 text-primary flex items-center justify-center text-[10px] font-bold">AS</div>
                                            Ahmad Sobari
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <span class="px-2 py-1 rounded-[0.25rem] bg-info/10 text-info text-[12px] font-medium">Awal Tanam</span>
                                    </td>
                                    <td class="px-6 py-4 border-b border-border">
                                        <div class="flex items-center gap-4">
                                            <span class="text-body truncate max-w-[200px]">Proses penanaman bibit s...</span>
                                            <button class="text-info hover:text-primary transition-colors flex items-center gap-1 text-[13px] font-medium">
                                                <span class="material-symbols-outlined text-[16px]">image</span> 5 Foto
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 bg-background/50 text-center rounded-b-[0.5rem]">
                        <button class="text-primary hover:text-primary-hover font-medium text-[14px] transition-colors">Lihat Semua Riwayat</button>
                    </div>
                </div>

@endsection
