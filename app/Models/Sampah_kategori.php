<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah_kategori extends Model
{
    use HasFactory;
    protected $table = 'sampah_kategori';
    protected $fillable = [
        'id',
        'nama',
    ];

    public $timestamps = false;
}
