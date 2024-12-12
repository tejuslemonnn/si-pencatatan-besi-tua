<?php

namespace App\Models;

use App\Models\DetailMaterialModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialModel extends Model
{
    use HasFactory;

    protected $table = 'materialreqs';
    protected $primaryKey = 'id';
    protected $guarded = [];
    
    // protected $fillable = [
    //     'user_id',
    //     'request',
    //     'destination',
    //     'product',
    //     'qty',
    //     'schedule',
    //     'expired',
    //     'description',
    //     'status'
    // ];

    public function detailMaterial()
    {
        return $this->hasMany(DetailMaterialModel::class, 'material_id', 'id');
    }

    public function requestMaterial()
    {
        return $this->belongsTo(User::class, 'request', 'id');
    }

    public function sourceWarehouse()
    {
        return $this->belongsTo(User::class, 'source', 'id');
    }

    public function destinationWarehouse()
    {
        return $this->belongsTo(User::class, 'destination', 'id');
    }
}
