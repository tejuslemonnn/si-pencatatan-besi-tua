<?php

namespace App\Observers;

use App\Models\BarangMasukBesiTua;

class BarangMasukBesiTuaObserver
{
    public function updated(BarangMasukBesiTua $barangMasukBesiTua)
    {
        if ($barangMasukBesiTua->wasChanged('jumlah')) {
            $newJumlah = $barangMasukBesiTua->jumlah;

            $nextDatas = BarangMasukBesiTua::where('id', '>', $barangMasukBesiTua->id)->orderBy('id', 'asc')->get();

            $currentJumlah = $newJumlah;

            foreach ($nextDatas as $nextData) {
                $currentJumlah += $nextData->netto;
                $nextData->updateQuietly(['jumlah' => $currentJumlah]);
            }
        }
    }
}
