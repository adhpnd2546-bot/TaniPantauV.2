<nav class="flex items-center justify-between bg-white/95 backdrop-blur-[6px] rounded-[0.375rem] shadow-card min-h-[62px] mx-4 sm:mx-6 mt-4 mb-6 px-4 sm:px-6 sticky top-4 z-30 transition-all flex-shrink-0">
    
    <!-- Left: Hamburger & Search -->
    <div class="flex items-center gap-3 flex-1">
        <button class="lg:hidden text-heading hover:bg-black/5 p-1 rounded-md transition-colors" @click="sidebarOpen = true">
            <span class="material-symbols-outlined text-[24px]">menu</span>
        </button>
        
        <div class="flex items-center gap-2 w-full max-w-sm hidden sm:flex">
            <span class="material-symbols-outlined text-[20px] text-muted">search</span>
            <input type="text" placeholder="Cari..." class="w-full bg-transparent border-none focus:ring-0 text-[15px] text-body placeholder:text-muted py-2" />
        </div>
    </div>

    <!-- Right: Profile & Notifications -->
    <div class="flex items-center gap-4 flex-shrink-0">
        <!-- Notification -->
        <div class="relative" x-data="{ open: false }">
            <button class="relative p-1.5 text-body hover:bg-black/5 rounded-full transition-colors" @click="open = !open">
                <span class="material-symbols-outlined text-[22px]">notifications</span>
                <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-danger border-2 border-white box-content"></span>
            </button>
            
            <!-- Notification Dropdown -->
            <div x-show="open" @click.outside="open = false" x-transition.opacity.duration.200ms class="absolute right-0 mt-2 w-72 bg-white rounded-md shadow-card border border-border py-2 z-50" x-cloak>
                <div class="px-4 py-2 border-b border-border mb-2">
                    <h6 class="text-[14px] font-semibold text-heading m-0">Notifikasi</h6>
                </div>
                <a href="#" class="block px-4 py-2 hover:bg-black/5 transition-colors">
                    <p class="text-[13px] font-medium text-heading mb-1">Panen Blok A Siap!</p>
                    <p class="text-[12px] text-muted">Estimasi hasil 2.5 ton.</p>
                </a>
            </div>
        </div>

        @php
            $isPetugas = session('user_role') === 'petugas';
            $userName = $isPetugas ? 'Petugas Lapang' : 'Ahmad Manager';
            $userRole = $isPetugas ? 'Field Operations' : 'Administrator';
        @endphp

        <!-- Profile Avatar -->
        <div class="relative" x-data="{ open: false }">
            <button class="relative w-10 h-10 rounded-full border-2 border-transparent hover:border-primary/20 transition-all p-0.5 focus:outline-none" @click="open = !open">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($userName) }}&background=16A34A&color=fff&rounded=true" alt="User" class="w-full h-full object-cover rounded-full shadow-sm">
                <span class="absolute bottom-0.5 right-0.5 w-2.5 h-2.5 bg-success border-2 border-white rounded-full"></span>
            </button>
            
            <!-- Profile Dropdown -->
            <div x-show="open" @click.outside="open = false" x-transition.opacity.duration.200ms class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-card border border-border py-1 z-50" x-cloak>
                <div class="px-4 py-3 flex items-center gap-3 border-b border-border">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($userName) }}&background=16A34A&color=fff&rounded=true" alt="User" class="w-10 h-10 rounded-full">
                    <div>
                        <h6 class="text-[14px] font-semibold text-heading m-0">{{ $userName }}</h6>
                        <small class="text-muted text-[12px]">{{ $userRole }}</small>
                    </div>
                </div>
                <div class="py-1">
                    <a href="#" class="flex items-center gap-2 px-4 py-2 text-[14px] text-body hover:bg-black/5 transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-muted">person</span> Profil
                    </a>
                    <a href="#" class="flex items-center gap-2 px-4 py-2 text-[14px] text-body hover:bg-black/5 transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-muted">settings</span> Pengaturan
                    </a>
                </div>
                <div class="border-t border-border py-1">
                    <button onclick="confirmLogout()" class="w-full flex items-center gap-2 px-4 py-2 text-[14px] text-body hover:bg-black/5 transition-colors text-left">
                        <span class="material-symbols-outlined text-[18px] text-muted">power_settings_new</span> Keluar
                    </button>
                </div>
            </div>
        </div>
    </div>

</nav>
