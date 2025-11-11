<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnTransaction extends Model
{
    use HasFactory;

    protected $table = 'returns';

    protected $fillable = ['sale_id', 'reason', 'return_date', 'approved_by'];

    public function sale() { return $this->belongsTo(Sale::class); }
    public function items() { return $this->hasMany(ReturnItem::class, 'return_id'); }
    public function approver() { return $this->belongsTo(User::class, 'approved_by'); }
}
