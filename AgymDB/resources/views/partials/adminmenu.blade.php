<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">
        California Fitness Gym
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/">
<!-- ICONS CODE -->
                <!-- <svg class="c-sidebar-nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg> -->
                Home
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/home">
<!-- ICONS CODE -->
                <!-- <svg class="c-sidebar-nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg> -->
                Dashboard
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/admin/employeeList">
<!-- ICONS CODE -->
                <!-- <svg class="c-sidebar-nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg>-->
                Employees
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/admin/customerList">
<!-- ICONS CODE -->
                <!-- <svg class="c-sidebar-nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg>-->
                Customers
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/admin/inventory">
<!-- ICONS CODE -->
                <!-- <svg class="c-sidebar-nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg>-->
                Inventory
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/admin/order">
<!-- ICONS CODE -->
                <!-- <svg class="c-sidebar-nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg>-->
                Order
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/admin/rates">
<!-- ICONS CODE -->
                <!-- <svg class="c-sidebar-nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg>-->
                Rates & Plans
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/admin/events">
<!-- ICONS CODE -->
                <!-- <svg class="c-sidebar-nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg>-->
                Events / Promos
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
<!-- ICONS CODE -->
                <!-- <svg class="c-sidebar-nav-icon">
                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg>-->
                Logout
            </a>
        </li>
    </ul>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>