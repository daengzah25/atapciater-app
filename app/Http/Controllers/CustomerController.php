<?php

namespace App\Http\Controllers;

use App\Models\Addons;
use App\Models\DaftarPaket;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\Libur;
use App\Models\Testimonial;
use App\Services\WhatsAppService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index()
    {
        $pakets = DaftarPaket::all();
        $testimonials = Testimonial::orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('customer.landing-page', compact('pakets', 'testimonials'));
    }

    public function storeTestimonial(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'asal_kota' => 'nullable|string|max:255',
            'testimoni' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        try {
            // Simpan testimoni ke database
            Testimonial::create([
                'nama' => $validated['nama'],
                'asal_kota' => $validated['asal_kota'],
                'testimoni' => $validated['testimoni'],
                'rating' => $validated['rating']
            ]);

            return redirect()->route('landing.page')
                ->with('success', 'Terima kasih! Testimoni Anda telah ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error menyimpan testimoni: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan testimoni. Silakan coba lagi.')
                ->withInput();
        }
    }



    // Tambahkan method baru untuk halaman daftar paket
    public function paket()
    {
        $pakets = DaftarPaket::all();

        return view('customer.daftar-paket', compact('pakets'));
    }

    public function showBookingForm($id_paket)
    {
        $paket = DaftarPaket::findOrFail($id_paket);
        $addons = Addons::where('stok', '>', 0)->get(); // Hanya tampilkan addons yang stok > 0

        // Ambil semua tanggal libur
        $tanggalLibur = Libur::pluck('tanggal')->toArray();

        return view('customer.booking', compact('paket', 'addons', 'tanggalLibur'));
    }

    public function submitBooking(Request $request)
    {
        // Screenshot hanya required jika bukan full_cash_on_site
        $screenshotRule = $request->metode_bayar === 'full_cash_on_site' ? 'nullable' : 'required';

        // Validasi data dengan pesan error yang lebih jelas
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'no_wa' => 'required|string|max:15|regex:/^[0-9]{10,13}$/',
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'catatan' => 'nullable|string|max:500',
            'metode_bayar' => 'required|in:dp_50%,lunas,full_cash_on_site',
            'screenshot' => $screenshotRule . '|image|mimes:jpeg,png,jpg|max:2048',
            'id_paket' => 'required|integer|exists:daftar_paket,id_paket',
            'harga_paket' => 'required|integer|min:1',
            'nama_paket' => 'required|string|max:255',
            'addons' => 'nullable|array'
        ], [
            'nama_pemesan.required' => 'Nama Pemesan harus diisi',
            'no_wa.required' => 'Nomor WhatsApp harus diisi',
            'no_wa.regex' => 'Format Nomor WhatsApp tidak valid (10-13 digit)',
            'tanggal_booking.required' => 'Tanggal Booking harus dipilih',
            'tanggal_booking.date' => 'Format Tanggal Booking tidak valid',
            'tanggal_booking.after_or_equal' => 'Tanggal Booking harus hari ini atau setelahnya',
            'metode_bayar.required' => 'Metode Pembayaran harus dipilih',
            'screenshot.required' => 'Bukti Pembayaran harus diupload',
            'screenshot.image' => 'File harus berupa gambar',
            'screenshot.mimes' => 'Format gambar harus JPG atau PNG',
            'screenshot.max' => 'Ukuran file maksimal 2MB'
        ]);

        DB::beginTransaction();
        try {
            // Cek ketersediaan slot paket
            $paket = DaftarPaket::findOrFail($request->id_paket);
            if ($paket->slot <= 0) {
                return redirect()->back()
                    ->withErrors(['error' => 'Maaf, slot untuk paket ini sudah habis.'])
                    ->withInput();
            }

            // Cek ketersediaan stok addons
            if ($request->addons) {
                foreach ($request->addons as $addonId => $quantity) {
                    if ($quantity > 0) {
                        $addon = Addons::find($addonId);
                        if (!$addon || $addon->stok < $quantity) {
                            return redirect()->back()
                                ->withErrors(['error' => 'Stok untuk ' . ($addon->nama_addons ?? 'addon') . ' tidak mencukupi.'])
                                ->withInput();
                        }
                    }
                }
            }

            // Cek tanggal libur
            $isLibur = Libur::where('tanggal', $request->tanggal_booking)->exists();
            $hariMinggu = (date('w', strtotime($request->tanggal_booking)) == 0);

            if ($isLibur || $hariMinggu) {
                return redirect()->back()
                    ->withErrors(['tanggal_booking' => 'Tanggal yang dipilih tidak tersedia untuk booking.'])
                    ->withInput();
            }

            // Generate random 6 digit ID pesanan
            do {
                $idPesanan = mt_rand(100000, 999999);
            } while (Pesanan::where('id_pesanan', $idPesanan)->exists());

            // Handle file upload
            $filename = null;
            if ($request->hasFile('screenshot')) {
                try {
                    $file = $request->file('screenshot');

                    $directory = public_path('bukti_pembayaran');
                    if (!file_exists($directory)) {
                        if (!mkdir($directory, 0755, true)) {
                            throw new \Exception('Gagal membuat direktori untuk menyimpan bukti pembayaran.');
                        }
                    }

                    $filename = 'bukti_' . $idPesanan . '_' . time() . '.' . $file->getClientOriginalExtension();
                    if (!$file->move($directory, $filename)) {
                        throw new \Exception('Gagal menyimpan file bukti pembayaran.');
                    }

                    Log::info('Bukti pembayaran disimpan: ' . $filename . ' di: ' . $directory);
                } catch (\Exception $e) {
                    Log::error('Error upload file: ' . $e->getMessage());
                    DB::rollBack();
                    return redirect()->back()
                        ->withErrors(['screenshot' => 'Gagal mengunggah file: ' . $e->getMessage()])
                        ->withInput();
                }
            } else {
                // Screenshot tidak wajib untuk metode full_cash_on_site
                if ($request->metode_bayar !== 'full_cash_on_site') {
                    DB::rollBack();
                    return redirect()->back()
                        ->withErrors(['screenshot' => 'File bukti pembayaran tidak ditemukan.'])
                        ->withInput();
                }
            }

            // Hitung total
            $totalTambahan = 0;
            $detailAddons = [];
            if ($request->addons) {
                foreach ($request->addons as $addonId => $quantity) {
                    if ($quantity > 0) {
                        $addon = Addons::find($addonId);
                        $subtotal = $addon->harga * $quantity;
                        $totalTambahan += $subtotal;

                        $detailAddons[] = [
                            'nama' => $addon->nama_addons,
                            'jumlah' => $quantity,
                            'subtotal' => $subtotal
                        ];
                    }
                }
            }

            $totalPaket = $request->harga_paket;
            $totalBayar = $totalPaket + $totalTambahan;

            // Jika DP 50%, total bayar hanya 50%
            if ($request->metode_bayar === 'dp_50%') {
                $totalBayar = floor($totalBayar * 0.5);
            }
            // Jika full_cash_on_site, total bayar 0 (dibayar di tempat)
            elseif ($request->metode_bayar === 'full_cash_on_site') {
                $totalBayar = 0;
            }

            // Simpan data pesanan
            $pesanan = new Pesanan();
            $pesanan->id_pesanan = $idPesanan;
            $pesanan->nama_pemesan = $request->nama_pemesan;
            $pesanan->tanggal_pesan = now();
            $pesanan->tanggal_booking = $request->tanggal_booking;
            $pesanan->catatan = $request->catatan;
            $pesanan->total = $totalBayar;
            $pesanan->no_wa = $request->no_wa;
            $pesanan->screenshot = $filename;
            $pesanan->status = 'menunggu_konfirmasi';
            $pesanan->metode_bayar = $request->metode_bayar;
            $pesanan->nama_paket = $request->nama_paket;
            $pesanan->harga_paket = $request->harga_paket;
            $pesanan->save();

            // Simpan detail pesanan (addons) dan kurangi stok
            if ($request->addons) {
                foreach ($request->addons as $addonId => $quantity) {
                    if ($quantity > 0) {
                        $addon = Addons::find($addonId);

                        $detail = new DetailPesanan();
                        $detail->id_pesanan = $idPesanan;
                        $detail->nama_addons = $addon->nama_addons;
                        $detail->harga_addons = $addon->harga;
                        $detail->jumlah = $quantity;
                        $detail->subtotal = $addon->harga * $quantity;
                        $detail->save();

                        // KURANGI STOK ADDONS
                        $addon->stok -= $quantity;
                        $addon->save();
                    }
                }
            }

            // KURANGI SLOT PAKET
            $paket->slot -= 1;
            $paket->save();

            DB::commit();

            // KIRIM WHATSAPP OTOMATIS VIA FONNTE
            $whatsAppService = new WhatsAppService();
            $whatsAppService->sendBookingNotification($pesanan, $detailAddons);

            // Redirect ke halaman receipt
            return redirect()->route('customer.receipt', ['id' => $idPesanan])
                ->with('success', 'Booking berhasil! ID Pesanan: ' . $idPesanan);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Booking error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function showReceipt($id)
    {
        $pesanan = Pesanan::with('detailPesanan')
            ->where('id_pesanan', $id)
            ->firstOrFail();

        return view('customer.receipt', compact('pesanan'));
    }

    // Method untuk halaman cek tiket
    public function showCekTiket()
    {
        return view('customer.cek-tiket');
    }

    // Method untuk proses cek tiket
    public function prosesCekTiket(Request $request)
    {
        $request->validate([
            'id_pesanan' => 'required|integer|digits:6',
        ]);

        $pesanan = Pesanan::with('detailPesanan')
            ->where('id_pesanan', $request->id_pesanan)
            ->first();

        if (! $pesanan) {
            return redirect()->route('customer.cektiket')
                ->withErrors(['id_pesanan' => 'ID Pesanan tidak ditemukan.'])
                ->withInput();
        }

        return view('customer.cek-tiket', compact('pesanan'));
    }
}
