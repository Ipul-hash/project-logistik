<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    use HasFactory;

    protected $fillable = ['return_id', 'product_id', 'quantity', 'amount'];

    public function returnTransaction() { return $this->belongsTo(ReturnTransaction::class, 'return_id'); }
    public function product() { return $this->belongsTo(Product::class); }
}
