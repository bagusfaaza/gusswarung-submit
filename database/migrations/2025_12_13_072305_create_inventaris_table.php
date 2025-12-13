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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nama bahan
            $table->integer('quantity');  // Jumlah stok
            $table->string('unit');  // Satuan
            $table->integer('minimal_stock');  // Minimal stok
            $table->enum('status', ['aman', 'rendah']);  // Status stok: aman atau rendah
            $table->decimal('price', 8, 2);  // Harga bahan, dengan 2 desimal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
