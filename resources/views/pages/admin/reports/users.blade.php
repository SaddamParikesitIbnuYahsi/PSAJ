@extends('layouts.dashboard')

@section('title', 'Laporan Manajemen Staf')

@section('content')
<div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
    <h2 class="text-2xl font-black text-slate-800 mb-8 flex items-center gap-2">
        <i class="fas fa-user-tie text-emerald-600"></i> Manifest Staf Operasional
    </h2>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100">
                    <th class="px-6 py-4">Nama Lengkap</th>
                    <th class="px-6 py-4">Alamat Email</th>
                    <th class="px-6 py-4">Role / Akses</th>
                    <th class="px-6 py-4">Bergabung Pada</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 text-sm">
                @forelse($users as $user)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 font-black text-slate-800">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-block px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest 
                                {{ $user->role == 'admin' ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-100' : 'bg-slate-100 text-slate-600' }}">
                                {{ ucfirst($user->role ?? 'Staf') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-400 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center py-10 text-slate-400 font-bold italic">Belum ada staf terdaftar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-8">{{ $users->links() }}</div>
</div>
@endsection