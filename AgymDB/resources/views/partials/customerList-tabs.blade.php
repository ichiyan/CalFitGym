<div class="card-header py-3">
    <ul class="nav nav-tabs">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle  @if (str_contains(url()->current(), 'admin/customerList/all')) active @endif" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">All ({{$countAll}}) </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/admin/customerList/all/all">All</a>
                <a class="dropdown-item" href="/admin/customerList/all/active">Active</a>
                <a class="dropdown-item" href="/admin/customerList/all/inactive">Inactive</a>
                <a class="dropdown-item" href="/admin/customerList/all/logged_in">Logged In</a>
                <a class="dropdown-item" href="/admin/customerList/all/logged_out">Logged Out</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle @if (str_contains(url()->current(), 'admin/customerList/walk_in')) active @endif" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">Walk-in ({{$countWalkIn}}) </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/admin/customerList/walk_in/all">All </a>
                <a class="dropdown-item" href="/admin/customerList/walk_in/active">Active </a>
                <a class="dropdown-item" href="/admin/customerList/walk_in/inactive">Inactive</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle @if (str_contains(url()->current(), 'admin/customerList/monthly')) active @endif " data-toggle="dropdown" href="/admin/customerList/monthly/all" role="button" aria-haspopup="true" aria-expanded="false">Monthly ({{$countMonthly}})</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/admin/customerList/monthly/all">All</a>
                <a class="dropdown-item" href="/admin/customerList/monthly/active">Active</a>
                <a class="dropdown-item" href="/admin/customerList/monthly/inactive">Inactive</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle @if (str_contains(url()->current(), 'admin/customerList/premium')) active @endif" data-toggle="dropdown" href="/admin/customerList/premium/all" role="button" aria-haspopup="true" aria-expanded="false">Premium ({{$countPremium}})</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/admin/customerList/premium/all">All</a>
                <a class="dropdown-item" href="/admin/customerList/premium/active">Active</a>
                <a class="dropdown-item" href="/admin/customerList/premium/inactive">Inactive</a>
            </div>
        </li>
    </ul>
</div>
