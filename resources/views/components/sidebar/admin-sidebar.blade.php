<div class="space-y-2">
    <!-- Dashboard Utama -->
    <x-sidebar.link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" icon="fas fa-kaaba">
        Dashboard Utama
    </x-sidebar.link>

    <!-- Manajemen Pengguna (Staf Biro) -->
    <x-sidebar.dropdown :active="request()->routeIs('admin.users.*')" icon="fas fa-user-shield">
        <x-slot name="trigger">Manajemen Staf</x-slot>
        <x-sidebar.sublink :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index', 'admin.users.edit', 'admin.users.show')">Daftar Staf</x-sidebar.sublink>
        <x-sidebar.sublink :href="route('admin.users.create')" :active="request()->routeIs('admin.users.create')">Tambah Akun Staf</x-sidebar.sublink>
    </x-sidebar.dropdown>

    <!-- Data Jamaah (Ganti dari Produk) -->
    <x-sidebar.dropdown :active="request()->routeIs('admin.products.*')" icon="fas fa-users">
        <x-slot name="trigger">Manifest Jamaah</x-slot>
        <x-sidebar.sublink :href="route('admin.products.index')" :active="request()->routeIs('admin.products.index', 'admin.products.edit', 'admin.products.show')">Data Seluruh Jamaah</x-sidebar.sublink>
        <x-sidebar.sublink :href="route('admin.products.create')" :active="request()->routeIs('admin.products.create')">Registrasi Jamaah Baru</x-sidebar.sublink>
    </x-sidebar.dropdown>

    <!-- Program Paket (Ganti dari Kategori) -->
    <x-sidebar.dropdown :active="request()->routeIs('admin.categories.*')" icon="fas fa-box">
        <x-slot name="trigger">Program Paket</x-slot>
        <x-sidebar.sublink :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index', 'admin.categories.edit', 'admin.categories.show')">Daftar Paket Umroh</x-sidebar.sublink>
        <x-sidebar.sublink :href="route('admin.categories.create')" :active="request()->routeIs('admin.categories.create')">Tambah Paket Baru</x-sidebar.sublink>
    </x-sidebar.dropdown>
    
    <!-- Agen & Mitra (Ganti dari Supplier) -->
    <x-sidebar.dropdown :active="request()->routeIs('admin.suppliers.*')" icon="fas fa-handshake">
        <x-slot name="trigger">Mitra & Agen</x-slot>
        <x-sidebar.sublink :href="route('admin.suppliers.index')" :active="request()->routeIs('admin.suppliers.index', 'admin.suppliers.edit', 'admin.suppliers.show')">Direktori Agen</x-sidebar.sublink>
        <x-sidebar.sublink :href="route('admin.suppliers.create')" :active="request()->routeIs('admin.suppliers.create')">Tambah Mitra Baru</x-sidebar.sublink>
    </x-sidebar.dropdown>

    <!-- Laporan & Analisis -->
    <x-sidebar.dropdown :active="request()->routeIs('admin.reports.*')" icon="fas fa-file-invoice">
        <x-slot name="trigger">Laporan Pusat</x-slot>
        <x-sidebar.sublink :href="route('admin.reports.stock')" :active="request()->routeIs('admin.reports.stock')">Statistik Kuota Seat</x-sidebar.sublink>
        <x-sidebar.sublink :href="route('admin.reports.transactions')" :active="request()->routeIs('admin.reports.transactions')">Riwayat Aktivitas</x-sidebar.sublink>
    </x-sidebar.dropdown>

    <!-- Pengaturan Aplikasi -->
    <x-sidebar.link :href="route('admin.settings')" :active="request()->routeIs('admin.settings')" icon="fas fa-cogs">
        Konfigurasi Biro
    </x-sidebar.link>
</div>