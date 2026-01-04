<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data booking milik user yang sedang login (sementara kita pakai ID 1 dulu jika belum ada sistem login)
        $userId = Auth::id() ?? 1;

        $bookings = Booking::where('user_id', $userId)
            ->with('console')
            ->latest()
            ->get();

        // Hitung statistik sederhana
        $totalPlayTime = $bookings->where('status', 'completed')->sum('total_hours');
        $activeRentals = $bookings->where('status', 'active')->count();

        return view('dashboard', compact('bookings', 'totalPlayTime', 'activeRentals'));
    }
}
