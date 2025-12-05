<?php

namespace App\Http\Controllers;

use App\Models\Addons;
use App\Models\DaftarPaket;
use App\Models\Pesanan;
use App\Models\Libur;
use App\Models\Testimonial;
use App\Services\WhatsAppService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalPaket = DaftarPaket::count();
        $totalAddons = Addons::count();
        $totalPesanan = Pesanan::count();
        $totalSlot = Libur::count();

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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Handle file upload - simpan langsung ke public/images/paket_images
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');

                // Buat directory jika belum ada
                $directory = public_path('images/paket_images');
                if (! file_exists($directory)) {
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');

                // Buat directory jika belum ada
                $directory = public_path('images/paket_images');
                if (! file_exists($directory)) {
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Handle file upload - simpan langsung ke public/images/addons_images
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');

                // Buat directory jika belum ada
                $directory = public_path('images/addons_images');
                if (! file_exists($directory)) {
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
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');

                // Buat directory jika belum ada
                $directory = public_path('images/addons_images');
                if (! file_exists($directory)) {
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
            'status' => 'required|in:menunggu_konfirmasi,dikonfirmasi,dibatalkan,selesai',
        ]);

        $oldStatus = $pesanan->status;
        $pesanan->update($validated);

        // Kirim notifikasi WhatsApp jika status berubah
        $whatsAppService = new WhatsAppService();

        if ($validated['status'] === 'dikonfirmasi' && $oldStatus !== 'dikonfirmasi') {
            $whatsAppService->sendConfirmationNotification($pesanan);
        } elseif ($validated['status'] === 'dibatalkan' && $oldStatus !== 'dibatalkan') {
            $whatsAppService->sendCancellationNotification($pesanan, 'Pesanan dibatalkan oleh admin.');
        }

        return redirect()->route('admin.kelola.pesanan')->with('success', 'Status pesanan berhasil diperbarui!');
    }

    /**
     * Kelola Libur - Menggantikan Kelola Slot
     */
    public function kelolaLibur(Request $request)
    {
        $query = Libur::query();

        // Filter berdasarkan bulan
        if ($request->has('filter_bulan') && $request->filter_bulan != '') {
            $query->whereMonth('tanggal', $request->filter_bulan);
        }

        // Filter berdasarkan tahun
        if ($request->has('filter_tahun') && $request->filter_tahun != '') {
            $query->whereYear('tanggal', $request->filter_tahun);
        }

        $liburs = $query->orderBy('tanggal', 'desc')->get();

        return view('admin.kelola-libur', compact('liburs'));
    }

    public function simpanLibur(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date|unique:libur,tanggal',
            'keterangan' => 'nullable|string|max:255'
        ]);

        Libur::create($validated);
        return redirect()->route('admin.kelola.libur')->with('success', 'Tanggal libur berhasil ditambahkan.');
    }

    public function updateLibur(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date|unique:libur,tanggal,' . $id . ',id_libur',
            'keterangan' => 'nullable|string|max:255'
        ]);

        $libur = Libur::findOrFail($id);
        $libur->update($validated);
        return redirect()->route('admin.kelola.libur')->with('success', 'Tanggal libur berhasil diperbarui.');
    }

    public function hapusLibur($id)
    {
        $libur = Libur::findOrFail($id);
        $libur->delete();
        return redirect()->route('admin.kelola.libur')->with('success', 'Tanggal libur berhasil dihapus.');
    }

    public function getLibur($id)
    {
        $libur = Libur::findOrFail($id);
        return response()->json($libur);
    }

    public function kelolaTestimoni()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')->get();
        return view('admin.kelola-testimoni', compact('testimonials'));
    }

    public function hapusTestimoni($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('admin.kelola.testimoni')
            ->with('success', 'Testimoni berhasil dihapus.');
    }
}
