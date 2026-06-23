<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kecamatan', function (Blueprint $table) {
            $table->foreignId('provinsi_id')->nullable()->constrained('provinsi')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('kecamatan', function (Blueprint $table) {
            $table->dropForeign(['provinsi_id']);
            $table->dropColumn('provinsi_id');
        });
    }
};
