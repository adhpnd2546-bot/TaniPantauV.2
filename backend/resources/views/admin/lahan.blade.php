@extends('layouts.app')

@section('title', 'Manajemen Lahan - TaniPantau')

@section('content')
    @if(session('success'))
    <div class="mb-4 px-4 py-3 bg-success/10 border border-success/20 text-success rounded-[0.5rem] text-[14px] font-medium">
        {{ session('success') }}
    </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h4 class="text-[1.25rem] font-medium text-heading dark:text-dark-heading mb-1">Daftar Lahan Pertanian</h4>
            <p class="text-[0.9375rem] text-body dark:text-dark-body m-0">Kelola dan pantau seluruh area pertanian terdaftar.</p>
        </div>
        <a href="{{ route('admin.lahan.create') }}" class="bg-primary hover:bg-primary-hover text-white text-[15px] font-medium py-2 px-4 rounded-[0.375rem] flex items-center gap-2 transition-all shadow-primary">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Tambah Lahan
        </a>
    </div>

    <form method="GET" class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-4 mb-6">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <div>
                <label class="text-[11px] font-semibold text-muted dark:text-dark-muted uppercase tracking-wide mb-1.5 block">Komoditas</label>
                <select name="komoditas" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[14px] text-heading dark:text-dark-heading bg-white dark:bg-dark-card appearance-none focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all" style="background-image:url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 12 12%22><path fill=%22%2364748b%22 d=%22M6 8L1 3h10z%22/></svg>');background-repeat:no-repeat;background-position:right 10px center;padding-right:32px;">
                    <option value="">Semua</option>
                    <option value="padi" {{ request('komoditas') == 'padi' ? 'selected' : '' }}>Padi</option>
                    <option value="jagung" {{ request('komoditas') == 'jagung' ? 'selected' : '' }}>Jagung</option>
                    <option value="hortikultura" {{ request('komoditas') == 'hortikultura' ? 'selected' : '' }}>Hortikultura</option>
                </select>
            </div>
            <div>
                <label class="text-[11px] font-semibold text-muted dark:text-dark-muted uppercase tracking-wide mb-1.5 block">Status Fase</label>
                <select name="status_fase" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[14px] text-heading dark:text-dark-heading bg-white dark:bg-dark-card appearance-none focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all" style="background-image:url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 12 12%22><path fill=%22%2364748b%22 d=%22M6 8L1 3h10z%22/></svg>');background-repeat:no-repeat;background-position:right 10px center;padding-right:32px;">
                    <option value="">Semua</option>
                    <option value="persiapan" {{ request('status_fase') == 'persiapan' ? 'selected' : '' }}>Persiapan</option>
                    <option value="tanam" {{ request('status_fase') == 'tanam' ? 'selected' : '' }}>Tanam</option>
                    <option value="pemeliharaan" {{ request('status_fase') == 'pemeliharaan' ? 'selected' : '' }}>Pemeliharaan</option>
                    <option value="panen" {{ request('status_fase') == 'panen' ? 'selected' : '' }}>Panen</option>
                </select>
            </div>
            <div>
                <label class="text-[11px] font-semibold text-muted dark:text-dark-muted uppercase tracking-wide mb-1.5 block">Kecamatan</label>
                <select name="kecamatan" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[14px] text-heading dark:text-dark-heading bg-white dark:bg-dark-card appearance-none focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all" style="background-image:url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 12 12%22><path fill=%22%2364748b%22 d=%22M6 8L1 3h10z%22/></svg>');background-repeat:no-repeat;background-position:right 10px center;padding-right:32px;">
                    <option value="">Semua</option>
                    @foreach($kecamatan as $k)
                        <option value="{{ $k->id }}" {{ request('kecamatan') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-[11px] font-semibold text-muted dark:text-dark-muted uppercase tracking-wide mb-1.5 block">Petugas</label>
                <select name="petugas" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[14px] text-heading dark:text-dark-heading bg-white dark:bg-dark-card appearance-none focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all" style="background-image:url('data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%2212%22 viewBox=%220 0 12 12%22><path fill=%22%2364748b%22 d=%22M6 8L1 3h10z%22/></svg>');background-repeat:no-repeat;background-position:right 10px center;padding-right:32px;">
                    <option value="">Semua</option>
                    @foreach($petugas as $p)
                        <option value="{{ $p->id }}" {{ request('petugas') == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="bg-primary hover:bg-primary-hover text-white px-4 py-2 rounded-[0.375rem] text-[13px] font-semibold transition-all shadow-primary flex-1">Filter</button>
                <a href="{{ route('admin.lahan.index') }}" class="bg-white dark:bg-dark-card border border-border dark:border-dark-border px-4 py-2 rounded-[0.375rem] text-[13px] text-muted dark:text-dark-muted hover:text-heading dark:text-dark-heading hover:bg-slate-50 dark:hover:bg-dark-border/20 transition-all">Reset</a>
            </div>
        </div>
    </form>

    <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card">
        <div class="px-6 py-4 border-b border-border dark:border-dark-border flex justify-between items-center">
            <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading m-0">{{ $lahan->total() }} Lahan Terdaftar</h5>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase w-16">#</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Nama Lahan</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Petani</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Komoditas</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Petugas</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Luas (Ha)</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Fase</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[14px] text-body dark:text-dark-body">
                    @forelse($lahan as $i => $l)
                    <tr class="hover:bg-slate-50 dark:hover:bg-dark-border/20 transition-colors">
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border text-muted dark:text-dark-muted">{{ $lahan->firstItem() + $i }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border font-medium text-heading dark:text-dark-heading">{{ $l->nama_lahan }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">{{ $l->petani->nama_petani ?? '-' }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border text-heading dark:text-dark-heading">{{ ucfirst($l->komoditas) }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">{{ $l->petugas->name ?? '-' }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">{{ number_format($l->luas_lahan, 1) }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">
                            @php
                                $faseStyles = [
                                    'persiapan' => 'background:#8592a315;color:#8592a3;',
                                    'tanam' => 'background:#03c3ec20;color:#03c3ec;',
                                    'pemeliharaan' => 'background:#ffab0020;color:#e69a00;',
                                    'panen' => 'background:#71dd3720;color:#56b82a;',
                                ];
                                $style = $faseStyles[$l->status_fase] ?? 'background:#8592a315;color:#8592a3;';
                            @endphp
                            <span class="px-3 py-1 rounded-[0.25rem] text-[12px] font-semibold inline-block" style="{{ $style }}">{{ ucfirst($l->status_fase) }}</span>
                        </td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.lahan.show', $l->id) }}" class="text-muted dark:text-dark-muted hover:text-primary transition-colors p-1" title="Detail">
                                    <span class="material-symbols-outlined text-[18px] notranslate" translate="no">visibility</span>
                                </a>
                                <a href="{{ route('admin.lahan.edit', $l->id) }}" class="text-muted dark:text-dark-muted hover:text-primary transition-colors p-1" title="Edit">
                                    <span class="material-symbols-outlined text-[18px] notranslate" translate="no">edit</span>
                                </a>
                                <form action="{{ route('admin.lahan.destroy', $l->id) }}" method="POST" onsubmit="return confirm('Hapus data lahan ini?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-muted dark:text-dark-muted hover:text-danger transition-colors p-1" title="Hapus">
                                        <span class="material-symbols-outlined text-[18px] notranslate" translate="no">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-6 py-8 text-center text-muted dark:text-dark-muted">Belum ada data lahan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($lahan->hasPages())
        <div class="px-6 py-4 border-t border-border dark:border-dark-border flex flex-col sm:flex-row items-center justify-between gap-4">
            <span class="text-[13px] text-muted dark:text-dark-muted">Menampilkan {{ $lahan->firstItem() }} hingga {{ $lahan->lastItem() }} dari {{ $lahan->total() }} Lahan</span>
            <div class="flex items-center gap-1">
                {{ $lahan->links() }}
            </div>
        </div>
        @endif
    </div>
@endsection
