<div class="card-header py-3">
    <ul class="nav nav-tabs">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle  @if (str_contains(url()->current(), 'admin/employeeList/all')) active @endif" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">All ({{$countAll}}) </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/admin/employeeList/all/all">All</a>
                <a class="dropdown-item" href="/admin/employeeList/all/logged_in">Logged In</a>
                <a class="dropdown-item" href="/admin/employeeList/all/logged_out">Logged Out</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($active == 'current') active @endif" href='/admin/employeeList/current'>Current ({{ $countCurrent }})</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($active == 'previous') active @endif" href='/admin/employeeList/previous'>Previous ({{ $countPrevious }})</a>
        </li>
    </ul>
</div>
