# Changelog

## Versi 1.0.0 - Initial Release

### Fitur Utama
- ✅ Sistem autentikasi dengan role-based access control (Admin & Mahasiswa)
- ✅ Presensi harian dengan check-in dan check-out
- ✅ Deteksi keterlambatan otomatis (setelah jam 08:00)
- ✅ Manajemen jadwal PKL dan rotasi lokasi
- ✅ Logbook kegiatan harian dengan approval system
- ✅ Sistem penilaian PKL dengan 5 aspek penilaian
- ✅ Dashboard untuk Admin dan Mahasiswa
- ✅ Laporan dan statistik PKL

### Teknologi
- Laravel 10
- MySQL Database
- Bootstrap 5 UI
- Blade Templates
- Server-side timestamp untuk presensi

### Database Tables
- users (dengan role: admin/mahasiswa)
- locations (lokasi layanan)
- schedules (jadwal PKL)
- attendances (presensi harian)
- logbooks (logbook kegiatan)
- assessments (penilaian PKL)

### Default Users
- Admin: admin@pkl.local / password
- Mahasiswa: mahasiswa@pkl.local / password

