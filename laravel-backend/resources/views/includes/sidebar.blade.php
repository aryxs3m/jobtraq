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
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" aria-current="page" href="/">
                        <i class="fas fa-gauge-simple-high"></i>
                        Dashboard
                    </a>
                </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>Naplók</span>
            </h6>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="/scraper-logs">
                        <i class="fas fa-file-text"></i>
                        Scraper naplók
                    </a>
                </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>Hirdetések</span>
            </h6>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="/job-listings">
                        <i class="fas fa-building"></i>
                        Álláshirdetések
                    </a>
                </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>Scraper beállítások</span>
            </h6>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="/scraper-keywords">
                        <i class="fas fa-cloud"></i>
                        Scraper kulcsszavak
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="/job-positions">
                        <i class="fas fa-briefcase"></i>
                        Pozíciók
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="/job-levels">
                        <i class="fas fa-level-up"></i>
                        Pozíció szintek
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="/job-stacks">
                        <i class="fas fa-code"></i>
                        Stackek
                    </a>
                </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>Törzsadatok</span>
            </h6>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="/data/locations">
                        <i class="fas fa-map-location"></i>
                        Helyek
                    </a>
                </li>
            </ul>
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="/data/countries">
                        <i class="fas fa-map"></i>
                        Országok
                    </a>
                </li>
            </ul>

            <hr class="my-3">

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="#" onclick="logout(event)">
                        <i class="fas fa-user-lock"></i>
                        Kijelentkezés
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
