<div class="space-y-2 font-bold text-sm">
    <a href="{{ route('user.dashboard') }}" 
       class="flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('user.dashboard') ? 'bg-emerald-600 text-white' : 'text-slate-500 hover:bg-emerald-50' }}">
        <i class="fas fa-home w-6"></i>
        <span>Dashboard Beranda</span>
    </a>

    <p class="px-4 pt-6 pb-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pemesanan</p>

    <a href="{{ route('user.products.index') }}" 
       class="flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('user.products.*') ? 'bg-emerald-600 text-white' : 'text-slate-500 hover:bg-emerald-50' }}">
        <i class="fas fa-kaaba w-6"></i>
        <span>Pilihan Paket Umroh</span>
    </a>

    <a href="{{ route('user.stock.history') }}" 
       class="flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('user.stock.history') ? 'bg-emerald-600 text-white' : 'text-slate-500 hover:bg-emerald-50' }}">
        <i class="fas fa-history w-6"></i>
        <span>Riwayat Pesanan Saya</span>
    </a>

    <p class="px-4 pt-6 pb-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">Akun Saya</p>

    <a href="{{ route('user.profile') }}" 
       class="flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('user.profile') ? 'bg-emerald-600 text-white' : 'text-slate-500 hover:bg-emerald-50' }}">
        <i class="fas fa-user-circle w-6"></i>
        <span>Profil & Dokumen</span>
    </a>
</div>