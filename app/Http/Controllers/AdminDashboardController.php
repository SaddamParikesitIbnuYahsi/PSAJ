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
    // ===================================
    // DASHBOARD UTAMA
    // ===================================
    public function index()
    {
        try {
            $totalProducts = Product::count(); // Total Jamaah
            $totalSuppliers = Supplier::count(); // Total Agen
            $totalUsers = User::count();
            $totalCategories = Category::count(); // Total Paket

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
                'totalProducts', 'totalSuppliers', 'totalUsers', 'totalCategories', 
                'chartData', 'recentTransactions', 'recentUsers', 'lowStockProducts'
            ));
        } catch (\Exception $e) {
            return view('pages.admin.dashboard.index', [
                'totalProducts' => 0, 'totalSuppliers' => 0, 'totalUsers' => 0, 'totalCategories' => 0,
                'chartData' => ['categories' => [], 'incoming' => [], 'outgoing' => []],
                'recentTransactions' => collect([]), 'recentUsers' => collect([]), 'lowStockProducts' => collect([])
            ])->with('error', 'Gagal memuat dashboard');
        }
    }

    // ===================================
    // MANAJEMEN PENGGUNA (USERS)
    // ===================================
    public function userList(Request $request)
    {
        $query = User::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
            });
        }
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        $users = $query->latest()->paginate(10);
        $roles = ['Admin', 'User', 'Staf Registrasi']; // Roles diperbarui

        return view('pages.admin.users.index', compact('users', 'roles'));
    }

    public function userCreate()
    {
        $roles = ['Admin', 'User', 'Staf Registrasi'];
        return view('pages.admin.users.create', compact('roles'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:Admin,User,Staf Registrasi',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function userShow(User $user)
    {
        return view('pages.admin.users.show', compact('user'));
    }

    public function userEdit(User $user)
    {
        $roles = ['Admin', 'User', 'Staf Registrasi'];
        return view('pages.admin.users.edit', compact('user', 'roles'));
    }

    public function userUpdate(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'required|in:Admin,User,Staf Registrasi',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->only('name', 'email', 'role');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('admin.users.index')->with('success', 'Data pengguna diperbarui');
    }

    public function confirmDeleteUser(User $user)
    {
        return view('pages.admin.users.delete', compact('user'));
    }

    public function userDestroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Tidak dapat menghapus akun sendiri');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus');
    }

    // ===================================
    // MANAJEMEN MANIFEST (PRODUCTS)
    // ===================================
    public function productList(Request $request)
    {
        $query = Product::with(['category', 'supplier']);
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%")->orWhere('sku', 'like', "%{$request->search}%");
        }
        $products = $query->paginate(15);
        
        $stockStats = [
            'in_stock' => Product::whereColumn('current_stock', '>', 'min_stock')->count(),
            'low_stock' => Product::where('current_stock', '>', 0)->whereColumn('current_stock', '<=', 'min_stock')->count(),
            'out_of_stock' => Product::where('current_stock', '<=', 0)->count(),
        ];

        return view('pages.admin.products.index', compact('products', 'stockStats'));
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
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'current_stock' => 'required|integer',
            'min_stock' => 'required|integer',
            'unit' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('product_images', 'public');
        }

        Product::create($validated);
        return redirect()->route('admin.products.index')->with('success', 'Jamaah berhasil didaftarkan');
    }

    public function productShow(Product $product)
    {
        $product->load(['category', 'supplier', 'stockTransactions.user']);
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
        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('product_images', 'public');
        }
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Data diperbarui');
    }

    public function confirmDeleteProduct(Product $product)
    {
        return view('pages.admin.products.delete', compact('product'));
    }

    public function destroy(Product $product)
    {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Data dihapus');
    }

    // ===================================
    // MANAJEMEN PROGRAM PAKET (CATEGORIES)
    // ===================================
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
        $request->validate(['name' => 'required|string|max:255|unique:categories']);
        Category::create($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Program paket ditambahkan');
    }

    public function categoryShow(Category $category)
    {
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
        return redirect()->route('admin.categories.index')->with('success', 'Program diperbarui');
    }

    public function confirmDeleteCategory(Category $category)
    {
        return view('pages.admin.categories.delete', compact('category'));
    }

    public function categoryDestroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Program dihapus');
    }

    // ===================================
    // MANAJEMEN AGEN/MITRA (SUPPLIERS)
    // ===================================
    public function supplierList(Request $request)
    {
        $query = Supplier::query()->withCount('products')->latest();
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        $suppliers = $query->paginate(10);
        $totalProductsFromSuppliers = Supplier::count();
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
            'contact_person' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email|unique:suppliers',
        ]);
        Supplier::create($validated);
        return redirect()->route('admin.suppliers.index')->with('success', 'Mitra ditambahkan');
    }

    public function supplierShow(Supplier $supplier)
    {
        return view('pages.admin.suppliers.show', compact('supplier'));
    }

    public function supplierEdit(Supplier $supplier)
    {
        return view('pages.admin.suppliers.edit', compact('supplier'));
    }

    public function supplierUpdate(Request $request, Supplier $supplier)
    {
        $supplier->update($request->all());
        return redirect()->route('admin.suppliers.index')->with('success', 'Data mitra diperbarui');
    }

    public function confirmDeleteSupplier(Supplier $supplier)
    {
        return view('pages.admin.suppliers.delete', compact('supplier'));
    }

    public function supplierDestroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('admin.suppliers.index')->with('success', 'Mitra dihapus');
    }

    // ===================================
    // LAPORAN & PROFILE
    // ===================================
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

    public function reportTransactions()
    {
        $transactions = StockTransaction::with(['product', 'user'])->latest()->paginate(20);
        return view('pages.admin.reports.transactions', compact('transactions'));
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

    public function profile()
    {
        return view('pages.profile.edit', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $user->update($request->only('name', 'email'));
        return back()->with('success', 'Profil diperbarui');
    }

    // ===================================
    // EXCEL EXPORT / IMPORT
    // ===================================
    public function export(Request $request)
    {
        return Excel::download(new ProductsExport($request), 'manifest-jamaah.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:xlsx,xls']);
        try {
            Excel::import(new ProductsImport, $request->file('file'));
            return redirect()->route('admin.products.index')->with('success', 'Data berhasil diimpor');
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')->with('error', 'Gagal impor data');
        }
    }
}