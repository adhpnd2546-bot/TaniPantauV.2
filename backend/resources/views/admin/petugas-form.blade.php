@extends('layouts.app')

@section('title', $title . ' - TaniPantau')

@section('content')
<div class="max-w-3xl mx-auto w-full">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.petugas.index') }}" class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-dark-border/30 transition-colors text-heading dark:text-dark-heading">
            <span class="material-symbols-outlined text-[24px]">arrow_back</span>
        </a>
        <div>
            <h4 class="text-[1.25rem] font-medium text-heading dark:text-dark-heading mb-1">{{ $title }}</h4>
            <p class="text-[0.9375rem] text-body dark:text-dark-body m-0">Lengkapi formulir di bawah dengan data petugas yang benar.</p>
        </div>
    </div>

    <form action="{{ $petugas ? route('admin.petugas.update', $petugas->id) : route('admin.petugas.store') }}" method="POST" class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-6 sm:p-8">
        @csrf
        @if($petugas) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="name">Nama Petugas <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $petugas->name ?? '') }}" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card @error('name') border-danger @enderror" required>
                @error('name') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="email">Email <span class="text-danger">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email', $petugas->email ?? '') }}" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card @error('email') border-danger @enderror" required>
                @error('email') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="password">Password <span class="text-danger">*</span></label>
                <input type="password" id="password" name="password" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card @error('password') border-danger @enderror" {{ $petugas ? '' : 'required' }}>
                @error('password') <small class="text-danger mt-1">{{ $message }}</small> @enderror
                @if($petugas) <small class="text-muted dark:text-dark-muted mt-1">Kosongkan jika tidak ingin mengubah password.</small> @endif
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-border dark:border-dark-border">
            <a href="{{ route('admin.petugas.index') }}" class="px-5 py-2 bg-white dark:bg-dark-card border border-border dark:border-dark-border rounded-[0.375rem] text-[14px] text-heading dark:text-dark-heading font-medium hover:bg-slate-100 dark:hover:bg-dark-border/30 transition-colors">Batal</a>
            <button type="submit" id="btnSubmit" class="px-5 py-2 bg-primary text-white rounded-[0.375rem] text-[14px] font-medium hover:bg-primary-hover transition-colors shadow-primary">
                {{ $petugas ? 'Perbarui' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmit');
            btn.innerHTML = '<span class="material-symbols-outlined text-[18px] animate-spin">refresh</span> Menyimpan...';
            setTimeout(function() {
                btn.disabled = true;
            }, 0);
        });
    });
</script>
@endpush
@endsection
