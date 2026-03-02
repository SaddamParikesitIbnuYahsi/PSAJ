<div class="space-y-2">
    <!-- Dashboard Utama -->
    <x-sidebar.link :href="route('staff.dashboard')" :active="request()->routeIs('staff.dashboard')" icon="fas fa-th-large">
        Dashboard Tugas
    </x-sidebar.link>

    <!-- Menu Manajemen Manifest -->
    <x-sidebar.dropdown :active="request()->routeIs('staff.stock.*')" icon="fas fa-users-rectangle">
        <x-slot name="trigger">Manajemen Pendaftaran</x-slot>
        <x-sidebar.sublink :href="route('staff.stock.incoming.list')" :active="request()->routeIs('staff.stock.incoming.*')">
            <i class="fas fa-user-plus mr-2 text-[10px]"></i> Daftar Jamaah Masuk
        </x-sidebar.sublink>
        <x-sidebar.sublink :href="route('staff.stock.outgoing.list')" :active="request()->routeIs('staff.stock.outgoing.*')">
            <i class="fas fa-plane-departure mr-2 text-[10px]"></i> Daftar Keberangkatan
        </x-sidebar.sublink>
    </x-sidebar.dropdown>

    <!-- Menu Laporan & Riwayat -->
    <x-sidebar.dropdown :active="request()->routeIs('staff.reports.*')" icon="fas fa-file-signature">
        <x-slot name="trigger">Laporan & Manifest</x-slot>
        <x-sidebar.sublink :href="route('staff.reports.incoming')" :active="request()->routeIs('staff.reports.incoming')">
            <i class="fas fa-history mr-2 text-[10px]"></i> Riwayat Jamaah Masuk
        </x-sidebar.sublink>
        <x-sidebar.sublink :href="route('staff.reports.outgoing')" :active="request()->routeIs('staff.reports.outgoing')">
            <i class="fas fa-passport mr-2 text-[10px]"></i> Riwayat Penerbangan
        </x-sidebar.sublink>
    </x-sidebar.dropdown>
</div>