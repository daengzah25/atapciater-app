<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $table = 'slot';
    protected $primaryKey = 'id_slot';
    protected $fillable = ['id_paket', 'tanggal', 'slot_tersedia'];

    public function paket()
    {
        return $this->belongsTo(DaftarPaket::class, 'id_paket', 'id_paket');
    }
}
