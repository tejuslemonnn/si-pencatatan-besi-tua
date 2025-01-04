<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpiredModel extends Model
{
    use HasFactory;
    protected $table = 'expired';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'type',
        'warehouse',
        'expired',
        'status',
    ];
}
