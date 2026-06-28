<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
       class="fixed lg:static inset-y-0 left-0 w-[260px] bg-white dark:bg-dark-card flex flex-col z-50 transition-transform duration-300 ease-in-out lg:translate-x-0 shadow-card lg:shadow-none border-r border-transparent lg:border-border dark:lg:border-dark-border">
    
    <!-- Brand Logo -->
    <div class="h-[64px] flex items-center justify-between lg:justify-start px-6 mt-3 mb-2 flex-shrink-0">
        <a href="#" class="flex items-center gap-2.5">
            <span class="material-symbols-outlined text-primary text-[32px]" style="font-variation-settings: 'FILL' 1;">eco</span>
            <span class="text-[22px] font-bold text-heading dark:text-dark-heading tracking-tighter">Tani<span class="bg-primary text-white px-1.5 py-0.5 rounded ml-0.5">Pantau</span></span>
        </a>
        
        <!-- Close Button (Mobile) -->
        <button class="lg:hidden text-muted dark:text-dark-muted hover:text-heading dark:hover:text-dark-heading" @click="sidebarOpen = false">
            <span class="material-symbols-outlined text-[20px]">close</span>
        </button>
    </div>
    
    <!-- Menu Scrollable -->
    <ul class="flex flex-col py-4 px-4 overflow-y-auto gap-1 flex-grow">
        <!-- Section Header -->
        <li class="px-4 mt-2 mb-2">
            <span class="text-[11px] font-medium uppercase text-muted dark:text-dark-muted tracking-widest relative before:content-[''] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-2 before:h-[1px] before:bg-muted dark:before:bg-dark-muted ml-3">Menu Utama</span>
        </li>
        
        <!-- Dashboard -->
        <li>
            <a href="{{ route('manajer.dashboard') }}" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] {{ request()->routeIs('manajer.dashboard') ? 'bg-primary/10 text-primary font-medium' : 'text-body dark:text-dark-body hover:bg-primary/5 hover:text-primary dark:hover:bg-dark-border/30' }} transition-colors group">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('manajer.dashboard') ? '' : 'text-muted dark:text-dark-muted group-hover:text-primary' }} transition-colors" {{ request()->routeIs('manajer.dashboard') ? 'style=font-variation-settings:\'FILL\'1;' : '' }}>home</span>
                    <span class="text-[15px]">Analitik</span>
                </div>
            </a>
        </li>
        
        <!-- Lahan -->
        <li>
            <a href="{{ route('manajer.lahan') }}" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] {{ request()->routeIs('manajer.lahan') && !request()->routeIs('manajer.lahan.map') ? 'bg-primary/10 text-primary font-medium' : 'text-body dark:text-dark-body hover:bg-primary/5 hover:text-primary dark:hover:bg-dark-border/30' }} transition-colors group">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('manajer.lahan') && !request()->routeIs('manajer.lahan.map') ? '' : 'text-muted dark:text-dark-muted group-hover:text-primary' }} transition-colors" {{ request()->routeIs('manajer.lahan') && !request()->routeIs('manajer.lahan.map') ? 'style=font-variation-settings:\'FILL\'1;' : '' }}>landscape</span>
                    <span class="text-[15px]">Area Lahan</span>
                </div>
            </a>
        </li>
        
        <!-- Peta Lahan -->
        <li>
            <a href="{{ route('manajer.lahan.map') }}" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] {{ request()->routeIs('manajer.lahan.map') ? 'bg-primary/10 text-primary font-medium' : 'text-body dark:text-dark-body hover:bg-primary/5 hover:text-primary dark:hover:bg-dark-border/30' }} transition-colors group">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('manajer.lahan.map') ? '' : 'text-muted dark:text-dark-muted group-hover:text-primary' }} transition-colors" {{ request()->routeIs('manajer.lahan.map') ? 'style=font-variation-settings:\'FILL\'1;' : '' }}>map</span>
                    <span class="text-[15px]">Peta Lahan</span>
                </div>
            </a>
        </li>
        
        <!-- Petani -->
        <li>
            <a href="{{ route('manajer.petani') }}" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] {{ request()->routeIs('manajer.petani') ? 'bg-primary/10 text-primary font-medium' : 'text-body dark:text-dark-body hover:bg-primary/5 hover:text-primary dark:hover:bg-dark-border/30' }} transition-colors group">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[20px] text-muted dark:text-dark-muted group-hover:text-primary transition-colors">group</span>
                    <span class="text-[15px]">Data Petani</span>
                </div>
            </a>
        </li>

        <!-- Section Header -->
        <li class="px-4 mt-6 mb-2">
            <span class="text-[11px] font-medium uppercase text-muted dark:text-dark-muted tracking-widest relative before:content-[''] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-2 before:h-[1px] before:bg-muted dark:before:bg-dark-muted ml-3">Monitoring</span>
        </li>

        <!-- Kunjungan -->
        <li>
            <a href="{{ route('manajer.kunjungan') }}" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] {{ request()->routeIs('manajer.kunjungan') ? 'bg-primary/10 text-primary font-medium' : 'text-body dark:text-dark-body hover:bg-primary/5 hover:text-primary dark:hover:bg-dark-border/30' }} transition-colors group">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[20px] text-muted dark:text-dark-muted group-hover:text-primary transition-colors">fact_check</span>
                    <span class="text-[15px]">Riwayat Kunjungan</span>
                </div>
            </a>
        </li>
        
        <li class="mt-auto mb-2">
            <button onclick="confirmLogout()" class="w-full flex items-center px-4 py-2.5 rounded-[0.375rem] text-danger hover:bg-danger/10 transition-colors group mt-4">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[20px] text-danger/80 group-hover:text-danger transition-colors">logout</span>
                    <span class="text-[15px] font-medium">Keluar</span>
                </div>
            </button>
        </li>
    </ul>
</aside>
