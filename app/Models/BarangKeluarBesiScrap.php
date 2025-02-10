<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarBesiScrap extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function suratJalan()
    {
        return $this->belongsTo(SuratJalan::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    // perusahaan
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    // dataKapal
    public function dataKapal()
    {
        return $this->belongsTo(DataKapal::class);
    }
}
