<div>
    {{-- ─── Hero Image ──────────────────────────── --}}
    @php $heroMedia = $project->media->first(); @endphp
    <div style="height: 80dvh; overflow: hidden; position: relative;"
         x-data x-init="$el.querySelector('img')?.classList.add('hero-loaded')">
        @if($heroMedia)
            <img src="{{ Storage::url($heroMedia->path_or_url) }}"
                 alt="{{ $project->title }}"
                 style="width:100%;height:100%;object-fit:cover;filter:brightness(0.75);transform:scale(1.05);transition:transform 1.2s ease, filter 0.5s;"
                 x-init="setTimeout(() => { $el.style.transform = 'scale(1)' }, 50)">
        @elseif($project->cover_image)
            <img src="{{ Storage::url($project->cover_image) }}"
                 alt="{{ $project->title }}"
                 style="width:100%;height:100%;object-fit:cover;filter:brightness(0.75);transform:scale(1.05);transition:transform 1.2s ease;"
                 x-init="setTimeout(() => { $el.style.transform = 'scale(1)' }, 50)">
        @else
            <div style="width:100%;height:100%;background:var(--color-surface);"></div>
        @endif

        {{-- Overlay info --}}
        <div style="position:absolute;bottom:3rem;left:3rem;right:3rem;" data-aos="fade-up">
            <p style="font-size:0.72rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--color-accent);margin-bottom:0.75rem;">
                {{ $project->kategori }} · {{ $project->tahun }}
            </p>
            <h1 style="font-family:var(--font-serif);font-size:clamp(2.5rem,5vw,5rem);font-weight:300;line-height:1.05;">
                {{ $project->title }}
            </h1>
            @if($project->client)
            <p style="color:rgba(232,228,222,0.6);margin-top:0.75rem;font-size:0.85rem;">
                Klien: {{ $project->client }}
            </p>
            @endif
        </div>
    </div>

    {{-- ─── Deskripsi ─────────────────────────── --}}
    @if($project->deskripsi)
    <div class="section" style="max-width: 800px;" data-aos="fade-up">
        <p style="font-family:var(--font-serif);font-size:1.25rem;font-weight:300;line-height:1.9;color:var(--color-muted);">
            {{ $project->deskripsi }}
        </p>
    </div>
    @endif

    {{-- ─── Galeri Media ───────────────────────── --}}
    @if($project->media->count() > 1)
    <div class="section section--full" style="padding: 0 2px 2px;">
        <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:2px;">
            @foreach($project->media->skip(1) as $media)
            <div style="overflow:hidden;aspect-ratio:{{ $loop->iteration % 3 === 0 ? '16/9' : '4/3' }};"
                 data-aos="fade-up"
                 data-aos-delay="{{ ($loop->index % 2) * 150 }}">
                @if($media->type === 'image')
                    <img src="{{ Storage::url($media->path_or_url) }}"
                         alt="{{ $project->title }}"
                         style="width:100%;height:100%;object-fit:cover;transition:transform 0.7s ease;"
                         onmouseover="this.style.transform='scale(1.03)'"
                         onmouseout="this.style.transform=''">
                    <x-unsplash-credit :media="$media" />
                @else
                    <video src="{{ Storage::url($media->path_or_url) }}"
                           controls
                           style="width:100%;height:100%;object-fit:cover;">
                    </video>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ─── Back to projects ─────────────────── --}}
    <div class="section" style="text-align:center;padding-top:4rem;padding-bottom:4rem;">
        <a href="{{ route('proyek') }}" wire:navigate class="btn">
            ← Kembali ke Semua Proyek
        </a>
    </div>
</div>
