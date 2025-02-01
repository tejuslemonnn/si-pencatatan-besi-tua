<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukBesiTua extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk_besi_tuas';

    protected $guarded = [];

    // public function produk()
    // {
    //     return $this->belongsTo(Produk::class);
    // }
}
