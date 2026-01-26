# Sistem Informasi PKL
## Dinas Perpustakaan Umum dan Arsip Daerah Kota Malang

Aplikasi web untuk mengelola Praktik Kerja Lapangan (PKL) dengan fitur:
- Presensi harian (datang & pulang)
- Jadwal PKL dan rotasi lokasi layanan
- Logbook kegiatan harian
- Laporan dan penilaian PKL

### Teknologi
- Laravel 10
- MySQL
- Bootstrap 5
- Blade Templates

### Instalasi

1. Install dependencies:
```bash
composer install
npm install
```

2. Copy file environment:
```bash
cp .env.example .env
```

3. Generate application key:
```bash
php artisan key:generate
```

4. Setup database di `.env` dan jalankan migrasi:
```bash
php artisan migrate --seed
```

5. Jalankan aplikasi:
```bash
php artisan serve
npm run dev
```

### Default Login

**Admin:**
- Email: admin@pkl.local
- Password: password

**Mahasiswa:**
- Email: mahasiswa@pkl.local
- Password: password

