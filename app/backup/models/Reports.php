<?php

namespace App\Models;

use App\Models\User;
use App\Models\ITRModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reports extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function itr()
    {
        return $this->belongsTo(ITRModel::class, 'warehouse_id', 'id');
    }

    public function warehouse()
    {
        return $this->belongsTo(User::class, 'warehouse_id', 'id');
    }

    public function fromWarehouse()
    {
        return $this->belongsTo(User::class, 'from_warehouse_id', 'id');
    }

}
