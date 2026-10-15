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
        Schema::table('2024', function (Blueprint $table) {
            $table->string('keperluan')->nullable()->after('alamat');
            $table->string('foto_ktp')->nullable()->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('2024', function (Blueprint $table) {
            $table->dropColumn(['keperluan', 'foto_ktp']);
        });
    }
};
