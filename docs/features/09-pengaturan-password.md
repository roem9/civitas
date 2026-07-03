# Fitur 09 — Pengaturan Password

## Ringkasan

Pengajar mengganti password login. Validasi: password baru dan konfirmasi harus sama.

## File Terkait

| Tipe | Path |
|------|------|
| Controller | `application/controllers/Pengaturan.php` |
| Model | `Main_model.php` |
| View | `application/views/page/pengaturan.php` |
| Template | `application/views/templates/header.php` |

## Route / Endpoint

| Method | URL | Method |
|--------|-----|--------|
| GET | `/pengaturan/password` | `password()` |
| POST | `/pengaturan/edit_password` | `edit_password()` |

## Form Fields

| Field | Name | Type |
|-------|------|------|
| Password baru | `pass1` | password |
| Konfirmasi | `pass2` | password |

## Logic (`edit_password`)

```php
if ($pass1 === $pass2) {
    Main_model::edit_data('admin', ['id_admin' => $nip], ['password' => $pass1]);
} else {
    // flash error: password tidak sama
}
```

## Tabel Database: `admin`

| Kolom | Keterangan |
|-------|------------|
| `id_admin` | Sama dengan NIP (`kpq.nip`) |
| `password` | **Plain text** (legacy) |
| `level` | `kpq` untuk pengajar |

## Keamanan — Catatan Penting

1. Password **tidak di-hash** — risiko keamanan serius
2. Tidak ada verifikasi password lama sebelum ganti
3. Tidak ada policy kompleksitas password
4. Tidak ada CSRF protection

### Rekomendasi Refactor

```php
// Saat simpan
'password' => password_hash($pass1, PASSWORD_DEFAULT)

// Saat login (Login_model)
password_verify($input, $stored_hash)
```

## UX

- Konfirmasi JS: "Yakin akan mengubah password Anda?"
- Flash success / warning / danger
- Menu sidebar `#password` active

## Variabel View (`password()`)

Hanya sidebar counters — tidak ada data khusus selain flash.

## Tugas Umum untuk Developer

| Tugas | Petunjuk |
|-------|----------|
| Implement hash | Ubah `edit_password` + `cek_login` + migrasi data |
| Wajib password lama | Tambah field `pass_lama`, verifikasi dulu |
| Reset via email | Fitur baru, tidak ada di codebase |

## Testing Manual

1. `/pengaturan/password` — form tampil
2. pass1 ≠ pass2 → error flash
3. pass1 = pass2 → `admin.password` berubah di DB
4. Logout → login dengan password baru → berhasil
