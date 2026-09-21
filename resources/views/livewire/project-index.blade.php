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

    {{-- Grid proyek --}}
    @if($projects->count())
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 540px), 1fr)); gap: 4px; padding: 0 4px;">
        @foreach($projects as $project)
        <a href="{{ route('proyek.show', $project->slug) }}" wire:navigate
           class="project-grid__item"
           style="aspect-ratio: 16/11;"
           data-aos="fade-up"
           data-aos-delay="{{ $loop->index * 150 }}">
            @if($project->cover_image)
                <img src="{{ Storage::url($project->cover_image) }}" alt="{{ $project->title }}" style="width:100%;height:100%;object-fit:cover;">
            @else
                <div style="width:100%;height:100%;background:var(--color-surface);display:flex;align-items:center;justify-content:center;">
                    <span style="color:var(--color-muted);font-size:0.75rem;letter-spacing:0.1em;">{{ strtoupper($project->kategori ?? 'Hospitality') }}</span>
                </div>
            @endif
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
