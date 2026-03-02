<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'supplier_id',
        'name',
        'sku',
        'description',
        'purchase_price',
        'selling_price',
        'image',
        'current_stock', 
        'min_stock',
        'unit',
    ];

    protected $appends = ['formatted_selling_price'];

    // Relationships
    public function category() { return $this->belongsTo(Category::class); }
    public function supplier() { return $this->belongsTo(Supplier::class); }
    public function stockTransactions() { return $this->hasMany(StockTransaction::class); }

    // Formatted Price Accessor
    protected function formattedSellingPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => 'Rp ' . number_format($this->selling_price, 0, ',', '.')
        );
    }

    // Helper untuk update stock manual jika diperlukan
    public function updateStockFromTransactions()
    {
        $this->current_stock = $this->stockTransactions()
            ->selectRaw('SUM(CASE WHEN type = "Masuk" THEN quantity ELSE -quantity END) as stock')
            ->value('stock') ?? 0;
        $this->save();
    }
}