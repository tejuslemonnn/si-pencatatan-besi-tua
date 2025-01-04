<?php

namespace App\Models;

use App\Models\MaterialModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailMaterialModel extends Model
{
    use HasFactory;
    protected $table = 'detailmaterials';
    protected $primaryKey = 'id';
    protected $fillable = [
        'material_id',
        'product',
        'qty',     
        'description',
    ];

    public function material()
    {
        return $this->belongsTo(MaterialModel::class, 'id', 'material_id');
    }
}
