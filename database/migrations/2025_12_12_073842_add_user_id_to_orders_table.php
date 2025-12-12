<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Menambahkan kolom user_id setelah kolom status (atau di mana saja yang relevan)
            $table->unsignedBigInteger('user_id')->nullable()->after('status');
            // Menambahkan foreign key constraint (opsional, tapi disarankan)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Hapus foreign key dan kolom saat rollback
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
