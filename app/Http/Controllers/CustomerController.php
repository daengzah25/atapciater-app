<?php

namespace App\Http\Controllers;

use App\Models\Addons;
use App\Models\DaftarPaket;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use App\Models\Libur;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index()
    {
        $pakets = DaftarPaket::all();
        $testimonials = Testimonial::where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('customer.landing-page', compact('pakets', 'testimonials'));
    }

    public function storeTestimonial(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'asal_kota' => 'nullable|string|max:255',
            'testimoni' => 'required|string|min:10|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Testimonial::create($validated);

        return redirect()->route('landing.page')
            ->with('success', 'Terima kasih! Testimoni Anda telah dikirim dan menunggu persetujuan admin.');
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
        // Validasi data
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'no_wa' => 'required|string|max:15',
            'tanggal_booking' => 'required|date',
            'catatan' => 'nullable|string',
            'metode_bayar' => 'required|in:dp_50%,lunas',
            'screenshot' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'id_paket' => 'required|exists:daftar_paket,id_paket',
            'harga_paket' => 'required|integer',
            'nama_paket' => 'required|string',
            'addons' => 'nullable|array'
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
            if ($request->hasFile('screenshot')) {
                $file = $request->file('screenshot');

                $directory = public_path('bukti_pembayaran');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                $filename = 'bukti_' . $idPesanan . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move($directory, $filename);

                Log::info('Bukti pembayaran disimpan: ' . $filename . ' di: ' . $directory);
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
            $this->sendWhatsAppNotification($pesanan, $detailAddons);

            // Redirect ke halaman receipt
            return redirect()->route('customer.receipt', ['id' => $idPesanan])
                ->with('success', 'Booking berhasil! ID Pesanan: ' . $idPesanan);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Booking error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Kirim notifikasi WhatsApp via Fonnte
     */
    private function sendWhatsAppNotification($pesanan, $detailAddons)
    {
        try {
            $apiToken = env('FONNTE_API_TOKEN');

            if (! $apiToken || $apiToken === 'your_fonnte_api_token_here') {
                Log::error('Fonnte API token tidak dikonfigurasi atau masih default');

                return;
            }

            // Format nomor WhatsApp
            $phone = $this->formatPhoneNumber($pesanan->no_wa);

            // Format pesan
            $message = $this->formatWhatsAppMessage($pesanan, $detailAddons);

            Log::info('Mengirim WhatsApp via Fonnte:', [
                'phone' => $phone,
                'message_length' => strlen($message),
                'pesanan_id' => $pesanan->id_pesanan,
            ]);

            // Kirim via Fonnte API dengan format yang benar
            $response = Http::withHeaders([
                'Authorization' => $apiToken,
            ])->asForm()->post('https://api.fonnte.com/send', [
                'target' => $phone,
                'message' => $message,
                'delay' => '2',
                'countryCode' => '62',
            ]);

            // Log response untuk debugging
            Log::info('Fonnte Response: ', [
                'status' => $response->status(),
                'body' => $response->body(),
                'headers' => $response->headers(),
                'pesanan_id' => $pesanan->id_pesanan,
            ]);

            // Cek jika response sukses
            if ($response->successful()) {
                $responseData = $response->json();
                if ($responseData['status'] === true) {
                    Log::info('WhatsApp berhasil dikirim via Fonnte untuk pesanan: ' . $pesanan->id_pesanan);
                } else {
                    Log::error('Fonnte API error: ' . ($responseData['reason'] ?? 'Unknown error'));
                }
            } else {
                Log::error('Fonnte HTTP error: ' . $response->status() . ' - ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Error sending WhatsApp via Fonnte: ' . $e->getMessage());
        }
    }

    /**
     * Format nomor telepon untuk Fonnte
     */
    private function formatPhoneNumber($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (strpos($phone, '0') === 0) {
            $phone = '62' . substr($phone, 1);
        } elseif (strpos($phone, '62') !== 0) {
            $phone = '62' . $phone;
        }

        return $phone;
    }

    /**
     * Format pesan WhatsApp
     */
    private function formatWhatsAppMessage($pesanan, $detailAddons)
    {
        // Set locale ke Indonesia untuk Carbon
        Carbon::setLocale('id');

        $tanggalBooking = Carbon::parse($pesanan->tanggal_booking)->translatedFormat('l, d F Y');
        $tanggalPesan = Carbon::parse($pesanan->tanggal_pesan)->translatedFormat('l, d F Y H:i');
        $metodeBayar = $pesanan->metode_bayar == 'dp_50%' ? 'DP 50%' : 'Lunas';

        // Hitung total full (harga paket + semua addons)
        $totalFull = $pesanan->harga_paket;
        if (! empty($detailAddons)) {
            foreach ($detailAddons as $addon) {
                $totalFull += $addon['subtotal'];
            }
        }

        // Format addons jika ada
        $addonsText = '';
        if (! empty($detailAddons)) {
            $addonsText = "\n\n*TAMBAHAN:*\n";
            foreach ($detailAddons as $addon) {
                $addonsText .= "• {$addon['nama']} (x{$addon['jumlah']}): Rp " . number_format($addon['subtotal'], 0, ',', '.') . "\n";
            }
        }

        // Format pesan berdasarkan metode bayar
        if ($pesanan->metode_bayar == 'dp_50%') {
            $sisaBayar = $totalFull - $pesanan->total;

            $message = "Halo *{$pesanan->nama_pemesan}*,\n\n"
                . "Terima kasih telah melakukan booking di *ATAP CIATER*! 🏕️\n\n"
                . "*DETAIL BOOKING:*\n"
                . "📋 *ID Pesanan:* {$pesanan->id_pesanan}\n"
                . "👤 *Nama Pemesan:* {$pesanan->nama_pemesan}\n"
                . "📦 *Paket:* {$pesanan->nama_paket}\n"
                . "📅 *Tanggal Booking:* {$tanggalBooking}\n"
                . "🕒 *Waktu Pemesanan:* {$tanggalPesan}\n"
                . "💰 *Metode Bayar:* {$metodeBayar}"
                . $addonsText . "\n"
                . '💳 *TOTAL HARGA:* Rp ' . number_format($totalFull, 0, ',', '.') . "\n"
                . '💵 *DP 50% YANG DIBAYAR:* Rp ' . number_format($pesanan->total, 0, ',', '.') . "\n"
                . '📊 *SISA PEMBAYARAN:* Rp ' . number_format($sisaBayar, 0, ',', '.') . "\n\n"
                . "*Catatan:* Sisa pembayaran dapat dilunasi di tempat saat check-in.\n\n"
                . "*Status:* MENUNGGU KONFIRMASI\n\n"
                . "Pembayaran Anda akan diverifikasi dalam 1x24 jam. Terima kasih! 🙏\n\n"
                . "Untuk informasi lebih lanjut:\n"
                . "📞 Customer Service: 0812-3456-7890\n"
                . '📍 Lokasi: Atap Ciater, Subang';
        } else {
            // Untuk pembayaran lunas
            $message = "Halo *{$pesanan->nama_pemesan}*,\n\n"
                . "Terima kasih telah melakukan booking di *ATAP CIATER*! 🏕️\n\n"
                . "*DETAIL BOOKING:*\n"
                . "📋 *ID Pesanan:* {$pesanan->id_pesanan}\n"
                . "👤 *Nama Pemesan:* {$pesanan->nama_pemesan}\n"
                . "📦 *Paket:* {$pesanan->nama_paket}\n"
                . "📅 *Tanggal Booking:* {$tanggalBooking}\n"
                . "🕒 *Waktu Pemesanan:* {$tanggalPesan}\n"
                . "💰 *Metode Bayar:* {$metodeBayar}"
                . $addonsText . "\n"
                . '💳 *TOTAL PEMBAYARAN:* Rp ' . number_format($pesanan->total, 0, ',', '.') . "\n\n"
                . "*Status:* MENUNGGU KONFIRMASI\n\n"
                . "Pembayaran Anda akan diverifikasi dalam 1x24 jam. Terima kasih! 🙏\n\n"
                . "Untuk informasi lebih lanjut:\n"
                . "📞 Customer Service: 0812-3456-7890\n"
                . '📍 Lokasi: Atap Ciater, Subang';
        }

        return $message;
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
