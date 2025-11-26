<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libur extends Model
{
    use HasFactory;

    protected $table = 'libur';
    protected $primaryKey = 'id_libur';
    protected $fillable = ['tanggal', 'keterangan'];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'tanggal' => 'date',
    ];
}
