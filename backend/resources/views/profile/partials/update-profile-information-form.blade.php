<div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card dark:shadow-card-dark p-6 sm:p-8">
    <div class="mb-6">
        <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading m-0">Informasi Profil</h5>
        <p class="text-[0.875rem] text-body dark:text-dark-body mt-1 m-0">Perbarui nama dan email akun Anda.</p>
    </div>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div class="flex flex-col">
            <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="name">Nama</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autocomplete="name" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card @error('name') border-danger @enderror">
            @error('name') <small class="text-danger mt-1">{{ $message }}</small> @enderror
        </div>

        <div class="flex flex-col">
            <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card @error('email') border-danger @enderror">
            @error('email') <small class="text-danger mt-1">{{ $message }}</small> @enderror
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="px-5 py-2 bg-primary text-white rounded-[0.375rem] text-[14px] font-medium hover:bg-primary-hover transition-colors shadow-primary">Simpan</button>
            @if (session('status') === 'profile-updated')
                <span class="text-[13px] text-success font-medium" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)">Tersimpan!</span>
            @endif
        </div>
    </form>
</div>