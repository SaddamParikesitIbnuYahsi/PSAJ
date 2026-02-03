<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class StaffDashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama untuk Staf Registrasi.
     * Mengambil data antrean pendaftaran (Masuk) dan rencana terbang (Keluar).
     */
    public function index(): View
    {
        // 1. Ambil TUGAS UTAMA (Pendaftaran Jamaah Baru dengan status 'pending')
        // [FIXED] Menggunakan 'Masuk' (Huruf Kapital) sesuai data di database
        $incomingTasks = StockTransaction::with(['product', 'supplier'])
            ->where('type', 'Masuk')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->get();

        // 2. Ambil TUGAS KEBERANGKATAN (Rencana Terbang dengan status 'pending')
        // [FIXED] Menggunakan 'Keluar' (Huruf Kapital) sesuai data di database
        $outgoingTasks = StockTransaction::with('product')
            ->where('type', 'Keluar')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->get();

        // 3. Ambil data statistik untuk kartu atas (Aktivitas Hari Ini)
        $incomingTodayCount = StockTransaction::where('type', 'Masuk')
            ->whereDate('created_at', Carbon::today())
            ->count();
            
        $outgoingTodayCount = StockTransaction::where('type', 'Keluar')
            ->whereDate('created_at', Carbon::today())
            ->count();
            
        $totalPendingTasks = $incomingTasks->count() + $outgoingTasks->count();

        // 4. Ambil data Paket yang kuotanya hampir penuh (Low Stock)
        $lowStockProducts = Product::whereColumn('current_stock', '<=', 'min_stock')
            ->where('current_stock', '>', 0)
            ->orderBy('current_stock', 'asc')
            ->take(5)
            ->get();
        
        // 5. Riwayat manifest yang sudah diproses (Log Selesai)
        $recentTransactions = StockTransaction::with(['product', 'user'])
            ->whereIn('status', ['completed', 'dikeluarkan'])
            ->latest()
            ->limit(5)
            ->get();

        // Kirim semua data ke view
        return view('pages.staff.dashboard.index', compact(
            'incomingTasks',
            'outgoingTasks',
            'incomingTodayCount',
            'outgoingTodayCount',
            'totalPendingTasks',
            'lowStockProducts',
            'recentTransactions'
        ));
    }

    /**
     * Menampilkan halaman edit profil staf.
     */
    public function profile()
    {
        return view('pages.profile.edit', ['user' => Auth::user()]);
    }

    /**
     * Memproses update profil staf.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // Proses Upload Foto Profil
        if ($request->hasFile('photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        // Proses Ganti Password
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak cocok.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();
        
        return redirect()->route('staff.profile')->with('success', 'Profil Anda berhasil diperbarui.');
    }
}