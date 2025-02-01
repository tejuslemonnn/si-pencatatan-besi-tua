<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\MaterialModel;
use App\Models\StockCountModel;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        // 'email',
        'password',
        'role',
    ];

    public function isAdminGudang()
    {
        return $this->role === 'admin_gudang';
    }

    public function isAdminPengajuan()
    {
        return $this->role === 'admin_pengajuan';
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function ITR()
    {
        return $this->hasMany(ITRModel::class, 'id', 'source');
    }

    public function materials()
    {
        return $this->hasMany(MaterialModel::class, 'id', 'source');
    }

    public function stockCounts()
    {
        return $this->hasMany(StockCountModel::class, 'id', 'source');
    }
}
