# SIBIMBINGAN - Sistem Bimbingan Skripsi Online

SIBIMBINGAN adalah aplikasi web berbasis Laravel yang digunakan untuk mengelola proses bimbingan skripsi secara online. Sistem ini dirancang untuk memudahkan mahasiswa dalam mengajukan judul, mengunggah file bimbingan, melihat status revisi, serta memudahkan dosen dan admin dalam memantau proses bimbingan skripsi.

---

## Tentang Project

Project ini dibuat sebagai sistem informasi bimbingan skripsi online dengan fitur multi-role, yaitu:

* Admin
* Mahasiswa
* Dosen

Setiap role memiliki dashboard dan fitur yang berbeda sesuai kebutuhan pengguna.

---

## Fitur Utama

### Admin

* Login sebagai admin
* Melihat dashboard statistik
* Mengelola pengajuan judul mahasiswa
* Menentukan dosen pembimbing
* Melihat data bimbingan mahasiswa
* Melihat laporan bimbingan
* Export laporan bimbingan ke PDF

### Mahasiswa

* Registrasi akun mahasiswa
* Login sebagai mahasiswa
* Mengajukan judul skripsi
* Melihat status pengajuan judul
* Melihat dosen pembimbing
* Mengajukan bimbingan skripsi
* Upload file proposal/BAB skripsi
* Melihat catatan revisi dari dosen
* Melihat progress bimbingan

### Dosen

* Registrasi akun dosen
* Login sebagai dosen
* Melihat pengajuan judul mahasiswa bimbingan
* Memberikan status judul: disetujui, revisi, atau ditolak
* Melihat file bimbingan mahasiswa
* Memberikan catatan revisi
* Mengubah status bimbingan
* Melihat grafik status bimbingan

---

## Teknologi yang Digunakan

* Laravel 13
* PHP 8.4
* MySQL
* Blade Template
* Tailwind CSS
* Laravel Breeze
* DomPDF
* Vite
* Composer
* NPM

---

## Struktur Role Pengguna

| Role      | Keterangan                                       |
| --------- | ------------------------------------------------ |
| Admin     | Mengelola seluruh data sistem                    |
| Mahasiswa | Mengajukan judul dan bimbingan skripsi           |
| Dosen     | Memeriksa pengajuan, file, dan memberikan revisi |

---

## Alur Sistem

### 1. Alur Mahasiswa

1. Mahasiswa melakukan registrasi akun.
2. Mahasiswa login ke sistem.
3. Mahasiswa mengajukan judul skripsi.
4. Admin menentukan dosen pembimbing.
5. Dosen memeriksa judul mahasiswa.
6. Jika judul disetujui, mahasiswa dapat mengajukan bimbingan.
7. Mahasiswa mengunggah file proposal atau BAB skripsi.
8. Dosen memeriksa file.
9. Dosen memberikan catatan revisi atau menyetujui bimbingan.
10. Mahasiswa melihat status dan catatan revisi melalui dashboard.

### 2. Alur Dosen

1. Dosen melakukan registrasi akun.
2. Dosen login ke sistem.
3. Dosen melihat dashboard bimbingan.
4. Dosen melihat daftar pengajuan judul mahasiswa yang sudah ditentukan admin.
5. Dosen memberikan keputusan pada judul mahasiswa.
6. Dosen membuka file bimbingan mahasiswa.
7. Dosen memberikan catatan revisi.
8. Dosen mengubah status bimbingan menjadi menunggu, diproses, revisi, selesai, atau disetujui.

### 3. Alur Admin

1. Admin login ke sistem.
2. Admin melihat dashboard utama.
3. Admin melihat daftar pengajuan judul mahasiswa.
4. Admin menentukan dosen pembimbing.
5. Admin memantau data bimbingan.
6. Admin mencetak laporan bimbingan dalam bentuk PDF.

---

## Cara Install Project

Ikuti langkah berikut agar project bisa dijalankan di komputer lain.

### 1. Clone Repository

```bash
git clone https://github.com/afrinoer12/sibimbingan-laravel.git
```

Masuk ke folder project:

```bash
cd sibimbingan-laravel
```

---

### 2. Install Dependency Laravel

```bash
composer install
```

---

### 3. Install Dependency Frontend

```bash
npm install
```

---

### 4. Copy File Environment

```bash
copy .env.example .env
```

Untuk Git Bash atau Linux/Mac:

```bash
cp .env.example .env
```

---

### 5. Generate App Key

```bash
php artisan key:generate
```

---

### 6. Buat Database

Buat database baru di phpMyAdmin dengan nama:

```text
db_bimbingan_skripsi
```

Lalu sesuaikan konfigurasi database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_bimbingan_skripsi
DB_USERNAME=root
DB_PASSWORD=
```

Jika MySQL menggunakan password, isi bagian `DB_PASSWORD`.

---

### 7. Jalankan Migration

```bash
php artisan migrate
```

Jika ingin menghapus ulang database dan menjalankan migration dari awal:

```bash
php artisan migrate:fresh
```

---

### 8. Buat Storage Link

```bash
php artisan storage:link
```

Perintah ini diperlukan agar file skripsi yang diupload bisa dibuka melalui browser.

---

### 9. Jalankan Vite

Untuk mode development:

```bash
npm run dev
```

Atau untuk build production:

```bash
npm run build
```

---

### 10. Jalankan Server Laravel

Buka terminal baru, lalu jalankan:

```bash
php artisan serve
```

Akses project melalui browser:

```text
http://127.0.0.1:8000
```

---

## Cara Membuat Akun

### Mahasiswa

1. Buka halaman register.
2. Pilih role `Mahasiswa`.
3. Isi nama, email, NIM, program studi, dan password.
4. Klik daftar.
5. Setelah berhasil, mahasiswa langsung masuk ke dashboard mahasiswa.

### Dosen

1. Buka halaman register.
2. Pilih role `Dosen`.
3. Isi nama, email, NIDN, bidang keahlian, dan password.
4. Klik daftar.
5. Setelah berhasil, dosen langsung masuk ke dashboard dosen.

### Admin

Admin tidak dibuat melalui halaman register. Akun admin dibuat secara manual melalui database atau seeder agar lebih aman.

Contoh membuat admin melalui database:

```sql
INSERT INTO users (name, email, password, role, created_at, updated_at)
VALUES (
    'Admin',
    'admin@gmail.com',
    '$2y$12$GANTI_DENGAN_PASSWORD_HASH',
    'admin',
    NOW(),
    NOW()
);
```

Cara yang lebih mudah adalah membuat admin melalui Laravel Tinker.

```bash
php artisan tinker
```

Lalu jalankan:

```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@gmail.com',
    'password' => bcrypt('12345678'),
    'role' => 'admin',
]);
```

Login admin:

```text
Email    : admin@gmail.com
Password : 12345678
```

---

## Alur Penggunaan untuk Teman

Jika teman ingin menjalankan project ini, urutannya:

1. Clone project dari GitHub.
2. Jalankan `composer install`.
3. Jalankan `npm install`.
4. Copy `.env.example` menjadi `.env`.
5. Buat database `db_bimbingan_skripsi`.
6. Sesuaikan konfigurasi database di `.env`.
7. Jalankan `php artisan key:generate`.
8. Jalankan `php artisan migrate`.
9. Jalankan `php artisan storage:link`.
10. Jalankan `npm run dev`.
11. Jalankan `php artisan serve`.
12. Buka `http://127.0.0.1:8000`.
13. Register sebagai mahasiswa atau dosen.
14. Admin dibuat manual melalui Tinker.

---

## Perintah Cepat Setelah Clone

```bash
composer install
npm install
copy .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
npm run dev
php artisan serve
```

Untuk Git Bash/Linux/Mac:

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
npm run dev
php artisan serve
```

---

## Catatan Penting

File `.env` tidak boleh diupload ke GitHub karena berisi konfigurasi database dan data sensitif.

Folder berikut tidak perlu diupload ke GitHub:

```text
/vendor
/node_modules
.env
```

Pastikan file `.gitignore` sudah berisi:

```gitignore
/vendor
/node_modules
.env
/public/storage
/storage/*.key
```

---

## Troubleshooting

### 1. Error `vendor/autoload.php not found`

Jalankan:

```bash
composer install
```

### 2. Error `Vite manifest not found`

Jalankan:

```bash
npm install
npm run dev
```

Atau:

```bash
npm run build
```

### 3. Error database tidak ditemukan

Pastikan database sudah dibuat di phpMyAdmin dan nama database di `.env` sudah benar.

### 4. File upload tidak bisa dibuka

Jalankan:

```bash
php artisan storage:link
```

### 5. Route tidak terbaca

Jalankan:

```bash
php artisan optimize:clear
php artisan route:clear
php artisan view:clear
php artisan config:clear
```

---

## Developer

Project ini dikembangkan oleh:

```text
Afrizal Noer
Teknik Informatika
Universitas Adzkia
```

---

## Lisensi

Project ini dibuat untuk kebutuhan pembelajaran dan pengembangan sistem informasi bimbingan skripsi online.

```
```
