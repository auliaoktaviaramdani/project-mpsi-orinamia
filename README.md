# SIMORIN - Sistem Informasi Manajemen Orinamia

<p align="center">
  <img src="https://img.shields.io/badge/Entity-PT%20Cahaya%20Binar%20Berlian-6E387A?style=for-the-badge" alt="PT Cahaya Binar Berlian">
  <img src="https://img.shields.io/badge/Brand-ORINAMIA%20Daily%20Wear-E074D8?style=for-the-badge" alt="Orinamia Daily Wear">
  <img src="https://img.shields.io/badge/Framework-Laravel%2012-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/Database-MySQL-4479A1?style=for-the-badge&logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/Tests-Passed%20(100%25)-success?style=for-the-badge" alt="Tests Passed">
</p>

**SIMORIN** adalah sistem informasi manajemen operasional terpadu yang dikembangkan khusus untuk unit usaha konveksi pakaian seragam, baju medis OKA, dan pakaian kerja berbadan hukum resmi **PT CAHAYA BINAR BERLIAN** (merk dagang **ORINAMIA Daily Wear & Konveksi**).

---

## Profil Perusahaan & Legalitas Resmi

Sesuai dokumen proposal resmi perusahaan, SIMORIN memadukan identitas legal dan standar kemitraan sebagai berikut:

- **Nama Entitas Hukum:** PT CAHAYA BINAR BERLIAN
- **Merk Dagang:** ORINAMIA Konveksi & Daily Wear
- **SK Kemenkumham RI:** `AHU-0202685.AH.01.30. Tahun 2024`
- **Nomor Induk Berusaha (NIB):** `2104240036065`
- **Tahun Berdiri:** Agustus 2015 (berawal dari inisiatif mandiri tenaga perawat medis)
- **Rekening Resmi Perusahaan:** Bank Syariah Indonesia (BSI) `7273909413` a/n PT Cahaya Binar Berlian
- **Alamat Workshop:** Jl Cibodas Raya No 10 D Perum 1, Karawaci, Tangerang, Banten
- **Atelier Administrasi:** Jl Tongkol Raya No 20C Perum 1, Karawaci, Tangerang
- **Hotline / WhatsApp Resmi:** `0857 1610 7394`

### Klien & Mitra Terverifikasi
Perusahaan telah berpengalaman melayani pengadaan seragam instansi terkemuka, antara lain:
- **Perhotelan & Hospitality:** Novotel Hotels, Omar Hotel, Grand Mirah Hotel
- **Kesehatan & Rumah Sakit:** RS Sari Asih, RS An-Nisa Tangerang, RSIA Bunda Sejati
- **Organisasi Profesi & Relawan:** HIPKABI Banten (Himpunan Perawat Kamar Bedah Indonesia), NAKES PRO Volunteer
- **Institusi Sosial & Filantropi:** BAZNAS (Badan Amil Zakat Nasional), Dompet Dhuafa, Rumah Zakat
- **Industri Manufaktur:** PT DNP Indonesia

---

## Filosofi Desain Antarmuka (7 Referensi Desain)

Aplikasi SIMORIN mengusung konsep visual **Soft Editorial Atelier** yang dirancang bebas dari template generik ("AI slop") dan memadukan 7 referensi desain modern:

1. **[reactbits.dev](https://reactbits.dev/):** Spotlight card cursor physics yang memancarkan ambient halo mengikuti kursor mouse, shiny shimmer text animation (`.shiny-text`), dan rolling counter tickers pada angka ringkasan.
2. **[animejs.com](https://animejs.com/):** Transisi bertingkat (*staggered entrance*) pada kartu dan panel serta animasi pegas (*elastic bounce*) saat memilih palet 13 warna seragam OKA.
3. **[21st.dev](https://21st.dev/community/templates):** Tata letak Bento Grid modular berhirarki kuat dan bilah navigasi kaca buram (*frosted glass* `backdrop-filter: blur(14px)`).
4. **[skiper-ui.com](https://skiper-ui.com/):** Segmented control pill pada filter status, tombol preset persentase DP (`30%`, `50% SOP MOU`, `100%`), dan kalkulator simulasi pemesanan.
5. **[aura.build](https://www.aura.build/):** Tata cahaya atmosferik (*ambient radial mesh*) ungu-lavender halus di latar belakang untuk mode terang dan gelap.
6. **[godly.design](https://godly.design/websites/):** Tipografi haute-couture atelier memadukan display serif `Newsreader`, sans-serif `Plus Jakarta Sans`, dan `JetBrains Mono` (`tabular-nums`) untuk nominal angka agar tidak terpotong.
7. **[motion-primitives.com](https://motion-primitives.com/):** Laci akordeon interaktif untuk rincian spesifikasi teknis kain (Toyobo Fodu medis, American Drill kantor, dan Ripstop Scotlight 3M K3).

---

## Modul & Fitur Utama Sistem

### 1. Halaman Depan Publik (`/`)
- Etalase digital resmi profil PT Cahaya Binar Berlian.
- Simulasi visual interaktif **13 Palet Warna Seragam Medis OKA** (Toska, Navy, Maroon, Hijau, Hijau Muda, Soft Pink, Pink Fanta, Biru Muda, Biru Benhur, Ungu, Kuning, Orange, dan Putih).
- Kalkulator estimasi biaya kontrak dan simulasi komitmen pembayaran dua termin secara transparan.
- Tautan integrasi instan menuju WhatsApp resmi perusahaan dan login sistem.

### 2. Meja Kerja Penjualan (`/penjualan`)
- Pengelolaan pesanan pakaian custom (*Make-to-Order*).
- Otomatisasi pembuatan dokumen dua tahap:
  - **Termin I:** Invoice DP 50% saat penandatanganan PO dan MOU.
  - **Termin II:** Invoice Pelunasan dengan jangka waktu maksimal 7 hari dari tanggal faktur.
- Tracking status siklus pesanan: `BELUM_BAYAR`, `DP_LUNAS`, `LUNAS`, dan `TERKIRIM`.

### 3. Pengadaan Bahan Baku (`/pembelian`)
- Pencatatan transaksi belanja kain, benang, kancing, puring, dan aksesoris ke supplier.
- Penyimpanan *snapshot harga riil* saat transaksi untuk akurasi kalkulasi HPP.

### 4. Laporan Finansial & Arus Kas (`/laporan`)
- Monitoring sisa piutang tertunggak pelanggan per periode.
- Rekapitulasi pengeluaran bahan baku dan arus kas masuk.
- Fasilitas cetak dokumen laporan resmi siap cetak/PDF.

### 5. Data Master Terpadu (`/master`)
- Master Pelanggan (Instansi, Perusahaan, Rumah Sakit, Individu).
- Master Supplier Bahan Baku.
- Katalog Spesifikasi Bahan Baku tanpa sistem stok mati.

### 6. Keamanan & Hak Akses Berbasis Peran
- **Admin:** Memiliki wewenang operasional penuh (pencatatan penjualan, penerbitan invoice, pembelian bahan, dan kelola data master).
- **Owner:** Hak akses pengawasan laporan keuangan, rekap piutang, dan ringkasan eksekutif dashboard.

---

## Panduan Instalasi & Menjalankan Aplikasi

### 1. Prasyarat Sistem
- PHP versi 8.2 atau lebih tinggi (ekstensi: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`)
- Composer versi 2.x
- Server MySQL / MariaDB (misal via XAMPP)

### 2. Kloning Repository
```bash
git clone https://github.com/auliaoktaviaramdani/project-mpsi-orinamia.git
cd project-mpsi-orinamia
git checkout dev-mika
```

### 3. Instalasi Dependensi
```bash
composer install
```

### 4. Konfigurasi Lingkungan (.env)
Salin berkas konfigurasi template:
```bash
cp .env.example .env
php artisan key:generate
```

Sesuaikan parameter database di dalam file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=orinamia
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Impor Skema Database
Impor struktur dan data awal dari berkas SQL yang tersedia:
- Lokasi berkas: `database/sql/orinamia.sql`
- Dapat diimpor melalui phpMyAdmin atau terminal:
```bash
mysql -u root -p orinamia < database/sql/orinamia.sql
```

### 6. Menjalankan Server Pengembangan
```bash
php artisan serve
```
Akses aplikasi melalui browser di: **`http://127.0.0.1:8000`**

---

## Kredensial Akun Pengguna Demo

| Peran | Username | Password | Hak Akses |
|---|---|---|---|
| **Admin** | `admin` | `password` | Akses penuh operasional penjualan, pembelian, master data, dan laporan |
| **Owner** | `owner` | `password` | Pengawasan dashboard, monitoring piutang, dan rekapitulasi laporan |

---

## Pengujian Kualitas Kode (Testing & Linting)

Sistem telah dilengkapi rangkaian automated feature test:
```bash
# Menjalankan seluruh test suite PHPUnit
php artisan test

# Memeriksa dan memformat standar kode dengan Laravel Pint
vendor/bin/pint
```

Hasil pengujian: **6 test / 25 assertions lulus 100%**.

---

## Hak Cipta & Kepemilikan
Seluruh hak cipta dilindungi undang-undang.
Copyright &copy; 2015 &ndash; 2026 **PT CAHAYA BINAR BERLIAN** &bull; **ORINAMIA Daily Wear & Konveksi**.
