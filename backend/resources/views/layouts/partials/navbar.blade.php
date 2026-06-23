<nav class="flex items-center justify-between bg-white/95 dark:bg-dark-card/95 backdrop-blur-[6px] rounded-[0.375rem] shadow-card dark:shadow-card-dark min-h-[62px] mx-4 sm:mx-6 mt-4 mb-6 px-4 sm:px-6 sticky top-4 z-30 transition-all flex-shrink-0">
    
    <!-- Left: Hamburger & Search -->
    <div class="flex items-center gap-3 flex-1">
        <button class="lg:hidden text-heading dark:text-dark-heading hover:bg-slate-100 dark:hover:bg-dark-border/30 p-1 rounded-md transition-colors" @click="sidebarOpen = true">
            <span class="material-symbols-outlined text-[24px]">menu</span>
        </button>
        
        <div class="flex items-center gap-2 w-full max-w-sm hidden sm:flex">
            <span class="material-symbols-outlined text-[20px] text-muted dark:text-dark-muted">search</span>
            <input type="text" placeholder="Cari..." class="w-full bg-transparent border-none focus:ring-0 text-[15px] text-body dark:text-dark-body placeholder:text-muted dark:placeholder:text-dark-muted py-2" />
        </div>
    </div>

    <!-- Right: Profile & Notifications -->
    <div class="flex items-center gap-4 flex-shrink-0">
        @php
            $role = auth()->user()->role;
            $notifList = [];

            $tindakan = \App\Models\KunjunganLahan::where('status_tindak_lanjut', 'perlu_tindakan')->with('lahan.petani')->latest()->take(3)->get();
            $linkTindak = match($role) { 'admin' => route('admin.kunjungan'), default => route('petugas.kunjungan.index') };
            foreach ($tindakan as $k) {
                $notifList[] = ['icon' => 'emergency', 'color' => 'text-warning', 'title' => $k->lahan->nama_lahan ?? '-', 'desc' => 'Perlu tindakan lanjut', 'link' => $linkTindak ];
            }

            $lahanBlm = \App\Models\Lahan::whereDoesntHave('kunjungan')->with('petani')->latest()->take(3)->get();
            $linkLahan = match($role) { 'admin' => route('admin.lahan.show', 0), default => '#' };
            foreach ($lahanBlm as $l) {
                $link = $role === 'admin' ? route('admin.lahan.show', $l->id) : $linkLahan;
                $notifList[] = ['icon' => 'warning', 'color' => 'text-danger', 'title' => $l->nama_lahan, 'desc' => 'Belum pernah dikunjungi', 'link' => $link ];
            }

            $notifList = array_slice($notifList, 0, 5);
            $totalNotif = count($notifList);
        @endphp

        <!-- Dark Mode Toggle -->
        <button onclick="toggleDarkMode()" class="p-1.5 text-body dark:text-dark-body hover:bg-slate-100 dark:hover:bg-dark-border/30 rounded-full transition-colors">
            <span class="material-symbols-outlined text-[22px] dark:hidden">dark_mode</span>
            <span class="material-symbols-outlined text-[22px] hidden dark:inline">light_mode</span>
        </button>

        <!-- Notification -->
        <div class="relative" x-data="{ open: false }">
            <button class="relative p-1.5 text-body dark:text-dark-body hover:bg-slate-100 dark:hover:bg-dark-border/30 rounded-full transition-colors" @click="open = !open">
                <span class="material-symbols-outlined text-[22px]">notifications</span>
                @if($totalNotif > 0)
                <span class="absolute -top-0.5 -right-0.5 w-4 h-4 rounded-full bg-danger border-2 border-white dark:border-dark-card box-content text-white text-[10px] font-bold flex items-center justify-center">{{ $totalNotif > 9 ? '9+' : $totalNotif }}</span>
                @endif
            </button>
            
            <!-- Notification Dropdown -->
            <div x-show="open" @click.outside="open = false" x-transition.opacity.duration.200ms class="absolute right-0 mt-2 w-80 bg-white dark:bg-dark-card rounded-md shadow-card dark:shadow-card-dark border border-border dark:border-dark-border py-2 z-50" x-cloak>
                <div class="px-4 py-2 border-b border-border dark:border-dark-border">
                    <h6 class="text-[14px] font-semibold text-heading dark:text-dark-heading m-0">Notifikasi</h6>
                </div>
                @if(count($notifList) > 0)
                    @foreach($notifList as $n)
                    <a href="{{ $n['link'] }}" class="flex items-start gap-3 px-4 py-3 hover:bg-slate-50 dark:hover:bg-dark-border/20 transition-colors border-b border-border/50 dark:border-dark-border/30 last:border-0">
                        <span class="material-symbols-outlined text-[20px] {{ $n['color'] }} flex-shrink-0 mt-0.5">{{ $n['icon'] }}</span>
                        <div class="min-w-0">
                            <p class="text-[13px] font-medium text-heading dark:text-dark-heading mb-0.5 truncate">{{ $n['title'] }}</p>
                            <p class="text-[12px] text-muted dark:text-dark-muted m-0">{{ $n['desc'] }}</p>
                        </div>
                    </a>
                    @endforeach
                @else
                    <div class="px-4 py-6 text-center">
                        <span class="material-symbols-outlined text-[28px] text-muted dark:text-dark-muted block mb-2">check_circle</span>
                        <p class="text-[13px] text-muted dark:text-dark-muted m-0">Tidak ada notifikasi</p>
                    </div>
                @endif
            </div>
        </div>

        @php
            $user = auth()->user();
            $userName = $user?->name ?? 'Administrator';
            $userRole = match($user?->role) {
                'admin' => 'Administrator',
                'petugas' => 'Field Operations',
                default => 'User',
            };
        @endphp

        <!-- Profile Avatar -->
        <div class="relative" x-data="{ open: false }">
            <button class="relative w-10 h-10 rounded-full border-2 border-transparent hover:border-primary/20 transition-all p-0.5 focus:outline-none" @click="open = !open">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($userName) }}&background=16A34A&color=fff&rounded=true" alt="User" class="w-full h-full object-cover rounded-full shadow-sm">
                <span class="absolute bottom-0.5 right-0.5 w-2.5 h-2.5 bg-success border-2 border-white dark:border-dark-card rounded-full"></span>
            </button>
            
            <!-- Profile Dropdown -->
            <div x-show="open" @click.outside="open = false" x-transition.opacity.duration.200ms class="absolute right-0 mt-2 w-56 bg-white dark:bg-dark-card rounded-md shadow-card dark:shadow-card-dark border border-border dark:border-dark-border py-1 z-50" x-cloak>
                <div class="px-4 py-3 flex items-center gap-3 border-b border-border dark:border-dark-border">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($userName) }}&background=16A34A&color=fff&rounded=true" alt="User" class="w-10 h-10 rounded-full">
                    <div>
                        <h6 class="text-[14px] font-semibold text-heading dark:text-dark-heading m-0">{{ $userName }}</h6>
                        <small class="text-muted dark:text-dark-muted text-[12px]">{{ $userRole }}</small>
                    </div>
                </div>
                <div class="py-1">
                    <a href="{{ route('profile.edit') }}" class="group flex items-center gap-2 px-4 py-2 text-[14px] text-body dark:text-dark-body hover:bg-primary/5 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-muted dark:text-dark-muted group-hover:text-primary transition-colors">person</span> Profil
                    </a>
                    <a href="{{ route('profile.edit') }}" class="group flex items-center gap-2 px-4 py-2 text-[14px] text-body dark:text-dark-body hover:bg-primary/5 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[18px] text-muted dark:text-dark-muted group-hover:text-primary transition-colors">settings</span> Pengaturan
                    </a>
                </div>
                <div class="border-t border-border dark:border-dark-border py-1">
                    <button onclick="confirmLogout()" class="group w-full flex items-center gap-2 px-4 py-2 text-[14px] text-body dark:text-dark-body hover:bg-danger/10 hover:text-danger transition-colors text-left">
                        <span class="material-symbols-outlined text-[18px] text-muted dark:text-dark-muted group-hover:text-danger transition-colors">power_settings_new</span> Keluar
                    </button>
                </div>
            </div>
        </div>
    </div>

</nav>
