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
    public function index(): View
    {
        $incomingTasks = Product::with(['category', 'supplier'])
            ->latest()
            ->take(5)
            ->get();

        $outgoingTasks = Product::where('current_stock', '<=', 0)
            ->latest()
            ->take(5)
            ->get();

        $incomingTodayCount = Product::whereDate('created_at', Carbon::today())->count();
        $outgoingTodayCount = Product::where('current_stock', '<=', 0)->whereDate('updated_at', Carbon::today())->count();
        $totalPendingTasks = Product::count();

        $lowStockProducts = Product::whereColumn('current_stock', '<=', 'min_stock')
            ->where('current_stock', '>', 0)
            ->take(5)->get();

        $recentTransactions = StockTransaction::with(['product', 'user'])->latest()->limit(5)->get();

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
                Storage::disk('public')->delete($user->profile_photo_path);
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

        return redirect()->route('staff.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}