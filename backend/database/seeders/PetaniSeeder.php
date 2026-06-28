<?php

namespace Database\Seeders;

use App\Models\Petani;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\User;
use Illuminate\Database\Seeder;

class PetaniSeeder extends Seeder
{
    public function run(): void
    {
        $kecNglegok = Kecamatan::where('nama', 'Nglegok')->first();
        $kecPonggok = Kecamatan::where('nama', 'Ponggok')->first();
        $kecUdanawu = Kecamatan::where('nama', 'Udanawu')->first();

        $desaNglegokSatu = Desa::where('nama', 'Nglegok Satu')->first();
        $desaPonggokSatu = Desa::where('nama', 'Ponggok Satu')->first();
        $desaUdanawuSatu = Desa::where('nama', 'Udanawu Satu')->first();

        $petugas1 = User::where('email', 'petugas@petugas.com')->first();
        $petugas2 = User::where('email', 'petugas2@petugas2.com')->first();

        $petani = [
            ['nama_petani' => 'Budi Santoso', 'nik' => '3501020304050001', 'alamat' => 'Dusun Krajan', 'kecamatan_id' => $kecNglegok->id, 'desa_id' => $desaNglegokSatu->id, 'no_hp' => '081234567890', 'petugas_id' => $petugas1->id],
            ['nama_petani' => 'Siti Maryam', 'nik' => '3501020304050002', 'alamat' => 'Dusun Tengah', 'kecamatan_id' => $kecNglegok->id, 'desa_id' => $desaNglegokSatu->id, 'no_hp' => '081234567891', 'petugas_id' => $petugas1->id],
            ['nama_petani' => 'Haji Maman', 'nik' => '3501020304050003', 'alamat' => 'Dusun Wetan', 'kecamatan_id' => $kecPonggok->id, 'desa_id' => $desaPonggokSatu->id, 'no_hp' => '081234567892', 'petugas_id' => $petugas1->id],
            ['nama_petani' => 'Tarjo Kusumo', 'nik' => '3501020304050004', 'alamat' => 'Dusun Kidul', 'kecamatan_id' => $kecUdanawu->id, 'desa_id' => $desaUdanawuSatu->id, 'no_hp' => '081234567893', 'petugas_id' => $petugas1->id],
            ['nama_petani' => 'Ahmad Ridwan', 'nik' => '3501020304050005', 'alamat' => 'Dusun Lor', 'kecamatan_id' => $kecPonggok->id, 'desa_id' => $desaPonggokSatu->id, 'no_hp' => '081234567894', 'petugas_id' => $petugas2->id],
            ['nama_petani' => 'Dewi Sartika', 'nik' => '3501020304050006', 'alamat' => 'Dusun Mukti', 'kecamatan_id' => $kecUdanawu->id, 'desa_id' => $desaUdanawuSatu->id, 'no_hp' => '081234567895', 'petugas_id' => $petugas2->id],
            ['nama_petani' => 'Supriyono', 'nik' => '3501020304050007', 'alamat' => 'Dusun Makmur', 'kecamatan_id' => $kecNglegok->id, 'desa_id' => $desaNglegokSatu->id, 'no_hp' => '081234567896', 'petugas_id' => $petugas2->id],
            ['nama_petani' => 'Kartini', 'nik' => '3501020304050008', 'alamat' => 'Dusun Asri', 'kecamatan_id' => $kecPonggok->id, 'desa_id' => $desaPonggokSatu->id, 'no_hp' => '081234567897', 'petugas_id' => $petugas2->id],
        ];

        foreach ($petani as $data) {
            Petani::create($data);
        }
    }
}
