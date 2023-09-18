<div class="sidebar col-md-3 col-lg-2 p-0">
    <div class="offcanvas-lg offcanvas-end" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">{{ config('app.name') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>

        <div class="px-3 mt-3 d-flex align-items-center">
            <i class="fas fa-user-circle display-6 me-3 text-primary-emphasis"></i>
            <div>
                <p class="m-0">
                    <strong>{{ \Illuminate\Support\Facades\Auth::user()->name }}</strong>
                </p>
                <p class="m-0 small">{{ \Illuminate\Support\Facades\Auth::user()->email }}</p>
            </div>
        </div>

        <hr class="mt-4 mb-0">

        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">

            <x-sidebar-menu-tree></x-sidebar-menu-tree>

            <hr class="my-3">

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="#" onclick="logout()">
                        <i class="fas fa-user-lock"></i>
                        Kijelentkezés
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
