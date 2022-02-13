<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark  accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand my-2 d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/img/logo.png') }}" width="135px">
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">


    <div class="sidebar-heading">
        Manage Collections
    </div>

    <!-- Nav Item - Collections Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-th-list"></i>
            <span>Collections</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Browse Collections:</h6>
                <a class="collapse-item" href="{{ url('/groups') }}">Group</a>
                <a class="collapse-item" href="{{ url('/category') }}">Category</a>
                <a class="collapse-item" href="{{ url('/sub-category') }}">Sub Category (Brand)</a>
                <a class="collapse-item" href="{{ url('/products') }}">Products (Items)</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manage Order
    </div>

    <!-- Nav Item - Orders Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-truck"></i>
            <span>Orders</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Browse Orders:</h6>
                <a class="collapse-item" href="{{ url('orders') }}">Orders</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manage Coupon
    </div>

    <!-- Nav Item - Coupon -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/coupon-view') }}">
            <i class="fas fa-gift"></i>
            <span>Coupon</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manage Slider (Ads)
    </div>

    <!-- Nav Item - Home Slider -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('manage-slider') }}">
            <i class="fas fa-ad"></i>
            <span>Home Slider</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Manage Users
    </div>

    <!-- Nav Item - Registered Users -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('registered-user') }}">
            <i class="fas fa-users"></i>
            <span>Users</span>
        </a>
    </li>

    <hr class="sidebar-divider">


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <hr class="sidebar-divider d-none d-md-block">

</ul>
