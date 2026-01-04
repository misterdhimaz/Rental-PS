<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Console;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // ==========================================
    // [1] DASHBOARD UTAMA
    // ==========================================
    public function index()
    {
        $stats = [
            'total_revenue' => Booking::where('status', 'finished')->sum('total_price') ?? 0,
            'active_bookings' => Booking::where('status', 'confirmed')->count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'total_users' => User::count(),
        ];

        $bookings = Booking::with(['user', 'console'])->latest()->paginate(10);

        return view('admin.dashboard', compact('stats', 'bookings'));
    }

    // ==========================================
    // [2] MANAJEMEN BOOKING
    // ==========================================
    public function updateStatus($id, Request $request)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Protokol Berhasil: Status Diperbarui!');
    }

    // ==========================================
    // [3] CRUD UNIT CONSOLE
    // ==========================================
    public function manageConsoles()
    {
        $consoles = Console::with('category')->latest()->get();
        $categories = Category::all();
        return view('admin.consoles', compact('consoles', 'categories'));
    }

    public function storeConsole(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price_per_hour' => 'required|numeric',
        ]);

        Console::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . rand(100, 999),
            'category_id' => $request->category_id,
            'price_per_hour' => $request->price_per_hour,
            'status' => 'available'
        ]);

        return redirect()->back()->with('success', 'Unit Baru Berhasil Diaktifkan!');
    }

    public function updateConsole(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price_per_hour' => 'required|numeric',
            'status' => 'required|in:available,unavailable,maintenance'
        ]);

        $console = Console::findOrFail($id);
        $console->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price_per_hour' => $request->price_per_hour,
            'status' => $request->status,
            'slug' => Str::slug($request->name) . '-' . $id
        ]);

        return redirect()->back()->with('success', 'Data Unit Berhasil Diperbarui!');
    }

    public function deleteConsole($id)
    {
        Console::destroy($id);
        return redirect()->back()->with('success', 'Unit Telah Dihapus.');
    }

    // ==========================================
    // [4] CRUD KATEGORI
    // ==========================================
    public function manageCategories()
    {
        $categories = Category::withCount('consoles')->get();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories,name']);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->back()->with('success', 'Kategori Berhasil Ditambahkan!');
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate(['name' => 'required|unique:categories,name,' . $id]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->back()->with('success', 'Kategori Berhasil Diperbarui!');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        // Cek apakah ada unit di kategori ini sebelum hapus
        if ($category->consoles()->count() > 0) {
            return redirect()->back()->with('error', 'Gagal! Kategori ini masih memiliki unit aktif.');
        }

        $category->delete();
        return redirect()->back()->with('success', 'Kategori Berhasil Dihapus.');
    }

    // ==========================================
    // [5] LAPORAN KEUANGAN
    // ==========================================
    public function revenueReport()
    {
        // Laporan per Bulan (SQLite)
        $monthlyRevenue = Booking::select(
                DB::raw('SUM(total_price) as total'),
                DB::raw("strftime('%m', created_at) as month")
            )
            ->where('status', 'finished')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get();

        // Laporan per Kategori
        $categoryRevenue = Booking::join('consoles', 'bookings.console_id', '=', 'consoles.id')
            ->join('categories', 'consoles.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('SUM(bookings.total_price) as total'))
            ->where('bookings.status', 'finished')
            ->groupBy('categories.name')
            ->get();

        return view('admin.reports', compact('monthlyRevenue', 'categoryRevenue'));
    }
}
