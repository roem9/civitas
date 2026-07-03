# Dokumentasi Fitur — Civitas (LKP TAR-Q)

Dokumentasi ini ditujukan untuk **programmer** atau **AI agent** yang perlu memahami, memperbaiki, atau mengembangkan fitur tanpa membaca seluruh codebase.

## Cara Membaca

1. Baca [00-overview.md](00-overview.md) terlebih dahulu untuk konteks proyek, stack, dan konvensi umum.
2. Buka file fitur yang relevan di folder `features/`.
3. Setiap file fitur berisi: ringkasan, file terkait, route/endpoint, alur bisnis, tabel database, dan catatan untuk developer.

## Daftar Fitur

| No | Fitur | File |
|----|-------|------|
| 1 | Autentikasi & Login | [features/01-autentikasi-login.md](features/01-autentikasi-login.md) |
| 2 | Beranda (Dashboard) | [features/02-beranda-dashboard.md](features/02-beranda-dashboard.md) |
| 3 | Inbox | [features/03-inbox.md](features/03-inbox.md) |
| 4 | Jadwal KBM | [features/04-jadwal-kbm.md](features/04-jadwal-kbm.md) |
| 5 | Jadwal Badal | [features/05-jadwal-badal.md](features/05-jadwal-badal.md) |
| 6 | Waiting List | [features/06-waiting-list.md](features/06-waiting-list.md) |
| 7 | Kesediaan Mengajar | [features/07-kesediaan-mengajar.md](features/07-kesediaan-mengajar.md) |
| 8 | Pengaturan Profil | [features/08-pengaturan-profil.md](features/08-pengaturan-profil.md) |
| 9 | Pengaturan Password | [features/09-pengaturan-password.md](features/09-pengaturan-password.md) |

## Referensi Tambahan

| Topik | File |
|-------|------|
| Model & database bersama | [10-shared-models-database.md](10-shared-models-database.md) |
| Template UI & sidebar | [11-template-ui.md](11-template-ui.md) |

## Quick Reference — File Utama

```
application/
├── controllers/
│   ├── Login.php
│   ├── Home.php
│   ├── Kelas.php
│   ├── Inbox.php
│   ├── Kesediaan.php
│   └── Pengaturan.php
├── models/
│   ├── Login_model.php
│   ├── Civitas_model.php
│   └── Main_model.php
└── views/
    ├── templates/header.php      # Sidebar + layout utama
    ├── templates/header-login.php
    ├── login/login.php
    └── page/                     # Halaman per fitur
```

## Catatan untuk Agent

- Framework: **CodeIgniter 3** (bukan CI4).
- Semua halaman kecuali login memerlukan session `status = login` dan `id` (NIP).
- `application/config/` **tidak ada di repo** — konfigurasi database harus disiapkan di environment deploy.
- Password disimpan **plain text** di tabel `admin` (legacy).
- Gunakan `Main_model` untuk CRUD generik; `Civitas_model` untuk logika bisnis KPQ.
