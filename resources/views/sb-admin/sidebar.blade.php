<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <img class="img-profile rounded-circle" height="50" src="{{ url('/img/mm.jpg') }}">
        </div>
        <div class="sidebar-brand-text mx-3">SI Pencatatan Besi Tua</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ url()->current() == route('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!--
    <div class="sidebar-heading">
        Interface
    </div> -->

    <!-- Material Request -->
    <li class="nav-item {{ url()->current() == route('materialReqs') ? 'active' : '' }}">
        <a class="nav-link" href="/materialreq">
            <i class="fas fa fa-fw fa-code-pull-request"></i>
            <span>Material Request</span></a>
    </li>

    <!-- Stock Count -->
    <li class="nav-item {{ url()->current() == route('stockCounts') ? 'active' : '' }}">
        <a class="nav-link" href="/stockcount">
            <i class="fas fa-fw fa-sharp fa-solid fa-warehouse"></i>
            <span>Stock Count</span></a>
    </li>

    <!-- ITR -->
    <li class="nav-item {{ url()->current() == route('itr') ? 'active' : '' }}">
        <a class="nav-link" href="/ITR">
            <i class="fas fa-fw fa-solid fa-arrow-right-arrow-left"></i>
            <span>Interwarehouse Transfer</span></a>
    </li>
    @if (auth()->user()->role == 'admin_gudang')
        <li class="nav-item {{ url()->current() == route('itrIn') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('itrIn') }}">
                <i class="fas fa-fw fa-solid fa-arrow-right-arrow-left"></i>
                <span>Interwarehouse Transfer In</span></a>
        </li>
    @endif

    <!-- Delivery Order -->
    <li class="nav-item {{ url()->current() == route('do') ? 'active' : '' }}">
        <a class="nav-link" href="/DO">
            <i class="fas fa-fw fa-solid fa-truck-pickup"></i>
            <span>Delivery Order</span></a>
    </li>

    <!-- Produk -->
    @if (auth()->user()->role != 'admin_pengajuan')
        <li class="nav-item {{ url()->current() == route('products') ? 'active' : '' }}">
            <a class="nav-link" href="/product">
                <i class="fas fa-fw fa-brands fa-product-hunt"></i>
                <span>Product</span></a>
        </li>
    @endif


    @if (auth()->user()->role == 'admin_gudang')
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
    @endif

    <!-- Laporan -->
    @if (auth()->user()->role == 'admin_gudang')
        <li class="nav-item {{ url()->current() == route('reporting') ? 'active' : '' }}"
            href="{{ route('expiredMaterial') }}">
            <a class="nav-link" href="{{ route('reporting') }}">
                <i class="fas fa-fw fa-solid fa-book"></i>
                <span>Reporting</span></a>
        </li>
    @endif

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
