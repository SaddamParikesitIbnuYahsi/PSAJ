<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Ubah ke model Product
use Illuminate\Contracts\View\View;
use Carbon\Carbon;
use App\Exports\ManifestExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\StockTransaction;
use App\Exports\DepartureExport;

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
        $transactions = StockTransaction::with(['product', 'user', 'supplier'])
            ->where('type', 'Keluar')
            ->latest('date')
            ->paginate(10);

        return view('pages.staff.reports.outgoing_report', [
            'transactions' => $transactions,
            'reportTitle' => 'Riwayat Keberangkatan'
        ]);
    }

    /**
     * Export manifest jamaah (laporan incoming) ke Excel untuk Staff.
     */
    public function export(Request $request)
    {
        $query = Product::with(['category', 'supplier']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $fileName = 'manifest-jamaah-staff-' . now()->format('Ymd-His') . '.xlsx';

        return Excel::download(new ManifestExport($query), $fileName);
    }

    /**
     * Export laporan keberangkatan (riwayat stock transaction Keluar) ke Excel.
     */
    public function exportDepartures(Request $request)
    {
        $query = StockTransaction::with(['product.category', 'supplier', 'user'])
            ->where('type', 'Keluar');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        $fileName = 'laporan-keberangkatan-staff-' . now()->format('Ymd-His') . '.xlsx';

        return Excel::download(new DepartureExport($query), $fileName);
    }
}