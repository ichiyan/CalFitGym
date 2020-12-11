@extends('layouts.app')

@section('menu')
    @include('admin.adminmenu')
@endsection

@section('content')
<div class="card">
    <div class="card-header">{{ __('CUSTOMERS') }}</div>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <div class="card">
                        <div class="card-header">
                            <form>
                                <div>
                                    <label>Search: <input type="text" name="search" placeholder="find customer name"></label>
                                </div>
                            </form>
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href='/admin/customerList'>All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item nav-link" href='/admin/customerList/walk_in'>Walk-In</a>
                                    <a class="dropdown-item" href='/admin/customerList/walk_in/active'>Active</a>
                                    <a class="dropdown-item" href='/admin/customerList/walk_in/inactive'>Inactive</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item nav-link" href='/admin/customerList/monthly'>Monthly</a>
                                    <a class="dropdown-item" href='/admin/customerList/montly/active'>Active</a>
                                    <a class="dropdown-item" href='/admin/customerList/monthly/inactive'>Inactive</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item nav-link" href='/admin/customerList/premium'>Premium</a>
                                    <a class="dropdown-item" href='/admin/customerList/premium/active'>Active</a>
                                    <a class="dropdown-item" href='/admin/customerList/premium/inactive'>Inactive</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-header">
                            No. of Customers:  
                        </div>
                        <table class="table table-responsive-sm table-hover table-outline mb-0">
                            <tr class="thead-light">
                                <td class="text-center">dot</td>
                                <td class="text-center">#</td>
                                <td class="text-center">Name</td>
                                <td class="text-center">Age</td>
                                <td class="text-center">Address</td>
                                <td class="text-center">Email Address</td>
                                <td class="text-center">Contact No.</td>
                                <td class="text-center">Membership</td>
                                <td class="text-center">Status</td>
                                <td class="text-center">More Info</td>
                                <td class="text-center">Action</td>
                            </tr>        
                            
                        </table>
                    </div>
                </div>  
            </div>
        </main>
    </div>            
</div>   
@endsection