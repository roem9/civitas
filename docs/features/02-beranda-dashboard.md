# Fitur 02 — Beranda (Dashboard)

## Ringkasan

Halaman utama setelah login. Menampilkan ringkasan profil pengajar, statistik KBM bulan berjalan, jumlah badal/dibadal, dan total honor.

## File Terkait

| Tipe | Path |
|------|------|
| Controller | `application/controllers/Home.php` |
| Model | `application/models/Civitas_model.php`, `Main_model.php` |
| View | `application/views/page/beranda.php` |
| Template | `application/views/templates/header.php` |

## Route / Endpoint

| Method | URL | Controller Method |
|--------|-----|-------------------|
| GET | `/` atau `/home` | `Home::index()` |
| POST | `/home/get_detail_golongan` | `Home::get_detail_golongan()` (AJAX) |
| POST | `/home/get_detail_ot` | `Home::get_detail_ot()` (AJAX) |

## Data yang Ditampilkan

### Kartu Profil
- Nama, NIK, golongan
- Modal detail profil (read-only, link ke pengaturan profil)

### Kartu KBM Bulan Ini
- Jumlah kelas aktif
- Jumlah KBM (bukan badal)
- Jumlah badal (sebagai pengganti)
- Jumlah dibadal (KBM pengajar sendiri yang digantikan orang lain)

### Kartu Honor
- `honor_kbm + honor_badal` (format Rupiah)
- Alert: OT dinonaktifkan selama pandemi

## Variabel View Utama

| Variable | Sumber | Keterangan |
|----------|--------|------------|
| `$kpq` | `Civitas_model::get_data_kpq()` | Data profil |
| `$kelas` | COUNT kelas aktif | Jumlah kelas |
| `$kbm` | `get_kbm_now()` | KBM bulan ini (non-badal) |
| `$badal` | `get_badal_now()` | KBM sebagai pembadal |
| `$dibadal` | `get_dibadal_now()` | KBM sendiri yang dibadal |
| `$honor_kbm` | SUM `biaya` dari `$kbm` | |
| `$honor_badal` | SUM `biaya` dari `$badal` | |
| `$bulan` | Array 1–12 nama bulan ID | |
| `$jml`, `$jml_*` | Sidebar counters | Sama seperti halaman lain |

## Perhitungan OT (Internal)

`Home::ot($gol, $kbm, $oot)` menghitung honor OT berdasarkan:
- `$gol`: golongan (`E` = karyawan, tarif lebih tinggi)
- `$kbm`: jumlah KBM (1–5)
- `$oot`: level OT jadwal (1, 2, atau 3)

OT dijumlahkan ke `$data['ot']` di controller, tetapi **tidak ditampilkan** di view beranda saat ini (hanya honor KBM+badal).

## Endpoint AJAX

### `get_detail_golongan`
- **Input POST:** `id` (kode golongan)
- **Output:** JSON array dari tabel `golongan`

### `get_detail_ot`
- **Input POST:** `id` (golongan)
- **Output:** JSON struktur honor OT hardcoded di `Civitas_model::get_detail_ot()`

## Alur Load Halaman

```
Home::index()
  → ambil NIP dari session
  → hitung sidebar counters
  → hitung jadwal per hari
  → loop jadwal: hitung OT
  → loop badal: tambah OT
  → load header + beranda + footer
```

## Sidebar

File `header.php` membutuhkan variabel counter. `Home::index()` mengisi semuanya.

## Tugas Umum untuk Developer

| Tugas | Petunjuk |
|-------|----------|
| Tampilkan honor OT lagi | Edit `beranda.php`, gunakan `$ot` dari controller |
| Ubah periode (bukan bulan ini) | Ubah filter di `get_kbm_now()` dll. atau tambah parameter |
| Dashboard chart | Tambah library chart di view, endpoint data baru |

## Testing Manual

1. Login → land di beranda
2. Verifikasi angka KBM/badal sesuai data DB bulan berjalan
3. Klik "detail" profil → modal terbuka
4. Honor = jumlah `biaya` semua KBM + badal bulan ini
