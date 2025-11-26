<?php

namespace App\Http\Controllers;

use App\Models\DaftarPaket;
use App\Models\Pesanan;
use App\Models\Slot;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    // Method untuk kelola slot
    public function index(Request $request)
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_paket' => 'required|exists:daftar_paket,id_paket',
            'tanggal' => 'required|date|after_or_equal:today',
            'slot_tersedia' => 'required|integer|min:0',
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
            return redirect()->back()->with('error', 'Gagal menyimpan slot: '.$e->getMessage());
        }
    }

    // Update slot
    public function update(Request $request, $id)
    {
        $slot = Slot::findOrFail($id);

        $validated = $request->validate([
            'id_paket' => 'required|exists:daftar_paket,id_paket',
            'tanggal' => 'required|date|after_or_equal:today',
            'slot_tersedia' => 'required|integer|min:0',
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
            return redirect()->back()->with('error', 'Gagal memperbarui slot: '.$e->getMessage());
        }
    }

    // Hapus slot
    public function destroy($id)
    {
        $slot = Slot::findOrFail($id);

        // Jika relasi paket ada, cocokan berdasarkan nama_paket + tanggal_booking
        if ($slot->paket) {
            $paketName = $slot->paket->nama_paket;

            $related = Pesanan::where('tanggal_booking', $slot->tanggal)
                ->where('nama_paket', $paketName)
                ->whereIn('status', ['menunggu_konfirmasi', 'dikonfirmasi'])
                ->exists();

            if ($related) {
                return redirect()->back()->with('error', 'Tidak dapat menghapus slot karena terdapat pesanan aktif untuk paket ini pada tanggal tersebut!');
            }
        } else {
            // Paket sudah dihapus -> sesuai permintaan Anda, izinkan hapus tanpa memblokir
            // (CATATAN: ini bisa meninggalkan pesanan dengan nama paket yang sama; inkonsistensi data mungkin terjadi)
        }

        $slot->delete();

        return redirect()->route('admin.kelola.slot')->with('success', 'Slot berhasil dihapus!');
    }

    // Get data slot untuk edit
    public function getSlot($id)
    {
        $slot = Slot::findOrFail($id);

        return response()->json($slot);
    }
}
