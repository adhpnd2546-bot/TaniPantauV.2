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
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase text-center">Petani</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase text-center">Lahan</th>
                        <th class="px-6 py-3 border-b border-border dark:border-dark-border bg-[#f9f9f9] dark:bg-dark-surface text-[12px] font-semibold tracking-wide text-muted dark:text-dark-muted uppercase text-right w-56">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[14px] text-body dark:text-dark-body">
                    @forelse($petugas as $i => $p)
                    <tr class="hover:bg-slate-50 dark:hover:bg-dark-border/20 transition-colors">
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border text-muted dark:text-dark-muted">{{ $i + 1 }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border font-medium text-heading dark:text-dark-heading">{{ $p->name }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border">{{ $p->email }}</td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border text-center">
                            <span class="px-3 py-1 rounded-[0.25rem] bg-info/10 text-info text-[13px] font-semibold">{{ $p->petani_count }} petani</span>
                        </td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border text-center">
                            <span class="px-3 py-1 rounded-[0.25rem] bg-primary/10 text-primary text-[13px] font-semibold">{{ $p->lahan_count }} lahan</span>
                        </td>
                        <td class="px-6 py-4 border-b border-border dark:border-dark-border text-right">
                            <div class="flex items-center justify-end gap-2">
                                @if($p->petani_count > 0 || $p->lahan_count > 0)
                                <button onclick="openReassign({{ $p->id }}, '{{ $p->name }}', {{ $p->petani_count }}, {{ $p->lahan_count }})" class="text-muted dark:text-dark-muted hover:text-warning transition-colors p-1" title="Alihkan">
                                    <span class="material-symbols-outlined text-[18px]">swap_horiz</span>
                                </button>
                                @endif
                                <a href="{{ route('admin.petugas.edit', $p->id) }}" class="text-muted dark:text-dark-muted hover:text-primary transition-colors p-1" title="Edit">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <form action="{{ route('admin.petugas.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus petugas ini?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-muted dark:text-dark-muted hover:text-danger transition-colors p-1" title="Hapus">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-6 py-8 text-center text-muted dark:text-dark-muted">Belum ada petugas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Reassign Modal --}}
    <div id="reassignModal" class="fixed inset-0 z-[100] flex items-center justify-center hidden bg-black/40">
        <div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-xl w-full max-w-md mx-4 overflow-hidden">
            <div class="px-6 py-4 border-b border-border dark:border-dark-border flex items-center justify-between">
                <h5 class="text-[16px] font-semibold text-heading dark:text-dark-heading m-0">Alihkan</h5>
                <button onclick="closeReassign()" class="text-muted dark:text-dark-muted hover:text-heading transition-colors p-1">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
            <form id="reassignForm" method="POST" action="{{ route('admin.petugas.reassign') }}" class="p-6">
                @csrf
                <input type="hidden" name="from_id" id="reassignFromId">
                <input type="hidden" name="type" id="reassignType" value="petani">
                <div class="mb-4">
                    <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5 block">Petugas Asal</label>
                    <p id="reassignFromName" class="text-[15px] text-body dark:text-dark-body font-medium m-0"></p>
                    <p id="reassignCount" class="text-[13px] text-muted dark:text-dark-muted mt-1 m-0"></p>
                </div>
                <div class="mb-4 flex gap-2">
                    <button type="button" id="reassignTypePetani" class="flex-1 px-3 py-2 rounded-[0.375rem] text-[13px] font-medium border transition-colors bg-primary text-white border-primary">Petani + Lahan</button>
                    <button type="button" id="reassignTypeLahan" class="flex-1 px-3 py-2 rounded-[0.375rem] text-[13px] font-medium border border-border dark:border-dark-border text-body dark:text-dark-body hover:bg-slate-50 dark:hover:bg-dark-border/30 transition-colors">Lahan Saja</button>
                </div>
                <div class="mb-6">
                    <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5 block" for="reassignToId">Alihkan ke Petugas</label>
                    <select id="reassignToId" name="to_id" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card">
                        <option value="">-- Kosongkan (tidak ditugaskan) --</option>
                        @foreach($petugas as $p)
                            <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->petani_count }} petani, {{ $p->lahan_count }} lahan)</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center gap-3 justify-end">
                    <button type="button" onclick="closeReassign()" class="px-4 py-2 border border-border dark:border-dark-border rounded-[0.375rem] text-[14px] text-heading dark:text-dark-heading hover:bg-slate-50 dark:hover:bg-dark-border/30 transition-colors">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-warning hover:bg-warning/90 text-white rounded-[0.375rem] text-[14px] font-medium transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">swap_horiz</span>
                        Alihkan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function openReassign(id, name, petaniCount, lahanCount) {
        document.getElementById('reassignFromId').value = id;
        document.getElementById('reassignFromName').textContent = name;
        document.getElementById('reassignCount').textContent = petaniCount + ' petani, ' + lahanCount + ' lahan akan dialihkan';

        document.getElementById('reassignToId').querySelectorAll('option').forEach(function(opt) {
            if (opt.value == id) opt.disabled = true;
            else opt.disabled = false;
        });

        document.getElementById('reassignModal').classList.remove('hidden');
        setReassignType('petani');
    }

    function closeReassign() {
        document.getElementById('reassignModal').classList.add('hidden');
    }

    function setReassignType(type) {
        document.getElementById('reassignType').value = type;
        var petaniBtn = document.getElementById('reassignTypePetani');
        var lahanBtn = document.getElementById('reassignTypeLahan');
        if (type === 'petani') {
            petaniBtn.className = 'flex-1 px-3 py-2 rounded-[0.375rem] text-[13px] font-medium border transition-colors bg-primary text-white border-primary';
            lahanBtn.className = 'flex-1 px-3 py-2 rounded-[0.375rem] text-[13px] font-medium border border-border dark:border-dark-border text-body dark:text-dark-body hover:bg-slate-50 dark:hover:bg-dark-border/30 transition-colors';
        } else {
            lahanBtn.className = 'flex-1 px-3 py-2 rounded-[0.375rem] text-[13px] font-medium border transition-colors bg-primary text-white border-primary';
            petaniBtn.className = 'flex-1 px-3 py-2 rounded-[0.375rem] text-[13px] font-medium border border-border dark:border-dark-border text-body dark:text-dark-body hover:bg-slate-50 dark:hover:bg-dark-border/30 transition-colors';
        }
    }

    document.getElementById('reassignTypePetani').addEventListener('click', function() { setReassignType('petani'); });
    document.getElementById('reassignTypeLahan').addEventListener('click', function() { setReassignType('lahan'); });

    document.getElementById('reassignModal').addEventListener('click', function(e) {
        if (e.target === this) closeReassign();
    });
</script>
@endpush