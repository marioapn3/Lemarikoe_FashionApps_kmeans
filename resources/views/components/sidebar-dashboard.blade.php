<div class="col-lg-1">
    <div class="sidebar py-2 py-lg-5 px-2 gap-3 rounded-end-1">
        <a href="{{ route('dashboard.index') }}" class="text-brown sidebar-menu-home">
            <img src="{{ asset('assets/images/logo-home.svg') }}" width="30" alt="Home">
        </a>

        <div class="d-flex flex-row flex-lg-column gap-2">
            <a href="{{ route('dashboard.digital-wardrobe') }}" class="sidebar-menu wardrobe">
                <img src="{{ asset('assets/images/logo-wardrobe.svg') }}" alt="Wardrobe">
            </a>
            <a href="{{ route('dashboard.mix-match') }}" class="sidebar-menu">
                <img src="{{ asset('assets/images/logo-mix-match.svg') }}" alt="Mix Match">
            </a>
            <a href="{{ route('dashboard.auto-mix-match') }}" class="sidebar-menu">
                <img src="{{ asset('assets/images/logo-auto-mix-match.svg') }}" alt="Auto">
            </a>
            <a href="{{ route('dashboard.outfit-history') }}" class="sidebar-menu">
                <img src="{{ asset('assets/images/logo-history.svg') }}" alt="History">
            </a>
        </div>

        <a href="{{ route('logout') }}" class="text-brown sidebar-menu-home">
            <img src="{{ asset('assets/images/logo-logout.svg') }}" alt="Home">
        </a>
    </div>
</div>
