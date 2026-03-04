<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;

class StaffDashboardController extends Controller
{
    public function index(): View
    {
        // 1. Ambil data Jamaah (Model Product) agar sinkron dengan Admin
        $incomingTasks = Product::with(['category', 'supplier'])
            ->latest()
            ->take(5)
            ->get();

        // 2. Ambil data Jamaah yang kuotanya penuh (Model Product)
        $outgoingTasks = Product::where('current_stock', '<=', 0)
            ->latest()
            ->take(5)
            ->get();

        // 3. Statistik
        $incomingTodayCount = Product::whereDate('created_at', Carbon::today())->count();
        $outgoingTodayCount = Product::where('current_stock', '<=', 0)->whereDate('updated_at', Carbon::today())->count();
        $totalPendingTasks = Product::count();

        $lowStockProducts = Product::whereColumn('current_stock', '<=', 'min_stock')
            ->where('current_stock', '>', 0)
            ->take(5)->get();
        
        $recentTransactions = StockTransaction::with(['product', 'user'])->latest()->limit(5)->get();

        return view('pages.staff.dashboard.index', compact(
            'incomingTasks', 'outgoingTasks', 'incomingTodayCount',
            'outgoingTodayCount', 'totalPendingTasks', 'lowStockProducts', 'recentTransactions'
        ));
    }
}