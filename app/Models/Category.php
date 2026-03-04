<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'programs'; // Nama tabel baru di database

    protected $fillable = ['name', 'description', 'departure_date', 'return_date']; // Pastikan field tanggal masuk di sini

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}