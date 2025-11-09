<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    public $incrementing = false; // Karena id_pesanan adalah integer acak
    protected $keyType = 'int';
    protected $fillable = [
        'id_pesanan', 'nama_pemesan', 'tanggal_pesan', 'tanggal_booking', 
        'catatan', 'total', 'no_wa', 'screenshot', 'status', 'metode_bayar', 
        'nama_paket', 'harga_paket'
    ];

    // Relasi ke DetailPesanan
    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan', 'id_pesanan');
    }
}
