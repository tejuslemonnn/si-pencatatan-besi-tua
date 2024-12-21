<ul class="navbar-nav bg-gradient-light sidebar sidebar-light accordion" id="accordionSidebar">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link {{ url()->current() == route('dashboard') ? 'text-purple' : '' }}" href="/dashboard">
            {{-- <i class="fa-duotone fa-solid fa-gauge"></i> --}}
            <i class="fas fa-fw fa-tachometer-alt {{ url()->current() == route('dashboard') ? 'text-purple' : '' }}"></i>
            <span class="font-weight-bold">Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <div class="sidebar-heading">
        Produk
    </div>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('data-kapal.*') ? 'text-purple' : '' }}"
            href="{{ route('data-kapal.index') }}">
            {{-- <i class="fa-duotone fa-solid fa-gauge"></i> --}}
            <i class="fa-solid fa-ship {{ request()->routeIs('data-kapal.*') ? 'text-purple' : '' }}"></i>
            <span class="font-weight-bold">Data Kapal</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('produk.*') ? 'text-purple' : '' }}"
            href="{{ route('produk.index') }}">
            {{-- <i class="fa-duotone fa-solid fa-gauge"></i> --}}
            <i class="fa-solid fa-box {{ request()->routeIs('produk.*') ? 'text-purple' : '' }}"></i>
            <span class="font-weight-bold">Produk</span></a>
    </li>

    <div class="sidebar-heading">
        DO
    </div>

    <div class="sidebar-heading">
        Laporan
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExpired"
            aria-expanded="true" aria-controls="collapseExpired">
            <i class="fa-regular fa-calendar-days"></i>
            <span>Expired Draft</span>
        </a>
        <div id="collapseExpired" class="collapse {{ Request::is('expired*') ? 'show' : '' }}"
            aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Draft:</h6>
                <a class="collapse-item {{ url()->current() == route('expiredMaterial') ? 'active' : '' }}"
                    href="{{ route('expiredMaterial') }}">Expired Material</a>
                <a class="collapse-item {{ url()->current() == route('expiredStock') ? 'active' : '' }}"
                    href="{{ route('expiredStock') }}">Expired Stock</a>
                <a class="collapse-item {{ url()->current() == route('expiredITR') ? 'active' : '' }}"
                    href="{{ route('expiredITR') }}">Expired ITR</a>
                <a class="collapse-item {{ url()->current() == route('expiredDO') ? 'active' : '' }}"
                    href="{{ route('expiredDO') }}">Expired DO</a>
            </div>
        </div>
    </li>


    </li>


    <!-- Divider -->
    {{-- <hr class="sidebar-divider"> --}}

    <!-- Heading -->
    {{-- <div class="sidebar-heading">
        Addons
    </div> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse show" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item active" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Charts -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li> --}}

    <!-- Nav Item - Tables -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>

    </div>

</ul>
