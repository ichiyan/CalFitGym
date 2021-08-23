@extends('layouts.admin-app')

@section('sidebar')

    @include('partials.admin-sidebar')

@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employees</h1>
        <!-- <div class="btn-toolbar">
            <div class="btn-group mr-3">
                <a href="{{ route('register') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> New Employee</a>
            </div>
        </div> -->
        <div class="btn-toolbar">
            <div class="btn-group mr-3">
                <a href="{{ route('newEmployee') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> New Employee </a>
            </div>
        </div>
    </div><!-- End of Page Heading  -->

    <!-- Table  -->
    <div class="card shadow mb-4">

        @include('partials.employeeList-tabs')

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Log</th>
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

                    <tbody>
                        @forEach ($employees as $value => $employee)
                                <tr>
                                    <td>
                                    @if (is_null( $employee->date_separated ) )
                                        @if($log[$value]->exit == NULL)
                                            <a href="/admin/log/{{$log[$value]->id}}/edit"><span class="log-btn login" data-toggle="tooltip" data-placement="top" title="click to logout"></span></a>
                                        @else
                                            <a href="/admin/log/{{$employee->id}}/create"><span class="log-btn logout" data-toggle="tooltip" data-placement="top" title="click to login"></span></a>
                                        @endif
                                    @else
                                        <span class="log-btn inactive" data-toggle="tooltip" data-placement="top" title="inactive"></span>
                                    @endif
                                    </td>

                                    <td> {{$employee->id}} </td>
                                    <td> {{$employee->fname}}   {{$employee->lname}} </td>
                                    <td> {{$bday[$value]}} </td>
                                    <td> {{$employee->email_address}} </td>
                                    <td> {{$employee->phone_number}} </td>
                                    <td> &#8369 {{ number_format( $employee->monthly_salary , 2, '.', ',') }} </td>
                                    <td> {{$employee->no_of_trainees}} </td>
                                    <td>
                                        {{-- <form>
                                            @csrf
                                            <input type='hidden' name='employee_id' value='{{$employee->id}}'>
                                            <button class="btn btn-primary" type="submit" value="Update">
                                        </form> --}}
                                        <button type="button" class="btn btn-sm btn-info"><a href="{{route('employeeDetail', $employee->id)}}" style="color: white">Info</a></button>
                                        <button type="button" class="btn btn-sm btn-primary"><a href="{{route('employeeEdit', $employee->id)}}" style="color: white">Edit</a></button>
                                        @if (is_null( $employee->date_separated ) )
                                            <button type="button" class="btn btn-sm btn-danger"><a href="" data-toggle="modal" data-target="#dismissEmployeeModal-{{$employee->id}}" style="color: white">Dismiss</a></button>
                                            {{-- @if($employee->user_id == 0)
                                                <div class="btn-group mr-3">
                                                    <a href="{{ route('register') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Register</a>
                                                </div>
                                            @endif --}}
                                        @else
                                            <button type="button" class="btn btn-sm btn-warning"><a href="" data-toggle="modal" data-target="#rehireEmployeeModal-{{$employee->id}}"  style="color: white">Rehire</a></button>
                                        @endif

                                    </td>

                                </tr>

                                 <!-- Dismiss Employee Modal-->
                                <div class="modal fade" id="dismissEmployeeModal-{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Dismiss employee?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Select "Dismiss" below to confirm dismissal of {{$employee->fname}}   {{$employee->lname}}.</div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-danger"><a href="/admin/employee/{{$employee->id}}/delete" style="color: white">Dismiss</a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 <!-- Rehire Employee Modal-->
                                <div class="modal fade" id="rehireEmployeeModal-{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Rehire employee?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Select "Rehire" below to confirm reemployment of {{$employee->fname}}   {{$employee->lname}}.</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-warning"><a href="/admin/employee/{{$employee->id}}/rehire" style="color: white">Rehire</a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                         @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>






@endsection
