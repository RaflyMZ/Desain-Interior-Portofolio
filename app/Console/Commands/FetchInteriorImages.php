<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\ProjectMedia;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FetchInteriorImages extends Command
{
    protected $signature = 'fetch:interior-images
                            {kategori : Query/keyword untuk Unsplash (e.g. "minimalist living room")}
                            {--slug= : Slug proyek untuk dihubungkan ke project_media}
                            {--jumlah=5 : Jumlah foto yang diambil}
                            {--orientation=landscape : Orientasi foto (landscape/portrait)}
                            {--set-cover : Set foto pertama sebagai cover_image proyek}
                            {--profile : Set foto pertama sebagai foto profil desainer}';

    protected $description = 'Ambil foto interior dari Unsplash API dan simpan ke project_media';

    public function handle(): int
    {
        $kategori    = $this->argument('kategori');
        $slug        = $this->option('slug');
        $jumlah      = (int) $this->option('jumlah');
        $orientation = $this->option('orientation') ?: 'landscape';
        $setCover    = $this->option('set-cover');
        $isProfile   = $this->option('profile');
        $accessKey   = config('services.unsplash.access_key');

        if (! $accessKey || $accessKey === 'your_access_key_here') {
            $this->error('UNSPLASH_ACCESS_KEY belum diset di .env!');
            return 1;
        }

        $this->info("Fetching {$jumlah} foto ({$orientation}) untuk: \"{$kategori}\"...");

        try {
            $response = Http::timeout(60)
                ->withoutVerifying()
                ->retry(3, 2000)
                ->withHeaders([
                    'Authorization' => "Client-ID {$accessKey}",
                ])->get('https://api.unsplash.com/search/photos', [
                    'query'       => $kategori,
                    'per_page'    => $jumlah,
                    'orientation' => $orientation,
                ]);
        } catch (\Exception $e) {
            $this->error('Gagal menghubungi Unsplash API: ' . $e->getMessage());
            return 1;
        }

        if ($response->failed()) {
            $this->error('Gagal fetch dari Unsplash: HTTP ' . $response->status());
            return 1;
        }

        $hasil = $response->json('results');

        if (empty($hasil)) {
            $this->warn('Tidak ada hasil ditemukan untuk query tersebut.');
            return 0;
        }

        // Temukan proyek jika slug diberikan
        $project = null;
        if ($slug) {
            $project = Project::where('slug', $slug)->first();
            if (! $project) {
                $this->error("Proyek dengan slug \"{$slug}\" tidak ditemukan.");
                return 1;
            }
        }

        $folder = $isProfile ? 'images/profile' : ('images/projects/' . \Illuminate\Support\Str::slug($kategori));
        Storage::disk('public')->makeDirectory($folder);

        $nextOrder = $project
            ? (ProjectMedia::where('project_id', $project->id)->max('order') + 1)
            : 0;

        foreach ($hasil as $i => $foto) {
            $imageUrl = $foto['urls']['regular'];
            $filename = $folder . '/' . ($nextOrder + $i) . '_' . uniqid() . '.jpg';

            // Download dengan timeout 60s, retry 2x, tanpa SSL verify (CDN Unsplash kadang SSL timeout)
            $downloaded = false;
            for ($attempt = 1; $attempt <= 3; $attempt++) {
                try {
                    $imageContent = Http::timeout(60)
                        ->withoutVerifying()
                        ->retry(1, 2000)
                        ->get($imageUrl)
                        ->body();
                    $downloaded = true;
                    break;
                } catch (\Exception $e) {
                    $this->warn("    Attempt {$attempt} gagal: " . $e->getMessage());
                    if ($attempt < 3) sleep(3);
                }
            }

            if (! $downloaded) {
                $this->error("  ✗ Skip foto " . ($i + 1) . " — gagal download setelah 3 percobaan.");
                continue;
            }

            Storage::disk('public')->put($filename, $imageContent);

            $creditName = $foto['user']['name'];
            $creditUrl  = $foto['user']['links']['html'] . '?utm_source=portofolio_interior&utm_medium=referral';

            $this->line("  ✓ Tersimpan: {$filename}");
            $this->line("    Kredit: {$creditName} ({$creditUrl})");

            if ($isProfile && $i === 0) {
                \App\Models\Profile::first()?->update(['foto' => $filename]);
                $this->info("  → Set sebagai foto Profil desainer");
            }

            if ($project) {
                $media = ProjectMedia::create([
                    'project_id'  => $project->id,
                    'type'        => 'image',
                    'source'      => 'unsplash',
                    'path_or_url' => $filename,
                    'credit_name' => $creditName,
                    'credit_url'  => $creditUrl,
                    'order'       => $nextOrder + $i,
                ]);

                // Set cover image proyek jika diminta dan ini foto pertama
                if ($setCover && $i === 0 && ! $project->cover_image) {
                    $project->update(['cover_image' => $filename]);
                    $this->info("  → Set sebagai cover_image proyek \"{$project->title}\"");
                }
            }
        }

        $this->newLine();
        $this->info("✅ Selesai. {$jumlah} foto berhasil diambil dari Unsplash.");

        if ($project) {
            $this->line("   Tersimpan ke proyek: {$project->title} (slug: {$slug})");
        } elseif ($isProfile) {
            $this->line("   Tersimpan ke Profil Desainer");
        } else {
            $this->warn('   Tidak ada slug proyek — foto hanya tersimpan ke storage, tidak ke project_media.');
            $this->line('   Gunakan --slug=nama-slug untuk menghubungkan ke proyek.');
        }

        return 0;
    }
}
