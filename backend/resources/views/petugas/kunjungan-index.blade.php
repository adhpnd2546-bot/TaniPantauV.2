@extends('layouts.app')

@section('title', 'Riwayat Kunjungan Saya - TaniPantau')

@section('content')
    @if(session('success'))
    <div class="mb-4 px-4 py-3 bg-success/10 border border-success/20 text-success rounded-[0.5rem] text-[14px] font-medium">
        {{ session('success') }}
    </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h4 class="text-[1.25rem] font-medium text-heading dark:text-dark-heading mb-1">Riwayat Kunjungan Saya</h4>
            <p class="text-[0.9375rem] text-body dark:text-dark-body m-0">Riwayat kunjungan lapangan yang telah Anda catat.</p>
        </div>
        <a href="{{ route('petugas.kunjungan.create') }}" class="px-4 py-2 bg-primary hover:bg-primary-hover text-white text-[14px] font-medium rounded-lg shadow-sm transition-all flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Catat Kunjungan Baru
        </a>
    </div>

    <div class=" bg-white dark:bg-dark-card  dark:bg-dark-card rounded-[0.5rem] shadow-card">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase w-12">#</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Tanggal</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Lahan</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Kondisi</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Tindak Lanjut</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Foto</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase">Catatan</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[14px] text-body dark:text-dark-body">
                    @forelse($kunjungan as $i => $k)
                    <tr class="hover:bg-slate-50 dark:hover:bg-dark-border/20 transition-colors">
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border text-muted dark:text-dark-muted">{{ $kunjungan->firstItem() + $i }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border font-medium text-heading dark:text-dark-heading">{{ \Carbon\Carbon::parse($k->tanggal_kunjungan)->format('d M Y') }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">{{ $k->lahan->nama_lahan ?? '-' }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">
                            @php
                                $kondisiColors = ['baik' => 'bg-success/10 text-success', 'cukup' => 'bg-warning/10 text-warning', 'buruk' => 'bg-danger/10 text-danger'];
                            @endphp
                            <span class="px-2 py-1 rounded-[0.25rem] {{ $kondisiColors[$k->kondisi_lahan] ?? 'bg-secondary/10 text-secondary' }} text-[12px] font-medium">{{ ucfirst($k->kondisi_lahan) }}</span>
                        </td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">
                            @php
                                $tindakColors = ['aman' => 'bg-success/10 text-success', 'perlu_pemantauan' => 'bg-warning/10 text-warning', 'perlu_tindakan' => 'bg-danger/10 text-danger'];
                                $tindakLabels = ['aman' => 'Aman', 'perlu_pemantauan' => 'Perlu Pantau', 'perlu_tindakan' => 'Perlu Tindakan'];
                            @endphp
                            <span class="px-2 py-1 rounded-[0.25rem] text-[12px] font-medium {{ $tindakColors[$k->status_tindak_lanjut] ?? 'bg-secondary/10 text-secondary' }}">{{ $tindakLabels[$k->status_tindak_lanjut] ?? $k->status_tindak_lanjut }}</span>
                        </td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">
                            @if($k->foto)
                                @php
                                    $fotoPath = $k->foto;
                                    if (str_starts_with($fotoPath, 'uploads/')) {
                                        $fotoUrl = url($fotoPath);
                                    } else {
                                        $fotoUrl = url('storage/' . $fotoPath);
                                    }
                                @endphp
                                <a href="{{ $fotoUrl }}" target="_blank" class="inline-block">
                                    <img src="{{ $fotoUrl }}" alt="Foto kunjungan" class="w-12 h-12 rounded-[0.25rem] object-cover border border-border dark:border-dark-border hover:opacity-80 transition-opacity" loading="lazy">
                                </a>
                            @else
                                <span class="text-muted dark:text-dark-muted">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border max-w-[200px] truncate" title="{{ $k->catatan_lapangan ?? '-' }}">{{ $k->catatan_lapangan ?? '-' }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('petugas.kunjungan.edit', $k->id) }}" class="text-primary hover:text-primary-hover p-1 transition-colors animate-hover" title="Edit Kunjungan">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <button onclick="deleteKunjungan({{ $k->id }})" class="text-danger hover:text-red-700 p-1 transition-colors" title="Hapus Kunjungan">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                                <form id="delete-form-{{ $k->id }}" action="{{ route('petugas.kunjungan.destroy', $k->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-6 py-8 text-center text-muted dark:text-dark-muted">Belum ada kunjungan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($kunjungan->hasPages())
        <div class="px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4 border-t border-border dark:border-dark-border">
            <span class="text-[13px] text-muted dark:text-dark-muted">Menampilkan {{ $kunjungan->firstItem() }} hingga {{ $kunjungan->lastItem() }} dari {{ $kunjungan->total() }} Kunjungan</span>
            <div class="flex items-center gap-1">
                @if($kunjungan->onFirstPage())
                    <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] border border-border dark:border-dark-border text-muted dark:text-dark-muted opacity-50" disabled>
                        <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                    </button>
                @else
                    <a href="{{ $kunjungan->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] border border-border dark:border-dark-border text-muted dark:text-dark-muted hover:bg-slate-100 dark:hover:bg-dark-border/30 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                    </a>
                @endif
                @foreach($kunjungan->getUrlRange(1, $kunjungan->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] {{ $page == $kunjungan->currentPage() ? 'bg-primary text-white font-medium shadow-primary' : 'text-body dark:text-dark-body hover:bg-slate-100 dark:hover:bg-dark-border/30' }} transition-colors font-medium text-[13px]">{{ $page }}</a>
                @endforeach
                @if($kunjungan->hasMorePages())
                    <a href="{{ $kunjungan->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] border border-border dark:border-dark-border text-muted dark:text-dark-muted hover:bg-slate-100 dark:hover:bg-dark-border/30 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                    </a>
                @else
                    <button class="w-8 h-8 flex items-center justify-center rounded-[0.375rem] border border-border dark:border-dark-border text-muted dark:text-dark-muted opacity-50" disabled>
                        <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                    </button>
                @endif
            </div>
        </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    function deleteKunjungan(id) {
        Swal.fire({
            title: 'Hapus Kunjungan?',
            text: "Data kunjungan akan dihapus secara permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff3e1d',
            cancelButtonColor: '#8592a3',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                title: 'font-public text-[18px] text-heading dark:text-dark-heading',
                popup: 'font-public rounded-[0.5rem] shadow-card dark:shadow-card-dark border border-border dark:border-dark-border',
                confirmButton: 'rounded-[0.375rem]',
                cancelButton: 'rounded-[0.375rem]'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endpush