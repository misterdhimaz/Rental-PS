<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Menangani permintaan yang masuk.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah terautentikasi (Login)
        // 2. Cek apakah kolom is_admin di tabel users bernilai true (1)
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Jika bukan admin, gagalkan akses dengan kode 403 (Forbidden)
        // Dimas bisa mengganti ini dengan redirect()->route('home') jika ingin dilempar ke beranda
        abort(403, 'AKSES DITOLAK: Protokol Keamanan Mendeteksi Anda Bukan Admin Sultan.');
    }
}
