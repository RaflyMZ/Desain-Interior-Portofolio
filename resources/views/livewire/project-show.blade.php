<div>
    {{-- ─── Head Blok (judul + breadcrumb + meta) ─── --}}
    <div class="section" style="padding-top: 9rem; padding-bottom: 2.5rem; max-width: 1200px;">
        {{-- Breadcrumb ala ArchDaily --}}
        <nav data-aos="fade-up"
             style="font-size: 0.68rem; letter-spacing: 0.18em; text-transform: uppercase; color: var(--color-muted); margin-bottom: 1.5rem;">
            <a href="{{ route('proyek') }}" wire:navigate style="color: var(--color-muted); text-decoration: none;">Proyek</a>
            &nbsp;/&nbsp;
            <a href="{{ route('proyek') }}" wire:navigate style="color: var(--color-muted); text-decoration: none;">{{ $project->kategori }}</a>
            &nbsp;/&nbsp;
            <span style="color: var(--color-text);">Hotel Bisnis Bintang 4</span>
        </nav>

        {{-- Judul serif besar seperti ArchDaily --}}
        <h1 data-aos="fade-up" data-aos-delay="50"
            style="font-family: var(--font-serif); font-size: clamp(2.2rem, 4.5vw, 4rem); font-weight: 300; line-height: 1.1;">
            {{ $project->title }}
            <span style="color: var(--color-muted);">&nbsp;/&nbsp;</span>
            <span style="font-size: 0.55em;">Ghiyas Rizwan</span>
        </h1>

        {{-- Brace credit --}}
        <p data-aos="fade-up" data-aos-delay="100"
           style="font-size: 0.78rem; color: var(--color-muted); margin-top: 0.75rem;">
            © Ghiyas Rizwan — Visualisasi 3D
        </p>

        {{-- Meta kategori • lokasi • tahun --}}
        <p data-aos="fade-up" data-aos-delay="150"
           style="font-size: 0.72rem; letter-spacing: 0.2em; text-transform: uppercase; margin-top: 1.75rem;">
            <span style="color: var(--color-accent);">{{ $project->kategori }}</span>
            &nbsp;•&nbsp;
            <span style="color: var(--color-muted);">Sukabumi, Indonesia</span>
            &nbsp;•&nbsp;
            <span style="color: var(--color-muted);">{{ $project->tahun }}</span>
        </p>
    </div>

    {{-- ─── Spesifikasi (expand-collapse ala ArchDaily) ─── --}}
    <div class="section" x-data="{ open: false }"
         style="padding-top: 0; padding-bottom: 2.5rem; max-width: 1200px;">
        <dl data-aos="fade-up"
            style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem 2rem; padding: 1.75rem 0; border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border); margin: 0;">
            <div>
                <dt style="font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 0.4rem;">Kategori</dt>
                <dd style="margin-left:0; font-size: 0.9rem;">{{ $project->kategori }}</dd>
            </div>
            <div>
                <dt style="font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 0.4rem;">Lokasi</dt>
                <dd style="margin-left:0; font-size: 0.9rem;">Sukabumi, Indonesia</dd>
            </div>
            <div>
                <dt style="font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 0.4rem;">Tahun</dt>
                <dd style="margin-left:0; font-size: 0.9rem;">{{ $project->tahun }}</dd>
            </div>
            @if($project->client)
            <div>
                <dt style="font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 0.4rem;">Klien</dt>
                <dd style="margin-left:0; font-size: 0.9rem;">{{ $project->client }}</dd>
            </div>
            @endif
            @if($project->media->count())
            <div>
                <dt style="font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 0.4rem;">Fotografi</dt>
                <dd style="margin-left:0; font-size: 0.9rem;">{{ $project->media->count() }} Gambar — Render 3D</dd>
            </div>
            @endif
        </dl>

        {{-- Detail tambahan, tersembunyi hingga toggle diklik --}}
        <div x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             style="display: none; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem 2rem; padding: 1.75rem 0; border-bottom: 1px solid var(--color-border);">
            <div>
                <dt style="font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 0.4rem;">Cakupan Desain</dt>
                <dd style="margin-left:0; font-size: 0.9rem; color: var(--color-muted);">Kamar Tidur · Walk-in Closet · Prefunction Area · Ballroom</dd>
            </div>
            <div>
                <dt style="font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 0.4rem;">Fungsi</dt>
                <dd style="margin-left:0; font-size: 0.9rem; color: var(--color-muted);">Guest Room & Fasilitas MICE</dd>
            </div>
            <div>
                <dt style="font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 0.4rem;">Identitas Lokal</dt>
                <dd style="margin-left:0; font-size: 0.9rem; color: var(--color-muted);">Interpretasi Motif Batik Gurilaps — Sukabumi</dd>
            </div>
            <div>
                <dt style="font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 0.4rem;">Peran</dt>
                <dd style="margin-left:0; font-size: 0.9rem; color: var(--color-muted);">Konsep · Pemodelan 3D · Visualisasi Render</dd>
            </div>
        </div>

        <button type="button" @click="open = !open"
                style="background: transparent; border: none; padding: 0.9rem 0; font-size: 0.7rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--color-accent); cursor: pointer;">
            <span x-text="open ? 'Spesifikasi Lebih Sedikit —' : 'Spesifikasi Lebih Banyak +'"></span>
        </button>
    </div>

    {{-- ─── Hero Image ─────────────────────────── --}}
    @php
        $heroMedia = $project->cover_image
            ? $project->media->firstWhere('path_or_url', $project->cover_image)
            : $project->media->first();
    @endphp
    <figure class="section section--full" style="margin: 0;" x-data x-init="$el.querySelector('img')?.classList.add('hero-loaded')">
        <div style="position: relative; overflow: hidden; max-height: 82dvh;">
            <img src="{{ Storage::url($project->cover_image ?: ($heroMedia?->path_or_url ?? '')) }}"
                 alt="{{ $project->title }} — Ballroom"
                 style="width: 100%; height: auto; max-height: 82dvh; object-fit: cover; transform: scale(1.04); transition: transform 1.4s ease;"
                 x-init="setTimeout(() => { $el.style.transform = 'scale(1)' }, 80)">
        </div>
        <figcaption
            style="text-align: center; font-size: 0.72rem; color: var(--color-muted); padding: 0.9rem 2rem 0;">
            {{ $heroMedia->caption ?? $project->title }} · © Ghiyas Rizwan
        </figcaption>
    </figure>

    {{-- ─── Deskripsi pengantar (ala "Text description provided by the architects") ─── --}}
    @if($project->deskripsi)
    <div class="section" style="max-width: 860px;">
        <p data-aos="fade-up"
           style="font-size: 0.72rem; letter-spacing: 0.18em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 2.5rem;">
            Deskripsi Teks oleh Desainer
        </p>
        <div style="max-width: 720px; margin: 0 auto;">
            @foreach(explode("\n\n", $project->deskripsi) as $paragraf)
            <p data-aos="fade-up"
               style="font-size: 1.02rem; font-weight: 300; line-height: 1.95; color: rgba(232,228,222,0.88); margin-bottom: 1.75rem;">
                {{ trim($paragraf) }}
            </p>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ─── Galeri Proyek: grid gambar ─── --}}
    @if($project->media->count())
    <style>
        .proj-gallery-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
        @media (max-width: 640px) { .proj-gallery-grid { grid-template-columns: 1fr; } }
    </style>
    <div class="section section--full" style="padding: 2rem 0 0;">
        <p class="section" data-aos="fade-up"
           style="max-width: 1200px; font-size: 0.72rem; letter-spacing: 0.18em; text-transform: uppercase; color: var(--color-accent); margin: 0 0 2.5rem;">
            Galeri Proyek
        </p>
        <div class="proj-gallery-grid" style="max-width: 1100px; margin: 0 auto; padding: 0 1.5rem;{{ $project->media->count() === 1 ? ' grid-template-columns: 1fr;' : '' }}">
            @foreach($project->media as $media)
            <figure style="margin: 0;" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 2) * 100 }}">
                <div style="overflow: hidden; background: var(--color-surface); aspect-ratio: 4/3;">
                    @if($media->type === 'image')
                        <img src="{{ Storage::url($media->path_or_url) }}"
                             alt="{{ $media->caption ?? $project->title }}"
                             loading="lazy"
                             style="width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.8s ease;"
                             onmouseover="this.style.transform='scale(1.03)'"
                             onmouseout="this.style.transform=''">
                    @else
                        <video src="{{ Storage::url($media->path_or_url) }}" controls
                               style="width: 100%; height: 100%; object-fit: cover; display: block;">
                        </video>
                    @endif
                </div>
                @if($media->caption)
                <figcaption style="font-size: 0.72rem; color: var(--color-muted); padding-top: 0.65rem;">
                    {{ $media->caption }}
                </figcaption>
                @endif
            </figure>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ─── Penutup: kembali ke daftar proyek ─── --}}
    <div class="section" style="text-align: center; padding-top: 5rem; padding-bottom: 5rem;">
        <a href="{{ route('proyek') }}" wire:navigate class="btn">
            ← Kembali ke Semua Proyek
        </a>
    </div>
</div>
