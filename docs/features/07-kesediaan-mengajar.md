# Fitur 07 — Kesediaan Mengajar

## Ringkasan

Pengajar menyatakan slot waktu (hari + jam) yang bersedia mengajar. Data disimpan di tabel `kesediaan` dengan pola **replace all** (hapus semua lalu insert ulang).

## File Terkait

| Tipe | Path |
|------|------|
| Controller | `application/controllers/Kesediaan.php` |
| Model | `application/models/Civitas_model.php`, `Main_model.php` |
| View | `application/views/page/kesediaan.php` |
| Template | `application/views/templates/header.php` |

## Route / Endpoint

| Method | URL | Method |
|--------|-----|--------|
| GET | `/kesediaan` | `index()` |
| POST | `/kesediaan/add_kesediaan` | `add_kesediaan()` |

> Duplikat endpoint juga ada di `Pengaturan::add_kesediaan()` — kemungkinan legacy, gunakan yang di `Kesediaan`.

## Alur Halaman

### `index()`
1. Mark inbox as read: `Civitas_model::edit_status_inbox($nip)` (legacy)
2. Load kesediaan existing: `get_all_kesediaan($nip)`
3. Format ke array string `"hari jam"` untuk checkbox checked state
4. Render form checkbox per hari

### `add_kesediaan()`
1. `DELETE FROM kesediaan WHERE nip = :nip`
2. Loop `$_POST['sedia']` — format value: `"hari|jam"` (contoh: `senin|07.00`)
3. Insert tiap slot ke `kesediaan`
4. Flash success/warning jika kosong

## Format Checkbox

```html
<input type="checkbox" name="sedia[]" value="senin|07.00">
```

Helper PHP `sedia($str, $sedia)` di view mengecek apakah slot sudah dipilih.

## Slot Waktu per Hari

Setiap hari (Ahad–Sabtu) memiliki slot:
- 07.00, 08.30, 10.00, 13.00, 15.30, 17.00

Beberapa slot menampilkan label OT:
- 07.00 → OT: 60
- 17.00 → OT: 90

(Hanya informasi UI, tidak disimpan ke DB)

## Tabel Database: `kesediaan`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `nip` | string | NIP pengajar |
| `hari` | string | senin, selasa, … ahad (lowercase) |
| `jam` | string | Contoh: `07.00` |

Tidak ada primary key eksplisit di kode — kombinasi nip+hari+jam.

## Variabel View

| Variable | Isi |
|----------|-----|
| `$sedia` | Array string `"hari jam"` untuk checked state |
| Sidebar counters | Standard |

## Bug / Duplikasi di Codebase

`Pengaturan::add_kesediaan()` memiliki bug:
```php
$kesediaan = [...];
$result = $this->Main_model->add_data("kesediaan", $data); // $data salah, harus $kesediaan
```
Gunakan `Kesediaan::add_kesediaan()` sebagai referensi yang benar.

## Tugas Umum untuk Developer

| Tugas | Petunjuk |
|-------|----------|
| Tambah slot jam baru | Edit `kesediaan.php` + dokumentasi |
| Validasi minimal 1 slot | Sudah ada warning flash |
| Tampilkan kesediaan di admin | Endpoint API baru dari `get_all_kesediaan` |
| Hapus duplikat Pengaturan | Hapus method di `Pengaturan.php` |

## Testing Manual

1. `/kesediaan` — checkbox tercentang sesuai DB
2. Ubah pilihan → simpan → DB ter-replace
3. Kosongkan semua → warning flash, tabel kosong untuk NIP tersebut
