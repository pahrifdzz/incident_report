<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * Clean Architecture: Add status_kejadian untuk kategorisasi kejadian
     */
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            // Tambahkan kolom status_kejadian untuk kategorisasi kejadian
            $table->enum('status_kejadian', ['hampir_celaka', 'kecelakaan'])->default('hampir_celaka')->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     * Clean Architecture: Remove status_kejadian column
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            // Hapus kolom status_kejadian jika rollback
            $table->dropColumn('status_kejadian');
        });
    }
};
