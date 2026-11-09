<div>
    <div class="section">
        <p style="font-size: 0.72rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 1rem;" data-aos="fade-up">
            Galeri Karya
        </p>
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 3rem; flex-wrap: wrap; gap: 1.5rem;">
            <h1 style="font-family: var(--font-serif); font-size: clamp(2rem, 4vw, 3.5rem); font-weight: 300;" data-aos="fade-up" data-aos-delay="100">
                Proyek
            </h1>

            {{-- Filter kategori --}}
            @if($kategori->count())
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;" data-aos="fade-up" data-aos-delay="150">
                <button wire:click="$set('filter', '')"
                        style="font-size: 0.7rem; letter-spacing: 0.12em; text-transform: uppercase; padding: 0.4rem 1.2rem; border: 1px solid {{ $filter === '' ? 'var(--color-accent)' : 'var(--color-border)' }}; color: {{ $filter === '' ? 'var(--color-accent)' : 'var(--color-muted)' }}; background: transparent; cursor: pointer; transition: all 0.25s;">
                    Semua
                </button>
                @foreach($kategori as $kat)
                <button wire:click="$set('filter', '{{ $kat }}')"
                        style="font-size: 0.7rem; letter-spacing: 0.12em; text-transform: uppercase; padding: 0.4rem 1.2rem; border: 1px solid {{ $filter === $kat ? 'var(--color-accent)' : 'var(--color-border)' }}; color: {{ $filter === $kat ? 'var(--color-accent)' : 'var(--color-muted)' }}; background: transparent; cursor: pointer; transition: all 0.25s;">
                    {{ ucfirst($kat) }}
                </button>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    {{-- Grid proyek: kartu besar --}}
    @if($projects->count())
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(420px, 1fr)); gap: 2rem; padding: 0 3rem 4rem; max-width: 1400px; margin: 0 auto;">
        @foreach($projects as $project)
        <a href="{{ route('proyek.show', $project->slug) }}" wire:navigate
           class="project-card"
           style="position: relative; display: flex; flex-direction: column; overflow: hidden; background: var(--color-surface); border: 1px solid var(--color-border); transition: border-color 0.3s ease, transform 0.3s ease;"
           data-aos="fade-up"
           data-aos-delay="{{ $loop->index * 100 }}">
            {{-- Gambar --}}
            <div style="position: relative; aspect-ratio: 16/10; overflow: hidden;">
                @if($project->cover_image)
                    <img src="{{ Storage::url($project->cover_image) }}" alt="{{ $project->title }}"
                         style="width: 100%; height: 100%; display: block; object-fit: cover; transition: transform 0.7s ease, filter 0.35s ease;">
                @else
                    <div style="width: 100%; height: 100%; background: var(--color-border);"></div>
                @endif
                {{-- Overlay label di atas gambar --}}
                <span style="position: absolute; top: 1rem; left: 1rem; font-size: 0.6rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--color-accent); background: rgba(14,14,14,0.75); padding: 0.45rem 0.9rem;">
                    {{ $project->kategori }} · {{ $project->tahun }}
                </span>
            </div>

            {{-- Info kartu --}}
            <span style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 1.5rem 1.7rem;">
                <span style="font-family: var(--font-serif); font-size: 1.7rem; font-weight: 400; line-height: 1.25; color: var(--color-text);">
                    {{ $project->title }}
                </span>
                <span class="project-card__arrow" aria-hidden="true" style="font-size: 1.4rem; color: var(--color-accent); transition: transform 0.3s ease; flex-shrink: 0;">→</span>
            </span>
        </a>
        @endforeach
    </div>
    @else
    <div class="section" style="text-align:center;">
        <p style="font-family:var(--font-serif);font-size:1.8rem;color:var(--color-muted);font-weight:300;">
            Belum ada proyek yang tersedia
        </p>
    </div>
    @endif
</div>
