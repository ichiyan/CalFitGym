@extends('layouts.app')

@section('menu')
    @include('admin.adminmenu')
@endsection

@section('content')
<div class="card">
    <div class="card-header">{{ __('CUSTOMER') }}</div>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <div class="card">
                        <div class="card-header">
                            Edit customer information                           
                        </div>
                        <div class="card-header">
                            <form method='post' action='/admin/customer/{{$customer->id}}/update'>

                                {{csrf_field()}}
                                <input type='hidden' name='_method' value='PUT'>

                                <div>
                                    <div>Customer Information</div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Firstname: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='fname' required value='{{$customer->fname}}'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Surname: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='lname' required value='{{$customer->lname}}'>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Birthday: </label>
                                        <div class="col-md-6">
                                            <input type='date' name='birthday' value='{{$customer->birthday}}'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Height: </label>
                                        <div class="col-md-6">
                                            <input type='number' name='height' placeholder='cm' value='{{$customer->height}}'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Weight: </label>
                                        <div class="col-md-6">
                                            <input type='number' name='weight' placeholder='kgs' value='{{$customer->weight}}'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Pre-Existing Conditions: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='pre_existing_conditions' value='{{$customer->pre_existing_conditions}}'>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div>Contact Details</div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Street Address: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='street_address' value='{{$customer->street_address}}'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-6 col-form-label text-md-right"> Barangay: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='barangay' required value='{{$customer->barangay}}'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> City: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='city' value='{{$customer->city}}'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Phone Number: </label>
                                        <div class="col-md-6">
                                            <input type='number' name='phone_number' value='{{$customer->phone_number}}'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Email Address: </label>
                                        <div class="col-md-6">
                                            <input type='email' name='email_address' value='{{$customer->email_address}}'>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div>Emergency Contact Details: </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Name: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='emergency_contact_name' value='{{$customer->emergency_contact_name}}'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Contact Number: </label>
                                        <div class="col-md-6">
                                            <input type='number' name='emergency_contact_number' value='{{$customer->emergency_contact_number}}'>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Relationship: </label>
                                        <div class="col-md-6">
                                            <input type='text' name='emergency_contact_relationship' value='{{$customer->emergency_contact_relationship}}'>
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