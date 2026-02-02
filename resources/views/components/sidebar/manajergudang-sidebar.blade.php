<div class="space-y-2">
    <!-- Dashboard User -->
    <x-sidebar.link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')" icon="fas fa-home">
        Beranda Utama
    </x-sidebar.link>

    <p class="px-4 pt-6 pb-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pemesanan</p>

    <!-- Pilihan Paket -->
    <x-sidebar.link :href="route('user.products.index')" :active="request()->routeIs('user.products.*')" icon="fas fa-kaaba">
        Pilihan Paket Umroh
    </x-sidebar.link>

    <!-- Transaksi Pemesanan -->
    <x-sidebar.dropdown :active="request()->routeIs('user.stock.*')" icon="fas fa-file-invoice">
        <x-slot name="trigger">Pendaftaran</x-slot>
        <x-sidebar.sublink :href="route('user.stock.in')" :active="request()->routeIs('user.stock.in')">Pesan Paket Baru</x-sidebar.sublink>
        <x-sidebar.sublink :href="route('user.stock.history')" :active="request()->routeIs('user.stock.history')">Riwayat Pesanan</x-sidebar.sublink>
    </x-sidebar.dropdown>

    <p class="px-4 pt-6 pb-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">Akun Saya</p>

    <x-sidebar.link :href="route('user.profile')" :active="request()->routeIs('user.profile')" icon="fas fa-user-circle">
        Profil & Berkas
    </x-sidebar.link>
</div>