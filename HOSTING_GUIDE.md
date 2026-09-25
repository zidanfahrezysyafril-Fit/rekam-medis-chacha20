# Panduan Hosting MedSecure (Rekam Medis ChaCha20)

Dokumen ini berisi panduan lengkap untuk melakukan *hosting* aplikasi **MedSecure** ke server web (cPanel / VPS / Shared Hosting).

---

## 1. Persiapan File Sebelum Upload
Aplikasi ini sudah diproduksi dan di-build asetnya.

1. **Aset Terkompilasi**: Pastikan folder `public/build` sudah terisi file `.css` dan `.js` hasil kompilasi.
2. **File `.htaccess` Root**: File `.htaccess` di root proyek sudah disediakan agar otomatis mengarahkan domain ke folder `public/`.
3. **Database Dump**: Ekspor database `rekam_medis` dari phpMyAdmin lokal menjadi file `rekam_medis.sql`.

---

## 2. Langkah Deploy ke cPanel / Shared Hosting

### Langkah A: Upload File Project
1. Masuk ke **cPanel** -> **File Manager**.
2. Upload seluruh folder proyek `rekam-medis-chacha20` ke folder root akun Anda (atau langsung di dalam `public_html` jika ingin dijadikan domain utama).
3. Ekstrak file jika Anda mengupload dalam bentuk `.zip`.

### Langkah B: Konfigurasi Database di cPanel
1. Masuk ke **cPanel** -> **MySQL® Databases**.
2. Buat database baru (misal: `username_rekam_medis`).
3. Buat pengguna database baru dan atur kata sandi yang kuat.
4. Hubungkan pengguna tersebut ke database dengan centang **ALL PRIVILEGES**.
5. Buka **phpMyAdmin** di cPanel, pilih database baru, lalu lakukan **Import** file `rekam_medis.sql`.

### Langkah C: Pengaturan File `.env`
Buka file `.env` di cPanel File Manager, sesuaikan konfigurasinya:
```env
APP_NAME=MedSecure
APP_ENV=production
APP_DEBUG=false
APP_URL=https://nama-domain-anda.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=username_rekam_medis
DB_USERNAME=username_dbuser
DB_PASSWORD=password_dbuser_anda

SESSION_DRIVER=database
SESSION_SECURE_COOKIE=true
```

### Langkah D: Keamanan Tambahan di Server Live
- **SSL / HTTPS**: Aktifkan SSL di cPanel (Let's Encrypt / AutoSSL) agar protokol HTTPS berjalan.
- **Kunci Aplikasi (`APP_KEY`)**: Jangan pernah mengubah `APP_KEY` yang sudah dipakai mengenkripsi data, karena data ChaCha20 terikat dengan kunci ini.

---

## 3. Fitur Keamanan Terintegrasi di MedSecure
- **Enkripsi ChaCha20-Poly1305 (Libsodium / OpenSSL)** untuk data medis pasien (Diagnosis, Keluhan, Tindakan, Resep, Catatan Dokter).
- **Hashing Email & NIK (HMAC SHA-256)** untuk pencarian data tanpa membocorkan identitas asli di basis data.
- **Proteksi Brute-Force & Rate Limiting** pada Login dan OTP.
- **Autentikasi Dua-Faktor (2FA/OTP)** saat pendaftaran akun.
- **HTTP Security Headers** (X-Frame-Options, X-Content-Type-Options, X-XSS-Protection, Referrer-Policy, Permissions-Policy).
- **Activity Log (Jejak Audit)** mencatat semua aktivitas penting pengguna beserta IP Address.
