<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Ubah ke model Product
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Carbon\Carbon;

class StaffReportController extends Controller
{
    public function showIncomingReport(Request $request): View
    {
        // Mengambil data dari tabel Product (Manifest Jamaah) agar sama dengan Admin
        $query = Product::with(['category', 'supplier']);

        // Filter pencarian nama atau SKU (sama seperti logika Admin)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Filter kategori/paket (Opsional)
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter tanggal pendaftaran (berdasarkan created_at produk)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Ambil data terbaru
        $transactions = $query->latest()->paginate(10);

        // Statistik disesuaikan dengan data Product (Sinkron dengan kartu di UI Staff)
        $totalPendaftar = Product::count();
        
        // Seat Tersedia (Sinkron dengan logika 'Tersedia' di Admin)
        $sudahVerifikasi = Product::whereColumn('current_stock', '>', 'min_stock')->count();
        
        // Kuota Menipis (Sinkron dengan logika 'Sisa Sedikit' di Admin)
        $prosesDokumen = Product::where('current_stock', '>', 0)
            ->whereColumn('current_stock', '<=', 'min_stock')
            ->count();
            
        // Pendaftar Baru Hari Ini
        $daftarHariIni = Product::whereDate('created_at', Carbon::today())->count();

        return view('pages.staff.reports.incoming_report', [
            'transactions'    => $transactions, // Variabel tetap sama agar UI tidak pecah
            'reportTitle'     => 'Data Manifest Jamaah',
            'totalPendaftar'  => $totalPendaftar,
            'sudahVerifikasi' => $sudahVerifikasi,
            'prosesDokumen'   => $prosesDokumen,
            'daftarHariIni'   => $daftarHariIni
        ]);
    }

    public function showOutgoingReport(): View
    {
        // Tetap menggunakan transaksi jika ini khusus untuk riwayat keluar/masuk barang/stok
        // Namun untuk manifest jamaah, sebaiknya diarahkan ke data Product
        $transactions = Product::where('current_stock', '<=', 0) // Contoh: Jamaah yang kuotanya sudah penuh
            ->latest()
            ->paginate(10);

        return view('pages.staff.reports.outgoing_report', [
            'transactions' => $transactions,
            'reportTitle' => 'Riwayat Keberangkatan'
        ]);
    }
}