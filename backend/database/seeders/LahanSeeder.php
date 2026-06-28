<?php

namespace Database\Seeders;

use App\Models\Lahan;
use App\Models\Petani;
use Illuminate\Database\Seeder;

class LahanSeeder extends Seeder
{
    public function run(): void
    {
        $petaniMap = Petani::pluck('petugas_id', 'id');

        $lahan = [
            ['petani_id' => 1, 'nama_lahan' => 'Blok A1 - Sawah Irigasi', 'komoditas' => 'padi', 'luas_lahan' => 2.5, 'latitude' => -7.56840000, 'longitude' => 112.75890000, 'tanggal_tanam' => '2024-10-01', 'status_fase' => 'tanam'],
            ['petani_id' => 2, 'nama_lahan' => 'Blok B2 - Tani Jaya', 'komoditas' => 'jagung', 'luas_lahan' => 1.8, 'latitude' => -7.57210000, 'longitude' => 112.76230000, 'tanggal_tanam' => '2024-09-15', 'status_fase' => 'pemeliharaan'],
            ['petani_id' => 3, 'nama_lahan' => 'Blok C3 - Sumber Air', 'komoditas' => 'padi', 'luas_lahan' => 4.0, 'latitude' => -7.56020000, 'longitude' => 112.75010000, 'tanggal_tanam' => null, 'status_fase' => 'persiapan'],
            ['petani_id' => 5, 'nama_lahan' => 'Blok D4 - Lembah Hijau', 'komoditas' => 'hortikultura', 'luas_lahan' => 3.2, 'latitude' => -7.57580000, 'longitude' => 112.77120000, 'tanggal_tanam' => '2024-08-01', 'status_fase' => 'panen'],
            ['petani_id' => 6, 'nama_lahan' => 'Blok E5 - Bukit Sari', 'komoditas' => 'padi', 'luas_lahan' => 5.5, 'latitude' => -7.56550000, 'longitude' => 112.74560000, 'tanggal_tanam' => '2024-10-10', 'status_fase' => 'tanam'],
            ['petani_id' => 7, 'nama_lahan' => 'Blok F6 - Sawah Baru', 'komoditas' => 'jagung', 'luas_lahan' => 2.0, 'latitude' => -7.57000000, 'longitude' => 112.75550000, 'tanggal_tanam' => '2024-09-20', 'status_fase' => 'pemeliharaan'],
            ['petani_id' => 1, 'nama_lahan' => 'Blok G7 - Kebun Organik', 'komoditas' => 'hortikultura', 'luas_lahan' => 1.5, 'latitude' => -7.57320000, 'longitude' => 112.76080000, 'tanggal_tanam' => '2024-07-15', 'status_fase' => 'panen'],
            ['petani_id' => 3, 'nama_lahan' => 'Blok H8 - Ladang Barat', 'komoditas' => 'padi', 'luas_lahan' => 3.0, 'latitude' => -7.56180000, 'longitude' => 112.74890000, 'tanggal_tanam' => null, 'status_fase' => 'persiapan'],
        ];

        foreach ($lahan as $data) {
            $data['petugas_id'] = $petaniMap[$data['petani_id']] ?? null;
            Lahan::create($data);
        }
    }
}
