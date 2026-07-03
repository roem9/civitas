# Template UI & Sidebar

Dokumen referensi layout bersama yang dipakai semua halaman setelah login.

## File Template

| File | Fungsi |
|------|--------|
| `application/views/templates/header.php` | Sidebar, navbar, `<head>`, buka `<body>` |
| `application/views/templates/footer.php` | Tutup layout, script sidebar toggle |
| `application/views/templates/header-login.php` | Header minimal untuk halaman login |
| `assets/css/style.css`, `style3.css` | Custom styling |
| `assets/js/script.js` | Sidebar collapse, overlay |

## Layout Structure

```
┌─────────────────────────────────────────┐
│ #sidebar (nav)                          │
│  - Beranda                              │
│  - Inbox [badge]                        │
│  - Jadwal KBM [badge]                   │
│    └ sub-menu per hari                  │
│  - Jadwal Badal [badge]                 │
│  - Waiting List [badge]                 │
│  - Kesediaan Mengajar                   │
│  - Pengaturan Profil                    │
│  - Pengaturan Password                  │
│  - Keluar                               │
├─────────────────────────────────────────┤
│ #content                                │
│  navbar sticky (title)                  │
│  ─────────────────────                  │
│  [page content dari views/page/*.php]   │
└─────────────────────────────────────────┘
```

## Variabel Wajib untuk `header.php`

Setiap controller yang load `header` **harus** mengisi:

| Variable | Tipe | Keterangan |
|----------|------|------------|
| `$title` | string | Judul halaman di navbar |
| `$jml_inbox` | int | Badge inbox unread |
| `$jml_kelas` | int | Total jadwal aktif |
| `$jml_badal` | int | Jadwal badal aktif |
| `$jml_wl` | int | Waiting list tersedia |
| `$jml` | array | Count per hari: senin, selasa, … ahad |

### Contoh Inisialisasi (dari controller)

```php
$data['jml_wl'] = COUNT($this->Civitas_model->get_all_wl());
$data['jml_kelas'] = COUNT($this->Civitas_model->get_all_jadwal_kpq($nip));
$data['jml_badal'] = COUNT($this->Civitas_model->get_all_jadwal_badal_kpq($nip));
$data['jml_inbox'] = COUNT($this->Civitas_model->get_all_inbox_off($nip));
$data['jml'] = [
    "senin" => COUNT($this->Civitas_model->get_jadwal_hari_kpq($nip, 'senin')),
    // ... semua hari
];
```

**Jika variable tidak di-set → PHP notice/error di sidebar.**

## Menu Sidebar — ID untuk Active State

Setiap halaman men-set class `active` via jQuery di bagian bawah view:

| Halaman | Script |
|---------|--------|
| Beranda | `$("#beranda").addClass("active")` |
| Inbox | `$("#inbox").addClass("active")` |
| Jadwal KBM | `$("#kelasku").addClass("active")` |
| Jadwal Badal | `$("#jadwal_badal").addClass("active")` |
| Waiting List | `$("#wl").addClass("active")` |
| Kesediaan | `$("#kesediaan").addClass("active")` |
| Profil | `$("#profil").addClass("active")` |
| Password | `$("#password").addClass("active")` |

## Sub-menu Hari

Hanya hari dengan `$jml['hari'] != 0` yang ditampilkan di sidebar.

Link format: `base_url()?>kelas/hari/{hari}` — lowercase (senin, ahad, dll.)

## Flash Messages

Pattern standar di views:

```php
<?php if ($this->session->flashdata('pesan')) : ?>
    <?= $this->session->flashdata('pesan'); ?>
<?php endif; ?>
```

Flash berisi HTML alert Bootstrap lengkap (di-set di controller).

Key flash yang dipakai:
- `pesan` — notifikasi umum (success/warning/danger)
- `login` — pesan redirect karena belum login

## Helper Rupiah

Didefinisikan di `header.php`:

```php
function rupiah($angka) {
    return "Rp " . number_format($angka, 0, ',', '.');
}
```

Hanya tersedia setelah header di-load.

## Library Frontend

| Library | Sumber |
|---------|--------|
| Bootstrap 4.4.1 | CDN |
| jQuery 3.4.1 | CDN |
| Font Awesome | Local `assets/css/fontawesome-free/` |
| mCustomScrollbar | CDN |

## Pola Modal (umum di fitur KBM)

1. Tombol dengan `data-id` berisi string pipe-separated: `id_kelas|id_jadwal|nama|...`
2. Click handler parse `data-id`
3. AJAX load data ke modal
4. Form POST ke controller

## Pola Konfirmasi

```html
onclick="return confirm('Yakin akan ...?')"
```

Dipakai untuk: logout, hapus inbox, ambil/batalkan WL, simpan profil/password.

## Menambah Menu Sidebar Baru

1. Tambah link di `header.php` dengan `id` unik
2. Set `$title` di controller baru
3. Pastikan semua counter sidebar diisi (copy dari controller lain)
4. Di view baru: `$("#menu-id").addClass("active")`

## Favicon & Branding

- Logo: `assets/img/logo-tarq.jpg`
- Aplikasi untuk LKP TAR-Q (Tilawah Al-Qur'an)

## Mobile

Viewport meta disable user scaling:
```html
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
```

Sidebar collapsible via `#sidebarCollapse` button.
