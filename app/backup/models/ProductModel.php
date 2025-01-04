<?php

namespace App\Models;

use App\Models\DetailStockCountModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductModel extends Model
{
    use HasFactory;
    
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
            "user_id",
            "name",
            "code",
            "image",
            "price",
            "qty",
            "description",
    ];

    public function detailStockCount()
    {
        return $this->hasMany(DetailStockCountModel::class, 'id', 'product');
    }
}
