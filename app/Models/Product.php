<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'supplier_id', 'warehouse_id',
        'code', 'name', 'unit', 'purchase_price', 'selling_price',
        'stock', 'min_stock'
    ];

    public function category() { return $this->belongsTo(Category::class); }
    public function supplier() { return $this->belongsTo(Supplier::class); }
    public function warehouse() { return $this->belongsTo(Warehouse::class); }

    public function saleItems() { return $this->hasMany(SaleItem::class); }
    public function stockMovements() { return $this->hasMany(StockMovement::class); }
}
