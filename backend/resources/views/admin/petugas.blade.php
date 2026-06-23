@extends('layouts.app')

@section('title', 'Manajemen Petugas - TaniPantau')

@section('content')
    @if(session('success'))
    <div class="mb-4 px-4 py-3 bg-success/10 border border-success/20 text-success rounded-[0.5rem] text-[14px] font-medium">
        {{ session('success') }}
    </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h4 class="text-[1.25rem] font-medium text-heading dark:text-dark-heading mb-1">Daftar Petugas Lapang</h4>
            <p class="text-[0.9375rem] text-body dark:text-dark-body m-0">Kelola akun petugas lapangan.</p>
        </div>
        <a href="{{ route('admin.petugas.create') }}" class="bg-primary hover:bg-primary-hover text-white text-[15px] font-medium py-2 px-4 rounded-[0.375rem] flex items-center gap-2 transition-all shadow-primary">
            <span class="material-symbols-outlined text-[20px]">person_add</span>
            Tambah Petugas
        </a>
    </div>

    <div class=" bg-white dark:bg-dark-card  dark:bg-dark-card rounded-[0.5rem] shadow-card">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase w-12">#</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Nama</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Email</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Role</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase text-right w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[14px] text-body dark:text-dark-body">
                    @forelse($petugas as $i => $p)
                    <tr class="hover:bg-slate-50 dark:hover:bg-dark-border/20 transition-colors">
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border text-muted dark:text-dark-muted">{{ $i + 1 }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border font-medium text-heading dark:text-dark-heading">{{ $p->name }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">{{ $p->email }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">
                            <span class="px-3 py-1 rounded-[0.25rem] bg-info/10 text-info text-[12px] font-medium">{{ ucfirst($p->role) }}</span>
                        </td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.petugas.edit', $p->id) }}" class="text-muted dark:text-dark-muted hover:text-primary transition-colors p-1">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <form action="{{ route('admin.petugas.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus petugas ini?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-muted dark:text-dark-muted hover:text-danger transition-colors p-1">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-8 text-center text-muted dark:text-dark-muted">Belum ada petugas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endSection
