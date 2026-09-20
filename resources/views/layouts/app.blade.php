<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="{{ $description ?? 'Portofolio Desain Interior — Ruang yang dirancang dengan presisi dan ketenangan.' }}">
    <title>{{ $title ?? 'Portofolio' }} — Desain Interior</title>

    {{-- Google Fonts — preconnect untuk performa --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Inter:wght@300;400;500&display=swap"
        rel="stylesheet">

    @livewireStyles

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    {{-- ─── Navbar ─────────────────────────────── --}}
    <header class="navbar" x-data="{ scrolled: false, mobileOpen: false }"
        x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)" :class="{ scrolled }">
        <a href="{{ route('home') }}" wire:navigate class="navbar__logo">
            My Portofolio
        </a>

        {{-- Desktop Navigation --}}
        <nav class="navbar__desktop-nav">
            <ul class="navbar__nav">
                <li>
                    <a href="{{ route('home') }}" wire:navigate
                        class="navbar__link {{ request()->routeIs('home') ? 'active' : '' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('profil') }}" wire:navigate
                        class="navbar__link {{ request()->routeIs('profil') ? 'active' : '' }}">
                        Profil
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengalaman') }}" wire:navigate
                        class="navbar__link {{ request()->routeIs('pengalaman') ? 'active' : '' }}">
                        Pengalaman
                    </a>
                </li>
                <li>
                    <a href="{{ route('proyek') }}" wire:navigate
                        class="navbar__link {{ request()->routeIs('proyek*') ? 'active' : '' }}">
                        Proyek
                    </a>
                </li>
                <li>
                    <a href="{{ route('hubungi') }}" wire:navigate
                        class="navbar__link {{ request()->routeIs('hubungi') ? 'active' : '' }}">
                        Hubungi
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Mobile Hamburger Toggle --}}
        <button type="button" class="navbar__mobile-toggle" @click="mobileOpen = !mobileOpen" aria-label="Toggle Menu">
            <span class="hamburger-bar" :class="{ 'is-open': mobileOpen }"></span>
        </button>

        {{-- Mobile Navigation Drawer --}}
        <div class="mobile-menu" x-show="mobileOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4" @click.away="mobileOpen = false" style="display: none;">
            <ul class="mobile-menu__list">
                <li>
                    <a href="{{ route('home') }}" wire:navigate @click="mobileOpen = false"
                        class="mobile-menu__link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('profil') }}" wire:navigate @click="mobileOpen = false"
                        class="mobile-menu__link {{ request()->routeIs('profil') ? 'active' : '' }}">Profil</a>
                </li>
                <li>
                    <a href="{{ route('pengalaman') }}" wire:navigate @click="mobileOpen = false"
                        class="mobile-menu__link {{ request()->routeIs('pengalaman') ? 'active' : '' }}">Pengalaman</a>
                </li>
                <li>
                    <a href="{{ route('proyek') }}" wire:navigate @click="mobileOpen = false"
                        class="mobile-menu__link {{ request()->routeIs('proyek*') ? 'active' : '' }}">Proyek</a>
                </li>
                <li>
                    <a href="{{ route('hubungi') }}" wire:navigate @click="mobileOpen = false"
                        class="mobile-menu__link {{ request()->routeIs('hubungi') ? 'active' : '' }}">Hubungi</a>
                </li>
            </ul>
        </div>
    </header>

    {{-- ─── Main Content dengan transisi Livewire navigate ─── --}}
    <main class="page-wrapper" wire:key="{{ request()->path() }}" x-data
        x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0">
        {{ $slot }}
    </main>

    {{-- ─── Footer ──────────────────────────────── --}}
    <footer
        style="border-top: 1px solid var(--color-border); padding: 2.5rem 3rem; display: flex; justify-content: space-between; align-items: center;">
        <span style="font-size: 0.7rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--color-muted);">
            &copy; {{ date('Y') }} Studio Interior
        </span>
        <span style="font-size: 0.7rem; color: var(--color-muted);">
            Jakarta, Indonesia
        </span>
    </footer>

    @livewireScripts

</body>

</html>