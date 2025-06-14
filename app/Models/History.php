<?php

namespace App\Models;

use App\Models\User;
use App\Models\BarangKeluarBesiScrap;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class History extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function barangKeluarBesiTua()
    {
        return $this->belongsTo(BarangKeluarBesiTua::class, 'barang_keluar_besi_tuas');
    }

    public function barangKeluarBesiScrap()
    {
        return $this->belongsTo(BarangKeluarBesiScrap::class, 'barang_keluar_besi_scraps');
    }
}
