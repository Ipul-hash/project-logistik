<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'amount', 'payment_date', 'verified_by'];

    public function sale() { return $this->belongsTo(Sale::class); }
    public function verifier() { return $this->belongsTo(User::class, 'verified_by'); }
}
