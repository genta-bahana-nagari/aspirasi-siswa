
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

---

## 📁 Struktur Folder
```
aspirasi-siswa/
│
├── config/
│ └── db.php
│
├── auth/
│ ├── login.php
│ ├── register.php
│ └── logout.php
│
├── pages/
│ ├── admin/
│ │   ├──index.php ==> Dashboard Utama
│ │   ├──aspirasi/...
│ │   ├──kategori/...
│ │   ├──feedback/...
│ │   └──pengguna/...
│ │
│ └── siswa/
│     ├──index.php ==> Dashboard Utama
│     ├──aspirasi/...
│     └──histori/...
│  
├── assets/
│ ├── css/
│ └── js/
│
└── README.md
```