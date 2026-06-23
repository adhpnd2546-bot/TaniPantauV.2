<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('kota')->where('nama', 'Malang')->update(['nama' => 'Kabupaten Malang']);

        $provinsiId = DB::table('provinsi')->where('nama', 'Jawa Timur')->value('id');

        $kotaMalangId = DB::table('kota')->insertGetId([
            'provinsi_id' => $provinsiId,
            'nama' => 'Kota Malang',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kecamatanList = ['Kedungkandang', 'Sukun', 'Klojen', 'Blimbing', 'Lowokwaru'];

        foreach ($kecamatanList as $kecNama) {
            $kecId = DB::table('kecamatan')->insertGetId([
                'nama' => $kecNama,
                'provinsi_id' => $provinsiId,
                'kota_id' => $kotaMalangId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('desa')->insert([
                ['kecamatan_id' => $kecId, 'nama' => $kecNama . ' Satu', 'created_at' => now(), 'updated_at' => now()],
                ['kecamatan_id' => $kecId, 'nama' => $kecNama . ' Dua', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }

    public function down(): void
    {
        $kotaMalang = DB::table('kota')->where('nama', 'Kota Malang')->first();
        if ($kotaMalang) {
            $kecIds = DB::table('kecamatan')->where('kota_id', $kotaMalang->id)->pluck('id');
            DB::table('desa')->whereIn('kecamatan_id', $kecIds)->delete();
            DB::table('kecamatan')->where('kota_id', $kotaMalang->id)->delete();
            DB::table('kota')->where('id', $kotaMalang->id)->delete();
        }

        DB::table('kota')->where('nama', 'Kabupaten Malang')->update(['nama' => 'Malang']);
    }
};
