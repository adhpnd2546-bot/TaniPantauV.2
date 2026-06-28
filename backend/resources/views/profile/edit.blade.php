@extends('layouts.app')

@section('title', 'Pengaturan Akun - TaniPantau')

@section('content')
<div class="max-w-3xl mx-auto w-full" x-data="{ activeTab: window.location.hash === '#keamanan' ? 'keamanan' : 'profil' }" x-init="window.addEventListener('hashchange', () => activeTab = window.location.hash === '#keamanan' ? 'keamanan' : 'profil')">
    <div class="mb-6">
        <h4 class="text-[1.25rem] font-medium text-heading dark:text-dark-heading mb-1">Pengaturan Akun</h4>
        <p class="text-[0.9375rem] text-body dark:text-dark-body m-0">Kelola informasi pribadi dan keamanan kata sandi Anda.</p>
    </div>

    <!-- Tab Navigation -->
    <div class="flex border-b border-border dark:border-dark-border mb-6 gap-2">
        <button @click="activeTab = 'profil'; window.location.hash = 'profil'" 
                :class="activeTab === 'profil' ? 'border-primary text-primary font-semibold' : 'border-transparent text-muted dark:text-dark-muted hover:text-heading'" 
                class="px-4 py-2 border-b-2 text-[14.5px] font-medium transition-all focus:outline-none flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">person</span>
            Informasi Profil
        </button>
        <button @click="activeTab = 'keamanan'; window.location.hash = 'keamanan'" 
                :class="activeTab === 'keamanan' ? 'border-primary text-primary font-semibold' : 'border-transparent text-muted dark:text-dark-muted hover:text-heading'" 
                class="px-4 py-2 border-b-2 text-[14.5px] font-medium transition-all focus:outline-none flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">security</span>
            Keamanan Akun
        </button>
    </div>

    <!-- Tab Contents -->
    <div class="space-y-6">
        <div x-show="activeTab === 'profil'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div x-show="activeTab === 'keamanan'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
            @include('profile.partials.update-password-form')
        </div>
    </div>
</div>
@endsection