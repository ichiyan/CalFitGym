@extends('layouts.admin-app')

@section('sidebar')

    @include('partials.admin-sidebar')

@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customers</h1>
    </div><!-- End of Page Heading  -->

    <!-- Update Employee Record Form  -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Customer Record</h6>
        </div>
        <div class="card-body">
            <form method='post' action='/admin/customer/{{$customer->id}}/update'>
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
                    <div class="form-group-row"><div class="col-md-4 text-md-right record-heading">Customer Information</div></div>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Firstname: </label>
                        <div class="col-md-6">
                            <input type='text' name='fname' required value='{{$customer->fname}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Surname: </label>
                        <div class="col-md-6">
                            <input type='text' name='lname' required value='{{$customer->lname}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Birthday: </label>
                        <div class="col-md-6">
                            <input type='date' name='birthday' @if ($customer->member_type_id != '1') required @endif value='{{$customer->birthday}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Height: </label>
                        <div class="col-md-6">
                            <input type='number' name='height' placeholder="cm" @if ($customer->member_type_id != '1') required @endif value='{{$customer->height}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Weight: </label>
                        <div class="col-md-6">
                            <input type='number' name='weight' placeholder="kg" @if ($customer->member_type_id != '1') required @endif value='{{$customer->weight}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Pre-Existing Conditions: </label>
                        <div class="col-md-6">
                            <input type='text' name='pre_existing_conditions' @if ($customer->member_type_id != '1') required @endif  value='{{$customer->pre_existing_conditions}}'>
                        </div>
                    </div>

                    @if ($customer->member_type_id == '3')
                        <div class="form-group row">
                            <label class="col-md-6 col-form-label text-md-right"> Trainer: </label>
                            <div class="col-md-6">
                                <input type='text' name='birthday' required value='{{$trainer->fname}} {{$trainer->lname}}'>
                            </div>
                        </div>
                    @endif
                </div>
                <hr>
                <div>
                    <div class="form-group-row"><div class="col-md-4 text-md-right record-heading">Contact Details</div></div>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Street Address: </label>
                        <div class="col-md-6">
                            <input type='text' name='street_address' @if ($customer->member_type_id != '1') required @endif value='{{$customer->street_address}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Barangay: </label>
                        <div class="col-md-6">
                            <input type='text' name='barangay' @if ($customer->member_type_id != '1') required @endif value='{{$customer->barangay}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> City: </label>
                        <div class="col-md-6">
                            <input type='text' name='city' @if ($customer->member_type_id != '1') required @endif value='{{$customer->city}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Phone Number: </label>
                        <div class="col-md-6">
                            <input type='tel' name='phone_number' @if ($customer->member_type_id != '1') required @endif value='{{$customer->phone_number}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Email Address: </label>
                        <div class="col-md-6">
                            <input type='email' name='email_address' @if ($customer->member_type_id != '1') required @endif value='{{$customer->email_address}}'>
                        </div>
                    </div>
                </div>
                <hr>
                <div>
                    <div class="form-group-row"><div class="col-md-4 text-md-right record-heading">Emergency Contact Details</div></div>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Name: </label>
                        <div class="col-md-6">
                            <input type='text' name='emergency_contact_name' @if ($customer->member_type_id != '1') required @endif  value='{{$customer->emergency_contact_name}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Contact Number: </label>
                        <div class="col-md-6">
                            <input type='tel' name='emergency_contact_number' @if ($customer->member_type_id != '1') required @endif value='{{$customer->emergency_contact_number}}'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Relationship: </label>
                        <div class="col-md-6">
                            <input type='text' name='emergency_contact_relationship' @if ($customer->member_type_id != '1') required @endif value='{{$customer->emergency_contact_relationship}}'>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-row justify-content-center">
                    <div class="col-md-2"><input type='submit' class="btn btn-rounded-primary" value='Update'></div>
                    <div class="col-md-2"><button class="btn btn-rounded-light"><a href='{{ url()->previous() }}'>Cancel</a></button></div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
