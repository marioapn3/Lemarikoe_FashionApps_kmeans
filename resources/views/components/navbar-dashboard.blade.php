<nav class="navbar navbar-expand-lg bg-brown py-2 w-100 sticky-top" data-bs-theme="dark">
    <div class="container-fluid px-2 px-lg-5">
        <a href="{{ route('dashboard.index') }}" class="navbar-brand">
            <img src="{{ asset('assets/images/logo.png') }}" width="170" alt="Logo">
        </a>
        <div class="dropdown">
            <a class="text-white d-flex align-items-center gap-2 fw-semibold" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                {{ Auth::user()->name }}
                @if (Auth::user()->gender == 'boy')
                    <img src="{{ asset('assets/images/boy-icon.png') }}" alt="Username" width="40">
                @else
                    <img src="{{ asset('assets/images/girl-icon.png') }}" alt="Username" width="40">
                @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end bg-white border mt-2">
                <li>
                    <a class="dropdown-item text-dark bg-white" href="{{ route('dashboard.manage_account') }}">
                        Manage Account
                    </a>
                </li>
                <li>
                    <a class="dropdown-item text-dark bg-white" href="{{ route('logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
