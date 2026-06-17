@extends('layouts.app')

@section('title', 'Dashboard - TaniPantau')

@section('content')
                
                <!-- Row 1: Welcome & Weather -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-6">
                    <!-- Welcome Card (Spans 8 cols on desktop) -->
                    <div class="md:col-span-12 lg:col-span-8">
                        <div class="bg-primary text-white rounded-[0.5rem] shadow-primary relative overflow-hidden h-full">
                            <div class="flex flex-col sm:flex-row items-center sm:items-stretch h-full">
                                <div class="p-6 sm:w-2/3 flex flex-col justify-center relative z-10">
                                    <h5 class="text-[1.125rem] font-medium text-white mb-3">Selamat Datang, Ahmad! 🎉</h5>
                                    <p class="text-[0.9375rem] mb-4 text-white/90 leading-relaxed">
                                        Performa lahan pertanian Anda naik <span class="font-bold text-white">18%</span> bulan ini. Cek laporan irigasi dan estimasi panen sekarang.
                                    </p>
                                    <div>
                                        <a href="#" class="inline-block px-4 py-1.5 rounded-[0.375rem] bg-white text-primary text-[13px] font-semibold hover:bg-white/90 transition-all shadow-sm">Lihat Laporan</a>
                                    </div>
                                </div>
                                <!-- Subtle Icon Background -->
                                <div class="sm:w-1/3 flex items-end justify-center sm:justify-end pb-0 sm:pr-6 mt-4 sm:mt-0 relative h-32 sm:h-auto pointer-events-none z-0">
                                    <span class="material-symbols-outlined text-white/20 text-[120px] absolute -bottom-6 -right-6" style="font-variation-settings: 'FILL' 1;">eco</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Weather Widget (Spans 4 cols on desktop) -->
                    <div class="md:col-span-12 lg:col-span-4">
                        <div class="bg-white rounded-[0.5rem] shadow-card p-6 h-full flex flex-col justify-between relative overflow-hidden">
                            <div class="flex justify-between items-start relative z-10">
                                <div>
                                    <h6 class="text-[14px] font-semibold text-heading mb-1">Cuaca Hari Ini</h6>
                                    <p class="text-[12px] text-muted">Kecamatan Ngawi</p>
                                </div>
                                <div class="w-10 h-10 rounded-full bg-warning/10 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-warning text-[24px]">partly_cloudy_day</span>
                                </div>
                            </div>
                            <div class="mt-4 relative z-10">
                                <h3 class="text-[2.25rem] font-bold text-heading m-0 leading-tight">28°C</h3>
                                <p class="text-[13px] font-medium text-body mt-1">Cerah Berawan • Kelembaban 65%</p>
                            </div>
                            <!-- Decorative background element -->
                            <div class="absolute -bottom-8 -right-8 opacity-5 pointer-events-none">
                                <span class="material-symbols-outlined text-[150px]" style="font-variation-settings: 'FILL' 1;">cloud</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Row 2: 4 Stats Grids -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Stat 1: Lahan -->
                    <div class="bg-white rounded-[0.5rem] shadow-card p-5 flex flex-col justify-between hover:-translate-y-1 transition-transform duration-300">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-[0.375rem] bg-success/10 text-success flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-[22px]">landscape</span>
                            </div>
                        </div>
                        <span class="block text-[13px] font-medium text-heading mb-1">Total Lahan (Ha)</span>
                        <h3 class="text-[1.5rem] font-semibold text-heading m-0">1,240</h3>
                        <small class="text-success font-medium flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-[14px]">arrow_upward</span> 12.5%
                        </small>
                    </div>

                    <!-- Stat 2: Panen -->
                    <div class="bg-white rounded-[0.5rem] shadow-card p-5 flex flex-col justify-between hover:-translate-y-1 transition-transform duration-300">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-[0.375rem] bg-info/10 text-info flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-[22px]">agriculture</span>
                            </div>
                        </div>
                        <span class="block text-[13px] font-medium text-heading mb-1">Est. Panen (Ton)</span>
                        <h3 class="text-[1.5rem] font-semibold text-heading m-0">8,450</h3>
                        <small class="text-success font-medium flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-[14px]">arrow_upward</span> 4.2%
                        </small>
                    </div>

                    <!-- Stat 3: Petugas -->
                    <div class="bg-white rounded-[0.5rem] shadow-card p-5 flex flex-col justify-between hover:-translate-y-1 transition-transform duration-300">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-[0.375rem] bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-[22px]">group</span>
                            </div>
                        </div>
                        <span class="block text-[13px] font-medium text-heading mb-1">Petugas Aktif</span>
                        <h3 class="text-[1.5rem] font-semibold text-heading m-0">45</h3>
                        <small class="text-success font-medium flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-[14px]">arrow_upward</span> 2 Petugas Baru
                        </small>
                    </div>

                    <!-- Stat 4: Peringatan -->
                    <div class="bg-white rounded-[0.5rem] shadow-card p-5 flex flex-col justify-between hover:-translate-y-1 transition-transform duration-300">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-[0.375rem] bg-danger/10 text-danger flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-[22px]">warning</span>
                            </div>
                        </div>
                        <span class="block text-[13px] font-medium text-heading mb-1">Peringatan Lahan</span>
                        <h3 class="text-[1.5rem] font-semibold text-heading m-0">3</h3>
                        <small class="text-danger font-medium flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-[14px]">arrow_upward</span> 1 Serangan Hama
                        </small>
                    </div>
                </div>

                <!-- Data Table Section -->
                <div class="mt-6">
                    <div class="bg-white rounded-[0.5rem] shadow-card">
                        
                        <!-- Table Header -->
                        <div class="px-6 py-5 flex items-center justify-between border-b border-border">
                            <h5 class="text-[1.125rem] font-medium text-heading m-0">Status Lahan Operasional</h5>
                            <button class="p-1.5 hover:bg-black/5 rounded-md transition-colors text-muted">
                                <span class="material-symbols-outlined text-[20px]">more_vert</span>
                            </button>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Nama Lahan</th>
                                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Komoditas</th>
                                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Kelembaban</th>
                                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Petugas</th>
                                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Status</th>
                                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-[14px] text-body">
                                    <!-- Row 1 -->
                                    <tr class="hover:bg-black/[0.02] transition-colors group">
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded bg-primary/10 text-primary flex items-center justify-center font-bold text-[12px]">U1</div>
                                                <span class="font-medium text-heading">Blok Utara A1</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">Padi</td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-2">
                                                <div class="w-full h-1.5 bg-border rounded-full overflow-hidden max-w-[80px]">
                                                    <div class="h-full bg-primary" style="width: 65%;"></div>
                                                </div>
                                                <span class="text-[13px] font-medium">65%</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-2">
                                                <img src="https://ui-avatars.com/api/?name=Budi+S&background=random&rounded=true" class="w-6 h-6 rounded-full" alt="Budi">
                                                <span>Budi S.</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <span class="px-2 py-1 rounded-[0.25rem] bg-success/10 text-success text-[12px] font-medium">Terawat</span>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border text-center">
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        </td>
                                    </tr>
                                    
                                    <!-- Row 2 -->
                                    <tr class="hover:bg-black/[0.02] transition-colors group">
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded bg-warning/10 text-warning flex items-center justify-center font-bold text-[12px]">S2</div>
                                                <span class="font-medium text-heading">Blok Selatan B2</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">Jagung</td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-2">
                                                <div class="w-full h-1.5 bg-border rounded-full overflow-hidden max-w-[80px]">
                                                    <div class="h-full bg-warning" style="width: 42%;"></div>
                                                </div>
                                                <span class="text-[13px] font-medium">42%</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-2">
                                                <img src="https://ui-avatars.com/api/?name=Agus+T&background=random&rounded=true" class="w-6 h-6 rounded-full" alt="Agus">
                                                <span>Agus T.</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <span class="px-2 py-1 rounded-[0.25rem] bg-warning/10 text-warning text-[12px] font-medium">Irigasi</span>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border text-center">
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        </td>
                                    </tr>

                                    <!-- Row 3 -->
                                    <tr class="hover:bg-black/[0.02] transition-colors group">
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded bg-danger/10 text-danger flex items-center justify-center font-bold text-[12px]">T1</div>
                                                <span class="font-medium text-heading">Blok Timur C1</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">Kedelai</td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-2">
                                                <div class="w-full h-1.5 bg-border rounded-full overflow-hidden max-w-[80px]">
                                                    <div class="h-full bg-danger" style="width: 28%;"></div>
                                                </div>
                                                <span class="text-[13px] font-medium">28%</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <div class="flex items-center gap-2">
                                                <img src="https://ui-avatars.com/api/?name=Dewi+K&background=random&rounded=true" class="w-6 h-6 rounded-full" alt="Dewi">
                                                <span>Dewi K.</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border">
                                            <span class="px-2 py-1 rounded-[0.25rem] bg-danger/10 text-danger text-[12px] font-medium">Kritis</span>
                                        </td>
                                        <td class="px-6 py-3 border-b border-border text-center">
                                            <button class="text-muted hover:text-primary transition-colors opacity-0 group-hover:opacity-100"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

@endsection
