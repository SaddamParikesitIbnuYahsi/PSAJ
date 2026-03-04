<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke Program Paket (Kategori)
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            
            // Relasi ke Agen / Mitra Cabang (Supplier)
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');
            
            // Nama Lengkap Jamaah
            $table->string('name');
            
            // ID Registrasi / Nomor Paspor (SKU)
            $table->string('sku')->unique();
            
            // Keterangan / Riwayat Berkas Jamaah
            $table->text('description')->nullable();
            
            // Biaya Pokok Biro / HPP (Purchase Price)
            $table->decimal('purchase_price', 12, 2)->default(0);
            
            // Harga Jual Paket ke Jamaah (Selling Price)
            $table->decimal('selling_price', 12, 2)->default(0);
            
            // Foto Paspor / Identitas
            $table->string('image')->nullable();
            
            // Kuota Seat Tersedia (Current Stock)
            $table->integer('current_stock')->default(0);
            
            // Batas Minimum Seat untuk Peringatan (Min Stock)
            $table->integer('min_stock')->default(0);
            
            // Satuan (Default: pax / orang)
            $table->string('unit')->default('pax');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};