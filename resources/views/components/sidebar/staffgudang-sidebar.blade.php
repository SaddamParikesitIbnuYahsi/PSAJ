<div class="space-y-2">
    <x-sidebar.link :href="route('staff.dashboard')" :active="request()->routeIs('staff.dashboard')" icon="fas fa-clipboard-list">
        Dashboard Tugas
    </x-sidebar.link>

    <x-sidebar.dropdown :active="request()->routeIs('staff.stock.*')" icon="fas fa-boxes-stacked">
        <x-slot name="trigger">Manajemen Pendaftaran</x-slot>
        <x-sidebar.sublink :href="route('staff.stock.incoming.list')" :active="request()->routeIs('staff.stock.incoming.*')">Daftar Jamaah Masuk</x-sidebar.sublink>
        <x-sidebar.sublink :href="route('staff.stock.outgoing.list')" :active="request()->routeIs('staff.stock.outgoing.*')">Daftar Keberangkatan</x-sidebar.sublink>
    </x-sidebar.dropdown>

    <x-sidebar.dropdown :active="request()->routeIs('staff.reports.*')" icon="fas fa-chart-line">
        <x-slot name="trigger">Laporan</x-slot>
        <x-sidebar.sublink :href="route('staff.reports.incoming')" :active="request()->routeIs('staff.reports.incoming')">Riwayat Jamaah Masuk</x-sidebar.sublink>
        <x-sidebar.sublink :href="route('staff.reports.outgoing')" :active="request()->routeIs('staff.reports.outgoing')">Riwayat Penerbangan</x-sidebar.sublink>
    </x-sidebar.dropdown>
</div>