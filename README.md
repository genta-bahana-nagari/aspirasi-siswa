
# Pengaduan Sarana Sekolah

## 📌 Deskripsi Proyek
**Pengaduan Sarana Sekolah** adalah aplikasi berbasis web yang digunakan untuk menampung, mengelola, dan menindaklanjuti pengaduan atau aspirasi siswa terkait sarana dan prasarana sekolah.  
Aplikasi ini bertujuan untuk meningkatkan transparansi, efektivitas, dan komunikasi antara siswa dan pihak sekolah.

### Catatan:
- *Proyek ini hanya untuk mentoring, namun anda juga boleh mencobanya sendiri.*
- *Jangan hiraukan branch development. Cukup main saja.*

---

## 🎯 Tujuan
- Menyediakan media resmi pengaduan siswa
- Mempermudah pihak sekolah dalam mengelola laporan
- Meningkatkan kualitas sarana dan prasarana sekolah
- Mencatat status tindak lanjut pengaduan secara sistematis

---

## 🧩 Fitur Utama
- 🔐 Autentikasi pengguna (Login & Register)
- 📝 Pengajuan pengaduan/aspirasi
- 🗂️ Kategori pengaduan
- 📊 Status pengaduan:
  - Terkirim
  - Diproses
  - Dalam Perbaikan
  - Selesai
- 👤 Manajemen sesi pengguna
- 🚪 Logout sistem

---

## 🛠️ Teknologi yang Digunakan
- **Frontend**: HTML, CSS, Bootstrap
- **Backend**: PHP (Native)
- **Database**: MySQL / MariaDB
- **Web Server**: Apache (XAMPP / Laragon)
- **Version Control**: Git

### Catatan:
- *Kalau kamu ingin mendownload proyek ini di Windows dan akan mengujinya dengan Laragon atau XAMPP, pastikan anda taruh di:*

*C:\laragon\www\aspirasi-siswa*

---

## 📁 Struktur Folder
```
aspirasi-siswa/
│
├── auth/
│   ├── login.php               # Halaman login
│   ├── register.php            # Halaman registrasi
│   └── logout.php              # Logout
│
├── config/
│   └── db.php                  # Konfigurasi database
│   └── app.php                 # Konfigurasi dasar aplikasi (untuk navigasi)
│
├── includes/
│   └── auth_check.php          # Konfigurasi autentikasi
│   └── footer.php              # Footer
│   └── header.php              # Header
│   └── sidebar.php             # Sidebar
│
├── pages/
│   ├── admin/                  # Halaman dan modul admin
│   │   ├── index.php           # Dashboard utama admin
│   │   │
│   │   ├── aspirasi/           # Modul Aspirasi
│   │   │   ├── index.php
│   │   │   ├── create.php
│   │   │   └── edit.php
│   │   │
│   │   ├── kategori/           # Modul Kategori
│   │   │   ├── index.php
│   │   │   ├── create.php
│   │   │   └── edit.php
│   │   │
│   │   ├── feedback/           # Modul Feedback (opsional)
│   │   │   └── ...
│   │   │
│   │   └── pengguna/           # Modul Pengguna / Siswa
│   │       ├── index.php
│   │       ├── create.php
│   │       └── edit.php
│   │
│   └── siswa/                  # Halaman dan modul siswa
│       ├── index.php           # Dashboard utama siswa
│       │
│       ├── aspirasi/           # Modul Aspirasi siswa
│       │   ├── index.php
│       │   ├── create.php
│       │   └── edit.php
│       │
│       └── histori/            # Riwayat aspirasi siswa
│           └── index.php
│
├── assets/                     # File statis
│   ├── css/
│   │   └── style.css
│   │
│   └── js/
│       └── script.js
│
└── README.md
```