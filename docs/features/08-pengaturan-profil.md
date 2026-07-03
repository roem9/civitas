# Fitur 08 — Pengaturan Profil

## Ringkasan

Pengajar mengubah data profil pribadi yang boleh diedit. Nama dan NIK read-only.

## File Terkait

| Tipe | Path |
|------|------|
| Controller | `application/controllers/Pengaturan.php` |
| Model | `Main_model.php` |
| View | `application/views/page/profil.php` |
| Template | `application/views/templates/header.php` |

## Route / Endpoint

| Method | URL | Method |
|--------|-----|--------|
| GET | `/pengaturan/profil` | `profil()` |
| POST | `/pengaturan/edit_kpq` | `edit_kpq()` |

## Field Form

| Field | Name | Editable | Required |
|-------|------|----------|----------|
| Nama Lengkap | `nama` | ❌ readonly | — |
| NIK | — (display only) | ❌ | — |
| Tempat Lahir | `t4_lahir` | ✅ | ✅ |
| Tanggal Lahir | `tgl_lahir` | ✅ | ✅ |
| No. HP | `no_hp` | ✅ max 13 | ✅ |
| Alamat | `alamat` | ✅ | ✅ |
| Pendidikan | `pendidikan` | ✅ select | ✅ |
| Jurusan | `jurusan` | ✅ | ✅ |
| No. KTP | `no_ktp` | ✅ | ✅ |
| Tgl Bergabung | `tgl_masuk` | ✅ | ✅ |

### Opsi Pendidikan
SMA/Sederajat, DI, DII, DIII, S1, S2, S3

## Update Logic (`edit_kpq`)

```php
$data = [
    't4_lahir', 'tgl_lahir', 'no_hp', 'alamat',
    'tgl_masuk', 'pendidikan', 'jurusan', 'no_ktp'
];
Main_model::edit_data('kpq', ['nip' => $nip], $data);
```

- Success jika `affected_rows > 0`
- Warning jika tidak ada perubahan

## Tabel Database: `kpq`

Kolom yang diupdate tercantum di atas. Kolom lain (`nama_kpq`, `golongan`, `jk`, dll.) tidak bisa diubah dari fitur ini.

## UX

- Konfirmasi JavaScript sebelum submit: "Yakin akan mengubah data profil Anda?"
- Flash message setelah redirect
- Sidebar menu `#profil` di-set active via JS

## Variabel View

| Variable | Sumber |
|----------|--------|
| `$kpq` | `Main_model::get_one('kpq', ['nip' => $nip])` |

## Relasi dengan Beranda

Modal profil di beranda menampilkan data read-only yang sama, dengan link ke halaman ini untuk edit.

## Tugas Umum untuk Developer

| Tugas | Petunjuk |
|-------|----------|
| Validasi no HP format | Tambah di controller atau form_validation CI3 |
| Upload foto profil | Kolom baru + form enctype multipart |
| Audit log perubahan | Tabel history + hook setelah update |

## Testing Manual

1. `/pengaturan/profil` — data load benar
2. Edit field → simpan → DB updated
3. Submit tanpa perubahan → warning flash
4. Nama/NIK tidak berubah meski dimanipulasi di HTML
