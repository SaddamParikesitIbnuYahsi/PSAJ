@extends('layouts.dashboard')

@section('title', 'Kelola Staf Biro')

@section('content')
    <!-- Header Section with Emerald Gradient -->
    <div class="relative mb-10 overflow-hidden rounded-[2.5rem] shadow-sm border border-slate-100">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-600/10 to-amber-500/10 backdrop-blur-md"></div>
        <div class="relative p-8">
            <!-- Breadcrumb -->
            <nav class="flex items-center mb-6 space-x-2 text-[10px] font-black uppercase tracking-[0.2em]">
                <a href="{{ route('admin.dashboard') }}" class="text-slate-400 hover:text-emerald-600 transition">Dashboard</a>
                <i class="fas fa-chevron-right text-[8px] text-slate-300"></i>
                <span class="text-emerald-600">Manajemen Staf</span>
            </nav>

            <!-- Title Section -->
            <div class="flex flex-col items-start justify-between space-y-6 lg:flex-row lg:items-center lg:space-y-0">
                <div class="space-y-2">
                    <h1 class="text-3xl font-black text-slate-800 dark:text-white leading-tight">
                        <i class="mr-3 text-emerald-600 fas fa-users-cog"></i>
                        Kelola Pengguna Sistem
                    </h1>
                    <p class="text-sm font-medium text-slate-500 italic">
                        Manajemen hak akses administrator dan tim operasional biro umroh
                    </p>
                </div>
                <a href="{{ route('admin.users.create') }}"
                   class="inline-flex items-center px-8 py-4 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-700 shadow-xl shadow-emerald-100 transition transform hover:-translate-y-1">
                    <i class="fas fa-user-plus mr-2"></i>
                    <span>Tambah Staf Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 gap-6 mb-10 md:grid-cols-4">
        <!-- Total Users Card -->
        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm transition hover:shadow-md group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center transition-colors group-hover:bg-emerald-600 group-hover:text-white">
                    <i class="fas fa-users"></i>
                </div>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total</span>
            </div>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Seluruh Pengguna</p>
            <p class="text-2xl font-black text-slate-800">{{ $users->total() }}</p>
        </div>

        <!-- Admin Card -->
        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm transition hover:shadow-md border-b-4 border-b-red-400">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-user-shield"></i>
                </div>
                <span class="text-[10px] font-black text-red-600 uppercase tracking-widest">Akses</span>
            </div>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Admin Sistem</p>
            <p class="text-2xl font-black text-slate-800">{{ $users->where('role', 'Admin')->count() }}</p>
        </div>

        <!-- Manager Card -->
        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm transition hover:shadow-md border-b-4 border-b-blue-400">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-user-tie"></i>
                </div>
                <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">Akses</span>
            </div>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Manajer Operasional</p>
            <p class="text-2xl font-black text-slate-800">{{ $users->where('role', 'Manajer Operasional')->count() }}</p>
        </div>

        <!-- Staff Card -->
        <div class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm transition hover:shadow-md border-b-4 border-b-emerald-400">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-user-edit"></i>
                </div>
                <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Akses</span>
            </div>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-none mb-1">Staf Registrasi</p>
            <p class="text-2xl font-black text-slate-800">{{ $users->where('role', 'Staf Registrasi')->count() }}</p>
        </div>
    </div>

    <!-- Main Content Table -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50 bg-slate-50/30">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
                <h2 class="text-sm font-black text-slate-800 uppercase tracking-[0.2em]">Manifest Pengguna Aktif</h2>

                <!-- Search & Filter -->
                <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-wrap gap-3 w-full lg:w-auto">
                    <div class="relative flex-1 md:w-64">
                        <i class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 fas fa-search text-xs"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Nama atau email..."
                               class="w-full pl-11 pr-4 py-2.5 bg-white border-none rounded-xl shadow-inner focus:ring-2 focus:ring-emerald-500 text-sm font-bold">
                    </div>
                    <select name="role" class="px-4 py-2.5 bg-white border-none rounded-xl shadow-inner focus:ring-2 focus:ring-emerald-500 text-sm font-bold text-slate-600">
                        <option value="">Semua Jabatan</option>
                        @foreach(['Admin', 'Manajer Operasional', 'Staf Registrasi'] as $role)
                            <option value="{{ $role }}" {{ request('role') == $role ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-slate-900 text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-slate-800 transition shadow-lg">Cari</button>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50">
                        <th class="px-8 py-5">Informasi Staf</th>
                        <th class="px-8 py-5">Jabatan / Role</th>
                        <th class="px-8 py-5">Status</th>
                        <th class="px-8 py-5">Waktu Bergabung</th>
                        <th class="px-8 py-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($users as $user)
                        <tr class="hover:bg-slate-50 transition group">
                            <td class="px-8 py-5">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-black group-hover:bg-emerald-600 group-hover:text-white transition-all shadow-sm">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-black text-slate-800">{{ $user->name }}</div>
                                        <div class="text-[10px] font-bold text-slate-400 lowercase italic">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-5">
                                @php
                                    $roleStyle = $user->role == 'Admin' ? 'bg-red-50 text-red-600' : ($user->role == 'Manajer Operasional' ? 'bg-blue-50 text-blue-600' : 'bg-emerald-50 text-emerald-600');
                                @endphp
                                <span class="px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-tighter {{ $roleStyle }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-8 py-5">
                                <span class="flex items-center gap-1.5 text-[10px] font-black text-emerald-500 uppercase tracking-widest">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Aktif
                                </span>
                            </td>
                            <td class="px-8 py-5 text-xs font-bold text-slate-400">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex items-center justify-end space-x-1">
                                    <a href="{{ route('admin.users.show', $user) }}" class="p-2 text-slate-400 hover:text-emerald-600 transition"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="p-2 text-slate-400 hover:text-blue-600 transition"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('admin.users.delete', $user) }}" class="p-2 text-slate-400 hover:text-red-600 transition"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-8 border-t border-slate-50">{{ $users->links() }}</div>
    </div>
@endsection