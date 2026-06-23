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
            <span class="text-[11px] font-medium uppercase text-muted dark:text-dark-muted tracking-widest relative before:content-[''] before:absolute before:left-0 before:top-1/2 before:-translate-y-1/2 before:w-2 before:h-[1px] before:bg-muted dark:before:bg-dark-muted ml-3">Lapangan</span>
        </li>
        
        <!-- Data Entry (Active) -->
        <li>
            <a href="{{ route('petugas.kunjungan.create') }}" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] {{ request()->routeIs('petugas.kunjungan.create') ? 'bg-primary/10 text-primary font-medium' : 'text-body dark:text-dark-body hover:bg-primary/5 hover:text-primary dark:hover:bg-dark-border/30' }} transition-colors">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[20px]" {{ request()->routeIs('petugas.kunjungan.create') ? 'style=font-variation-settings:\'FILL\'1;' : '' }}>edit_note</span>
                    <span class="text-[15px]">Data Entry</span>
                </div>
            </a>
        </li>
        
        <!-- History -->
        <li>
            <a href="{{ route('petugas.kunjungan.index') }}" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] {{ request()->routeIs('petugas.kunjungan.index') ? 'bg-primary/10 text-primary font-medium' : 'text-body dark:text-dark-body hover:bg-primary/5 hover:text-primary dark:hover:bg-dark-border/30' }} transition-colors group">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[20px] text-muted dark:text-dark-muted group-hover:text-primary transition-colors {{ request()->routeIs('petugas.kunjungan.index') ? '!text-primary' : '' }}">history</span>
                    <span class="text-[15px]">Riwayat</span>
                </div>
            </a>
        </li>
        
        <!-- Settings -->
        <li>
            <a href="{{ route('profile.edit') }}" class="flex items-center justify-between px-4 py-2.5 rounded-[0.375rem] {{ request()->routeIs('profile.edit') ? 'bg-primary/10 text-primary font-medium' : 'text-body dark:text-dark-body hover:bg-primary/5 hover:text-primary dark:hover:bg-dark-border/30' }} transition-colors group mt-4">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[20px] text-muted dark:text-dark-muted group-hover:text-primary transition-colors {{ request()->routeIs('profile.edit') ? '!text-primary' : '' }}">settings</span>
                    <span class="text-[15px]">Pengaturan</span>
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
