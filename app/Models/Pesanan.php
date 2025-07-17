<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'user_id',
        'produk_id',
        'size',
        'kuantitas',
        'nama_penerima',
        'negara',
        'provinsi',
        'kota',
        'nama_jalan',
        'kode_pos',
        'pesan',
        'email',
        'no_hp',
        'pembayaran',
        'status',
        'total_harga',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
