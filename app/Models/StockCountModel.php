<?php

namespace App\Models;

use App\Models\DetailStockCountModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockCountModel extends Model
{
    use HasFactory;
    protected $table = 'stockcount';
    protected $primaryKey = 'id';
    protected $guarded = [];
    // protected $fillable = [
    //     'user_id',
    //     'inventory',
    //     'warehouse',
    //     // 'destination',
    //     'schedule',
    //     'expired',
    //     'status',
    // ];

    public function detailstockcount()
    {
        return $this->hasMany(DetailStockCountModel::class, 'stockcount_id', 'id');
    }

    public function stockWarehouse()
    {
        return $this->belongsTo(User::class, 'warehouse', 'id');
    }
}
