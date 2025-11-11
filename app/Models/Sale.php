<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number', 'cashier_id', 'customer_id',
        'total_amount', 'payment_status', 'payment_method'
    ];

    public function cashier() { return $this->belongsTo(User::class, 'cashier_id'); }
    public function customer() { return $this->belongsTo(Customer::class); }
    public function saleItems() { return $this->hasMany(SaleItem::class); }
    public function payments() { return $this->hasMany(Payment::class); }
    public function returns() { return $this->hasMany(ReturnTransaction::class, 'sale_id'); }
}
