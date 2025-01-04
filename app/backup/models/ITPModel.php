<?php

namespace App\Models;

use App\Models\ITRModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ITPModel extends Model
{
    use HasFactory;
    protected $table = 'itp';
    protected $primaryKey = 'id';
    protected $fillable = [
        'itr_id',
        'product',
        'product_name',
        'qty',
        'description',
        'current_qty',
        'return_qty',
    ];

    public function ITR()
    {
        return $this->belongsTo(ITRModel::class, 'id', 'itr_id');
    }

}
