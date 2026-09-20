<div class="section" style="max-width: 1080px;">
    <div class="profile-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 5.5rem; align-items: start;" data-aos="fade-up">

        {{-- Foto profil & Filosofi Desain --}}
        <div>
            @if($profile?->foto)
                <img src="{{ Storage::url($profile->foto) }}"
                     alt="{{ $profile->nama }}"
                     style="width: 100%; aspect-ratio: 3/4; object-fit: cover;">
            @else
                <div style="width: 100%; aspect-ratio: 3/4; background: var(--color-surface); display: flex; align-items: center; justify-content: center;">
                    <span style="color: var(--color-muted); font-size: 0.75rem; letter-spacing: 0.1em;">FOTO PROFIL</span>
                </div>
            @endif

            @if($profile?->filosofi_desain)
            <div style="border-left: 1px solid var(--color-accent); padding-left: 1.5rem; margin-top: 2.5rem;">
                <p style="font-size: 0.72rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 0.75rem;">
                    Filosofi Desain
                </p>
                <blockquote style="font-family: var(--font-serif); font-size: 1.25rem; font-weight: 300; font-style: italic; line-height: 1.6; color: var(--color-text);">
                    "{{ $profile->filosofi_desain }}"
                </blockquote>
            </div>
            @endif
        </div>

        {{-- Bio --}}
        <div style="padding-top: 2rem; max-width: 480px;">
            <p style="font-size: 0.72rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 1.5rem;">
                Profil
            </p>
            <h1 style="font-family: var(--font-serif); font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 300; margin-bottom: 2rem; line-height: 1.1;">
                {{ $profile?->nama ?? 'Nama Desainer' }}
            </h1>
            <div style="color: var(--color-muted); line-height: 1.9; font-size: 0.95rem; max-width: 460px;">
                {!! nl2br(e($profile?->bio ?? 'Bio belum diisi. Jalankan seeder untuk data awal.')) !!}
            </div>
        </div>
    </div>
</div>
