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
                            Create new employee                             
                        </div>
                        <div class="card-header">
                            <form method='' action='/admin/employee/create'>

                                <div>
                                    <div>Employee Information</div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Firstname: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='fname' required value='{{$user->name}}'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Surname: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='lname' required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Birthday: </label>
                                        <div class="col-md-6">
                                            <input type='date' name='birthday' required>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div>Contact Details</div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Street Address: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='street_address' required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-6 col-form-label text-md-right"> Barangay: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='barangay' required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> City: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='city' required>
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
                                            <input type='email' name='email_address' required value='{{$user->email}}'>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div>Emergency Contact Details: </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Name: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='emergency_contact_name' required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Contact Number: </label>
                                        <div class="col-md-6">
                                            <input type='tel' name='emergency_contact_number' required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Relationship: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='emergency_contact_relationship' required>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div>Additional Details</div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Monthly Salary: </label>
                                        <div class="col-md-6">
                                            <input type='number' name='monthly_salary' required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <center class="col-md-6">
                                        <input type='hidden' name='user_id' value='{{$user->id}}'>
                                        <input type='submit' value='Register'>
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