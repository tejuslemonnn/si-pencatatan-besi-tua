<?php

namespace App\Models;

use App\Models\Kendaraan;
use App\Models\Perusahaan;
use App\Models\SuratJalan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangKeluarBesiTua extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function suratJalan()
    {
        return $this->belongsTo(SuratJalan::class);
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
