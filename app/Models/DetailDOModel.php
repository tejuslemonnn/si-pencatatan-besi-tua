<?php

namespace App\Models;

use App\Models\DOModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDOModel extends Model
{
    use HasFactory;
    protected $table = 'detail_do';
    protected $primaryKey = 'id';
    protected $fillable = [
        'do_id',
        'product',
        'product_name',
        'qty',
        'description',

    ];

    public function DO()
    {
        return $this->belongsTo(DOModel::class, 'id', 'do_id');
    }
}
