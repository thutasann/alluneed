<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark  accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand my-2 d-flex align-items-center justify-content-center" href="{{ url('/vendor-dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/img/logo.png') }}" width="135px">
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Vendor Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/vendor-dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Vendor Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manage Items
    </div>

    <!-- Nav Item - Manage Items -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/vendor/products') }}">
            <i class="fas fa-th-list"></i>
            <span>Manage Products</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manage Ads
    </div>

    <!-- Nav Item - Manage Ads -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-ad"></i>
            <span>Advertise Products</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Ads:</h6>
                <a class="collapse-item" href="{{ url('/vendor/manage-ads') }}">Manage Ads</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manage Order
    </div>

    <!-- Nav Item - Manage Orders -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-truck"></i>
            <span>Orders</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Orders:</h6>
                <a class="collapse-item" href="{{ url('vendor/orders') }}">All Orders</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manage Coupon
    </div>

    <!-- Nav Item - Coupon -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('vendor/coupons') }}">
            <i class="fas fa-gift"></i>
            <span>Coupon</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manage your Customers
    </div>

    <!-- Nav Item - Customers -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('vendor/customers') }}">
            <i class="fas fa-users"></i>
            <span>Customers</span>
        </a>
    </li>

    <hr class="sidebar-divider">


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <hr class="sidebar-divider d-none d-md-block">

</ul>
