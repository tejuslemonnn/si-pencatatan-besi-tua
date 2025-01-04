<?php

namespace App\Models;

use App\Models\ITPModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ITRModel extends Model
{
    use HasFactory;
    protected $table = 'itr';
    protected $primaryKey = 'id';
    protected $guarded = [];
    // protected $fillable = [
    //     'user_id',
    //     'request',
    //     'source',
    //     'destination',
    //     'schedule',
    //     'expired',
    //     'status',
    // ];

    public function ITP()
    {
        return $this->hasMany(ITPModel::class, 'itr_id', 'id');
    }

    public function requestItr()
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
