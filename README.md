# TaniPantau

## Deskripsi Singkat
Aplikasi monitoring lahan pertanian dan kunjungan petugas lapangan. Sistem digunakan untuk mencatat data petani, lahan, titik lokasi, luas area, status fase tanam, dan kunjungan petugas lapang. Membantu pemantauan perkembangan lahan dari masa persiapan tanam sampai panen.

## Anggota Kelompok
1. Nama - NIM - Peran
2. Nama - NIM - Peran
3. Nama - NIM - Peran
4. Nama - NIM - Peran

## Fitur Aplikasi
- Login admin/petugas/manajer
- Dashboard statistik (total petani, lahan, kunjungan, lahan perlu tindakan)
- CRUD petani (nama, NIK, alamat, provinsi, kecamatan, desa, no HP)
- CRUD lahan (komoditas, luas, titik koordinat via peta, tanggal tanam, status fase)
- Input kunjungan lahan (kondisi, catatan, foto, status tindak lanjut)
- Update status fase lahan otomatis
- Filter lahan berdasarkan komoditas, status fase, kecamatan, petugas
- CRUD petugas lapangan
- API data lahan dan kunjungan
- Frontend publik (daftar lahan, detail + peta, riwayat kunjungan, pencarian)
- Validasi input, proteksi halaman admin, password ter-hash
- Data dummy/simulasi (NIK dan nomor HP bukan data asli)

## Teknologi
- Backend: Laravel 12, MySQL, REST API, Sanctum Auth
- Frontend: PHP Native, HTML/CSS/Bootstrap 5, Leaflet.js, Alpine.js
- Tools: cURL, SweetAlert2, Google Fonts, Material Symbols

## Cara Instalasi
1. Clone repository
2. Buat database `tanipantau` di MySQL/phpMyAdmin
3. Jalankan backend:
   ```bash
   cd backend
   cp .env.example .env
   # Edit .env, sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD
   composer install
   php artisan key:generate
   php artisan migrate:fresh --seed
   php artisan storage:link
   php artisan serve
   ```
   Backend berjalan di `http://127.0.0.1:8000`.

4. Jalankan frontend (terminal terpisah):
   ```bash
   cd frontend
   php -S localhost:8080
   ```
   Frontend berjalan di `http://localhost:8080`.

5. Akses frontend melalui browser di `http://localhost:8080`.

## Akun Demo

| Peran   | Email               | Password   |
|---------|---------------------|------------|
| Admin   | admin@example.com   | password   |
| Petugas | petugas@example.com | password   |
| Manajer | manajer@example.com | password   |

## Link Deploy
- Frontend: (belum di-deploy)
- Backend/Admin: (belum di-deploy)

## Endpoint API

| Method | Endpoint                         | Keterangan                     | Auth     |
|--------|----------------------------------|--------------------------------|----------|
| POST   | /api/auth/login                  | Login user                     | Public   |
| POST   | /api/auth/logout                 | Logout + hapus token           | Token    |
| GET    | /api/statistik                   | Statistik dashboard            | Token    |
| GET    | /api/kecamatan                   | Daftar kecamatan               | Token    |
| GET    | /api/desa/{kecamatanId}          | Daftar desa per kecamatan      | Token    |
| GET    | /api/petani                      | Daftar petani (paginated)      | Token    |
| GET    | /api/petani/{id}                 | Detail petani                  | Token    |
| POST   | /api/petani                      | Tambah petani                  | Token    |
| PUT    | /api/petani/{id}                 | Update petani                  | Token    |
| DELETE | /api/petani/{id}                 | Hapus petani                   | Token    |
| GET    | /api/lahan                       | Daftar lahan (paginated)       | Token    |
| GET    | /api/lahan/{id}                  | Detail lahan + riwayat         | Token    |
| GET    | /api/lahan/{id}/kunjungan        | Riwayat kunjungan per lahan    | Token    |
| POST   | /api/lahan                       | Tambah lahan                   | Token    |
| PUT    | /api/lahan/{id}                  | Update lahan                   | Token    |
| DELETE | /api/lahan/{id}                  | Hapus lahan                    | Token    |
| GET    | /api/kunjungan                   | Daftar kunjungan               | Token    |
| POST   | /api/kunjungan-lahan             | Catat kunjungan baru           | Token    |

## AI Usage Log
(Catatan penggunaan AI akan diisi oleh tim)

| No | Tanggal | Anggota | Tools AI | Prompt Penting | Hasil AI | Verifikasi/Revisi Tim |
|----|---------|---------|----------|----------------|----------|----------------------|
| 1 | ... | ... | ChatGPT | ... | ... | ... |

## Pembagian Tugas
1. Nama - Kontribusi
2. Nama - Kontribusi
3. Nama - Kontribusi
4. Nama - Kontribusi

## Catatan
- Seluruh data yang digunakan adalah data dummy/simulasi. Tidak ada data pasien, NIK, nomor HP, atau data kesehatan nyata.
- Pastikan backend Laravel berjalan (`php artisan serve`) agar frontend dapat mengambil data via API.
- Foto dokumentasi kunjungan disimpan di `backend/storage/app/public/kunjungan`.
