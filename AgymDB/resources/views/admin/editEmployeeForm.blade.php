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

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Employee Record</h6>
        </div>
        <div class="card-body">
            <form method='post' action='/admin/employee/{{$employee->id}}/update'>
                {{csrf_field()}}
                <input type='hidden' name='_method' value='PUT'>
                <div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="profile-img">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                                <div class="file btn btn-lg btn-primary">
                                    Change Photo
                                    <input type="file" name="file"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group-row"><div class="col-md-4 text-md-right record-heading">Employee Information</div></div>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Firstname: </label>
                        <div class="col-md-6">
                            <input type='text' name='fname' required value='{{$person->fname}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Surname: </label>
                        <div class="col-md-6">
                            <input type='text' name='lname' required value='{{$person->lname}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Birthday: </label>
                        <div class="col-md-6">
                            <input type='date' name='birthday' required value='{{$person->birthday}}'>
                        </div>
                    </div>
                </div>
                <hr>
                <div>
                    <div class="form-group-row"><div class="col-md-4 text-md-right record-heading">Contact Details</div></div>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Street Address: </label>
                        <div class="col-md-6">
                            <input type='text' name='street_address' required value='{{$person->street_address}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Barangay: </label>
                        <div class="col-md-6">
                            <input type='text' name='barangay' required value='{{$person->barangay}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> City: </label>
                        <div class="col-md-6">
                            <input type='text' name='city' required value='{{$person->city}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Phone Number: </label>
                        <div class="col-md-6">
                            <input type='tel' name='phone_number' required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Email Address: </label>
                        <div class="col-md-6">
                            <input type='email' name='email_address' required value='{{$person->email_address}}'>
                        </div>
                    </div>
                </div>
                <hr>
                <div>
                    <div class="form-group-row"><div class="col-md-4 text-md-right record-heading">Emergency Contact Details</div></div>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Name: </label>
                        <div class="col-md-6">
                            <input type='text' name='emergency_contact_name' required value='{{$person->emergency_contact_name}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Contact Number: </label>
                        <div class="col-md-6">
                            <input type='tel' name='emergency_contact_number' required value='{{$person->emergency_contact_number}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Relationship: </label>
                        <div class="col-md-6">
                            <input type='text' name='relationship' required value='{{$person->emergency_contact_relationship}}'>
                        </div>
                    </div>
                </div>
                <hr>
                <div>
                    <div class="form-group-row"><div class="col-md-4 text-md-right record-heading">Additional Information</div></div>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Monthly Salary: </label>
                        <div class="col-md-6">
                            <input type='number' name='monthly_salary' required value='{{$employee->monthly_salary}}'>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-row justify-content-center">
                    <div class="col-md-2"><input type='submit' class="btn btn-rounded-primary" value='Update'></div>
                    <div class="col-md-2"><button class="btn btn-rounded-light"><a href='/admin/employeeList'>Cancel</a></button></div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
