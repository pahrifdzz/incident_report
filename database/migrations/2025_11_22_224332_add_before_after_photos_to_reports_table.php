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
        Schema::table('reports', function (Blueprint $table) {
            $table->string('foto_sebelum')->nullable()->after('foto');
            $table->string('foto_sesudah')->nullable()->after('foto_sebelum');
            $table->string('cloudinary_public_id_sebelum')->nullable()->after('cloudinary_public_id');
            $table->string('cloudinary_public_id_sesudah')->nullable()->after('cloudinary_public_id_sebelum');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn(['foto_sebelum', 'foto_sesudah', 'cloudinary_public_id_sebelum', 'cloudinary_public_id_sesudah']);
        });
    }
};
