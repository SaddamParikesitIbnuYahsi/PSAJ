@extends('layouts.dashboard')

@section('title', 'Hapus Akun Pengguna')

@section('content')
<div class="max-w-2xl mx-auto py-12 px-6">
    <div class="bg-white border-2 border-red-50 rounded-[2.5rem] shadow-2xl overflow-hidden text-center p-10">
        <div class="w-20 h-20 bg-red-50 text-red-500 rounded-3xl flex items-center justify-center text-3xl mx-auto mb-6">
            <i class="fas fa-user-minus"></i>
        </div>
        
        <h2 class="text-2xl font-black text-slate-800 mb-2">Nonaktifkan Staf?</h2>
        <p class="text-sm font-medium text-slate-500 mb-8">Anda akan menghapus akses sistem secara permanen untuk:</p>

        <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 mb-10 flex items-center gap-4 text-left">
            <div class="w-12 h-12 rounded-2xl bg-slate-200 flex items-center justify-center font-black text-slate-500">{{ substr($user->name, 0, 1) }}</div>
            <div>
                <p class="font-black text-slate-800 leading-none mb-1">{{ $user->name }}</p>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest italic">{{ $user->role }}</p>
            </div>
        </div>

        <p class="mb-10 text-red-500 font-bold text-xs uppercase tracking-tighter">
            <i class="fas fa-exclamation-circle mr-1"></i> Aksi ini akan menghapus seluruh data kredensial staf tersebut!
        </p>

        <div class="flex justify-center gap-4">
            <a href="{{ route('admin.users.index') }}" class="px-8 py-4 font-bold text-slate-400 hover:text-slate-600 transition">Batal</a>
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="px-8 py-4 bg-red-600 text-white font-black rounded-2xl hover:bg-red-700 shadow-xl shadow-red-100 transition transform hover:-translate-y-1">
                    Hapus Permanen
                </button>
            </form>
        </div>
    </div>
</div>
@endsection