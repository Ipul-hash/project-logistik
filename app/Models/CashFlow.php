<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashFlow extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'account_id',
        'reference',
        'amount',
        'description',
        'status',
        'verified_by',
        'verified_at',
        'created_by'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function journals()
    {
        return $this->hasMany(Journal::class, 'cash_flow_id');
    }

   
}
