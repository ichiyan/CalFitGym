 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-dark-2 sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon">
            <i class="bx bx-dumbbell"></i>
        </div>
        <div class="sidebar-brand-text mx-3">CalFit Gym</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('home') ? 'active' : '' }} ">
        <a class="nav-link" href="{{ url('/home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manage
    </div>

    <!-- Nav Item - Employees -->
    <li class="nav-item  @if (str_contains(url()->current(), 'admin/employeeList')) active @endif ">
        <a class="nav-link collapsed" href="{{ url('/admin/employeeList/all/all') }}">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>Employees</span>
        </a>
    </li>

    <!-- Nav Item - Customers -->
    <li class="nav-item  @if (str_contains(url()->current(), 'admin/customerList')) active @endif  ">
        <a class="nav-link collapsed" href="/admin/customerList/all/all">
            <i class="fas fa-fw fa-user"></i>
            <span>Customers</span>
        </a>
    </li>

    <!-- Nav Item - Inventory -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/inventoryList/all">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Inventory</span>
        </a>
    </li>

    <!-- Nav Item - Order -->
    <li class="nav-item @if (str_contains(url()->current(), 'admin/order')) active @endif ">
        <a class="nav-link collapsed" href="/admin/orderList">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Order</span>
        </a>
    </li>

    <!-- Nav Item - Products -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="/productsList/all">
            <i class="fas fa-fw fa-store"></i>
            <span>Products</span>
        </a>
    </li>

    <!-- Nav Item - Rates & Plans -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#">
            <i class="fas fa-fw fa-tags"></i>
            <span>Rates & Plans</span>
        </a>
    </li>


    <!-- Nav Item - Events & Promos -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Events & Promos</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
