<?php

namespace App\Models;

use App\Models\Produk;
use App\Models\DataKapal;
use App\Models\Perusahaan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangMasukBesiTua extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk_besi_tuas';

    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function dataKapal()
    {
        return $this->belongsTo(DataKapal::class);
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }
}
