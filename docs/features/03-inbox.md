# Fitur 03 — Inbox

## Ringkasan

Kotak pesan notifikasi untuk pengajar. Menampilkan pesan sistem (konfirmasi badal, waiting list, dll.). Pesan baru ditandai `status = off` dan ditampilkan sebagai badge di sidebar.

## File Terkait

| Tipe | Path |
|------|------|
| Controller | `application/controllers/Inbox.php` |
| Model | `application/models/Civitas_model.php`, `Main_model.php` |
| View | `application/views/page/inbox.php` |
| Template | `application/views/templates/header.php` |

## Route / Endpoint

| Method | URL | Controller Method |
|--------|-----|-------------------|
| GET | `/inbox` | `Inbox::index()` |
| GET | `/inbox/delete_inbox/{id}` | `Inbox::delete_inbox($id)` |

## Alur Utama

### Buka Inbox
1. User membuka `/inbox`
2. Semua pesan pengajar di-update: `status = 'on'` (ditandai sudah dibaca)
3. Daftar pesan di-load urut `tgl_inbox DESC`
4. Badge unread di sidebar menjadi 0

### Hapus Pesan
1. User klik ikon trash
2. Konfirmasi JavaScript
3. `Main_model::delete_data('inbox', ['id_inbox' => $id])`
4. Redirect back dengan flash message

## Tabel Database: `inbox`

| Kolom | Keterangan |
|-------|------------|
| `id_inbox` | Primary key |
| `nip` | Penerima pesan |
| `judul` | Judul pesan |
| `inbox` | Isi pesan (HTML allowed) |
| `tgl_inbox` | Tanggal |
| `status` | `off` = belum dibaca, `on` = sudah dibaca |

## Query

| Method | Filter |
|--------|--------|
| `get_all_inbox($nip)` | Semua pesan user |
| `get_all_inbox_off($nip)` | `status = 'off'` (untuk badge) |

## Variabel View

| Variable | Isi |
|----------|-----|
| `$inbox` | Array pesan |
| `$jml_inbox` | Count unread (sebelum mark-as-read) |
| `$jml_wl`, `$jml_kelas`, `$jml_badal`, `$jml` | Sidebar |

## Siapa yang Menulis ke Inbox?

**Tidak ada logic insert inbox di controller pengajar ini.** Pesan kemungkinan dibuat oleh:
- Sistem admin terpisah (tidak ada di repo)
- Trigger/proses backend lain

Saat mengambil WL atau mengajukan badal, flash message memberitahu user "cek inbox" — implikasi ada proses eksternal yang mengisi tabel `inbox`.

## Perbedaan dengan Kesediaan

`Kesediaan::index()` juga memanggil `edit_status_inbox()` (mark all read) — duplikasi behavior dengan Inbox.

## Tugas Umum untuk Developer

| Tugas | Petunjuk |
|-------|----------|
| Tambah notifikasi dari fitur X | Insert ke `inbox` dengan `status='off'` |
| Real-time unread count | AJAX poll `get_all_inbox_off` |
| Soft delete | Tambah kolom `deleted_at`, jangan hard delete |

## Testing Manual

1. Pastikan ada record `inbox` dengan `nip` user dan `status='off'`
2. Badge sidebar > 0 sebelum buka inbox
3. Buka `/inbox` → badge hilang, `status` jadi `on` di DB
4. Hapus pesan → record terhapus
