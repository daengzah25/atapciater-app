<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class PICController extends Controller
{
    public function dashboard()
    {
        $pesanan = Pesanan::with('detailPesanan')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pic.dashboard', compact('pesanan'));
    }
}
