@extends('layouts.admin-app')

@section('sidebar')
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
        <li class="nav-item">
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
        <li class="nav-item active">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-user-tie"></i>
                <span>Employees</span>
            </a>
        </li>

        <!-- Nav Item - Customers -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-user"></i>
                <span>Customers</span>
            </a>
        </li>

        <!-- Nav Item - Inventory -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-boxes"></i>
                <span>Inventory</span>
            </a>
        </li>

        <!-- Nav Item - Order -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Order</span>
            </a>
        </li>

        <!-- Nav Item - Products -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-store"></i>
                <span>Products</span>
            </a>
        </li>

        <!-- Nav Item - Rates & Plans -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-tags"></i>
                <span>Rates & Plans</span>
            </a>
        </li>


        <!-- Nav Item - Events & Promos -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-calendar-alt"></i>
                <span>Events & Promos</span>
            </a>
        </li>

        <!-- Nav Item - Facility -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-dumbbell"></i>
                <span>Facility</span>
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

@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Employees ({{ $count }})</h1>
    <br><br>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Address</th>
                            <th>Email Address</th>
                            <th>Contact No.</th>
                            <th>Monthly Salary</th>
                            <th>Trainees</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Address</th>
                            <th>Email Address</th>
                            <th>Contact No.</th>
                            <th>Monthly Salary</th>
                            <th>Trainees</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forEach ($employees as $value => $employee)
                                <tr>
                                    <td> {{$employee->id}} </td>
                                    <td> {{$employee->fname}}   {{$employee->lname}} </td>
                                    <td> {{$bday[$value]}} </td>
                                    <td> {{$employee->street_address}} ,  {{$employee->city}}  City </td>
                                    <td> {{$employee->email_address}} </td>
                                    <td> {{$employee->phone_number}} </td>
                                    <td> {{$employee->monthly_salary}} </td>
                                    <td> {{$employee->no_of_trainees}} </td>
                                    <td>
<<<<<<< Updated upstream
                                        <button><a href="{{route('employeeEdit', $employee->id)}}">Update</a></button>
                                        <button><a href="{{route('employeeDetail', $employee->id)}}">Details</a></button>
=======
                                        <form>
                                            <input type='hidden' name='employee_id' value='{{$employee->id}}'>
                                            <input class="btn btn-sm btn-primary" type="submit" value="Update">
                                        </form>
>>>>>>> Stashed changes
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
