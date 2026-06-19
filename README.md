# SI-Sekretariat: Cloud-Integrated Information System

SI-Sekretariat adalah platform sistem informasi internal organisasi yang dirancang untuk mengotomatisasi manajemen administrasi, persuratan, notulensi rapat, dan kehadiran anggota secara real-time. 

Aplikasi ini mengintegrasikan framework PHP modern dengan ekosistem Google Workspace API untuk menciptakan alur kerja administratif tanpa kertas (*paperless*) yang efisien dan otomatis.

---

## 🚀 Masalah & Solusi (Studi Kasus)

* **Masalah Administrasi Organisasi:** Pengurus organisasi sebelumnya menghabiskan waktu rata-rata 30–45 menit per kegiatan untuk menyalin template notulensi secara manual, mencatat nomor urut surat keluar/masuk, dan merekap absensi secara manual ke spreadsheet terpisah. Proses manual ini rentan terhadap kesalahan penomoran surat (*human error*) dan lambatnya koordinasi data.
* **Solusi Otomatisasi:** SI-Sekretariat memangkas birokrasi ini dengan mengotomatisasi pembuatan dokumen Google Docs melalui API dalam waktu < 5 detik. Data absensi dan evaluasi disinkronkan secara real-time dari Google Sheets ke dashboard aplikasi menggunakan driver database *in-memory* SQLite.
* **Dampak Nyata:** Menghemat waktu administrasi hingga 90%, menghilangkan konflik penomoran surat resmi, dan menyediakan satu sumber data terpusat (*single source of truth*) yang mudah diakses oleh seluruh pengurus.

---

## 🛠️ Tech Stack & Arsitektur

* **Core Backend:** PHP 8.2 & Laravel 12.0 (MVC Architecture)
* **Primary Database:** PostgreSQL (Hosted on Supabase) - untuk data kredensial, role user, log persuratan, dan settings.
* **Dynamic In-Memory Database:** SQLite via **Laravel Sushi** - untuk memetakan data Google Sheets langsung menjadi Eloquent Model queryable (`SesiPresensi`, `Evaluasi`, `BeritaAcara`) secara real-time.
* **Cloud API Integration:** Google Sheets API v4, Google Docs API, Google Drive API (OAuth 2.0 Refresh Token Flow).
* **Frontend Pipeline:** Blade Templates, Tailwind CSS v4.0, Vite 7.0.
* **Deployment Adaptations:** Konfigurasi serverless di Vercel dengan optimasi penyimpanan sementara `/tmp` untuk file cache, session, dan compiled views (read-only filesystem workaround).

---

## 📊 Rancangan Infrastruktur

```mermaid
graph TD
    User([User / Pengurus]) -->|Interaksi UI| Frontend[Vite + Tailwind CSS v4]
    Frontend -->|HTTP Request| Laravel[Laravel 12 Engine]
    Laravel -->|SQL Query| Supabase[(Supabase PostgreSQL)]
    Laravel -->|Google OAuth2| GoogleCloud[Google Cloud Platform]
    GoogleCloud -->|Drive & Docs API| Docs[Document Automation]
    GoogleCloud -->|Sheets API v4| Sheets[Google Sheets Database]
    Sheets -->|API Read| Sushi[Laravel Sushi In-Memory SQLite]
    Sushi -->|Eloquent Model| Laravel
```

---

## ✨ Fitur Utama

1. **Otomatisasi Notulensi & Evaluasi:** Menyalin template Google Docs, mengelompokkannya ke dalam folder Drive yang sesuai, dan mengganti *placeholder text* (seperti `[Nama Kegiatan]`, `[JUDUL SYURO]`) secara otomatis via Batch Update API.
2. **Arsip & Manajemen Surat:** Perekaman nomor surat keluar, perihal, lampiran link drive, serta logging surat masuk secara terpusat untuk mencegah duplikasi penomoran.
3. **Presensi Kehadiran Terintegrasi:** Rekapitulasi absensi rapat atau acara langsung tersinkronisasi ke Google Sheets utama yang terintegrasi dengan model Sushi untuk diekspor kembali dalam format PDF.
4. **Role-Based Access Control (RBAC):** Pembagian hak akses antara *Superadmin* (Biro Kesekretariatan) untuk kendali penuh dan *Admin Unit/Fakultas* untuk mengelola data unit mereka masing-masing.

---

## ⚙️ Cara Setup Lokal

1. **Clone Repositori:**
   ```bash
   git clone https://github.com/username/si-sekretariat-portfolio.git
   cd si-sekretariat-portfolio
   ```

2. **Install Dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment:**
   Salin `.env.example` menjadi `.env` dan sesuaikan konfigurasinya:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Lengkapi variabel `DB_*` menggunakan PostgreSQL lokal atau cloud, serta `GOOGLE_*` dengan kredensial Google Cloud Console milik Anda.

4. **Migrate & Seed Database:**
   Jalankan migrasi database beserta data dummy yang telah disanitasi:
   ```bash
   php artisan migrate --seed
   ```
   *(Data login default akan otomatis dibuat menggunakan data contoh yang aman di `UserSeeder.php`)*

5. **Jalankan Aplikasi:**
   ```bash
   npm run dev
   ```
