@extends('layouts.admin-app')

@section('sidebar')

    @include('partials.sidebar-employees-active')

@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employees</h1>
    </div><!-- End of Page Heading  -->

    <!-- Update Employee Record Form  -->

    <button class="btn btn-light"><a href='/admin/employeeList'>Back</a></button>
    <br><br>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Employee Record</h6>
        </div>
        <div class="card-body">
            <form>
                <div>
                    <div class="form-group-row"><div class="col-md-4 text-md-right record-heading" >Employee Information</div></div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Firstname: </label>
                        <label class="col-md-6 col-form-label">{{$employee->fname}}</label>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Surname: </label>
                        <div class="col-md-6 col-form-label">{{$employee->lname}}</div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Birthday: </label>
                        <div class="col-md-6 col-form-label">{{$employee->birthday}}</div>
                    </div>
                </div>
                <hr>
                <div>
                    <div class="form-group-row"><div class="col-md-4 text-md-right record-heading">Contact Details</div></div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Street Address: </label>
                        <div class="col-md-6 col-form-label">{{$employee->street_address}}</div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> City: </label>
                        <div class="col-md-6 col-form-label">{{$employee->city}}</div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Phone Number: </label>
                        <div class="col-md-6 col-form-label">{{$employee->phone_number}}</div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Email Address: </label>
                        <div class="col-md-6 col-form-label">{{$employee->email_address}}</div>
                    </div>
                </div>
                <hr>

                <div>
                    <div class="form-group-row"><div class="col-md-4 text-md-right record-heading">Emergency Contact Details</div></div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Name: </label>
                        <div class="col-md-6 col-form-label">{{$employee->emergency_contact_name}}</div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Contact Number: </label>
                        <div class="col-md-6 col-form-label">{{$employee->emergency_contact_number}}</div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Relationship: </label>
                        <div class="col-md-6 col-form-label">{{$employee->emergency_contact_relationship}}</div>
                    </div>
                </div>
                <hr>

                <div>
                    <div class="form-group-row"><div class="col-md-4 text-md-right record-heading">Additional Information</div></div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Monthly Salary: </label>
                        <div class="col-md-6 col-form-label">{{$employee->monthly_salary}}</div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
