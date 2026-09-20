# Planning: Portofolio Desain Interior — Laravel 11

Referensi desain: https://www.andramatin.com/ (minimalis, grid foto full-bleed, whitespace luas, transisi halus antar halaman)

---

## 1. Tech Stack

| Komponen | Pilihan | Alasan |
|---|---|---|
| Framework | Laravel 11 (Blade) | Sesuai request |
| Build tool | Vite (bawaan Laravel 11) | Sudah terintegrasi |
| Interaktivitas | Livewire 3 | `wire:navigate` untuk transisi antar halaman ala SPA |
| Micro-interaction | Alpine.js | Auto ter-include lewat Livewire, JANGAN install manual via npm (bentrok double-load) |
| Animasi scroll | AOS (Animate On Scroll) atau GSAP | Reveal animation di halaman Proyek & Profil |
| Database | SQLite (commit ke repo) | Ringan, kompatibel dengan constraint deploy Vercel tanpa DB server terpisah |
| Sumber gambar dev | Unsplash API | Placeholder foto interior sebelum ada foto asli klien |
| Deployment | Vercel (via runtime PHP komunitas) — fallback Railway Hobby $5/bln kalau bermasalah | Sesuai request awal |

**Catatan status project:** tanpa CMS/admin panel dulu (fase ini). Update konten proyek dilakukan lewat edit seeder + redeploy, bukan form admin. CMS bisa jadi fase 2 kalau klien butuh update mandiri.

---

## 2. Instalasi Awal

```bash
composer create-project laravel/laravel portofolio-interior "11.*"
cd portofolio-interior

# Livewire — WAJIB install manual
composer require livewire/livewire

# Alpine.js TIDAK PERLU diinstall terpisah — sudah otomatis ikut lewat Livewire assets.
# Jangan npm install alpinejs, akan bentrok double-load.

# AOS untuk scroll animation
npm install aos

# Konfigurasi SQLite
touch database/database.sqlite
```

Di `.env`:
```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite
```

Layout utama (`resources/views/layouts/app.blade.php`) wajib load:
```blade
@livewireStyles
...
@vite(['resources/css/app.css', 'resources/js/app.js'])
...
@livewireScripts
```

---

## 3. Struktur Navbar & Halaman

| Menu | Route | Komponen Livewire | Isi |
|---|---|---|---|
| Home | `/` | `Home` | Hero grid foto proyek, gaya andramatin.com |
| Profil | `/profil` | `Profile` | Bio, filosofi desain, foto profil |
| Pengalaman Kerja | `/pengalaman` | `Experience` | Timeline karier, klien, penghargaan |
| Proyek | `/proyek` | `ProjectIndex` | Grid galeri proyek |
| Proyek Detail | `/proyek/{slug}` | `ProjectShow` | Galeri media (gambar/video) per proyek |
| Hubungi | `/hubungi` | `Contact` | Info kontak + form pesan |

Semua link navbar pakai `wire:navigate` supaya transisi antar halaman terasa mulus tanpa full reload:
```blade
<a href="{{ route('profil') }}" wire:navigate>Profil</a>
```

---

## 4. Struktur Database

```
profiles        : id, nama, bio, foto, filosofi_desain
contacts         : id, email, telepon, alamat, instagram_url, dst
experiences      : id, title, company, tahun_mulai, tahun_selesai, deskripsi
projects         : id, slug, title, kategori, deskripsi, client, tahun, cover_image
project_media    : id, project_id, type (image/video), source (unsplash/client/null),
                    path_or_url, credit_name, credit_url, order
```

Kolom `source`, `credit_name`, `credit_url` di `project_media` dipakai khusus untuk atribusi Unsplash (lihat bagian 6). Saat foto diganti foto asli klien, set `source = null` — badge kredit otomatis tidak tampil.

Model & migration:
```bash
php artisan make:model Profile -m
php artisan make:model Contact -m
php artisan make:model Experience -m
php artisan make:model Project -m
php artisan make:model ProjectMedia -m
```

---

## 5. Alur Animasi

- **Antar halaman:** fade-out konten lama → fade-in konten baru, dikombinasikan `wire:navigate` + Alpine transition (`x-transition`) di elemen konten utama layout.
- **Homepage:** grid foto muncul staggered — AOS `fade-up` per item dengan delay bertingkat.
- **Detail proyek:** hero image zoom-in halus saat page load (CSS transition + Alpine `x-init`).
- **Navbar:** underline/slide indicator saat hover/active menggunakan Alpine `x-data` state.

Contoh dasar transisi halaman di layout:
```blade
<main
    wire:key="{{ request()->path() }}"
    x-data
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
>
    {{ $slot }}
</main>
```

---

## 6. Panduan Integrasi Unsplash API

### 6.1 Setup

1. Daftar di `unsplash.com/developers` → New Application
2. Centang semua 4 checklist syarat (non-automated use, tidak replikasi core UX Unsplash, jaga kerahasiaan key, jangan abuse rate limit)
3. Simpan Access Key ke `.env`:
```
UNSPLASH_ACCESS_KEY=your_access_key_here
```
4. **Jangan pernah commit Access Key ke Git.** Pastikan `.env` ada di `.gitignore` (default Laravel sudah begitu).

### 6.2 Artisan Command untuk Fetch Foto

Buat command khusus:
```bash
php artisan make:command FetchInteriorImages
```

Isi command (`app/Console/Commands/FetchInteriorImages.php`):
```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FetchInteriorImages extends Command
{
    protected $signature = 'fetch:interior-images {kategori} {--jumlah=5}';
    protected $description = 'Ambil foto interior dari Unsplash API berdasarkan kategori';

    public function handle()
    {
        $kategori = $this->argument('kategori');
        $jumlah = $this->option('jumlah');
        $accessKey = config('services.unsplash.access_key');

        $response = Http::withHeaders([
            'Authorization' => "Client-ID {$accessKey}",
        ])->get('https://api.unsplash.com/search/photos', [
            'query' => $kategori,
            'per_page' => $jumlah,
            'orientation' => 'landscape',
        ]);

        if ($response->failed()) {
            $this->error('Gagal fetch dari Unsplash API: ' . $response->status());
            return 1;
        }

        $hasil = $response->json('results');
        $folder = "images/projects/{$kategori}";
        Storage::disk('public')->makeDirectory($folder);

        foreach ($hasil as $i => $foto) {
            $imageUrl = $foto['urls']['regular'];
            $imageContent = Http::get($imageUrl)->body();
            $filename = "{$folder}/" . ($i + 1) . '.jpg';
            Storage::disk('public')->put($filename, $imageContent);

            // Simpan data kredit untuk atribusi wajib
            $this->info("Tersimpan: {$filename} — Kredit: {$foto['user']['name']} ({$foto['user']['links']['html']})");

            // TODO: simpan ke tabel project_media dengan kolom:
            // path_or_url = $filename
            // source = 'unsplash'
            // credit_name = $foto['user']['name']
            // credit_url = $foto['user']['links']['html'] . '?utm_source=nama_app_kamu&utm_medium=referral'
        }

        $this->info("Selesai. {$jumlah} foto kategori '{$kategori}' berhasil diambil.");
        return 0;
    }
}
```

Tambahkan config di `config/services.php`:
```php
'unsplash' => [
    'access_key' => env('UNSPLASH_ACCESS_KEY'),
],
```

Jalankan:
```bash
php artisan fetch:interior-images "minimalist living room" --jumlah=5
php artisan fetch:interior-images "minimalist kitchen" --jumlah=3
php artisan fetch:interior-images "minimalist bedroom" --jumlah=3
```

### 6.3 Atribusi Wajib di UI (Tidak Otomatis)

API tidak otomatis menampilkan kredit di halaman — ini wajib di-render manual. Buat Blade component:

`resources/views/components/unsplash-credit.blade.php`:
```blade
@props(['media'])

@if($media->source === 'unsplash')
<div class="text-xs text-gray-400 mt-1">
    Photo by
    <a href="{{ $media->credit_url }}" target="_blank" rel="noopener">{{ $media->credit_name }}</a>
    on
    <a href="https://unsplash.com/?utm_source=portofolio_interior&utm_medium=referral" target="_blank" rel="noopener">Unsplash</a>
</div>
@endif
```

Pakai di galeri proyek:
```blade
@foreach($project->media as $media)
    <img src="{{ Storage::url($media->path_or_url) }}" alt="{{ $project->title }}">
    <x-unsplash-credit :media="$media" />
@endforeach
```

Karena kredit dikontrol lewat kolom `source` di database (bukan hardcode di Blade), begitu foto diganti foto asli hasil kerja klien, cukup update `source` jadi `null` — badge kredit otomatis hilang tanpa edit tampilan.

### 6.4 Aturan yang Wajib Dipatuhi

- Non-automated, high-quality, authentic — command di atas dijalankan manual per kategori, bukan auto-scraping massal.
- Tidak mereplikasi core UX Unsplash (bukan bikin galeri wallpaper/browsing generik).
- Access Key & Secret Key rahasia — hanya di `.env`, tidak pernah di kode/Git.
- Jangan spam request — command hanya dijalankan sesekali saat setup data proyek, bukan terus-menerus.
- Rate limit mode Demo: 50 request/jam — cukup untuk kebutuhan development ini.

### 6.5 Deploy ke Vercel — Kompatibilitas

Unsplash API adalah HTTP call biasa dari server Laravel, tidak bergantung platform hosting. Yang perlu dipastikan di Vercel:
- Set `UNSPLASH_ACCESS_KEY` sebagai Environment Variable di dashboard Vercel (bukan hardcode).
- Masalah utama Laravel di Vercel tetap soal runtime PHP komunitas (bukan native) — bukan soal Unsplash API-nya.

---

## 7. Rencana Deployment

**Opsi utama: Vercel** (via runtime PHP komunitas `vercel-php`)
- Cocok karena project fase ini tanpa CMS/upload runtime — semua gambar jadi bagian build (commit ke repo atau di-generate lewat command Unsplash di atas sebelum deploy)
- Database SQLite ikut ter-commit ke repo

**Fallback: Railway (Hobby $5/bulan)**
- Kalau runtime PHP di Vercel bermasalah/tidak stabil, pindah ke sini — Laravel native didukung penuh

**Tidak bisa dipakai:** GitHub Pages (hanya hosting statis, tidak ada PHP runtime sama sekali — ini berlaku mutlak, tidak terpengaruh ada/tidaknya CMS)

---

## 8. Timeline Kasar (solo dev)

1. Setup project, migration, seeder awal (1-2 hari)
2. Fetch & siapkan gambar placeholder via Unsplash API (0.5 hari)
3. Layout + navbar + homepage grid (2-3 hari)
4. Halaman Profil, Pengalaman, Proyek + detail (3-4 hari)
5. Halaman Hubungi + form validasi (1 hari)
6. Animasi transisi (Livewire navigate + Alpine + AOS) + polish (2-3 hari)
7. Setup & testing deploy Vercel (1-2 hari, alokasi lebih karena runtime PHP tidak resmi)

**Total estimasi: ~11-16 hari kerja**

---

## 9. Hal yang Perlu Dikonfirmasi ke Klien

- Jumlah proyek awal yang ditampilkan
- Font & warna brand (interior design umumnya minim warna, whitespace besar)
- Kapan foto asli proyek klien tersedia untuk menggantikan placeholder Unsplash
- Apakah nanti tetap butuh CMS di fase 2 untuk update mandiri
