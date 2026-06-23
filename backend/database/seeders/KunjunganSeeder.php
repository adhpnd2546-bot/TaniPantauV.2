<?php

namespace Database\Seeders;

use App\Models\KunjunganLahan;
use App\Models\User;
use Illuminate\Database\Seeder;

class KunjunganSeeder extends Seeder
{
    public function run(): void
    {
        $petugas = User::where('role', 'petugas')->first();
        if (!$petugas) return;

        $kunjungan = [
            ['lahan_id' => 1, 'petugas_id' => $petugas->id, 'tanggal_kunjungan' => '2024-10-27', 'kondisi_lahan' => 'baik', 'catatan_lapangan' => 'Pertumbuhan bibit baik, air irigasi cukup. Tidak ditemukan hama.', 'status_tindak_lanjut' => 'aman'],
            ['lahan_id' => 2, 'petugas_id' => $petugas->id, 'tanggal_kunjungan' => '2024-10-26', 'kondisi_lahan' => 'cukup', 'catatan_lapangan' => 'Ditemukan indikasi awal hama wereng di petak timur.', 'status_tindak_lanjut' => 'perlu_pemantauan'],
            ['lahan_id' => 1, 'petugas_id' => $petugas->id, 'tanggal_kunjungan' => '2024-10-12', 'kondisi_lahan' => 'baik', 'catatan_lapangan' => 'Proses penanaman bibit selesai, kondisi lahan siap.', 'status_tindak_lanjut' => 'aman'],
            ['lahan_id' => 4, 'petugas_id' => $petugas->id, 'tanggal_kunjungan' => '2024-10-25', 'kondisi_lahan' => 'baik', 'catatan_lapangan' => 'Sayuran tumbuh subur, penyiraman rutin dilakukan.', 'status_tindak_lanjut' => 'aman'],
            ['lahan_id' => 5, 'petugas_id' => $petugas->id, 'tanggal_kunjungan' => '2024-10-28', 'kondisi_lahan' => 'cukup', 'catatan_lapangan' => 'Beberapa area membutuhkan pemupukan tambahan.', 'status_tindak_lanjut' => 'perlu_pemantauan'],
            ['lahan_id' => 6, 'petugas_id' => $petugas->id, 'tanggal_kunjungan' => '2024-10-20', 'kondisi_lahan' => 'buruk', 'catatan_lapangan' => 'Serangan hama ulat cukup parah, perlu tindakan pengendalian segera.', 'status_tindak_lanjut' => 'perlu_tindakan'],
            ['lahan_id' => 3, 'petugas_id' => $petugas->id, 'tanggal_kunjungan' => '2024-10-30', 'kondisi_lahan' => 'baik', 'catatan_lapangan' => 'Lahan siap untuk masa tanam, pengairan sudah berfungsi.', 'status_tindak_lanjut' => 'aman'],
        ];

        foreach ($kunjungan as $data) {
            KunjunganLahan::create($data);
        }
    }
}
