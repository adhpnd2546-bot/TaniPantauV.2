@extends('layouts.app')

@section('title', 'Pengaturan Profil - TaniPantau')

@section('content')
<div class="max-w-3xl mx-auto w-full">
    <div class="flex items-center gap-3 mb-6">
        <div>
            <h4 class="text-[1.25rem] font-medium text-heading dark:text-dark-heading mb-1">Pengaturan Profil</h4>
            <p class="text-[0.9375rem] text-body dark:text-dark-body m-0">Kelola informasi akun dan kata sandi Anda.</p>
        </div>
    </div>

    <div class="space-y-6">
        @include('profile.partials.update-profile-information-form')

        @include('profile.partials.update-password-form')
    </div>
</div>
@endsection