<div>
    {{-- ─── Hero Section ──────────────────────── --}}
    <section style="height: 100dvh; display: flex; align-items: flex-end; padding: 4rem 3rem; position: relative; overflow: hidden;">

        {{-- Background grid foto --}}
        @if($projects->count())
        <div style="position: absolute; inset: 0; display: grid; grid-template-columns: repeat({{ min($projects->count(), 2) }}, 1fr); gap: 2px; z-index: 0;">
            @foreach($projects as $project)
            <a href="{{ route('proyek.show', $project->slug) }}" wire:navigate
               style="display: block; overflow: hidden; position: relative; height: 100%;"
               class="hero-card-link">
                @if($project->cover_image)
                    <img src="{{ Storage::url($project->cover_image) }}"
                         alt="{{ $project->title }}"
                         style="width:100%; height:100%; object-fit:cover; filter:brightness(0.5); transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1), filter 0.4s;"
                         onmouseover="this.style.transform='scale(1.05)'; this.style.filter='brightness(0.75)'"
                         onmouseout="this.style.transform=''; this.style.filter='brightness(0.5)'">
                @else
                    <div style="width:100%; height:100%; background: var(--color-surface);"></div>
                @endif
                <div style="position: absolute; top: 5.5rem; {{ $loop->first ? 'left: 3rem;' : 'right: 3rem;' }} z-index: 2; pointer-events: none;" class="hero-project-tag">
                    <span style="font-size: 0.68rem; letter-spacing: 0.18em; text-transform: uppercase; color: var(--color-accent); background: rgba(14,14,14,0.75); backdrop-filter: blur(10px); padding: 0.4rem 0.9rem; border: 1px solid rgba(200,170,130,0.25); border-radius: 2px;">
                        {{ $project->title }}
                    </span>
                </div>
            </a>
            @endforeach
        </div>
        {{-- Subtle dark vignette gradient --}}
        <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(14,14,14,0.92) 0%, rgba(14,14,14,0.3) 50%, rgba(14,14,14,0.6) 100%); pointer-events: none; z-index: 1;"></div>
        @else
        {{-- Placeholder saat belum ada proyek --}}
        <div style="position: absolute; inset: 0; background: linear-gradient(135deg, #0e0e0e 0%, #1a1612 100%); z-index: 0;"></div>
        @endif

        {{-- Hero text --}}
        <div style="position: relative; z-index: 2; max-width: 760px;" data-aos="fade-up">
            <p style="font-size: 0.72rem; letter-spacing: 0.22em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 1rem;">
                Portofolio Desain Interior
            </p>
            <h1 style="font-family: var(--font-serif); font-size: clamp(2.6rem, 5.5vw, 4.8rem); font-weight: 300; line-height: 1.1; margin-bottom: 1.5rem;">
                Ruang yang<br>dirancang dengan<br><em>presisi & ketenangan</em>
            </h1>
            <a href="{{ route('proyek') }}" wire:navigate class="btn">
                Lihat Semua Proyek
            </a>
        </div>
    </section>

    {{-- ─── Grid Proyek Section ────────────────── --}}
    @if($projects->count())
    <section class="section section--full">
        <div class="project-grid" style="grid-auto-rows: 480px;">
            @foreach($projects as $i => $project)
            <a href="{{ route('proyek.show', $project->slug) }}" wire:navigate
               class="project-grid__item"
               style="grid-column: span 6;"
               data-aos="fade-up"
               data-aos-delay="{{ $loop->index * 150 }}">
                @if($project->cover_image)
                    <img src="{{ Storage::url($project->cover_image) }}" alt="{{ $project->title }}">
                @else
                    <div style="width:100%; height:100%; background: var(--color-surface); display:flex; align-items:center; justify-content:center;">
                        <span style="color: var(--color-muted); font-size: 0.75rem; letter-spacing: 0.1em;">{{ strtoupper($project->kategori ?? 'Hospitality') }}</span>
                    </div>
                @endif
                <div class="project-grid__caption">
                    <p style="font-size: 0.7rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 0.35rem;">
                        {{ $project->kategori }} · {{ $project->tahun }}
                    </p>
                    <p style="font-family: var(--font-serif); font-size: 1.6rem; font-weight: 300;">
                        {{ $project->title }}
                    </p>
                    @if($project->client)
                    <p style="font-size: 0.75rem; color: rgba(232,228,222,0.7); margin-top: 0.25rem;">
                        {{ $project->client }}
                    </p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @else
    {{-- State kosong --}}
    <section class="section" style="text-align: center; padding: 6rem 3rem;">
        <p style="font-family: var(--font-serif); font-size: 2rem; color: var(--color-muted); font-weight: 300;">
            Proyek akan segera hadir
        </p>
        <p style="color: var(--color-muted); margin-top: 1rem; font-size: 0.85rem;">
            Jalankan seeder atau fetch gambar dari Unsplash untuk mulai.
        </p>
    </section>
    @endif
</div>
