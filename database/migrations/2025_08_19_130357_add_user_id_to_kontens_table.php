<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::table('kontens', function (Blueprint $table) {
            // Pastikan kolom user_id belum ada
            if (!Schema::hasColumn('kontens', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('kategori_id');

                // Tambahkan foreign key
                $table->foreign('user_id')
                      ->references('id')->on('users')
                      ->onDelete('cascade');
            }
        });
    }

    /**
     * Rollback migration.
     */
    public function down(): void
    {
        Schema::table('kontens', function (Blueprint $table) {
            if (Schema::hasColumn('kontens', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
