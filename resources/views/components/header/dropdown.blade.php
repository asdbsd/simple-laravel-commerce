<div class="dropdown ms-1">
    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
        data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
            class="rounded-circle">
    </a>
    <ul class="dropdown-menu text-small">
        <li><a class="dropdown-item" href="/dashboard/add-product">New product...</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <form method="POST" action="/logout">
                @csrf
                <button class="dropdown-item" href="/logout">Logout</button>
            </form>
        </li>
    </ul>
</div>