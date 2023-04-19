<div class="dropdown ms-1">
    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
        data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
            class="rounded-circle">
    </a>
    <ul class="dropdown-menu text-small">
        <li><a class="dropdown-item" href="{{ route('dashboard.create')}}">New product...</a></li>
        <li><a class="dropdown-item" href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item">Logout</button>
            </form>
        </li>
    </ul>
</div>