<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'role_id', 'name', 'email', 'password', 'phone', 'status'
    ];

    protected $hidden = ['password'];

    public function role()
    {
        return $this->belongsTo(Role::class);
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
