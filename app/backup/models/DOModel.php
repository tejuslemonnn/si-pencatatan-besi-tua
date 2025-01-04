<?php

namespace App\Models;

use App\Models\DetailDOModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DOModel extends Model
{
    use HasFactory;
    protected $table = 'do';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function DetailDO()
    {
        return $this->hasMany(DetailDOModel::class, 'do_id', 'id');
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
