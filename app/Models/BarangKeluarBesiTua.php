<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
