<div class="section" style="max-width: 1000px;">
    <div data-aos="fade-up">
        <p
            style="font-size:0.72rem;letter-spacing:0.2em;text-transform:uppercase;color:var(--color-accent);margin-bottom:1rem;">
            Informasi Kontak
        </p>
        <h1
            style="font-family:var(--font-serif);font-size:clamp(2.5rem,5vw,4.2rem);font-weight:300;margin-bottom:2rem;line-height:1.1;">
            Hubungi Kami
        </h1>
        <p style="color:var(--color-muted);font-size:1.05rem;line-height:1.8;max-width:650px;margin-bottom:4rem;">
            Tertarik untuk berkolaborasi atau berdiskusi mengenai rancangan ruang impian Anda? Silakan hubungi kami
            melalui saluran komunikasi di bawah ini.
        </p>
    </div>

    @if($contact)
        <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(280px, 1fr));gap:2.5rem;" data-aos="fade-up"
            data-aos-delay="100">

            {{-- Email --}}
            @if($contact->email)
                <div style="border:1px solid var(--color-border);padding:2.2rem;background:var(--color-surface);transition:border-color 0.3s;"
                    onmouseover="this.style.borderColor='var(--color-accent)'"
                    onmouseout="this.style.borderColor='var(--color-border)'">
                    <p
                        style="font-size:0.68rem;letter-spacing:0.18em;text-transform:uppercase;color:var(--color-accent);margin-bottom:0.75rem;">
                        Email
                    </p>
                    <h2 style="font-family:var(--font-serif);font-size:1.35rem;font-weight:300;margin-bottom:0.75rem;">
                        Surat Elektronik
                    </h2>
                    <a href="mailto:{{ $contact->email }}"
                        style="color:var(--color-text);font-size:0.95rem;word-break:break-all;text-decoration:underline;text-underline-offset:4px;">
                        {{ $contact->email }}
                    </a>
                </div>
            @endif

            {{-- Telepon / WhatsApp --}}
            @if($contact->telepon || $contact->whatsapp)
                <div style="border:1px solid var(--color-border);padding:2.2rem;background:var(--color-surface);transition:border-color 0.3s;"
                    onmouseover="this.style.borderColor='var(--color-accent)'"
                    onmouseout="this.style.borderColor='var(--color-border)'">
                    <p
                        style="font-size:0.68rem;letter-spacing:0.18em;text-transform:uppercase;color:var(--color-accent);margin-bottom:0.75rem;">
                        Telepon & WhatsApp
                    </p>
                    <h2 style="font-family:var(--font-serif);font-size:1.35rem;font-weight:300;margin-bottom:0.75rem;">
                        Komunikasi Langsung
                    </h2>
                    <div style="display:flex;flex-direction:column;gap:0.4rem;">
                        @if($contact->telepon)
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contact->telepon) }}"
                                style="color:var(--color-text);font-size:0.95rem;">
                                {{ $contact->telepon }}
                            </a>
                        @endif
                        @if($contact->whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->whatsapp) }}" target="_blank"
                                rel="noopener noreferrer"
                                style="color:var(--color-accent);font-size:0.85rem;margin-top:0.25rem;display:inline-block;">
                                Chat via WhatsApp &rarr;
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Instagram --}}
            @if($contact->instagram_url)
                <div style="border:1px solid var(--color-border);padding:2.2rem;background:var(--color-surface);transition:border-color 0.3s;"
                    onmouseover="this.style.borderColor='var(--color-accent)'"
                    onmouseout="this.style.borderColor='var(--color-border)'">
                    <p
                        style="font-size:0.68rem;letter-spacing:0.18em;text-transform:uppercase;color:var(--color-accent);margin-bottom:0.75rem;">
                        Media Sosial
                    </p>
                    <h2 style="font-family:var(--font-serif);font-size:1.35rem;font-weight:300;margin-bottom:0.75rem;">
                        Instagram
                    </h2>
                    <a href="{{ $contact->instagram_url }}" target="_blank" rel="noopener noreferrer"
                        style="color:var(--color-text);font-size:0.95rem;text-decoration:underline;text-underline-offset:4px;">
                        {{ '@' . ltrim(parse_url($contact->instagram_url, PHP_URL_PATH) ?? 'instagram', '/') }}
                    </a>
                </div>
            @endif

            {{-- Alamat Studio --}}
            @if($contact->alamat)
                <div style="border:1px solid var(--color-border);padding:2.2rem;background:var(--color-surface);grid-column:1 / -1;transition:border-color 0.3s;"
                    onmouseover="this.style.borderColor='var(--color-accent)'"
                    onmouseout="this.style.borderColor='var(--color-border)'">
                    <p
                        style="font-size:0.68rem;letter-spacing:0.18em;text-transform:uppercase;color:var(--color-accent);margin-bottom:0.75rem;">
                        Lokasi Studio
                    </p>
                    <h2 style="font-family:var(--font-serif);font-size:1.5rem;font-weight:300;margin-bottom:1rem;">
                        Alamat
                    </h2>
                    <p style="color:var(--color-muted);line-height:1.9;font-size:1rem;white-space:pre-line;max-width:600px;">
                        {{ $contact->alamat }}
                    </p>
                </div>
            @endif

            {{-- Tombol CV Saya (Tengah Bawah) --}}
            <div style="grid-column: 1 / -1; display: flex; flex-direction: column; align-items: center; justify-content: center; margin-top: 1.5rem; text-align: center;"
                data-aos="fade-up" data-aos-delay="150">
                <p
                    style="font-size:0.7rem; letter-spacing:0.18em; text-transform:uppercase; color:var(--color-muted); margin-bottom:1rem;">
                    Curriculum Vitae
                </p>
                <a href="{{ asset('files/cv-ghiyas-rizwan.pdf') }}" target="_blank" rel="noopener noreferrer" class="btn"
                    style="display: inline-flex; align-items: center; gap: 0.75rem; padding: 0.9rem 2.4rem; font-size: 0.75rem; letter-spacing: 0.16em; text-transform: uppercase;">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    <span>Lihat CV Saya</span>
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                        stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.8;">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                </a>

            </div>

        </div>
    @else
        <p style="color:var(--color-muted);">Informasi kontak belum tersedia.</p>
    @endif
</div>