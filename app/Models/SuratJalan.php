<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function generateNoSuratJalan()
    {
        $prefix = "SJ";
        $date = now()->format('dmY');
        $lastNumber = self::whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->value('no_surat_jalan');

        $increment = $lastNumber ? (int)substr($lastNumber, -3) + 1 : 1;
        return sprintf('%s-%s-%03d', $prefix, $date, $increment);
    }

    public function barangKeluarBesiTua()
    {
        return $this->hasOne(BarangKeluarBesiTua::class);
    }

    public function barangKeluarBesiScrap()
    {
        return $this->hasOne(BarangKeluarBesiScrap::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
    // perusahaann
    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }
}
