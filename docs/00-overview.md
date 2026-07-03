# Overview Proyek Civitas

## Apa Ini?

**Civitas** adalah portal web untuk **pengajar KPQ** (Kepengajian Qur'an) di **LKP TAR-Q**. Pengajar login, melihat jadwal mengajar, mencatat KBM (Kegiatan Belajar Mengajar), mengajukan/melakukan badal (penggantian), mengambil kelas dari waiting list, dan mengelola profil.

Repo: `roem9/civitas`

## Tech Stack

| Layer | Teknologi |
|-------|-----------|
| Backend | PHP, CodeIgniter 3 |
| Database | MySQL |
| Frontend | Bootstrap 4, jQuery, Font Awesome |
| Pola | MVC |

## Struktur Direktori Penting

```
/workspace/
├── index.php                 # Entry point CI3
├── application/
│   ├── controllers/          # Logic per modul
│   ├── models/               # Akses database
│   └── views/
│       ├── templates/        # Header, footer, sidebar
│       ├── login/
│       └── page/             # Konten halaman
├── assets/                   # CSS, JS, gambar
└── system/                   # Core CodeIgniter (jangan edit)
```

## Routing (CodeIgniter Default)

CI3 memakai routing `controller/method/parameter`. Contoh:

- `login` → `Login::index()`
- `home` → `Home::index()`
- `kelas/hari/senin` → `Kelas::hari('senin')`
- `kelas/ambil_wl/123` → `Kelas::ambil_wl(123)`

Default controller kemungkinan `home` atau `login` (tergantung config yang tidak di-commit).

## Autentikasi Global

Semua controller kecuali `Login` dan `Welcome` memeriksa session di `__construct()`:

```php
if ($this->session->userdata('status') != "login" || empty($this->session->userdata('id'))) {
    $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
    redirect(base_url("login"));
}
```

### Data Session Setelah Login

| Key | Isi | Keterangan |
|-----|-----|------------|
| `id` | NIP pengajar | Primary identifier |
| `status` | `"login"` | Flag autentikasi |
| `gol` | Golongan (A–E) | Untuk perhitungan honor/OT |
| `jk` | Jenis kelamin | Filter waiting list |

## Tipe Kelas

| Kode | Nama | Sumber Data |
|------|------|-------------|
| `R` | Reguler | View/tabel `kelas_reguler` |
| `PK` | PV Khusus (privat khusus) | `kelas_pv_khusus` + `jadwal` |
| `PL` | PV Luar (privat luar) | `kelas_pv_luar` + `jadwal` |

## Konsep Bisnis Utama

### KBM
Rekaman kegiatan mengajar di tanggal tertentu. Disimpan di tabel `kbm` dengan presensi di `presensi_peserta`.

### Badal
Penggantian mengajar: pengajar A mengajukan, pengajar B (`nip_badal`) menggantikan. Relasi di `kbm_badal`.

### Waiting List (WL)
Kelas tanpa pengajar (`kelas.status = 'wl'`). Pengajar bisa mengambil → status `konfirm` → konfirmasi via inbox.

### Honor
Dihitung dari `golongan` × `tipe_kelas`. Field `biaya` di `kbm` diisi saat add KBM atau rekap badal.

### OT (Overtime)
Honor tambahan berdasarkan jumlah KBM per jadwal dan level OT jadwal. Saat ini UI menampilkan peringatan bahwa OT dinonaktifkan selama pandemi.

## Pola Kode yang Sering Muncul

### Flash Message
```php
$this->session->set_flashdata('pesan', '<div class="alert alert-success">...</div>');
redirect($_SERVER['HTTP_REFERER']);
```

### Sidebar Counter
Hampir setiap halaman menghitung dan mengirim ke view:
- `$jml_wl`, `$jml_kelas`, `$jml_badal`, `$jml_inbox`
- `$jml['senin']` … `$jml['ahad']`

### AJAX Endpoint
Controller method POST → `echo json_encode($data);`

## Model Layer

| Model | Peran |
|-------|-------|
| `Main_model` | CRUD generik (`add_data`, `get_one`, `get_all`, `edit_data`, `delete_data`) |
| `Civitas_model` | Query kompleks KPQ: jadwal, KBM, badal, inbox, WL |
| `Login_model` | Autentikasi |

## Yang Tidak Ada di Repo Ini

- Panel admin pusat
- `application/config/` (database, routes, autoload)
- Migrasi SQL / schema dump
- Unit test

## Untuk Agent: Urutan Debug Umum

1. Cek session login
2. Cek NIP di session vs query database
3. Cek filter bulan/tahun (`date('m')`, `date('Y')`) — banyak query hanya bulan berjalan
4. Cek status record (`aktif`, `wl`, `konfirm`, `on`/`off`)
5. Trace dari view → controller → model
