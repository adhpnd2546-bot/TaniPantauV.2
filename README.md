# TaniPantau

## Deskripsi Singkat
Aplikasi monitoring lahan pertanian dan kunjungan petugas lapangan. Sistem digunakan untuk mencatat data petani, lahan, titik lokasi, luas area, status fase tanam, dan kunjungan petugas lapang. Membantu pemantauan perkembangan lahan dari masa persiapan tanam sampai panen.

## Anggota Kelompok
1. Adhiyatma Pandu H  - 24102002 - fullstuck
2. Inas Hasna Mufida - 24102012 - Frontend dev
3. Yudhistira Empi - 24102023 - backend dev
4. Anggun Tri Pratiwi - 24102026 - API dev

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
- Backend: Laravel 12, MySQL, REST API, Sanctum Auth, Alpine.js, Tailwind CSS
- Frontend Publik: PHP Native, Bootstrap 5, Leaflet.js, AOS, Bootstrap Icons
- Tools: Google Fonts, Material Symbols, SweetAlert2

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

| Peran   | Email                 | Password |
|---------|-----------------------|----------|
| Admin   | admin@admin.com       | 123      |
| Petugas | petugas@petugas.com   | 123      |
| Petugas | petugas2@petugas2.com | 123      |
| Manajer | manajer@manajer.com   | 123      |

## Link Deploy
- Frontend: https://pantautani.rf.gd/
- Backend/Admin: https://adminpantautani.rf.gd/login

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

| No | Tanggal | Anggota | Tools AI | Prompt Penting | Hasil dari AI | Verifikasi / Revisi Tim |
|----|---------|---------|----------|----------------|----------------|--------------------------|
| 1 | 2 Juni 2026 | Anggota | ChatGPT | *"Bang, kok query grafik harga komoditas lama banget? Aku pake foreach di Blade tinggal panggil DB::table('harga')->where('komoditas_id', $item->id)->get() di dalam loop. Loading-nya bisa 30 detik. Ada yang salah ya?"* | Gunakan **Eager Loading** dengan `->with('harga')` untuk menghindari **N+1 Query Problem**. Tambahkan **index** pada kolom `komoditas_id` dan `tanggal` di tabel harga. Gunakan `chunk()` atau `cursor()` untuk dataset besar. Untuk grafik, cukup ambil data agregat per bulan pakai `DB::raw('MONTH(tanggal)')` + `AVG(harga)` agar ringan. | Tim mengimplementasikan eager loading di model Komoditas, menambahkan database index migration untuk kolom `komoditas_id` + `tanggal`, dan mengubah query grafik menjadi agregat per-minggu dengan `GROUP BY`. Waktu muat turun dari ~30 detik menjadi < 1 detik. |
| 2 | 5 Juni 2026 | Anggota | ChatGPT | *"Kok API token yang aku simpen di localStorage bisa kepanggil sama orang lain? Terus pas expired Malah nggak diredirect ke login. Aku pake fetch() doang, cek status response 401 doang. Soalnya gawat bang udah bocor kayaknya."* | Jangan simpan token di `localStorage` — rentan **XSS**. Pindahkan ke **HttpOnly cookie** (otomatis dikirim tiap request). Di sisi Laravel, buat **middleware** `CheckTokenExpiry` yang cek `exp` dari JWT sebelum masuk controller. Di Frontend, buat **interceptor** (axios/fetch wrapper) yang otomatis redirect ke login bila dapat 401 dan hapus cookie. | Tim memindahkan token ke cookie HttpOnly via middleware Sanctum, membuat axios interceptor untuk intercept response 401, dan menambahkan refresh token flow otomatis (via refresh endpoint) sebelum benar-benar logout. |
| 3 | 8 Juni 2026 | Anggota | ChatGPT | *"Bang, upload foto lahan ukuran 12MB gagal mulu. Udah gedein `upload_max_filesize` di php.ini tetap aja loading lama. Kalo dipaksa keep, storage cepet penuh. Aku bingung..."* | Jangan simpan file mentah. Buat **Laravel Image Intervention** (pakai spatie/image) untuk **auto-resize** dan **compress** di sisi server sebelum disimpan. Simpan 3 versi: **thumbnail** (150×150), **medium** (800×800), dan **original** (max 1920px). Gunakan **job queue** untuk proses resize agar tidak blocking response. Client-side: validasi file size dan pakai **FileReader** + canvas resize sebelum upload. | Tim mengintegrasikan paket `intervention/image-laravel`, membuat class `ImageService` untuk handle resize & compress otomatis, menyimpan 3 variant gambar, dan memindahkan proses resize ke queue job `ResizeUploadedImage`. Upload foto 12MB jadi ~200KB dengan kualitas tetap baik. |
| 4 | 10 Juni 2026 | Anggota | ChatGPT | *"Tolongggg... filter lahan di dashboardku pake if-else bersarang 7 tingkat buat check wilayah, jenis tanaman, sama tanggal. Kode udah 200 baris di controller, susah dibaca, error kalau ada parameter kosong. Ada cara simpel?"* | Ganti pendekatan dengan **Query Scopes** atau **Eloquent Filter Pattern**. Buat class `LahanFilter` yang punya method terpisah tiap filter (`filterByWilayah()`, `filterByTanaman()`, `filterByTanggal()`). Gunakan **`when()`** condition dari Laravel — otomatis skip filter bila parameter null. Contoh: `$query->when($request->wilayah, fn($q, $wil) => $q->where('wilayah_id', $wil))`. Bikin **Request Form Request** untuk validasi parameter. | Tim merombak controller dengan membuat `LahanFilterService` berisi chainable method, mengganti semua if-else dengan `$query->when()`, dan memindahkan logika filter ke Repository pattern. Kode turun dari 200 baris jadi 35 baris, mudah dibaca dan ditambahi filter baru. |
| 5 | 13 Juni 2026 | Anggota | ChatGPT | *"Bang, petugas di lapangan kan lapor hama lewat HP. Tapi pas submit, admin nggak tahu ada laporan baru. Harus di-refresh manual terus. Udah coba pake setInterval 5 detik fetch data, tapi boros banget quota internet mereka. Ada saran?"* | Ganti **long polling** manual dengan **Server-Sent Events (SSE)** atau **Laravel Reverb** (WebSocket built-in Laravel 11+). SSE lebih irit karena koneksi satu arah (server push ke client) tanpa polling berulang. Di Laravel, trigger **event** saat laporan hama masuk, broadcast via Reverb, client terima realtime. Juga bisa fallback ke **Laravel Echo** + **Pusher** untuk kompatibilitas. Tambahkan **badge notifikasi** di navbar + **sound alert** ringan. | Tim mengimplementasikan **Laravel Reverb** (WebSocket) untuk broadcast event `LaporanHamaCreated`. Frontend menggunakan **Laravel Echo** + **SweetAlert2 toast** untuk notifikasi realtime. Tidak ada polling, notifikasi muncul dalam < 1 detik. |
| 6 | 16 Juni 2026 | Anggota | ChatGPT | *"Map Leaflet js aku nampilin 500 titik lahan petani. Udah pake marker biasa, tapi pas di-zoom out, browser lemot banget, scroll nge-lag. Apa karena terlalu banyak pin? Harus dibatesin?"* | Jangan batasi data, gunakan **Marker Clustering** dengan plugin `leaflet.markercluster`. Untuk dataset > 1000 titik, tambahkan **GeoJSON** + **tile caching**, dan pakai **canvas rendering** alih-alih DOM marker. Di backend, buat endpoint **GeoJSON API** yang return `type: "FeatureCollection"` dengan koordinat. Gunakan `L.geoJSON()` dengan `pointToLayer` + `clusterIconCreateFunction` untuk performa optimal. Server: beri **spatial index** di kolom koordinat. | Tim mengintegrasikan `leaflet.markercluster`, mengubah endpoint lahan jadi GeoJSON API dengan spatial indexing (MySQL POINT), dan beralih ke canvas renderer. 500 titik jadi ringan — tanpa lag, clustering otomatis rapi di tiap zoom level. |
| 7 | 19 Juni 2026 | Anggota | ChatGPT | *"Fitur export PDF laporan panenku pake DOMPDF, tapi kalo ada 100+ data, jadi blank page terus. Udah naikin memory_limit tetep error. Tampilannya juga berantakan kalo ada gambar."* | **DOMPDF** tidak cocok untuk dokumen besar/gambar kompleks. Migrasi ke **Laravel Snappy** (wkhtmltopdf) atau **Barryvdh/DomPDF** dengan konfigurasi `chroot`. Untuk > 100 data, gunakan **streaming download** — generate per halaman/chunk, bukan sekali muat. Set `'isRemoteEnabled' => true` untuk gambar remote. Alternatif: **Laravel Browsershot** (headless Chrome) untuk kualitas pixel-perfect, support CSS modern. | Tim pindah ke **Laravel Browsershot** (headless Chrome via Puppeteer), generate PDF per-chunk 50 data, dan stream hasilnya. PDF 200+ halaman dengan gambar lahan jadi lancar, tampilan rapi persis seperti di browser. |
| 8 | 22 Juni 2026 | Anggota | ChatGPT | *"Daftar riwayat irigasi lahan aku pake JOIN 4 tabel, tampil 10.000 baris pake pagination manual. Pas klik halaman 2, loading 8 detik. Querynya SELECT * FROM irigasi JOIN lahan JOIN petani JOIN wilayah — mungkin terlalu berat?"* | Query mentah `SELECT *` — hindari ambil kolom yang tidak perlu. Tambahkan **database indexing** pada kolom foreign key dan kolom yang di-ORDER BY / WHERE. Gunakan **cursor pagination** (berdasarkan `next_cursor` dari `id` atau `created_at`) daripada **offset pagination** untuk dataset besar — offset jadi lambat di halaman belakang. Di Laravel: `cursorPaginate()` yang 50-100x lebih cepat untuk dataset 10.000+. Juga gunakan **Query Builder** (bukan Eloquent) bila hanya butuh read-only data. | Tim menambahkan composite index pada `(lahan_id, created_at)` di tabel irigasi, mengganti `paginate()` dengan `cursorPaginate()`, dan memilih kolom spesifik (tidak SELECT *). Query dari 8 detik jadi ~200ms per halaman. |
| 9 | 25 Juni 2026 | Anggota | ChatGPT | *"Bang, loginnya lambat. Pas masuk, loading hampir 10 detik. Kayaknya gara-gara aku panggil relasi User -> Lahan -> Riwayat all di middleware. Tapi gara-gara itu jadi berat. Aku nggak ngerti cara optimize loading user data."* | Jangan eager load data relasional di **middleware** yang dieksekusi tiap request. Pindahkan ke halaman yang membutuhkan saja (**lazy loading** relevant). Simpan data sesi pengguna yang sering diakses (seperti role, nama, wilayah) ke **session** atau **cache** (Redis/file) setelah login pertama. Gunakan **Laravel Cache** dengan `remember()` untuk data yang jarang berubah — expired tiap 1 jam. Pasang **Redis** sebagai cache driver untuk performa maksimal. | Tim memisahkan eager load dari middleware, menyimpan role & data dasar user ke session, dan meng-cache data master (daftar wilayah, jenis tanaman) dengan `Cache::remember()`. Waktu login turun dari 10 detik menjadi < 1 detik. |
| 10 | 28 Juni 2026 | Anggota | ChatGPT | *"Form input kunjungan tadi udah dibuat pake HTML biasa, tapi tiap refresh data ilang. Terus kalo petugas salah isi, nggak ada validasi, langsung submit error 500. Pas dicek SQL error. Tolong handling form yang proper gimana?"* | Gunakan **Laravel Form Request** untuk validasi terpusat — buat class `StoreKunjunganRequest` dengan rules untuk setiap field. Jangan simpan data mentah — gunakan **Eloquent ORM** protected `$fillable` + **mass assignment**. Tambahkan **CSRF protection** (sudah default Laravel). Untuk UX, simpan input sementara di **session flash** (`->withInput()`) bila validasi gagal, dan tampilkan error per-field. Untuk frontend, tambahkan **Alpine.js form binding** + validasi client-side sebelum submit. | Tim membuat `StoreKunjunganRequest` dengan validasi (required, max file size 5MB, tanggal tidak boleh di masa depan), menggunakan `$fillable` di model, dan menambahkan error handling dengan `@error` Blade directive. Validasi client-side dengan Alpine.js mencegah submit sebelum data lengkap. |


## Pembagian Tugas
1. Adhiyatma Pandu H  - FullStuck
2. Inas Hasna Mufida - Frontend bug
3. Yudhistira Empi - Database Migration Seeder
4. Anggun Tri Pratiwi - API fixed

## Catatan
- Seluruh data yang digunakan adalah data dummy/simulasi. Tidak ada data pasien, NIK, nomor HP, atau data kesehatan nyata.
- Pastikan backend Laravel berjalan (`php artisan serve`) agar frontend dapat mengambil data via API.
- Foto dokumentasi kunjungan disimpan di `backend/storage/app/public/kunjungan`.