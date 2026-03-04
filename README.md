# 🕋 PSAJ – Sistem Manajemen Umroh

> **Portal internal untuk mengelola jamaah, paket umroh, mitra, dan laporan operasional biro.**

Aplikasi ini awalnya berbasis sistem stok gudang, lalu dimodifikasi penuh menjadi **sistem manajemen biro umroh**:

- Admin mengelola **manifest jamaah, program paket, mitra/agen, laporan pusat dan export manifest**.
- Staf Registrasi mengelola **pendaftaran & keberangkatan jamaah** dan bisa **mencetak laporan**.
- User (role `User`) memiliki **dashboard ringkas** untuk melihat paket, riwayat, dan profil.

## ✨ Fitur Utama

- **Landing page umroh** untuk promosi paket, fasilitas, testimoni, dan CTA konsultasi/WhatsApp.
- **Role-based access**:
  - Admin: manajemen staf, jamaah, paket, mitra, laporan pusat.
  - Staf Registrasi: tugas pendaftaran & keberangkatan, laporan incoming/outgoing + export.
  - User: melihat paket, riwayat, dan kelola profil.
- **Manifest Jamaah**: data jamaah terhubung dengan paket (kategori) dan mitra (supplier), plus riwayat transaksi.
- **Program Paket Umroh**: paket Ekonomis, VIP, Keluarga, Ramadhan, Plus Turki (via seeder).
- **Mitra & Agen**: direktori agen/cabang dengan statistik jamaah.
- **Laporan & Export**:
  - Admin: laporan kuota seat per paket + filter program/status.
  - Staff: laporan jamaah masuk & keberangkatan, export Excel manifest dan keberangkatan.

---

## 🛠️ Yang Digunakan

| Teknologi        | Fungsi                  |
| ---------------- | ----------------------- |
| **Laravel**      | Backend & routing       |
| **MySQL**        | Basis data utama        |
| **Blade + Tailwind CSS** | Tampilan dashboard & landing page |
| **Alpine.js**    | Interaksi ringan di UI  |
| **Maatwebsite/Excel** | Export & import Excel (manifest, laporan) |

---

## 🚀 Cara Install

### Yang Perlu Dipersiapkan

Pastikan komputer sudah ada:

-   **PHP** versi 8.1 atau lebih baru ✅
-   **Composer** (untuk install Laravel) ✅
-   **MySQL** (tempat menyimpan data) ✅
-   **Git** (untuk download kode) ✅

### Langkah Install

**1. Clone repository**

```bash
git clone <url-repo-ini>.git
cd PSAJ
```

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
DB_DATABASE=umroh
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

## 📁 Struktur Folder (Ringkas)

```
PSAJ/
├── app/
│   ├── Http/Controllers/     # Controller web & API
│   ├── Models/               # User, Product (Jamaah), Category (Paket), Supplier (Mitra), StockTransaction
│   └── Services/             # Logika bisnis tambahan (jika ada)
├── database/
│   ├── migrations/           # Struktur tabel
│   └── seeders/              # Data awal (paket, mitra, jamaah contoh, user)
├── routes/
│   ├── web.php               # Route web (landing + dashboard admin/staff/user)
│   └── api.php               # API internal (auth, produk, stok)
└── resources/
    ├── views/                # Blade view (landing, dashboard, laporan, dsb.)
    └── css/, js/             # Asset frontend (Tailwind, Alpine, dll.)
```

---

## 🔗 URL & Endpoint Penting

### Web (UI)

- `/` – Landing page biro umroh.
- `/login` – Halaman login.
- `/admin/dashboard` – Dashboard Admin.
- `/staff/dashboard` – Dashboard Staf Registrasi.
- `/user/dashboard` – Dashboard User.

### API (contoh)

- **Auth**
  - `POST /api/auth/register` – Registrasi user (default role: `User`).
  - `POST /api/auth/login` – Login.
  - `GET /api/profile` – Profil user login.

- **Master data** (prefix `/api/admin` dengan middleware role Admin)
  - `GET /api/admin/products` – Daftar jamaah.
  - `GET /api/admin/categories` – Daftar program paket.
  - `GET /api/admin/suppliers` – Daftar mitra/agen.

---

## 🔐 Sistem Keamanan

Autentikasi menggunakan **Laravel Sanctum** + session untuk web.  
Untuk client non-browser, gunakan token Bearer yang didapat dari endpoint login API.

---

## 🧪 Testing

### Jalankan test:

```bash
# Test semua
php artisan test

# Test file tertentu
php artisan test tests/Feature/ProductControllerTest.php
```

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
DB_DATABASE=psaj_umroh_production
```

---

## 🤝 Kontribusi

Mau bantu develop? Silakan!

### Alur kontribusi

1. **Fork** repository ini ke akun GitHub kamu.
2. **Clone** fork ke lokal:
   ```bash
   git clone <url-fork-kamu>.git
   cd PSAJ
   ```
3. **Buat branch** baru yang deskriptif:
   ```bash
   git checkout -b feat/nama-fitur
   # atau
   git checkout -b fix/nama-bug
   ```
4. Setup environment & jalankan:
   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   # sesuaikan DB_* di .env
   php artisan migrate:fresh --seed
   php artisan serve
   ```
5. Lakukan perubahan kode dengan tetap mengikuti:
   - Penamaan role: `Admin`, `Staf Registrasi`, `User`.
   - Struktur route (group prefix `admin/`, `staff/`, `user/`).
   - Tema UI (Tailwind dengan nuansa emerald/dark mode).
6. Jalankan test (kalau ada):
   ```bash
   php artisan test
   ```
7. Commit dengan pesan jelas:
   ```bash
   git commit -m "feat: tambah export laporan keberangkatan staff"
   ```
8. Push ke fork dan buat **Pull Request** ke repo utama. Jelaskan:
   - Ringkasan perubahan.
   - Langkah cara mengetes.
   - Screenshot (kalau ada perubahan UI).

---

## 📝 Tips Development

### Command berguna:

```bash
# Buat model baru dengan controller resource + migration
php artisan make:model NamaModel -mcr

# Hapus semua cache
php artisan optimize:clear

# Debug mode
php artisan tinker
```

---


