<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga_per_hari',
        'gambar',
    ];

    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class);
    }
}
