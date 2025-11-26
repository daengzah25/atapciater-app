<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials';
    protected $primaryKey = 'id_testimonial';
    protected $fillable = ['nama', 'asal_kota', 'testimoni', 'rating'];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'rating' => 'integer',
    ];
}
