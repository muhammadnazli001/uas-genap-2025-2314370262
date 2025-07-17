<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'name', 'description', 'price',
        'kategoris_id', 'is_publish', 'published_at', 'foto','size'
    ];
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategoris_id');
    }
}
