<?php

namespace App\Models;

use App\Models\ProductModel;
use App\Models\StockCountModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailStockCountModel extends Model
{
    use HasFactory;
    protected $table = 'detailstockcount';
    protected $primaryKey = 'id';
    protected $fillable = [
        'stockcount_id',
        'product',
        'qty',
        'description',
    ];

    public function stockcount()
    {
        return $this->belongsTo(StockCountModel::class, 'id', 'stockcount_id');
    }

    public function productStockCount()
    {
        return $this->belongsTo(ProductModel::class, 'product', 'id');
    }
}
