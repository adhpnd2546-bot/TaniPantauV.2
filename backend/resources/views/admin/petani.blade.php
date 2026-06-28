@extends('layouts.app')

@section('title', 'Manajemen Petani - TaniPantau')

@section('content')
    @if(session('success'))
    <div class="mb-4 px-4 py-3 bg-success/10 border border-success/20 text-success rounded-[0.5rem] text-[14px] font-medium">
        {{ session('success') }}
    </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h4 class="text-[1.25rem] font-medium text-heading dark:text-dark-heading mb-1">Daftar Petani</h4>
            <p class="text-[0.9375rem] text-body dark:text-dark-body m-0">Kelola data petani dan status keaktifan.</p>
        </div>
        <a href="{{ route('admin.petani.create') }}" class="bg-primary hover:bg-primary-hover text-white text-[15px] font-medium py-2 px-4 rounded-[0.375rem] flex items-center gap-2 transition-all shadow-primary">
            <span class="material-symbols-outlined text-[20px]">person_add</span>
            Tambah Petani
        </a>
    </div>

    <div class=" bg-white dark:bg-dark-card  dark:bg-dark-card rounded-[0.5rem] shadow-card">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase w-12 text-center">#</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Nama Petani</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">NIK</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Desa / Kecamatan</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Total Lahan</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Petugas Lapang</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Status</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase text-right w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[14px] text-body dark:text-dark-body">
                    @forelse($petani as $i => $p)
                    <tr class="hover:bg-slate-50 dark:hover:bg-dark-border/20 transition-colors group">
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border text-muted dark:text-dark-muted text-center">{{ $petani->firstItem() + $i }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($p->nama_petani) }}&background=random&rounded=true" class="w-9 h-9 rounded-full" alt="">
                                <div>
                                    <div class="font-medium text-heading dark:text-dark-heading">{{ $p->nama_petani }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border font-mono text-[13px] tracking-wide">{{ $p->nik }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">
                            <div class="font-medium text-heading dark:text-dark-heading">{{ $p->desa->nama ?? '-' }}</div>
                            <div class="text-[12px] text-muted dark:text-dark-muted">Kec. {{ $p->kecamatan->nama ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">{{ $p->lahan_count }} Lahan</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">
                            @if($p->petugas)
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($p->petugas->name) }}&background=16A34A&color=fff&rounded=true" class="w-6 h-6 rounded-full" alt="">
                                    <span class="text-[13px] font-medium">{{ $p->petugas->name }}</span>
                                </div>
                            @else
                                <span class="text-[13px] text-muted dark:text-dark-muted italic">Belum ditugaskan</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-[0.25rem] bg-success/10 text-success text-[12px] font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-success"></span>
                                Aktif
                            </span>
                        </td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.petani.edit', $p->id) }}" class="text-muted dark:text-dark-muted hover:text-primary transition-colors p-1">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <form action="{{ route('admin.petani.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus data petani ini?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-muted dark:text-dark-muted hover:text-danger transition-colors p-1">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-6 py-8 text-center text-muted dark:text-dark-muted">Belum ada data petani.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($petani->hasPages())
        <div class="px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-border dark:border-dark-border">
            <span class="text-[13px] text-muted dark:text-dark-muted">Menampilkan {{ $petani->firstItem() }} hingga {{ $petani->lastItem() }} dari {{ $petani->total() }} Petani</span>
            <div class="overflow-x-auto max-w-full">
                <div class="flex items-center gap-1">
                    @if($petani->onFirstPage())
                        <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] border border-border dark:border-dark-border text-muted dark:text-dark-muted opacity-50 flex-shrink-0" disabled>
                            <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                        </button>
                    @else
                        <a href="{{ $petani->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] border border-border dark:border-dark-border text-muted dark:text-dark-muted hover:bg-slate-100 dark:hover:bg-dark-border/30 transition-colors flex-shrink-0">
                            <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                        </a>
                    @endif
                    @foreach($petani->getUrlRange(1, $petani->lastPage()) as $page => $url)
                        <a href="{{ $url }}" class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] flex-shrink-0 {{ $page == $petani->currentPage() ? 'bg-primary text-white font-medium shadow-primary' : 'text-body dark:text-dark-body hover:bg-slate-100 dark:hover:bg-dark-border/30' }} transition-colors font-medium text-[13px]">{{ $page }}</a>
                    @endforeach
                    @if($petani->hasMorePages())
                        <a href="{{ $petani->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] border border-border dark:border-dark-border text-muted dark:text-dark-muted hover:bg-slate-100 dark:hover:bg-dark-border/30 transition-colors flex-shrink-0">
                            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                        </a>
                    @else
                        <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] border border-border dark:border-dark-border text-muted dark:text-dark-muted opacity-50 flex-shrink-0" disabled>
                            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
