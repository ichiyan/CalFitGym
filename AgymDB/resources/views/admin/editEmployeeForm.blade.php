@extends('layouts.app')

@section('menu')
    @include('admin.adminmenu')
@endsection

@section('content')
<div class="card">
    <div class="card-header">{{ __('EMPLOYEES') }}</div>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <div class="card">
                        <div class="card-header">
                            Edit employee information
                        </div>
                        <div class="card-header">
                            <form method='post' action='/admin/employee/{{$employee->id}}/update'>

                                {{csrf_field()}}
                                <input type='hidden' name='_method' value='PUT'>

                                <div>
                                    <div>Employee Information</div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Firstname: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='fname' required value='{{$person->fname}}'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Surname: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='lname' required value='{{$person->lname}}'>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Birthday: </label>
                                        <div class="col-md-6">
                                            <input type='date' name='birthday' required value='{{$person->birthday}}'>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div>Contact Details</div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Street Address: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='street_address' required value='{{$person->street_address}}'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> City: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='city' required value='{{$person->city}}'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Phone Number: </label>
                                        <div class="col-md-6">
                                            <input type='tel' name='phone_number' required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Email Address: </label>
                                        <div class="col-md-6">
                                            <input type='email' name='email_address' required value='{{$person->email_address}}'>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div>Emergency Contact Details: </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Name: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='emergency_contact_name' required value='{{$person->emergency_contact_name}}'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Contact Number: </label>
                                        <div class="col-md-6">
                                            <input type='tel' name='emergency_contact_number' required value='{{$person->emergency_contact_number}}'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Relationship: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='relationship' required value='{{$person->emergency_contact_relationship}}'>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div>Additional Details</div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Monthly Salary: </label>
                                        <div class="col-md-6">
                                            <input type='number' name='monthly_salary' required value='{{$employee->monthly_salary}}'>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <center class="col-md-6">
                                        <input type='submit' value='Update'>
                                    </center>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>  
            </div>
        </main>
    </div>            
</div>   
@endsection