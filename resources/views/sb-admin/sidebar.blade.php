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

    <div class="sidebar-heading">
        Produk
    </div>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('produk.*') ? 'text-purple' : '' }}"
            href="{{ route('produk.index') }}">
            {{-- <i class="fa-duotone fa-solid fa-gauge"></i> --}}
            <i class="fa-solid fa-box {{ request()->routeIs('produk.*') ? 'text-purple' : '' }}"></i>
            <span class="font-weight-bold">Produk</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('stock-scrap.*') ? 'text-purple' : '' }}"
            href="{{ route('stock-scrap.index') }}">
            {{-- <i class="fa-duotone fa-solid fa-gauge"></i> --}}
            <i class="fa-solid fa-box {{ request()->routeIs('stock-scrap.*') ? 'text-purple' : '' }}"></i>
            <span class="font-weight-bold">Stok Scrap</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('perusahaan.*') ? 'text-purple' : '' }}"
            href="{{ route('perusahaan.index') }}">
            {{-- <i class="fa-duotone fa-solid fa-gauge"></i> --}}
            <i class="fa-solid fa-box {{ request()->routeIs('perusahaan.*') ? 'text-purple' : '' }}"></i>
            <span class="font-weight-bold">Perusahaan</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('kendaraan.*') ? 'text-purple' : '' }}"
            href="{{ route('kendaraan.index') }}">
            {{-- <i class="fa-duotone fa-solid fa-gauge"></i> --}}
            <i class="fa-solid fa-box {{ request()->routeIs('kendaraan.*') ? 'text-purple' : '' }}"></i>
            <span class="font-weight-bold">Kendaraan</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('surat-jalan.*') ? 'text-purple' : '' }}"
            href="{{ route('surat-jalan.index') }}">
            {{-- <i class="fa-duotone fa-solid fa-gauge"></i> --}}
            <i class="fa-solid fa-box {{ request()->routeIs('surat-jalan.*') ? 'text-purple' : '' }}"></i>
            <span class="font-weight-bold">Surat Jalan</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('barang-masuk.*') ? 'text-purple' : '' }}"
            href="{{ route('barang-masuk.index') }}">
            {{-- <i class="fa-duotone fa-solid fa-gauge"></i> --}}
            <i class="fa-solid fa-box {{ request()->routeIs('barang-masuk.*') ? 'text-purple' : '' }}"></i>
            <span class="font-weight-bold">Barang Masuk</span></a>
    </li>


    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('barang-keluar.*') ? 'text-purple' : '' }}"
            href="{{ route('barang-keluar.index') }}">
            {{-- <i class="fa-duotone fa-solid fa-gauge"></i> --}}
            <i class="fa-solid fa-box {{ request()->routeIs('barang-keluar.*') ? 'text-purple' : '' }}"></i>
            <span class="font-weight-bold">Barang Keluar</span></a>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link collapsed {{ request()->routeIs('barang-masuk-besi-tua.*') || request()->routeIs('barang-masuk-besi-scrap.*') ? 'text-purple' : '' }}"
            href="#" data-toggle="collapse" data-target="#collapseBarangMasuk" aria-expanded="true"
            aria-controls="collapseBarangMasuk">
            <i
                class="fa-solid fa-indent {{ request()->routeIs('barang-masuk-besi-tua.*') || request()->routeIs('barang-masuk-besi-scrap.*') ? 'text-purple' : '' }}"></i>
            <span class="font-weight-bold">Barang Masuk</span>
        </a>
        <div id="collapseBarangMasuk"
            class="collapse {{ request()->routeIs('barang-masuk-besi-tua.*') || request()->routeIs('barang-masuk-besi-scrap.*') ? 'show' : '' }}"
            aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white collapse-inner rounded mb-1">
                <a class="collapse-item {{ request()->routeIs('barang-masuk-besi-tua.*') ? 'active' : '' }}"
                    href="{{ route('barang-masuk-besi-tua.index') }}">Besi Tua</a>
            </div>
            <div class="bg-white collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('barang-masuk-besi-scrap.*') ? 'active' : '' }}"
                    href="{{ route('barang-masuk-besi-scrap.index') }}">Besi Scrap</a>
            </div>
        </div>
    </li> --}}

    {{-- <li class="nav-item">
        <a class="nav-link collapsed {{ request()->routeIs('barang-keluar-besi-tua.*') || request()->routeIs('barang-keluar-besi-scrap.*') ? 'text-purple' : '' }}"
            href="#" data-toggle="collapse" data-target="#collapseBarangKeluar" aria-expanded="true"
            aria-controls="collapseBarangKeluar">
            <i
                class="fa-solid fa-indent {{ request()->routeIs('barang-keluar-besi-tua.*') || request()->routeIs('barang-keluar-besi-scrap.*') ? 'text-purple' : '' }}"></i>
            <span class="font-weight-bold">Barang Keluar</span>
        </a>
        <div id="collapseBarangKeluar"
            class="collapse {{ request()->routeIs('barang-keluar-besi-tua.*') || request()->routeIs('barang-keluar-besi-scrap.*') ? 'show' : '' }}"
            aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white collapse-inner rounded mb-1">
                <a class="collapse-item {{ request()->routeIs('barang-keluar-besi-tua.*') ? 'active' : '' }}"
                    href="{{ route('barang-keluar-besi-tua.index') }}">Besi Tua</a>
            </div>
            <div class="bg-white collapse-inner rounded">
                <a class="collapse-item {{ request()->routeIs('barang-keluar-besi-scrap.*') ? 'active' : '' }}"
                    href="{{ route('barang-keluar-besi-scrap.index') }}">Besi Scrap</a>
            </div>
        </div>
    </li> --}}

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('history.*') ? 'text-purple' : '' }}"
            href="{{ route('history.index') }}">
            {{-- <i class="fa-duotone fa-solid fa-gauge"></i> --}}
            <i class="fa-solid fa-box {{ request()->routeIs('history.*') ? 'text-purple' : '' }}"></i>
            <span class="font-weight-bold">Riwayat</span></a>
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
