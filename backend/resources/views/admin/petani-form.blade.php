@extends('layouts.app')

@section('title', $title . ' - TaniPantau')

@section('content')
<div class="max-w-3xl mx-auto w-full">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.petani.index') }}" class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-dark-border/30 transition-colors text-heading dark:text-dark-heading">
            <span class="material-symbols-outlined text-[24px]">arrow_back</span>
        </a>
        <div>
            <h4 class="text-[1.25rem] font-medium text-heading dark:text-dark-heading mb-1">{{ $title }}</h4>
            <p class="text-[0.9375rem] text-body dark:text-dark-body m-0">Lengkapi formulir di bawah dengan data yang benar.</p>
        </div>
    </div>

    <form action="{{ $petani ? route('admin.petani.update', $petani->id) : route('admin.petani.store') }}" method="POST" class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card p-6 sm:p-8">
        @csrf
        @if($petani) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="nama_petani">Nama Petani <span class="text-danger">*</span></label>
                <input type="text" id="nama_petani" name="nama_petani" value="{{ old('nama_petani', $petani->nama_petani ?? '') }}" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card @error('nama_petani') border-danger @enderror" required>
                @error('nama_petani') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="nik">NIK <span class="text-danger">*</span></label>
                <input type="text" id="nik" name="nik" value="{{ old('nik', $petani->nik ?? '') }}" maxlength="16" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card @error('nik') border-danger @enderror" required>
                @error('nik') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col md:col-span-2">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="alamat">Alamat <span class="text-danger">*</span></label>
                <textarea id="alamat" name="alamat" rows="2" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card @error('alamat') border-danger @enderror" required>{{ old('alamat', $petani->alamat ?? '') }}</textarea>
                @error('alamat') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="provinsi_id">Provinsi <span class="text-danger">*</span></label>
                <select id="provinsi_id" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card">
                    <option value="">Pilih Provinsi...</option>
                    @foreach($provinsi as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col" id="kota-wrapper" style="display: none;">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="kota_id">Kota <span class="text-danger">*</span></label>
                <select id="kota_id" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card">
                    <option value="">Pilih Kota...</option>
                </select>
            </div>

            <div class="flex flex-col" id="kecamatan-wrapper" style="display: none;">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="kecamatan_id">Kecamatan <span class="text-danger">*</span></label>
                <select id="kecamatan_id" name="kecamatan_id" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card @error('kecamatan_id') border-danger @enderror" required>
                    <option value="">Pilih Kecamatan...</option>
                </select>
                @error('kecamatan_id') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col" id="desa-wrapper" style="display: none;">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="desa_id">Desa <span class="text-danger">*</span></label>
                <select id="desa_id" name="desa_id" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card @error('desa_id') border-danger @enderror" required>
                    <option value="">Pilih Desa...</option>
                </select>
                @error('desa_id') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="no_hp">Nomor HP <span class="text-danger">*</span></label>
                <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $petani->no_hp ?? '') }}" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card @error('no_hp') border-danger @enderror" required>
                @error('no_hp') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="petugas_id">Petugas Lapang (PPL)</label>
                <select id="petugas_id" name="petugas_id" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card @error('petugas_id') border-danger @enderror">
                    <option value="">-- Pilih Petugas --</option>
                    @foreach($petugas as $p)
                        <option value="{{ $p->id }}" {{ old('petugas_id', $petani->petugas_id ?? '') == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                    @endforeach
                </select>
                @error('petugas_id') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5">Status Petani</label>
                <div class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] bg-[#f8f9fa] dark:bg-dark-surface flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-success inline-block"></span>
                    <span class="text-heading dark:text-dark-heading font-medium">Aktif</span>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-border dark:border-dark-border">
            <a href="{{ route('admin.petani.index') }}" class="px-5 py-2 bg-white dark:bg-dark-card border border-border dark:border-dark-border rounded-[0.375rem] text-[14px] text-heading dark:text-dark-heading font-medium hover:bg-slate-100 dark:hover:bg-dark-border/30 transition-colors">Batal</a>
            <button type="submit" id="btnSubmit" class="px-5 py-2 bg-primary text-white rounded-[0.375rem] text-[14px] font-medium hover:bg-primary-hover transition-colors shadow-primary">
                {{ $petani ? 'Perbarui' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
@push('scripts')
<script id="wilayah-data" type="application/json">{!! json_encode($wilayahJson) !!}</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const provSelect = document.getElementById('provinsi_id');
        const kotaSelect = document.getElementById('kota_id');
        const kecSelect = document.getElementById('kecamatan_id');
        const desaSelect = document.getElementById('desa_id');
        const kotaWrapper = document.getElementById('kota-wrapper');
        const kecWrapper = document.getElementById('kecamatan-wrapper');
        const desaWrapper = document.getElementById('desa-wrapper');
        const btnSubmit = document.getElementById('btnSubmit');

        const wilayahData = JSON.parse(document.getElementById('wilayah-data').textContent);

        function getKotaByProv(provId) {
            const prov = wilayahData.find(p => p.id === provId);
            return prov ? prov.kota : [];
        }

        function getKecamatanByKota(kotaId) {
            for (const p of wilayahData) {
                const kota = p.kota.find(k => k.id === kotaId);
                if (kota) return kota.kecamatan;
            }
            return [];
        }

        function getDesaByKec(kecId) {
            for (const p of wilayahData) {
                for (const k of p.kota) {
                    const kec = k.kecamatan.find(x => x.id === kecId);
                    if (kec) return kec.desa;
                }
            }
            return [];
        }

        function showEl(el) {
            el.style.display = 'flex';
        }

        function hideEl(el) {
            el.style.display = 'none';
        }

        function populateSelect(select, items, placeholder) {
            select.innerHTML = '<option value="">' + placeholder + '</option>';
            items.forEach(item => {
                const opt = document.createElement('option');
                opt.value = item.id;
                opt.textContent = item.nama;
                select.appendChild(opt);
            });
        }

        function filterKota() {
            const selectedProv = provSelect.value;
            hideEl(kecWrapper);
            hideEl(desaWrapper);
            if (!selectedProv) {
                hideEl(kotaWrapper);
                return;
            }
            const kotaList = getKotaByProv(selectedProv);
            populateSelect(kotaSelect, kotaList, 'Pilih Kota...');
            showEl(kotaWrapper);
        }

        function filterKecamatan() {
            const selectedKota = kotaSelect.value;
            hideEl(desaWrapper);
            if (!selectedKota) {
                hideEl(kecWrapper);
                return;
            }
            const kecList = getKecamatanByKota(selectedKota);
            populateSelect(kecSelect, kecList, 'Pilih Kecamatan...');
            showEl(kecWrapper);
        }

        function filterDesa() {
            const selectedKec = kecSelect.value;
            desaSelect.value = '';
            if (!selectedKec) {
                hideEl(desaWrapper);
                return;
            }
            const desaList = getDesaByKec(selectedKec);
            populateSelect(desaSelect, desaList, 'Pilih Desa...');
            showEl(desaWrapper);
        }

        provSelect.addEventListener('change', function() {
            kotaSelect.value = '';
            kecSelect.value = '';
            desaSelect.value = '';
            filterKota();
        });

        kotaSelect.addEventListener('change', function() {
            kecSelect.value = '';
            desaSelect.value = '';
            filterKecamatan();
        });

        kecSelect.addEventListener('change', filterDesa);

        // Disable submit button after click to prevent double submit
        document.querySelector('form').addEventListener('submit', function() {
            btnSubmit.innerHTML = '<span class="material-symbols-outlined text-[18px] animate-spin">refresh</span> Menyimpan...';
            setTimeout(function() {
                btnSubmit.disabled = true;
            }, 0);
        });

        // Trigger on load if editing
        const originalKec = '{{ old('kecamatan_id', $petani->kecamatan_id ?? '') }}';
        const originalDesa = '{{ old('desa_id', $petani->desa_id ?? '') }}';
        if (originalKec) {
            function findAndSelectKota() {
                for (const p of wilayahData) {
                    for (const k of p.kota) {
                        const match = k.kecamatan.some(x => x.id === originalKec);
                        if (match) {
                            provSelect.value = p.id;
                            filterKota();
                            kotaSelect.value = k.id;
                            filterKecamatan();
                            kecSelect.value = originalKec;
                            filterDesa();
                            if (originalDesa) {
                                desaSelect.value = originalDesa;
                            }
                            return;
                        }
                    }
                }
            }
            findAndSelectKota();
        }
    });
</script>
@endpush

@endsection
