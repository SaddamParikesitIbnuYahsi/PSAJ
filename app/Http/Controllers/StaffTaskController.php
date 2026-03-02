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
        // Mengambil data dari Product agar sinkron dengan input Admin
        $query = Product::with(['category', 'supplier']);

        // Filter Pencarian Nama atau SKU
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Filter Status Kuota
        if ($request->filled('status') && $request->status !== 'semua') {
            if ($request->status == 'completed') {
                $query->whereColumn('current_stock', '>', 'min_stock');
            } else {
                $query->whereColumn('current_stock', '<=', 'min_stock');
            }
        }

        // Kita tetap gunakan nama variabel $transactions agar tidak merusak Blade
        $transactions = $query->latest()->paginate(15);

        return view('pages.staff.tasks.list_incoming', compact('transactions'));
    }

    public function showIncomingConfirmationForm(StockTransaction $transaction): View|RedirectResponse
    {
        if ($transaction->type !== 'masuk' || $transaction->status !== 'pending') {
            return redirect()->route('staff.dashboard')->with('error', 'Tugas tidak valid atau sudah diproses.');
        }
        return view('pages.staff.tasks.confirm_incoming', ['task' => $transaction]);
    }

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
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses.');
        }

        return redirect()->route('staff.stock.incoming.list')->with('success', 'Data dikonfirmasi.');
    }

    public function listOutgoing(): View
    {
        $transactions = Product::where('current_stock', '<=', 0)
            ->latest()
            ->paginate(15);
        return view('pages.staff.tasks.list_outgoing', compact('transactions'));
    }
}