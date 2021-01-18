@extends('layouts.admin-app')

@section('sidebar')

    @include('partials.sidebar-employees-active')

@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employees</h1>
        <div class="btn-toolbar">
            <div class="btn-group mr-3">
                <a href="{{ route('register') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> New Employee</a>
            </div>
        </div>
    </div><!-- End of Page Heading  -->

    <!-- Table  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link @if($active == 'all') active @endif" href='/admin/employeeList'>All ({{ $countAll }})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($active == 'current') active @endif" href='/admin/employeeList/current'>Current ({{ $countCurrent }})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if($active == 'previous') active @endif" href='/admin/employeeList/previous'>Previous ({{ $countPrevious }})</a>
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
                        @forEach ($employees as $value => $employee)
                                <tr>
                                    <td> {{$employee->id}} </td>
                                    <td> {{$employee->fname}}   {{$employee->lname}} </td>
                                    <td> {{$bday[$value]}} </td>
                                    <td> {{$employee->email_address}} </td>
                                    <td> {{$employee->phone_number}} </td>
                                    <td> &#8369 {{ number_format( $employee->monthly_salary , 2, '.', ',') }} </td>
                                    <td> {{$employee->no_of_trainees}} </td>
                                    <td>
                                        <button><a href="{{route('employeeEdit', $employee->id)}}">Update</a></button>
                                        <button><a href="{{route('employeeDetail', $employee->id)}}">Details</a></button>
                                        {{-- <form>
                                            @csrf
                                            <input type='hidden' name='employee_id' value='{{$employee->id}}'>
                                            <button class="btn btn-primary" type="submit" value="Update">
                                        </form> --}}
                                        <button type="button" class="btn btn-sm btn-info"><a href="{{route('employeeDetail', $employee->id)}}" style="color: white">Info</a></button>
                                        <button type="button" class="btn btn-sm btn-primary"><a href="{{route('employeeEdit', $employee->id)}}" style="color: white">Update</a></button>
                                        @if (is_null( $employee->date_separated ) )
                                            <button type="button" class="btn btn-sm btn-danger"><a href="" style="color: white">Rehire</a></button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-danger"><a href="" style="color: white">Dismiss</a></button>
                                        @endif
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
