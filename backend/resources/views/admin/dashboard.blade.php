@extends('layouts.app')

@section('title', 'Dashboard - TaniPantau')

@section('content')
    <!-- Row 1: Welcome -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-6">
        <div class="md:col-span-12 lg:col-span-8">
            <div class="bg-primary text-white rounded-[0.5rem] shadow-primary relative overflow-hidden h-full">
                <div class="flex flex-col sm:flex-row items-center sm:items-stretch h-full">
                    <div class="p-6 sm:w-2/3 flex flex-col justify-center relative z-10">
                        <h5 class="text-[1.125rem] font-medium text-white mb-3">Selamat Datang! 🎉</h5>
                        <p class="text-[0.9375rem] mb-4 text-white/90 leading-relaxed">
                            Total <span class="font-bold text-white">{{ $totalLahan }}</span> lahan terdaftar dengan <span
                                class="font-bold text-white">{{ $totalPetani }}</span> petani. Pantau perkembangan
                            lahan dan kunjungan secara real-time.
                        </p>
                        <div>
                            <a href="{{ route('admin.lahan.index') }}"
                                class="inline-block px-4 py-1.5 rounded-[0.375rem] bg-white dark:bg-dark-card text-primary text-[13px] font-semibold hover:bg-white/90 transition-all shadow-sm">Lihat
                                Lahan</a>
                        </div>
                    </div>
                    <div
                        class="sm:w-1/3 flex items-end justify-center sm:justify-end pb-0 sm:pr-6 mt-4 sm:mt-0 relative h-32 sm:h-auto pointer-events-none z-0">
                        <span class="material-symbols-outlined text-white/20 text-[120px] absolute -bottom-6 -right-6"
                            style="font-variation-settings: 'FILL' 1;">eco</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:col-span-12 lg:col-span-4">
            <div
                class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-6 h-full flex flex-col justify-between relative overflow-hidden">
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <h6 class="text-[14px] font-semibold text-heading dark:text-dark-heading mb-1">Ringkasan Data</h6>
                        <p class="text-[12px] text-muted dark:text-dark-muted">TaniPantau Dashboard</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-[24px]"
                            style="font-variation-settings: 'FILL' 1;">monitoring</span>
                    </div>
                </div>
                <div class="mt-4 relative z-10">
                    <h3 class="text-[2.25rem] font-bold text-heading dark:text-dark-heading m-0 leading-tight">{{ $totalKunjungan }}</h3>
                    <p class="text-[13px] font-medium text-body dark:text-dark-body mt-1">Total Kunjungan Tercatat</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2: 4 Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-5 hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-[0.375rem] bg-success/10 text-success flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">groups</span>
                </div>
            </div>
            <span class="block text-[13px] font-medium text-heading dark:text-dark-heading mb-1">Total Petani</span>
            <h3 class="text-[1.5rem] font-semibold text-heading dark:text-dark-heading m-0">{{ $totalPetani }}</h3>
                <small class="text-success font-medium flex items-center gap-1 mt-1">
                <span class="material-symbols-outlined text-[14px]">circle</span> Terdaftar
            </small>
        </div>

        <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-5 hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-[0.375rem] bg-info/10 text-info flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">landscape</span>
                </div>
            </div>
            <span class="block text-[13px] font-medium text-heading dark:text-dark-heading mb-1">Total Lahan</span>
            <h3 class="text-[1.5rem] font-semibold text-heading dark:text-dark-heading m-0">{{ $totalLahan }}</h3>
            <small class="text-info font-medium flex items-center gap-1 mt-1">
                <span class="material-symbols-outlined text-[14px]">circle</span> Tercatat
            </small>
        </div>

        <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-5 hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-[0.375rem] bg-primary/10 text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">assignment</span>
                </div>
            </div>
            <span class="block text-[13px] font-medium text-heading dark:text-dark-heading mb-1">Total Kunjungan</span>
            <h3 class="text-[1.5rem] font-semibold text-heading dark:text-dark-heading m-0">{{ $totalKunjungan }}</h3>
            <small class="text-success font-medium flex items-center gap-1 mt-1">
                <span class="material-symbols-outlined text-[14px]">circle</span> Tercatat
            </small>
        </div>

        <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-5 hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-[0.375rem] bg-danger/10 text-danger flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">warning</span>
                </div>
            </div>
            <span class="block text-[13px] font-medium text-heading dark:text-dark-heading mb-1">Lahan Perlu Tindakan</span>
            <h3 class="text-[1.5rem] font-semibold text-heading dark:text-dark-heading m-0">{{ $lahanPerluTindakan }}</h3>
            <small class="text-danger font-medium flex items-center gap-1 mt-1">
                <span class="material-symbols-outlined text-[14px]">circle</span> Perlu Perhatian
            </small>
        </div>
    </div>

    @if(!empty($lahanPerPetugas))
    <div class="mt-6 grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-6">
            <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-6">
                <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading m-0 mb-4">Lahan per Petugas</h5>
                <div class="space-y-3">
                    @foreach($lahanPerPetugas as $lp)
                    <div>
                        <div class="flex justify-between text-[13px] mb-1">
                            <span class="font-medium text-heading dark:text-dark-heading">{{ $lp['name'] }}</span>
                            <span class="text-muted dark:text-dark-muted">{{ $lp['total_petani'] }} petani · {{ $lp['total_lahan'] }} lahan</span>
                        </div>
                        @php $max = max(array_column($lahanPerPetugas, 'total_lahan')); @endphp
                        <div class="w-full bg-[#e2e8f0] dark:bg-dark-border rounded-full h-2.5 overflow-hidden">
                            <div class="bg-primary h-2.5 rounded-full transition-all duration-500" style="width: {{ $max > 0 ? ($lp['total_lahan'] / $max) * 100 : 0 }}%;"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="lg:col-span-6">
            <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card">
                <div class="px-6 py-5 flex items-center justify-between border-b border-border dark:border-dark-border">
                    <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading m-0">Lahan Terbaru</h5>
                <a href="{{ route('admin.lahan.index') }}"
                    class="inline-block px-4 py-1.5 rounded-[0.375rem] bg-white dark:bg-dark-card text-primary text-[13px] font-semibold hover:bg-white/90 transition-all shadow-sm">
                    Lihat Lahan
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">
                                Nama Lahan</th>
                            <th
                                class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">
                                Petani</th>
                            <th
                                class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">
                                Komoditas</th>
                            <th
                                class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">
                                Luas (Ha)</th>
                            <th
                                class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">
                                Fase</th>
                        </tr>
                    </thead>
                    <tbody class="text-[14px] text-body dark:text-dark-body">
                        @forelse($lahanTerbaru as $l)
                            <tr class="hover:bg-slate-50 dark:hover:bg-dark-border/20 transition-colors">
                                <td class="px-6 py-3 border-b border-border dark:border-dark-border font-medium text-heading dark:text-dark-heading">{{ $l->nama_lahan }}</td>
                                <td class="px-6 py-3 border-b border-border dark:border-dark-border">{{ $l->petani->nama_petani ?? '-' }}</td>
                                <td class="px-6 py-3 border-b border-border dark:border-dark-border">{{ ucfirst($l->komoditas) }}</td>
                                <td class="px-6 py-3 border-b border-border dark:border-dark-border">{{ number_format($l->luas_lahan, 1) }}</td>
                                <td class="px-6 py-3 border-b border-border dark:border-dark-border">
                                    @php
                                        $faseColors = ['persiapan' => 'bg-secondary/10 text-secondary', 'tanam' => 'bg-info/10 text-info', 'pemeliharaan' => 'bg-warning/10 text-warning', 'panen' => 'bg-success/10 text-success'];
                                        $color = $faseColors[$l->status_fase] ?? 'bg-secondary/10 text-secondary';
                                    @endphp
                                    <span
                                        class="px-2 py-1 rounded-[0.25rem] {{ $color }} text-[12px] font-medium">{{ ucfirst($l->status_fase) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-muted dark:text-dark-muted">Belum ada data lahan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="mt-6">
        <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card">
            <div class="px-6 py-5 flex items-center justify-between border-b border-border dark:border-dark-border">
                <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading m-0">Lahan Terbaru</h5>
                <a href="{{ route('admin.lahan.index') }}"
                    class="inline-block px-4 py-1.5 rounded-[0.375rem] bg-white dark:bg-dark-card text-primary text-[13px] font-semibold hover:bg-white/90 transition-all shadow-sm">
                    Lihat Lahan
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Nama Lahan</th>
                            <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Petani</th>
                            <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Komoditas</th>
                            <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Luas (Ha)</th>
                            <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Fase</th>
                        </tr>
                    </thead>
                    <tbody class="text-[14px] text-body dark:text-dark-body">
                        @forelse($lahanTerbaru as $l)
                            <tr class="hover:bg-slate-50 dark:hover:bg-dark-border/20 transition-colors">
                                <td class="px-6 py-3 border-b border-border dark:border-dark-border font-medium text-heading dark:text-dark-heading">{{ $l->nama_lahan }}</td>
                                <td class="px-6 py-3 border-b border-border dark:border-dark-border">{{ $l->petani->nama_petani ?? '-' }}</td>
                                <td class="px-6 py-3 border-b border-border dark:border-dark-border">{{ ucfirst($l->komoditas) }}</td>
                                <td class="px-6 py-3 border-b border-border dark:border-dark-border">{{ number_format($l->luas_lahan, 1) }}</td>
                                <td class="px-6 py-3 border-b border-border dark:border-dark-border">
                                    @php
                                        $faseColors = ['persiapan' => 'bg-secondary/10 text-secondary', 'tanam' => 'bg-info/10 text-info', 'pemeliharaan' => 'bg-warning/10 text-warning', 'panen' => 'bg-success/10 text-success'];
                                        $color = $faseColors[$l->status_fase] ?? 'bg-secondary/10 text-secondary';
                                    @endphp
                                    <span class="px-2 py-1 rounded-[0.25rem] {{ $color }} text-[12px] font-medium">{{ ucfirst($l->status_fase) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-8 text-center text-muted dark:text-dark-muted">Belum ada data lahan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
@endsection