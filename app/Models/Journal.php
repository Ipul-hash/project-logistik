<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'cash_flow_id',
        'transaction_ref',
        'account_id',
        'debit',
        'credit',
        'description',
        'created_at'
    ];

    public function cashflow()
    {
        return $this->belongsTo(CashFlow::class, 'cash_flow_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
