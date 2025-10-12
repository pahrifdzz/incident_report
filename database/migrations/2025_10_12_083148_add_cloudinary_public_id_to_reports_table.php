<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * Clean Architecture: Add Cloudinary public_id untuk image management
     */
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            // Tambahkan kolom cloudinary_public_id untuk menyimpan public ID dari Cloudinary
            $table->string('cloudinary_public_id')->nullable()->after('foto');
        });
    }

    /**
     * Reverse the migrations.
     * Clean Architecture: Remove Cloudinary public_id column
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            // Hapus kolom cloudinary_public_id jika rollback
            $table->dropColumn('cloudinary_public_id');
        });
    }
};
