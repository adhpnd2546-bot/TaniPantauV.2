<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kecamatan', function (Blueprint $table) {
            $table->dropForeign(['kabupaten_id']);
        });

        Schema::rename('kabupaten', 'kota');

        Schema::table('kecamatan', function (Blueprint $table) {
            $table->renameColumn('kabupaten_id', 'kota_id');
            $table->foreign('kota_id')->references('id')->on('kota')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('kecamatan', function (Blueprint $table) {
            $table->dropForeign(['kota_id']);
        });

        Schema::rename('kota', 'kabupaten');

        Schema::table('kecamatan', function (Blueprint $table) {
            $table->renameColumn('kota_id', 'kabupaten_id');
            $table->foreign('kabupaten_id')->references('id')->on('kabupaten')->onDelete('set null');
        });
    }
};
