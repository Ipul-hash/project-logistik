<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'role_id', 'name', 'email', 'password', 'phone', 'status'
    ];

    protected $hidden = ['password'];

    protected $guard_name = 'web'; // penting buat Spatie

    public function role()
    {
        return $this->belongsTo(CustomRole::class, 'role_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'cashier_id');
    }

    public function cashFlows()
    {
        return $this->hasMany(CashFlow::class, 'created_by');
    }

    public function logs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}
