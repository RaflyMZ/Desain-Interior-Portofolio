<div class="section" style="max-width: 900px;">
    {{-- ─── Pengalaman Kerja ───────────────────── --}}
    <p style="font-size: 0.72rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 1rem;" data-aos="fade-up">
        Perjalanan Karier
    </p>
    <h1 style="font-family: var(--font-serif); font-size: clamp(2rem, 4vw, 3.5rem); font-weight: 300; margin-bottom: 4rem;" data-aos="fade-up" data-aos-delay="100">
        Pengalaman Kerja
    </h1>

    @if($experiences->count())
    <div class="timeline" x-data="{ activeLightbox: null }">
        @foreach($experiences as $exp)
        <div class="timeline__item" 
             data-aos="fade-up" 
             data-aos-delay="{{ $loop->index * 80 }}" 
             x-data="{ 
                 showDetail: false,
                 scrollToDetail() {
                     setTimeout(() => {
                         const navH = 90;
                         const el = this.$refs.detailBox;
                         if (el) {
                             const top = el.getBoundingClientRect().top + window.pageYOffset - navH;
                             window.scrollTo({ top: Math.max(0, top), behavior: 'smooth' });
                         }
                     }, 150);
                 },
                 scrollToItem() {
                     setTimeout(() => {
                         const navH = 90;
                         const el = this.$refs.timelineItem;
                         if (el) {
                             const top = el.getBoundingClientRect().top + window.pageYOffset - navH;
                             window.scrollTo({ top: Math.max(0, top), behavior: 'smooth' });
                         }
                     }, 100);
                 }
             }" 
             x-ref="timelineItem">
            
            <div class="timeline__year">
                {{ $exp->periode ?? ($exp->tahun_mulai . ($exp->tahun_selesai ? ' — ' . $exp->tahun_selesai : ' — Sekarang')) }}
            </div>
            <h2 class="timeline__title">{{ $exp->title }}</h2>
            <div class="timeline__company">{{ $exp->company }}</div>
            
            {{-- ─── Ringkasan Pengalaman ─── --}}
            @if($exp->ringkasan)
            <p style="color: var(--color-muted); font-size: 0.92rem; line-height: 1.8; max-width: 680px; margin-bottom: 1.25rem;">
                {{ $exp->ringkasan }}
            </p>
            @elseif($exp->deskripsi)
            <p style="color: var(--color-muted); font-size: 0.92rem; line-height: 1.8; max-width: 680px; margin-bottom: 1.25rem;">
                {{ Str::limit($exp->deskripsi, 220) }}
            </p>
            @endif

            {{-- ─── Button Detail ─── --}}
            @if($exp->deskripsi || !empty($exp->gallery))
            <div>
                <button type="button"
                        @click="showDetail = !showDetail; if (showDetail) { scrollToDetail(); } else { scrollToItem(); }"
                        class="btn"
                        style="display: inline-flex; align-items: center; gap: 0.65rem; padding: 0.6rem 1.4rem; font-size: 0.72rem; letter-spacing: 0.14em; text-transform: uppercase; cursor: pointer; transition: all 0.3s ease; border-radius: 2px;">
                    <span x-text="showDetail ? 'Sembunyikan Detail' : 'Lihat Detail Pengalaman'"></span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         style="transition: transform 0.3s ease;"
                         :style="showDetail ? 'transform: rotate(180deg);' : 'transform: rotate(0deg);'">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
            </div>

            {{-- ─── Detail Konten Lengkap & Foto ─── --}}
            <div x-show="showDetail"
                 x-ref="detailBox"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="timeline__detail-box"
                 style="display: none;">
                
                {{-- Label Header Detail --}}
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; padding-bottom: 0.75rem; border-bottom: 1px solid rgba(255,255,255,0.06);">
                    <span style="display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: var(--color-accent);"></span>
                    <span style="font-size: 0.72rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--color-accent); font-weight: 500;">
                        Seluruh Isi Konten & Pengalaman
                    </span>
                </div>

                {{-- Seluruh Isi Konten Paragraf --}}
                @if($exp->deskripsi)
                <div class="timeline__detail-text">
                    @foreach(preg_split('/\r\n|\r|\n\n|\n/', $exp->deskripsi) as $paragraf)
                        @if(trim($paragraf))
                        <p>{{ trim($paragraf) }}</p>
                        @endif
                    @endforeach
                </div>
                @endif

                {{-- ─── 3 Foto dengan Sub Judul ─── --}}
                @if(!empty($exp->gallery) && is_array($exp->gallery))
                <div class="experience-gallery-grid">
                    @foreach($exp->gallery as $idx => $item)
                    <div class="experience-gallery-item"
                         @click="activeLightbox = '{{ Storage::url($item['image'] ?? '') }}'">
                        <div class="experience-gallery-img-wrapper">
                            <img src="{{ Storage::url($item['image'] ?? '') }}"
                                 alt="{{ $item['title'] ?? 'Dokumentasi ' . ($idx + 1) }}"
                                 loading="lazy">
                            <div style="position: absolute; top: 0.6rem; right: 0.6rem; background: rgba(0,0,0,0.6); backdrop-filter: blur(6px); border-radius: 50%; width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; color: var(--color-accent); border: 1px solid rgba(200,170,130,0.3);">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="15 3 21 3 21 9"></polyline>
                                    <polyline points="9 21 3 21 3 15"></polyline>
                                    <line x1="21" y1="3" x2="14" y2="10"></line>
                                    <line x1="3" y1="21" x2="10" y2="14"></line>
                                </svg>
                            </div>
                        </div>
                        <div class="experience-gallery-content">
                            <div class="experience-gallery-subtitle">
                                {{ $item['title'] ?? 'Dokumentasi ' . ($idx + 1) }}
                            </div>
                            @if(!empty($item['description']))
                            <div class="experience-gallery-desc">
                                {{ $item['description'] }}
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Tombol Tutup Ringkas di Bawah --}}
                <div style="margin-top: 2rem; display: flex; justify-content: flex-end;">
                    <button type="button"
                            @click="showDetail = false; scrollToItem();"
                            style="background: transparent; border: 1px solid var(--color-border); color: var(--color-muted); font-size: 0.72rem; letter-spacing: 0.12em; text-transform: uppercase; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border-radius: 2px; transition: all 0.25s;"
                            onmouseover="this.style.borderColor='var(--color-accent)'; this.style.color='var(--color-accent)'"
                            onmouseout="this.style.borderColor='var(--color-border)'; this.style.color='var(--color-muted)'">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="18 15 12 9 6 15"></polyline>
                        </svg>
                        <span>Tutup Detail</span>
                    </button>
                </div>
            </div>
            @endif
        </div>
        @endforeach

        {{-- ─── Lightbox Modal Preview ─── --}}
        <div x-show="activeLightbox"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click.self="activeLightbox = null"
             @keydown.escape.window="activeLightbox = null"
             style="position: fixed; inset: 0; background: rgba(0,0,0,0.92); backdrop-filter: blur(14px); z-index: 99999; display: flex; align-items: center; justify-content: center; padding: 2rem;"
             style="display: none;">
            
            {{-- Tombol Tutup Fixed di Pojok Kanan Atas Viewport (Tidak Terpotong) --}}
            <button type="button"
                    @click="activeLightbox = null"
                    style="position: fixed; top: 1.5rem; right: 2rem; z-index: 100005; background: rgba(22, 22, 22, 0.9); border: 1px solid var(--color-accent); color: var(--color-accent); padding: 0.6rem 1.25rem; border-radius: 9999px; backdrop-filter: blur(12px); cursor: pointer; display: flex; align-items: center; gap: 0.6rem; font-size: 0.75rem; letter-spacing: 0.12em; text-transform: uppercase; box-shadow: 0 4px 20px rgba(0,0,0,0.6); transition: all 0.25s ease;"
                    onmouseover="this.style.background='var(--color-accent)'; this.style.color='var(--color-bg)'"
                    onmouseout="this.style.background='rgba(22, 22, 22, 0.9)'; this.style.color='var(--color-accent)'">
                <span>Tutup (ESC)</span>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <div style="position: relative; max-width: 90vw; max-height: 85vh; display: flex; align-items: center; justify-content: center;">
                <img :src="activeLightbox"
                     alt="Preview Foto"
                     style="max-width: 100%; max-height: 82vh; object-fit: contain; border: 1px solid var(--color-border); box-shadow: 0 20px 50px rgba(0,0,0,0.85); border-radius: 4px;">
            </div>
        </div>
    </div>
    @else
    <p style="color: var(--color-muted);">Data pengalaman belum tersedia. Jalankan seeder.</p>
    @endif

    {{-- ─── Sertifikasi ────────────────────────── --}}
    <div style="margin-top: 6rem; padding-top: 5rem; border-top: 1px solid var(--color-border);" data-aos="fade-up">
        <p style="font-size: 0.72rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--color-accent); margin-bottom: 1rem;">
            Kualifikasi & Pelatihan
        </p>
        <h2 style="font-family: var(--font-serif); font-size: clamp(2rem, 3.5vw, 3rem); font-weight: 300; margin-bottom: 3.5rem;">
            Sertifikasi
        </h2>

        @if($certificates->count())
        <div style="display: flex; flex-direction: column; gap: 2rem;">
            @foreach($certificates as $cert)
            <div style="border: 1px solid var(--color-border); padding: 2.2rem; background: var(--color-surface); transition: border-color 0.3s;"
                 onmouseover="this.style.borderColor='var(--color-accent)'"
                 onmouseout="this.style.borderColor='var(--color-border)'"
                 data-aos="fade-up"
                 data-aos-delay="{{ $loop->index * 80 }}">
                
                <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1.25rem; margin-bottom: 1rem;">
                    <div>
                        <span style="font-size: 0.72rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--color-accent); display: block; margin-bottom: 0.35rem;">
                            {{ $cert->tanggal }}
                        </span>
                        <h3 style="font-family: var(--font-serif); font-size: 1.6rem; font-weight: 300;">
                            {{ $cert->title }}
                        </h3>
                        <p style="color: var(--color-muted); font-size: 0.85rem; margin-top: 0.25rem;">
                            {{ $cert->issuer }}
                        </p>
                    </div>

                    @if($cert->file_url)
                    <a href="{{ asset($cert->file_url) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="btn"
                       style="display: inline-flex; align-items: center; gap: 0.6rem; padding: 0.65rem 1.6rem; font-size: 0.72rem; letter-spacing: 0.14em; text-transform: uppercase; align-self: center;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span>Lihat Sertifikat</span>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.8;">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                    </a>
                    @endif
                </div>

                @if($cert->deskripsi)
                <div style="color: var(--color-muted); font-size: 0.9rem; line-height: 1.8; max-width: 720px; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1.25rem; margin-top: 1.25rem;">
                    {!! nl2br(e($cert->deskripsi)) !!}
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <p style="color: var(--color-muted);">Data sertifikasi belum tersedia.</p>
        @endif
    </div>
</div>
