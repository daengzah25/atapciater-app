<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPaket extends Model
{
    use HasFactory;

    protected $table = 'daftar_paket';
    protected $primaryKey = 'id_paket';
    protected $fillable = ['nama_paket', 'slot', 'deskripsi', 'fasilitas', 'harga', 'gambar'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    /**
     * Relationship with slots
     */
    public function slots()
    {
        return $this->hasMany(Slot::class, 'id_paket', 'id_paket');
    }
}
