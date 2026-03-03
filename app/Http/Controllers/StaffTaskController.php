<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\StockTransaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaffTaskController extends Controller
{
    /**
     * Menampilkan daftar Manifes Pendaftaran Jamaah (Sinkron dengan Admin)
     */
    public function listIncoming(Request $request): View
    {
        $query = Product::with(['category', 'supplier']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'semua') {
            if ($request->status == 'completed') {
                $query->whereColumn('current_stock', '>', 'min_stock');
            } else {
                $query->whereColumn('current_stock', '<=', 'min_stock');
            }
        }

        $transactions = $query->latest()->paginate(15);
        return view('pages.staff.tasks.list_incoming', compact('transactions'));
    }

    /**
     * Memproses Keberangkatan (Stok Keluar)
     */
    public function processOutgoingDispatch(Request $request, StockTransaction $transaction): RedirectResponse
    {
        $product = $transaction->product;

        if (!$product) {
            return redirect()->route('staff.dashboard')->with('error', 'Jamaah tidak ditemukan.');
        }

        $request->validate([
            'quantity_dispatched' => "required|integer|min:1|max:{$product->current_stock}",
        ]);

        DB::beginTransaction();
        try {
            $previousStock = $product->current_stock;

            // 1. Kurangi kuota aktif di Manifest
            $product->decrement('current_stock', $request->quantity_dispatched);

            // 2. Update status transaksi keberangkatan menjadi Selesai (Terbang)
            $transaction->update([
                'status'         => 'completed',
                'quantity'       => $request->quantity_dispatched,
                'user_id'        => Auth::id(),
                'type'           => 'Keluar',
                'previous_stock' => $previousStock,
                'current_stock'  => $previousStock - $request->quantity_dispatched,
                'notes'          => 'Jamaah telah berangkat/terbang.'
            ]);

            DB::commit();
            return redirect()->route('staff.stock.outgoing.list')->with('success', 'Jamaah berhasil diberangkatkan dan riwayat diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses keberangkatan: ' . $e->getMessage());
        }
    }

    public function listOutgoing(): View
    {
        // Mengambil data rencana keberangkatan (Transaksi type Keluar)
        $transactions = StockTransaction::with(['product', 'user'])
            ->where('type', 'Keluar')
            ->latest()
            ->paginate(15);

        return view('pages.staff.tasks.list_outgoing', compact('transactions'));
    }

    // Fungsi konfirmasi masuk (Pendaftaran) tetap dipertahankan
    public function processIncomingConfirmation(Request $request, StockTransaction $transaction): RedirectResponse
    {
        $request->validate([
            'quantity_received' => 'required|integer|min:0',
            'received_date' => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            $product = $transaction->product;
            if ($product) {
                $product->increment('current_stock', $request->quantity_received);
            }

            $transaction->update([
                'status' => 'completed',
                'quantity' => $request->quantity_received,
                'date' => $request->received_date,
                'user_id' => Auth::id(),
            ]);

            DB::commit();
            return redirect()->route('staff.stock.incoming.list')->with('success', 'Data berhasil dikonfirmasi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses.');
        }
    }
}