<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarPaket;
use App\Models\Addons;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Http\Controllers\SlotController;
use App\Models\Slot;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPaket = DaftarPaket::count();
        $totalAddons = Addons::count();
        $totalPesanan = Pesanan::count();
        $totalSlot = Slot::count();

        return view('admin.dashboard', compact('totalPaket', 'totalAddons', 'totalPesanan'));
    }

    // Method untuk kelola daftar paket
    public function kelolaPaket()
    {
        $pakets = DaftarPaket::all();
        return view('admin.kelola-paket', compact('pakets'));
    }

    // Simpan paket baru
    // Simpan paket baru
    // Simpan paket baru
    // Simpan paket baru
    public function simpanPaket(Request $request)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'slot' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
            'fasilitas' => 'required|string',
            'harga' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            // Handle file upload - simpan langsung ke public/images/paket_images
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');

                // Buat directory jika belum ada
                $directory = public_path('images/paket_images');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Generate nama file unik
                $filename = 'paket_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Pindahkan file ke directory public
                $file->move($directory, $filename);

                $validated['gambar'] = $filename;
            }

            DaftarPaket::create($validated);

            return redirect()->route('admin.kelola.paket')->with('success', 'Paket berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan paket: ' . $e->getMessage());
        }
    }

    // Update paket
    public function updatePaket(Request $request, $id)
    {
        $paket = DaftarPaket::findOrFail($id);

        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'slot' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
            'fasilitas' => 'required|string',
            'harga' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');

                // Buat directory jika belum ada
                $directory = public_path('images/paket_images');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Hapus gambar lama jika ada
                if ($paket->gambar && file_exists(public_path('images/paket_images/' . $paket->gambar))) {
                    unlink(public_path('images/paket_images/' . $paket->gambar));
                }

                // Generate nama file unik
                $filename = 'paket_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Pindahkan file ke directory public
                $file->move($directory, $filename);

                $validated['gambar'] = $filename;
            } else {
                // Pertahankan gambar lama jika tidak ada upload baru
                $validated['gambar'] = $paket->gambar;
            }

            $paket->update($validated);

            return redirect()->route('admin.kelola.paket')->with('success', 'Paket berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui paket: ' . $e->getMessage());
        }
    }

    // Hapus paket (soft delete)
    public function hapusPaket($id)
    {
        try {
            $paket = DaftarPaket::findOrFail($id);

            // Hapus gambar fisik jika ada
            if ($paket->gambar && file_exists(public_path('images/paket_images/' . $paket->gambar))) {
                unlink(public_path('images/paket_images/' . $paket->gambar));
            }

            // Hapus paket - slot akan otomatis terhapus karena cascade di database
            $paket->delete();

            return redirect()->route('admin.kelola.paket')->with('success', 'Paket berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus paket: ' . $e->getMessage());
        }
    }


    // Get data paket untuk edit
    public function getPaket($id)
    {
        $paket = DaftarPaket::findOrFail($id);
        return response()->json($paket);
    }

    public function kelolaAddons()
    {
        $addons = Addons::all();
        return view('admin.kelola-addons', compact('addons'));
    }

    // Simpan addon baru
    public function simpanAddon(Request $request)
    {
        $validated = $request->validate([
            'nama_addons' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            // Handle file upload - simpan langsung ke public/images/addons_images
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');

                // Buat directory jika belum ada
                $directory = public_path('images/addons_images');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Generate nama file unik
                $filename = 'addon_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Pindahkan file ke directory public
                $file->move($directory, $filename);

                $validated['gambar'] = $filename;
            }

            Addons::create($validated);

            return redirect()->route('admin.kelola.addons')->with('success', 'Addon berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan addon: ' . $e->getMessage());
        }
    }

    // Update addon
    public function updateAddon(Request $request, $id)
    {
        $addon = Addons::findOrFail($id);

        $validated = $request->validate([
            'nama_addons' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');

                // Buat directory jika belum ada
                $directory = public_path('images/addons_images');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Hapus gambar lama jika ada
                if ($addon->gambar && file_exists(public_path('images/addons_images/' . $addon->gambar))) {
                    unlink(public_path('images/addons_images/' . $addon->gambar));
                }

                // Generate nama file unik
                $filename = 'addon_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Pindahkan file ke directory public
                $file->move($directory, $filename);

                $validated['gambar'] = $filename;
            } else {
                // Pertahankan gambar lama jika tidak ada upload baru
                $validated['gambar'] = $addon->gambar;
            }

            $addon->update($validated);

            return redirect()->route('admin.kelola.addons')->with('success', 'Addon berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui addon: ' . $e->getMessage());
        }
    }

    // Hapus addon (soft delete)
    public function hapusAddon($id)
    {
        $addon = Addons::findOrFail($id);

        // Hapus gambar fisik jika ada
        if ($addon->gambar && file_exists(public_path('images/addons_images/' . $addon->gambar))) {
            unlink(public_path('images/addons_images/' . $addon->gambar));
        }

        $addon->delete();

        return redirect()->route('admin.kelola.addons')->with('success', 'Addon berhasil dihapus!');
    }

    // Get data addon untuk edit
    public function getAddon($id)
    {
        $addon = Addons::findOrFail($id);
        return response()->json($addon);
    }

    // Method untuk kelola pesanan
    public function kelolaPesanan()
    {
        $pesanan = Pesanan::with('detailPesanan')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.kelola-pesanan', compact('pesanan'));
    }

    // Get detail pesanan untuk modal
    public function getDetailPesanan($id)
    {
        $pesanan = Pesanan::with('detailPesanan')
            ->where('id_pesanan', $id)
            ->firstOrFail();

        return response()->json($pesanan);
    }

    // Update status pesanan
    public function updateStatusPesanan(Request $request, $id)
    {
        $pesanan = Pesanan::where('id_pesanan', $id)->firstOrFail();

        $validated = $request->validate([
            'status' => 'required|in:menunggu_konfirmasi,dikonfirmasi,dibatalkan,selesai'
        ]);

        $oldStatus = $pesanan->status;
        $pesanan->update($validated);

        // Kirim notifikasi WhatsApp jika status berubah menjadi dikonfirmasi
        if ($validated['status'] == 'dikonfirmasi' && $oldStatus != 'dikonfirmasi') {
            $this->sendKonfirmasiWhatsApp($pesanan);
        }

        return redirect()->route('admin.kelola.pesanan')->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // Kirim notifikasi konfirmasi via WhatsApp
    private function sendKonfirmasiWhatsApp($pesanan)
    {
        try {
            $apiToken = env('FONNTE_API_TOKEN');

            if (!$apiToken || $apiToken === 'your_fonnte_api_token_here') {
                Log::error('Fonnte API token tidak dikonfigurasi');
                return;
            }

            $phone = $this->formatPhoneNumber($pesanan->no_wa);
            $message = $this->formatKonfirmasiMessage($pesanan);

            $response = Http::withHeaders([
                'Authorization' => $apiToken
            ])->asForm()->post('https://api.fonnte.com/send', [
                'target' => $phone,
                'message' => $message,
                'delay' => '2',
                'countryCode' => '62',
            ]);

            Log::info('WhatsApp Konfirmasi Response: ', [
                'status' => $response->status(),
                'body' => $response->body(),
                'pesanan_id' => $pesanan->id_pesanan
            ]);
        } catch (\Exception $e) {
            Log::error('Error sending konfirmasi WhatsApp: ' . $e->getMessage());
        }
    }

    // Format pesan konfirmasi
    private function formatKonfirmasiMessage($pesanan)
    {
        Carbon::setLocale('id');
        $tanggalBooking = Carbon::parse($pesanan->tanggal_booking)->translatedFormat('l, d F Y');

        $message = "Halo *{$pesanan->nama_pemesan}*,\n\n"
            . "Pesanan Anda di *ATAP CIATER* telah *DIKONFIRMASI*! 🎉\n\n"
            . "*DETAIL KONFIRMASI:*\n"
            . "📋 ID Pesanan: *{$pesanan->id_pesanan}*\n"
            . "📅 Tanggal Booking: *{$tanggalBooking}*\n"
            . "📦 Paket: *{$pesanan->nama_paket}*\n"
            . "💰 Total: Rp " . number_format($pesanan->total, 0, ',', '.') . "\n\n"
            . "Pesanan Anda sudah aktif dan siap untuk digunakan pada tanggal yang telah ditentukan.\n\n"
            . "Terima kasih telah memilih Atap Ciater! 🙏\n\n"
            . "Untuk informasi lebih lanjut:\n"
            . "📞 Customer Service: 0812-3456-7890\n"
            . "📍 Lokasi: Atap Ciater, Subang";

        return $message;
    }

    // Format nomor telepon
    private function formatPhoneNumber($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        } elseif (substr($phone, 0, 2) !== '62') {
            $phone = '62' . $phone;
        }

        return $phone;
    }


    // Method untuk kelola slot
    public function kelolaSlot(Request $request)
    {
        $query = Slot::with('paket');

        // Filter berdasarkan paket
        if ($request->has('filter_paket') && $request->filter_paket != '') {
            $query->where('id_paket', $request->filter_paket);
        }

        // Filter berdasarkan tanggal
        if ($request->has('filter_tanggal') && $request->filter_tanggal != '') {
            $query->where('tanggal', $request->filter_tanggal);
        }

        $slots = $query->orderBy('tanggal', 'desc')->get();
        $pakets = DaftarPaket::all();

        return view('admin.kelola-slot', compact('slots', 'pakets'));
    }

    // Simpan slot baru
    public function simpanSlot(Request $request)
    {
        $validated = $request->validate([
            'id_paket' => 'required|exists:daftar_paket,id_paket',
            'tanggal' => 'required|date|after_or_equal:today',
            'slot_tersedia' => 'required|integer|min:0'
        ]);

        try {
            // Cek apakah sudah ada slot untuk paket dan tanggal yang sama
            $existingSlot = Slot::where('id_paket', $validated['id_paket'])
                ->where('tanggal', $validated['tanggal'])
                ->first();

            if ($existingSlot) {
                return redirect()->back()->with('error', 'Slot untuk paket dan tanggal ini sudah ada!');
            }

            Slot::create($validated);

            return redirect()->route('admin.kelola.slot')->with('success', 'Slot berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan slot: ' . $e->getMessage());
        }
    }

    // Update slot
    public function updateSlot(Request $request, $id)
    {
        $slot = Slot::findOrFail($id);

        $validated = $request->validate([
            'id_paket' => 'required|exists:daftar_paket,id_paket',
            'tanggal' => 'required|date|after_or_equal:today',
            'slot_tersedia' => 'required|integer|min:0'
        ]);

        try {
            // Cek apakah sudah ada slot untuk paket dan tanggal yang sama (kecuali slot ini)
            $existingSlot = Slot::where('id_paket', $validated['id_paket'])
                ->where('tanggal', $validated['tanggal'])
                ->where('id_slot', '!=', $id)
                ->first();

            if ($existingSlot) {
                return redirect()->back()->with('error', 'Slot untuk paket dan tanggal ini sudah ada!');
            }

            $slot->update($validated);

            return redirect()->route('admin.kelola.slot')->with('success', 'Slot berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui slot: ' . $e->getMessage());
        }
    }

    // Hapus slot
    public function hapusSlot($id)
    {
        try {
            $slot = Slot::findOrFail($id);

            // Cek apakah slot terkait dengan pesanan yang aktif
            $relatedPesanan = Pesanan::where('id_paket', $slot->id_paket)
                ->where('tanggal_booking', $slot->tanggal)
                ->whereIn('status', ['menunggu_konfirmasi', 'dikonfirmasi'])
                ->exists();

            if ($relatedPesanan) {
                return redirect()->back()->with('error', 'Tidak dapat menghapus slot karena terdapat pesanan aktif!');
            }

            $slot->delete();

            return redirect()->route('admin.kelola.slot')->with('success', 'Slot berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus slot: ' . $e->getMessage());
        }
    }

    // Get data slot untuk edit
    public function getSlot($id)
    {
        $slot = Slot::findOrFail($id);
        return response()->json($slot);
    }
}
