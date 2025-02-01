<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukBesiScrap extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function produk()
    // {
    //     return $this->belongsTo(Produk::class);
    // }

    public function dataKapal()
    {
        return $this->belongsTo(DataKapal::class);
    }
}
