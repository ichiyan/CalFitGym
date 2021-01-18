@extends('layouts.admin-app')

@section('sidebar')

    @include('partials.sidebar-customers-active')

@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customers</h1>
        <div class="btn-toolbar">
            <div class="btn-group mr-3">
                <a href="{{ route('register') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> New Customer</a>
            </div>
        </div>
    </div><!-- End of Page Heading  -->

    <!-- Table  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href='/admin/customerList'>All</a>
                </li>
                <li class="nav-item ">
                    <a class="dropdown-item nav-link" href='/admin/customerList/walk_in/all'>Walk-In</a>
                    <a class="dropdown-item" href='/admin/customerList/walk_in/active'>Active</a>
                    <a class="dropdown-item" href='/admin/customerList/walk_in/inactive'>Inactive</a>
                </li>
                <li class="nav-item">
                    <a class="dropdown-item nav-link" href='/admin/customerList/monthly/all'>Monthly</a>
                    <a class="dropdown-item" href='/admin/customerList/monthly/active'>Active</a>
                    <a class="dropdown-item" href='/admin/customerList/monthly/inactive'>Inactive</a>
                </li>
                <li class="nav-item">
                    <a class="dropdown-item nav-link" href='/admin/customerList/premium/all'>Premium</a>
                    <a class="dropdown-item" href='/admin/customerList/premium/active'>Active</a>
                    <a class="dropdown-item" href='/admin/customerList/premium/inactive'>Inactive</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Age</th>
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
                            <th>Email Address</th>
                            <th>Contact No.</th>
                            <th>Monthly Salary</th>
                            <th>Trainees</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
