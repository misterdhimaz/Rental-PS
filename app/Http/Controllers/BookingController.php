<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Console;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // INI YANG KURANG, DIMAS!

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'console_id' => 'required|exists:consoles,id',
            'duration' => 'required|integer|min:1',
        ]);

        $console = Console::findOrFail($request->console_id);
        $totalPrice = $console->price_per_hour * $request->duration;

        // Sekarang Str::random(6) sudah bisa dikenali sistem
        $bookingCode = 'ALIA-' . strtoupper(Str::random(6));

        Booking::create([
            'user_id' => Auth::id(),
            'console_id' => $console->id,
            'booking_code' => $bookingCode,
            'duration' => $request->duration,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Sultan! Pesanan kamu diproses. Kode: ' . $bookingCode);
    }
}
