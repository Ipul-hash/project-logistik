<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_ref', 'account_id', 'debit', 'credit', 'description'
    ];

    public function account() { return $this->belongsTo(Account::class); }
}
