<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Console;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ConsoleController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        // Perbaikan: Pakai latest() supaya unit baru muncul di paling depan
        // Dan pastikan statusnya 'available' (huruf kecil semua sesuai seeder)
        $consoles = Console::with('category')
                            ->where('status', 'available')
                            ->latest()
                            ->get();

        return view('welcome', compact('categories', 'consoles'));
    }

    public function show($slug)
    {
        $console = Console::where('slug', $slug)->with('category')->firstOrFail();
        return view('show', compact('console'));
    }

    public function storeBooking(Request $request)
    {
        // Validasi sesuai data yang dikirim dari Modal depan (console_id & duration)
        $request->validate([
            'console_id' => 'required|exists:consoles,id',
            'duration' => 'required|integer|min:1',
        ]);

        $console = Console::findOrFail($request->console_id);

        // Hitung Total Harga
        $totalPrice = $console->price_per_hour * $request->duration;

        // Simpan ke Database (Sesuaikan dengan kolom tabel bookings kamu)
        Booking::create([
            'user_id'      => Auth::id(),
            'console_id'   => $console->id,
            'booking_code' => 'ALIA-' . strtoupper(Str::random(6)), // Pakai prefix ALIA
            'duration'     => $request->duration, // Pakai duration, bukan total_hours
            'total_price'  => $totalPrice,
            'status'       => 'pending'
        ]);

        return redirect()->route('dashboard')->with('success', 'Sultan! Booking berhasil dikirim. Silakan datang ke lokasi.');
    }
}
