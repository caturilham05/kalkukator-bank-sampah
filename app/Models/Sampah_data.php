<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah_data extends Model
{
    use HasFactory;
    protected $table    = 'sampah_data';
    protected $fillable = [
        'id',
        'sampah_kategori_id',
        'nama',
        'deskripsi',
        'foto',
        'harga',
        'satuan',
    ];

    public $timestamps = false;

}
