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
        <li class="nav-item active">
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
        <li class="nav-item">
            <a class="nav-link collapsed" href="/admin/employeeList">
                <i class="fas fa-fw fa-user-tie"></i>
                <span>Employees</span>
            </a>
        </li>

        <!-- Nav Item - Customers -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="/admin/customerList">
                <i class="fas fa-fw fa-user"></i>
                <span>Customers</span>
            </a>
        </li>

        <!-- Nav Item - Inventory -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="/admin/inventory">
                <i class="fas fa-fw fa-boxes"></i>
                <span>Inventory</span>
            </a>
        </li>

        <!-- Nav Item - Order -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="/admin/orderList">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Order</span>
            </a>
        </li>

        <!-- Nav Item - Products -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="">
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
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <div class="btn-toolbar">
                <div class="btn-group mr-3">
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> New Order</a>
                </div>
                <div class="btn-group mr-3">
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> New Customer</a>
                </div>
                <div class="btn-group mr-3">
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> New Product Batch</a>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">

             <!-- Earnings (Annual) Card Example -->
             <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Earnings (Annual)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"> &#8369 215,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Earnings (Monthly)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"> &#8369 40,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Earnings (Today) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Earnings (Today)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">&#8369 215,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logged Customers -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Logged Customers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Content Row -->

    </div>
    <!-- End of Page Content -->
@endsection


