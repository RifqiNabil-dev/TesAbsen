# Panduan Setup Sistem Informasi PKL

## Persyaratan Sistem
- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js & NPM (untuk asset compilation)

## Langkah Instalasi

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Konfigurasi Database
Edit file `.env` dan sesuaikan konfigurasi database:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pkl_system
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Jalankan Migrasi dan Seeder
```bash
php artisan migrate --seed
```

### 5. Build Assets (Opsional untuk development)
```bash
npm run dev
# atau untuk production
npm run build
```

### 6. Jalankan Server Development
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Default Login

### Admin
- Email: admin@pkl.local
- Password: password

### Mahasiswa
- Email: mahasiswa@pkl.local
- Password: password

## Fitur Sistem

### Admin
- Dashboard dengan statistik
- Manajemen data mahasiswa
- Manajemen jadwal PKL
- Manajemen lokasi layanan
- Monitoring presensi
- Approval logbook
- Laporan dan penilaian PKL

### Mahasiswa
- Dashboard personal
- Presensi harian (check-in/check-out)
- Input logbook kegiatan
- Lihat jadwal PKL
- Lihat status logbook

## Catatan Penting
- Waktu server digunakan untuk timestamp presensi
- Presensi terlambat jika check-in setelah jam 08:00
- Logbook harus disetujui admin sebelum dihitung
- Penilaian menggunakan skala 0-20 per aspek (total 100)

