<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\StockTransaction;
use App\Models\User;
use Carbon\Carbon;

class ManagerDashboardController extends Controller
{
    /**
     * Menghitung stok saat ini untuk sebuah produk.
     * Ini adalah helper function agar tidak mengulang kode.
     */

    /**
     * Menampilkan halaman dashboard untuk Manajer Gudang.
     */
   public function index()
{
    $totalProducts = Product::count();
    $totalSuppliers = Supplier::count();

    $lowStockProducts = Product::all()->filter(function ($product) {
        return isset($product->min_stock) && $product->current_stock <= $product->min_stock;
    })->sortBy('current_stock')->take(5);

    // Chart data dengan whereBetween
    $chartData = ['categories' => [], 'incoming' => [], 'outgoing' => []];
    for ($i = 6; $i >= 0; $i--) {
        $day = now()->subDays($i);
        $chartData['categories'][] = $day->format('d M');

        $chartData['incoming'][] = StockTransaction::where('type', 'Masuk')
            ->whereBetween('date', [$day->copy()->startOfDay(), $day->copy()->endOfDay()])
            ->sum('quantity');

        $chartData['outgoing'][] = StockTransaction::where('type', 'Keluar')
            ->whereBetween('date', [$day->copy()->startOfDay(), $day->copy()->endOfDay()])
            ->sum('quantity');
    }

    // Hitungan hari ini dengan whereBetween
    $incomingTodayCount = StockTransaction::where('type', 'Masuk')
        ->whereBetween('date', [now()->startOfDay(), now()->endOfDay()])
        ->count();

    $outgoingTodayCount = StockTransaction::where('type', 'Keluar')
        ->whereBetween('date', [now()->startOfDay(), now()->endOfDay()])
        ->count();

    $recentTransactions = StockTransaction::with('product', 'user')
        ->orderBy('date', 'desc')
        ->limit(5)
        ->get();

    $recentSuppliers = Supplier::latest()->limit(5)->get();

    return view('pages.manajergudang.dashboard.index', compact(
        'totalProducts', 'totalSuppliers', 'lowStockProducts',
        'incomingTodayCount', 'outgoingTodayCount', 'recentTransactions',
        'chartData', 'recentSuppliers'
    ));
}


    // ... (productList dan productShow tidak perlu diubah) ...
    public function productList(Request $request)
    {
        $query = Product::with('category');

        // Salin query efisien dari AdminDashboardController
        $query->addSelect(['*',
            'stock_in_sum' => StockTransaction::select(DB::raw('COALESCE(sum(quantity), 0)'))
                ->whereColumn('product_id', 'products.id')
                ->where('type', 'Masuk'),
            'stock_out_sum' => StockTransaction::select(DB::raw('COALESCE(sum(quantity), 0)'))
                ->whereColumn('product_id', 'products.id')
                ->where('type', 'Keluar')
        ]);

        if ($request->has('search') && $request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        $products = $query->latest()->paginate(15);
        return view('pages.manajergudang.products.index', compact('products'));
    }

    public function productShow(Product $product)
    {
        $product->load('category', 'supplier', 'stockTransactions');
        return view('pages.manajergudang.products.show', compact('product'));
    }


    // === Fungsionalitas Manajemen Stok ===

    public function stockIn(Request $request)
    {
        $packageId = $request->get('package_id');
        if (!$packageId) {
            return redirect()->route('manajergudang.dashboard')->with('error', 'Pilih paket terlebih dahulu dari halaman utama.');
        }

        $package = Category::find($packageId);
        if (!$package) {
            return redirect()->route('manajergudang.dashboard')->with('error', 'Paket tidak ditemukan.');
        }

        $packagePrices = [
            1 => 25_000_000,  // Paket Ekonomis
            2 => 35_000_000,  // Paket VIP
            3 => 40_000_000, // Paket Keluarga
        ];
        $packagePrice = $packagePrices[$packageId] ?? 25_000_000;

        $suppliers = Supplier::orderBy('name')->get(['id', 'name']);
        return view('pages.manajergudang.stock.in', compact('package', 'packagePrice', 'suppliers'));
    }

    public function stockInStore(Request $request)
    {
        $packageId = $request->get('package_id');
        if ($packageId) {
            return $this->stockInStoreFromPackage($request);
        }

        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
            'notes' => 'nullable|string|max:255',
        ]);

        try {
            DB::transaction(function () use ($validatedData) {
                $product = Product::findOrFail($validatedData['product_id']);
                StockTransaction::create([
                    'product_id' => $validatedData['product_id'],
                    'user_id' => Auth::id(),
                    'supplier_id' => $validatedData['supplier_id'],
                    'type' => 'Masuk',
                    'quantity' => $validatedData['quantity'],
                    'notes' => $validatedData['notes'],
                    'date' => Carbon::parse($validatedData['transaction_date'])->setTimeFrom(now()),
                    'status' => 'Diterima',
                ]);
                $product->increment('current_stock', $validatedData['quantity']);
            });
            return redirect()->route('manajergudang.dashboard')->with('success', 'Transaksi pendaftaran berhasil dicatat.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    protected function stockInStoreFromPackage(Request $request)
    {
        $validatedData = $request->validate([
            'package_id' => 'required|exists:categories,id',
            'package_price' => 'required|numeric|min:0',
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
            'notes' => 'nullable|string|max:500',
            'bukti_pembayaran' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:5120',
        ]);

        try {
            $path = $request->file('bukti_pembayaran')->store('bukti-pembayaran', 'public');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengupload bukti pembayaran: ' . $e->getMessage())->withInput();
        }

        $sku = $validatedData['sku'] ?: $this->generateJamaahSku();

        try {
            DB::transaction(function () use ($validatedData, $path, $sku) {
                $product = Product::create([
                    'category_id' => $validatedData['package_id'],
                    'supplier_id' => $validatedData['supplier_id'],
                    'name' => $validatedData['name'],
                    'sku' => $sku,
                    'description' => $validatedData['notes'],
                    'purchase_price' => (float) $validatedData['package_price'] * 0.88,
                    'selling_price' => (float) $validatedData['package_price'],
                    'image' => $path,
                    'current_stock' => $validatedData['quantity'],
                    'min_stock' => 0,
                    'unit' => 'pax',
                ]);

                StockTransaction::create([
                    'product_id' => $product->id,
                    'user_id' => Auth::id(),
                    'supplier_id' => $validatedData['supplier_id'],
                    'type' => 'Masuk',
                    'quantity' => $validatedData['quantity'],
                    'notes' => 'Registrasi jamaah baru - ' . ($validatedData['notes'] ?: 'Pembayaran paket umroh'),
                    'date' => Carbon::parse($validatedData['transaction_date'])->setTimeFrom(now()),
                    'status' => 'Diterima',
                ]);
            });

            return redirect()->route('manajergudang.dashboard')
                ->with('success', 'Berhasil! Transaksi selesai dan data jamaah telah masuk ke admin.')
                ->withFragment('paket');

        } catch (\Exception $e) {
            Storage::disk('public')->delete($path);
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    protected function generateJamaahSku(): string
    {
        $year = now()->format('Y');
        $last = Product::whereYear('created_at', $year)
            ->where('sku', 'like', "UMR-{$year}-%")
            ->orderByDesc('id')
            ->first();
        $num = $last ? (int) substr($last->sku, -4) + 1 : 1;
        return sprintf('UMR-%s-%04d', $year, $num);
    }

    public function stockOut()
    {
        // Sama seperti stockIn, gunakan query yang lebih efisien
        $products = Product::orderBy('name')->get();
        $products->load('stockTransactions');
        return view('pages.manajergudang.stock.out', compact('products'));
    }

    public function stockOutStore(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
            'notes' => 'nullable|string|max:255',
        ]);
        
        try {
            DB::transaction(function () use ($validatedData) {
                // 1. Cari produk
                $product = Product::findOrFail($validatedData['product_id']);

                // 2. Validasi stok sebelum melanjutkan
                if ($validatedData['quantity'] > $product->current_stock) {
                    // Melemparkan exception akan otomatis me-rollback transaksi DB
                    throw new \Exception('Kuota tidak mencukupi. Kuota tersedia: ' . $product->current_stock);
                }

                // 3. Buat catatan transaksi keluar
                StockTransaction::create([
                    'product_id' => $validatedData['product_id'],
                    'user_id' => Auth::id(),
                    'type' => 'Keluar',
                    'quantity' => $validatedData['quantity'],
                    'notes' => $validatedData['notes'],
                    'date' => Carbon::parse($validatedData['transaction_date'])->setTimeFrom(now()),
                    'status' => 'Dikeluarkan',
                ]);

                // 4. [FIX] Update stok di tabel products menggunakan decrement
                $product->decrement('current_stock', $validatedData['quantity']);
            });

            return redirect()->route('manajergudang.dashboard')->with('success', 'Transaksi keberangkatan berhasil dicatat.');
        
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function stockOpname(Request $request)
    {
        $query = Product::with('supplier')->orderBy('name');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        
        $products = $query->paginate(15);
        $suppliers = Supplier::orderBy('name')->get();
        $categories = Category::orderBy('name')->get(); // For the filter
        
        return view('pages.manajergudang.stock.opname', compact('products', 'suppliers', 'categories'));
    }

    public function stockOpnameStore(Request $request)
    {
        $validated = $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.system_stock' => 'required|integer',
            'products.*.physical_stock' => 'required|integer|min:0',
            'products.*.supplier_id' => 'nullable|exists:suppliers,id', // [BARU] Validasi supplier_id
        ]);

        DB::transaction(function () use ($validated) {
            foreach ($validated['products'] as $item) {
                $systemStock = (int)$item['system_stock'];
                $physicalStock = (int)$item['physical_stock'];
                
                if ($physicalStock !== $systemStock) {
                    $product = Product::findOrFail($item['id']);
                    $difference = $physicalStock - $systemStock;

                    StockTransaction::create([
                        'product_id' => $product->id,
                        'user_id' => Auth::id(),
                        'supplier_id' => $item['supplier_id'] ?? null, // [BARU] Simpan supplier_id
                        'type' => $difference > 0 ? 'Masuk' : 'Keluar', 
                        'quantity' => abs($difference), 
                        'notes' => 'Penyesuaian Rekonsiliasi Kuota',
                        'date' => now(),
                        'status' => $difference > 0 ? 'Diterima' : 'Dikeluarkan',
                    ]);
                    
                    $product->update(['current_stock' => $physicalStock]);
                }
            }
        });

        return redirect()->route('manajergudang.stock.opname')->with('success', 'Rekonsiliasi kuota berhasil disimpan dan data telah disesuaikan.');
    }

    public function supplierList(Request $request)
    {
        $query = Supplier::withCount('products');

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('contact_person', 'like', "%{$search}%");
            });
        }

        $suppliers = $query->latest()->paginate(15);
        
        // [BARU] Hitung statistik untuk kartu
        $stats = [
            'total_suppliers' => Supplier::count(),
            'total_products_from_suppliers' => Product::whereHas('supplier')->count(),
        ];

        return view('pages.manajergudang.suppliers.index', compact('suppliers', 'stats'));
    }

    public function supplierShow(Supplier $supplier)
    {
        // Load relasi produk untuk menampilkan statistik
        $supplier->load('products');
        return view('pages.manajergudang.suppliers.show', compact('supplier'));
    }

    public function reportStock(Request $request)
    {
        // --- 1. EFFICIENT QUERY FOR SUMMARY AND FILTERING ---
        // Start with a base query to get status counts
        $summaryQuery = Product::query()
            ->selectRaw("
                SUM(CASE WHEN current_stock > min_stock THEN 1 ELSE 0 END) as safe_count,
                SUM(CASE WHEN current_stock <= min_stock AND current_stock > 0 THEN 1 ELSE 0 END) as low_count,
                SUM(CASE WHEN current_stock <= 0 THEN 1 ELSE 0 END) as out_count
            ");

        // --- 2. QUERY FOR THE PAGINATED PRODUCT LIST ---
        // Start a separate query for the table data
        $productsQuery = Product::with('category');

        // --- 3. APPLY FILTERS TO BOTH QUERIES ---
        // Apply search filter (only for the product list)
        if ($request->filled('search')) {
            $search = $request->search;
            $productsQuery->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Apply category filter (to both the summary and the list)
        if ($request->filled('category_id')) {
            $categoryId = $request->category_id;
            $summaryQuery->where('category_id', $categoryId);
            $productsQuery->where('category_id', $categoryId);
        }

        // --- 4. EXECUTE QUERIES AND GET DATA ---
        // Execute the summary query to get the counts
        $summaryResult = $summaryQuery->first();
        $stockSummary = [
            'safe' => $summaryResult->safe_count ?? 0,
            'low' => $summaryResult->low_count ?? 0,
            'out' => $summaryResult->out_count ?? 0,
        ];

        // Execute the paginated query for the table
        $products = $productsQuery->paginate(20);

        // Get all categories for the filter dropdown
        $categories = Category::orderBy('name')->get();

        // --- 5. RETURN VIEW WITH ALL DATA ---
        return view('pages.manajergudang.reports.stock', compact('products', 'categories', 'stockSummary'));
    }

    public function reportTransactions(Request $request)
    {
        $query = StockTransaction::with(['product', 'user', 'supplier'])->latest('date');

        // Filter berdasarkan tipe transaksi
        if ($request->has('type') && $request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter berdasarkan rentang tanggal
        if ($request->has('start_date') && $request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }

        $transactions = $query->paginate(20);

        return view('pages.manajergudang.reports.transactions', compact('transactions'));
    }

    public function profile()
    {
        return view('pages.profile.edit', ['user' => Auth::user()]);
    }

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

        if ($request->hasFile('photo')) {
            if ($user->profile_photo_path) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_photo_path);
            }
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak cocok.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('manajergudang.profile')->with('success', 'Profil berhasil diperbarui.');
    }

}