<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\Provinsi;
use App\Models\Kota;
use Illuminate\Database\Seeder;

class WilayahSeeder extends Seeder
{
    public function run(): void
    {
        $provinsi = Provinsi::create(['nama' => 'Jawa Timur']);

        $kabupatenData = [
            'Blitar' => [
                'Nglegok', 'Ponggok', 'Udanawu', 'Garum', 'Kademangan', 'Kanigoro', 'Wlingi',
                'Selopuro', 'Srengat', 'Bakung', 'Binangun', 'Doko', 'Gandusari', 'Kesamben',
                'Panggungrejo', 'Sanan Kulon', 'Selorejo', 'Sutojayan', 'Talun', 'Wates',
                'Wonodadi', 'Wonotirto',
            ],
            'Kabupaten Malang' => [
                'Ampelgading', 'Tirtoyudo', 'Singosari', 'Lawang', 'Pakis', 'Bantur',
                'Bululawang', 'Dampit', 'Dau', 'Donomulyo', 'Gedangan', 'Gondanglegi',
                'Jabung', 'Kalipare', 'Karangploso', 'Kasembon', 'Kepanjen', 'Kromengan',
                'Ngajum', 'Ngantang', 'Pagak', 'Pagelaran', 'Pakisaji', 'Poncokusumo',
                'Pujon', 'Sumbermanjing Wetan', 'Sumberpucung', 'Tajinan', 'Tumpang',
                'Turen', 'Wagir', 'Wajak', 'Wonosari',
            ],
            'Kota Malang' => [
                'Kedungkandang', 'Sukun', 'Klojen', 'Blimbing', 'Lowokwaru',
            ],
            'Kediri' => [
                'Pare', 'Kandat', 'Plemahan', 'Kras', 'Badas', 'Banyakan', 'Gampengrejo',
                'Grogol', 'Gurah', 'Kandangan', 'Kayen Kidul', 'Kepung', 'Kunjang',
                'Mojo', 'Ngadiluwih', 'Ngancar', 'Pagu', 'Papar', 'Plosoklaten',
                'Puncu', 'Purwoasri', 'Ringinrejo', 'Semen', 'Tarokan', 'Wates',
            ],
        ];

        foreach ($kabupatenData as $kabNama => $kecamatanList) {
            $kab = Kota::create(['provinsi_id' => $provinsi->id, 'nama' => $kabNama]);
            foreach ($kecamatanList as $kecNama) {
                $kec = Kecamatan::create(['nama' => $kecNama, 'provinsi_id' => $provinsi->id, 'kota_id' => $kab->id]);
                Desa::create(['kecamatan_id' => $kec->id, 'nama' => $kecNama . ' Satu']);
                Desa::create(['kecamatan_id' => $kec->id, 'nama' => $kecNama . ' Dua']);
            }
        }
    }
}
