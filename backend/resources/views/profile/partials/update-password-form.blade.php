<div class="bg-white dark:bg-dark-card rounded-[0.5rem] shadow-card dark:shadow-card-dark p-6 sm:p-8">
    <div class="mb-6">
        <h5 class="text-[1.125rem] font-medium text-heading dark:text-dark-heading m-0">Kata Sandi</h5>
        <p class="text-[0.875rem] text-body dark:text-dark-body mt-1 m-0">Pastikan akun Anda menggunakan kata sandi yang kuat.</p>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div class="flex flex-col">
            <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="update_password_current_password">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card @error('current_password', 'updatePassword') border-danger @enderror">
            @error('current_password', 'updatePassword') <small class="text-danger mt-1">{{ $message }}</small> @enderror
        </div>

        <div class="flex flex-col">
            <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="update_password_password">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card @error('password', 'updatePassword') border-danger @enderror">
            @error('password', 'updatePassword') <small class="text-danger mt-1">{{ $message }}</small> @enderror
        </div>

        <div class="flex flex-col">
            <label class="text-[13px] font-medium text-heading dark:text-dark-heading mb-1.5" for="update_password_password_confirmation">Konfirmasi Kata Sandi Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="w-full border border-border dark:border-dark-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading dark:text-dark-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white dark:bg-dark-card">
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="px-5 py-2 bg-primary text-white rounded-[0.375rem] text-[14px] font-medium hover:bg-primary-hover transition-colors shadow-primary">Simpan</button>
            @if (session('status') === 'password-updated')
                <span class="text-[13px] text-success font-medium" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)">Tersimpan!</span>
            @endif
        </div>
    </form>
</div>