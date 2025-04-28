<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_penyewa',
        'peralatan_id',
        'tanggal_sewa',
        'lama_hari',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function peralatan()
    {
        return $this->belongsTo(Peralatan::class);
    }
}
