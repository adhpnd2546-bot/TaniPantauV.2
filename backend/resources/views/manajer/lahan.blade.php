@extends('layouts.app')

@section('title', 'Data Lahan - TaniPantau')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h4 class="text-[1.25rem] font-medium text-heading dark:text-dark-heading mb-1">Data Lahan Pertanian</h4>
            <p class="text-[0.9375rem] text-body dark:text-dark-body m-0">Pantau seluruh area pertanian terdaftar.</p>
        </div>
    </div>

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
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Luas (Ha)</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Fase</th>
                    </tr>
                </thead>
                <tbody class="text-[14px] text-body dark:text-dark-body">
                    @forelse($lahan as $i => $l)
                    <tr class="hover:bg-slate-50 dark:hover:bg-dark-border/20 transition-colors">
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border text-muted dark:text-dark-muted">{{ $lahan->firstItem() + $i }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border font-medium text-heading dark:text-dark-heading">{{ $l->nama_lahan }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">{{ $l->petani->nama_petani ?? '-' }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border text-heading dark:text-dark-heading">{{ ucfirst($l->komoditas) }}</td>
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
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-6 py-8 text-center text-muted dark:text-dark-muted">Belum ada data lahan.</td></tr>
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
