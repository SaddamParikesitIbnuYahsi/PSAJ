<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'manifest_details'; // Nama tabel baru di database

    protected $fillable = ['product_id', 'name', 'value'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}