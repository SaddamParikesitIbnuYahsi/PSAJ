<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Models\ProductAttribute;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Schema;
use App\Exports\ProductsTemplateExport;
use Illuminate\Support\Facades\Storage;

class AdminDashboardController extends Controller
{
    // Dashboard
    public function index()
    {
        try {
            $totalProducts = Product::count();
            $totalSuppliers = Supplier::count();
            $totalUsers = User::count();
            $totalCategories = Category::count();

            $chartData = ['categories' => [], 'incoming' => [], 'outgoing' => []];
            for ($i = 6; $i >= 0; $i--) {
                $day = now()->subDays($i);
                $chartData['categories'][] = $day->format('d M');
                $chartData['incoming'][] = StockTransaction::where('type', 'Masuk')
                    ->whereDate('date', $day->format('Y-m-d'))
                    ->sum('quantity');
                $chartData['outgoing'][] = StockTransaction::where('type', 'Keluar')
                    ->whereDate('date', $day->format('Y-m-d'))
                    ->sum('quantity');
            }

            $lowStockProducts = Product::all()
                ->filter(fn($product) => isset($product->min_stock) && $product->current_stock <= $product->min_stock)
                ->take(5);

            $recentTransactions = StockTransaction::with('product', 'user')
                ->orderBy('date', 'desc')
                ->latest()
                ->limit(5)
                ->get();

            $recentUsers = User::latest()->limit(5)->get();

            return view('pages.admin.dashboard.index', compact(
                'totalProducts',
                'totalSuppliers',
                'totalUsers',
                'totalCategories',
                'chartData',
                'recentTransactions',
                'recentUsers',
                'lowStockProducts'
            ));
        } catch (\Exception $e) {
            return view('pages.admin.dashboard.index', [
                'totalProducts' => 0,
                'totalSuppliers' => 0,
                'totalUsers' => 0,
                'totalCategories' => 0,
                'chartData' => [
                    'categories' => [],
                    'incoming' => [],
                    'outgoing' => []
                ],
                'recentTransactions' => collect([]),
                'recentUsers' => collect([]),
                'lowStockProducts' => collect([])
            ])->with('error', 'Gagal memuat data dashboard: ' . $e->getMessage());
        }
    }

    // Users Management
    public function userList(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(10);
        $roles = ['Admin', 'Manajer Operasional', 'Staf Registrasi']; // Fixed Roles

        return view('pages.admin.users.index', compact('users', 'roles'));
    }

    public function userCreate()
    {
        $roles = ['Admin', 'Manajer Operasional', 'Staf Registrasi']; // Fixed Roles
        return view('pages.admin.users.create', compact('roles'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:Admin,Manajer Operasional,Staf Registrasi', // Updated validation
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function userShow(User $user)
    {
        return view('pages.admin.users.show', compact('user'));
    }

    public function userEdit(User $user)
    {
        $roles = ['Admin', 'Manajer Operasional', 'Staf Registrasi']; // Fixed Roles
        return view('pages.admin.users.edit', compact('user', 'roles'));
    }

    public function userUpdate(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|in:Admin,Manajer Operasional,Staf Registrasi', // Updated validation
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate');
    }

    public function confirmDeleteUser(User $user)
    {
        return view('pages.admin.users.delete', compact('user'));
    }

    public function userDestroy(User $user)
    {
        DB::beginTransaction();
        try {
            if ($user->id === auth()->id()) {
                return redirect()->route('admin.users.index')
                    ->with('error', 'Anda tidak dapat menghapus akun sendiri');
            }

            $hasTransactions = StockTransaction::where('user_id', $user->id)->exists();

            if ($hasTransactions) {
                return redirect()->route('admin.users.index')
                    ->with('error', 'Tidak dapat menghapus pengguna karena memiliki riwayat transaksi terkait');
            }

            $userName = $user->name;
            $user->delete();

            DB::commit();

            return redirect()->route('admin.users.index')
                ->with('success', "Pengguna '{$userName}' berhasil dihapus");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.users.index')
                ->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
        }
    }

    // Products Management
    public function productList(Request $request)
    {
        $query = Product::query()
            ->with(['category', 'supplier'])
            ->withCount('stockTransactions');

        $query->select('products.*')
            ->addSelect([
                'current_stock' => StockTransaction::selectRaw('COALESCE(SUM(CASE WHEN type = "Masuk" THEN quantity ELSE -quantity END), 0)')
                    ->whereColumn('product_id', 'products.id')
            ]);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        if ($request->filled('stock_status')) {
            $status = $request->input('stock_status');
            $query->where(function($q) use ($status) {
                switch ($status) {
                    case 'out_of_stock':
                        $q->whereRaw('(SELECT COALESCE(SUM(CASE WHEN type = "Masuk" THEN quantity ELSE -quantity END), 0) FROM stock_transactions WHERE product_id = products.id) <= 0');
                        break;
                    case 'low_stock':
                        $q->whereRaw('(SELECT COALESCE(SUM(CASE WHEN type = "Masuk" THEN quantity ELSE -quantity END), 0) FROM stock_transactions WHERE product_id = products.id) > 0')
                           ->whereRaw('(SELECT COALESCE(SUM(CASE WHEN type = "Masuk" THEN quantity ELSE -quantity END), 0) FROM stock_transactions WHERE product_id = products.id) <= products.min_stock');
                        break;
                    case 'in_stock':
                        $q->whereRaw('(SELECT COALESCE(SUM(CASE WHEN type = "Masuk" THEN quantity ELSE -quantity END), 0) FROM stock_transactions WHERE product_id = products.id) > products.min_stock');
                        break;
                }
            });
        }

        $sortOptions = [
            'name_asc' => ['name', 'asc'],
            'name_desc' => ['name', 'desc'],
            'stock_asc' => ['current_stock', 'asc'],
            'stock_desc' => ['current_stock', 'desc'],
            'price_asc' => ['selling_price', 'asc'],
            'price_desc' => ['selling_price', 'desc'],
        ];

        $sort = $request->input('sort', 'name_asc');
        [$sortColumn, $sortDirection] = $sortOptions[$sort] ?? ['name', 'asc'];

        if ($sortColumn === 'current_stock') {
            $query->orderByRaw('(SELECT COALESCE(SUM(CASE WHEN type = "Masuk" THEN quantity ELSE -quantity END), 0) FROM stock_transactions WHERE product_id = products.id) ' . $sortDirection);
        } else {
            $query->orderBy($sortColumn, $sortDirection);
        }

        $products = $query->paginate(15);
        $categories = Category::orderBy('name')->get();

        $stockStats = [
            'in_stock' => DB::table('products')
                ->selectRaw('COUNT(*) as count')
                ->whereRaw('(SELECT COALESCE(SUM(CASE WHEN type = "Masuk" THEN quantity ELSE -quantity END), 0) FROM stock_transactions WHERE product_id = products.id) > min_stock')
                ->first()->count,

            'low_stock' => DB::table('products')
                ->selectRaw('COUNT(*) as count')
                ->whereRaw('(SELECT COALESCE(SUM(CASE WHEN type = "Masuk" THEN quantity ELSE -quantity END), 0) FROM stock_transactions WHERE product_id = products.id) > 0')
                ->whereRaw('(SELECT COALESCE(SUM(CASE WHEN type = "Masuk" THEN quantity ELSE -quantity END), 0) FROM stock_transactions WHERE product_id = products.id) <= min_stock')
                ->first()->count,

            'out_of_stock' => DB::table('products')
                ->selectRaw('COUNT(*) as count')
                ->whereRaw('(SELECT COALESCE(SUM(CASE WHEN type = "Masuk" THEN quantity ELSE -quantity END), 0) FROM stock_transactions WHERE product_id = products.id) <= 0')
                ->first()->count,
        ];

        return view('pages.admin.products.index', compact('products', 'categories', 'stockStats'));
    }

    public function productCreate()
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        return view('pages.admin.products.create', compact('categories', 'suppliers'));
    }

    public function productStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'current_stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('product_images', 'public');
        }

        $product = Product::create($validated);

        if ($validated['current_stock'] > 0) {
            StockTransaction::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'type' => 'Masuk',
                'quantity' => $validated['current_stock'],
                'notes' => 'Stok awal produk',
                'date' => now(),
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function productShow(Product $product)
    {
        $product->load(['category', 'supplier']);
        $product->load(['stockTransactions' => function($q) {
            $q->orderBy('date', 'desc')->with('user')->paginate(10);
        }]);

        return view('pages.admin.products.show', compact('product'));
    }

    public function productEdit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        return view('pages.admin.products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function productUpdate(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'description' => 'nullable|string',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0|gte:purchase_price',
            'min_stock' => 'required|integer|min:0',
            'unit' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'nullable|boolean',
        ]);

        try {
            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $validatedData['image'] = $request->file('image')->store('product_images', 'public');
            } elseif ($request->input('remove_image')) {
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                $validatedData['image'] = null;
            }

            $product->update($validatedData);

            return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui produk: ' . $e->getMessage())->withInput();
        }
    }

    public function confirmDeleteProduct(Product $product)
    {
        $product->load(['category', 'supplier']);
        return view('pages.admin.products.delete', compact('product'));
    }

    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->stockTransactions()->delete();
            $productName = $product->name;
            $product->delete();

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', "Produk '{$productName}' berhasil dihapus");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.products.index')->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }

    public function forceDestroy(Product $product)
    {
        DB::beginTransaction();
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            DB::table('stock_transactions')->where('product_id', $product->id)->delete();
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->delete();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            DB::commit();
            return redirect()->route('admin.products.index')->with('success', "Produk berhasil dihapus paksa");
        } catch (\Exception $e) {
            DB::rollBack();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            return redirect()->route('admin.products.index')->with('error', 'Gagal hapus paksa');
        }
    }

    // Categories Management
    public function categoryList(Request $request)
    {
        $query = Category::withCount('products');
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        $categories = $query->paginate(10);
        return view('pages.admin.categories.index', compact('categories'));
    }

    public function categoryCreate()
    {
        return view('pages.admin.categories.create');
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        Category::create($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function categoryShow(Category $category)
    {
        $category->load('products');
        return view('pages.admin.categories.show', compact('category'));
    }

    public function categoryEdit(Category $category)
    {
        return view('pages.admin.categories.edit', compact('category'));
    }

    public function categoryUpdate(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:255|unique:categories,name,'.$category->id]);
        $category->update($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Kategori diupdate');
    }

    public function confirmDeleteCategory(Category $category)
    {
        $category->loadCount('products');
        return view('pages.admin.categories.delete', compact('category'));
    }

    public function categoryDestroy(Category $category)
    {
        if ($category->products()->exists()) {
            $uncategorized = Category::firstOrCreate(['name' => 'Tidak Berkategori']);
            $category->products()->update(['category_id' => $uncategorized->id]);
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori dihapus');
    }

    // Suppliers Management
    public function supplierList(Request $request)
    {
        $query = Supplier::query()->withCount('products')->latest();
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        $suppliers = $query->paginate(10);
        $totalProductsFromSuppliers = Supplier::withCount('products')->get()->sum('products_count');
        return view('pages.admin.suppliers.index', compact('suppliers', 'totalProductsFromSuppliers'));
    }

    public function supplierCreate()
    {
        return view('pages.admin.suppliers.create');
    }

    public function supplierStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:suppliers',
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:suppliers',
            'address' => 'nullable|string',
        ]);

        Supplier::create($validated);
        return redirect()->route('admin.suppliers.index')->with('success', 'Mitra berhasil ditambahkan');
    }

    public function supplierShow(Supplier $supplier)
    {
        $supplier->load('products');
        return view('pages.admin.suppliers.show', compact('supplier'));
    }

    public function supplierEdit(Supplier $supplier)
    {
        return view('pages.admin.suppliers.edit', compact('supplier'));
    }

    public function supplierUpdate(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:suppliers,name,'.$supplier->id,
            'email' => 'required|email|unique:suppliers,email,'.$supplier->id,
        ]);
        $supplier->update($request->all());
        return redirect()->route('admin.suppliers.index')->with('success', 'Data mitra diperbarui');
    }

    public function supplierDestroy(Supplier $supplier)
    {
        if ($supplier->products()->exists()) {
            return redirect()->route('admin.suppliers.index')->with('error', 'Mitra memiliki data jamaah');
        }
        $supplier->delete();
        return redirect()->route('admin.suppliers.index')->with('success', 'Mitra dihapus');
    }

    public function confirmDeleteSupplier(Supplier $supplier)
    {
        $supplier->loadCount('products');
        return view('pages.admin.suppliers.delete', compact('supplier'));
    }

    // Reports
    public function reportStock(Request $request)
    {
        $query = Product::with('category');
        if ($request->filled('category_id')) $query->where('category_id', $request->category_id);
        
        $stockSummary = [
            'safe' => Product::whereColumn('current_stock', '>', 'min_stock')->count(),
            'low' => Product::where('current_stock', '>', 0)->whereColumn('current_stock', '<=', 'min_stock')->count(),
            'out' => Product::where('current_stock', '<=', 0)->count(),
        ];

        $products = $query->paginate(20);
        $categories = Category::all();
        return view('pages.admin.reports.stock', compact('products', 'categories', 'stockSummary'));
    }

    public function reportTransactions(Request $request)
    {
        $query = StockTransaction::with(['product', 'user'])->orderBy('created_at', 'desc');
        $transactions = $query->paginate(20);
        return view('pages.admin.reports.transactions', compact('transactions'));
    }

    public function reportUsers()
    {
        $users = User::all();
        return view('pages.admin.reports.users', compact('users'));
    }

    public function reportSystem()
    {
        $systemData = [
            'total_users' => User::count(),
            'total_jamaah' => Product::count(),
            'total_paket' => Category::count(),
            'total_agen' => Supplier::count(),
            'total_transaksi' => StockTransaction::count(),
        ];
        return view('pages.admin.reports.system', compact('systemData'));
    }

    // Excel Export/Import
    public function export(Request $request)
    {
        return Excel::download(new ProductsExport($request), 'data-jamaah.xlsx');
    }

    public function exportTemplate()
    {
        return Excel::download(new ProductsTemplateExport(), 'template-jamaah.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:xlsx,xls']);
        try {
            Excel::import(new ProductsImport, $request->file('file'));
            return redirect()->route('admin.products.index')->with('success', 'Data berhasil diimpor');
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')->with('error', 'Gagal impor: ' . $e->getMessage());
        }
    }
}