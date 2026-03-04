# 🕋 Al Madinah Haromain - Sistem Manajemen Umroh

> **Solusi digital terintegrasi untuk mengelola manifest jamaah dan keberangkatan secara profesional!** 🚀

Al Madinah Haromain adalah aplikasi manajemen biro perjalanan Umroh untuk mencatat pendaftaran jamaah, mengelola paket program, hingga memantau keberangkatan jamaah secara real-time.

## ✨ Kenapa Pilih Sistem Ini?

- 🔐 **Aman** - Sistem login multi-role (Admin & Staf Registrasi) untuk melindungi data jamaah.
- 📋 **Manifest Digital** - Pencatatan data jamaah lengkap dengan status kuota seat otomatis.
- ✈️ **Satu Klik Berangkat** - Fitur keberangkatan massal untuk memproses satu paket jamaah sekaligus.
- 📖 **Jurnal Aktivitas** - Log otomatis yang mencatat setiap riwayat pendaftaran dan keberangkatan.
- 📊 **Cetak Excel** - Laporan manifest yang rapi dan siap cetak kapan saja.

---

## 🛠️ Yang Digunakan

| Teknologi        | Fungsi                  |
| ---------------- | ----------------------- |
| **Laravel 10**   | Core sistem utama       |
| **MySQL**        | Database Manifest & Log |
| **Tailwind CSS** | Dashboard modern & rapi |
| **Alpine.js**    | Interaktivitas fitur UI |

---

## 🚀 Cara Install

### Yang Perlu Dipersiapkan

Pastikan komputer sudah terinstall:
- **PHP** versi 8.1 atau lebih baru ✅
- **Composer** ✅
- **MySQL** ✅
- **Laragon/XAMPP** ✅

### Langkah Instalasi

**1. Clone Repository**
```bash
git clone https://github.com/username/AlMadinahApp.git
cd AlMadinahApp

**2. Install komponen Laravel**

```bash
composer install
```

**3. Setup konfigurasi**

```bash
cp .env.example .env
php artisan key:generate
```

**4. Setting database**
Buka file `.env` dan isi:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Umroh
DB_USERNAME=root
DB_PASSWORD=
```

**5. Buat tabel database**

```bash
php artisan migrate:fresh --seed
```

**6. Jalankan aplikasi**

```bash
php artisan serve
```

Buka browser ke: http://127.0.0.1:8000 🎉

---

## 📁 Struktur Folder

```
stockify-backend/
├── app/
│   ├── Http/Controllers/     # Pengendali halaman
│   ├── Models/              # Model data
│   └── Services/           # Logika bisnis
├── database/
│   ├── migrations/         # Struktur tabel
│   └── seeders/           # Data awal
├── routes/
│   └── api.php            # Alamat halaman
└── resources/
    └── css/              # File tampilan
```

---

## 🔗 Alamat Halaman (API)

### Login & Daftar

| Cara | Alamat               | Fungsi            |
| ---- | -------------------- | ----------------- |
| POST | `/api/auth/register` | Daftar akun baru  |
| POST | `/api/auth/login`    | Masuk ke aplikasi |

### Struktur Tabel

| Tabel Database   |Tabel Deskripsi                       | Terminologi Sistem  |
| -----------------| -------------------------------------| ------------------- |
| programs         | Master data paket Umroh (VIP/Reguler)| Program Paket       |
| manifests        | Data induk pendaftaran jamaah        | Manifest Jamaah     |
| agencies         | Data induk pendaftaran jamaah        | Manifest Jamaah     |
| activity_journals| Data induk pendaftaran jamaah        | Manifest Jamaah     |

### Dashboard Admin

| Cara   | Alamat                               | Fungsi                      |
| ------ | -------------------------------------| ----------------------------|
| GET    | `/admin/products`                    | Manajemen Manifest Jamaah   |
| POST   | `/admin/categories/{id}/berangkatkan`| Proses Keberangkatan Massal |
| GET    | `/admin/reports/transactions`        | Lihat Jurnal Aktivitas      |

### Staf Registrasi

| Cara | Alamat                    | Fungsi                   |
| ---- | --------------------------| ------------------------ |
| GET  | `/staff/stock/incoming`   | Daftar Jamaah Baru Masuk |
| GET  | `/staff/reports/incoming` | Laporan Riwayat Manifest |
| GET  | `/staff/reports/export  ` | Export Manifest ke Excel |
---

## 🔐 Sistem Keamanan

Al Madinah Haramain menggunakan sistem token untuk keamanan.

---

## 🚢 Pasang di Server

### Persiapan production:

```bash
# Optimasi untuk server
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
```

### Setting server:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://website-kamu.com

# Database server
DB_HOST=alamat-database-server
DB_DATABASE=Umroh
```

---

## 🤝 Kontribusi

Mau bantu develop? Silakan!

### Caranya:

1. **Fork** repository ini
2. **Buat branch** baru: `git checkout -b fitur-baru`
3. **Commit** perubahan: `git commit -m "tambah fitur baru"`
4. **Push**: `git push origin fitur-baru`
5. **Buat Pull Request**

---

## 📝 Tips Development

### Command berguna:

```bash
# Membersihkan cache route dan view.
php artisan optimize:clear

# Membuat format laporan excel baru.
php artisan make:export NamaExport --model=Product

# Debug mode
php artisan tinker
```

---


