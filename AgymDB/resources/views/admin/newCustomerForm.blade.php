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
            <h6 class="m-0 font-weight-bold text-primary">Create Customer Record</h6>
        </div>
        <div class="card-body">
            <form method='post' action='/admin/customer/create' enctype="multipart/form-data">
                @csrf
                {{-- <input type='hidden' name='_method' value='PUT'> --}}
                <div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="profile-img">
                                <img id="profile-pic-preview"  src="/storage/customers/default-profile.png" alt=""/>
                                <div class="file btn btn-lg btn-primary">
                                    Change Photo
                                    <input id="profile-pic"  type="file" accept="image/*" name="cust_image" onchange="loadFile(event)"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group-row"><div class="col-md-4 text-md-right record-heading">Customer Information</div></div>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Firstname: </label>
                        <div class="col-md-6">
                            <input type='text' name='fname' required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Surname: </label>
                        <div class="col-md-6">
                            <input type='text' name='lname' required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Birthday: </label>
                        <div class="col-md-6">
                            <input type='date' name='birthday'>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Height: </label>
                        <div class="col-md-6">
                            <input type='number' name='height'  min="91" placeholder='cm'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Weight: </label>
                        <div class="col-md-6">
                            <input type='number' name='weight' min="10" placeholder='kg'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Pre-Existing Conditions: </label>
                        <div class="col-md-6">
                            <input type='text' name='pre_existing_conditions'>
                        </div>
                    </div>

                </div>
                <hr>
                <div>
                    <div class="form-group-row"><div class="col-md-4 text-md-right record-heading">Contact Details</div></div>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Street Address: </label>
                        <div class="col-md-6">
                            <input type='text' name='street_address'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Barangay: </label>
                        <div class="col-md-6">
                            <input type='text' name='barangay'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> City: </label>
                        <div class="col-md-6">
                            <input type='text' name='city'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Phone Number: </label>
                        <div class="col-md-6">
                            <input type='tel' name='phone_number'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Email Address: </label>
                        <div class="col-md-6">
                            <input type='email' name='email_address'>
                        </div>
                    </div>
                </div>
                <hr>
                <div>
                    <div class="form-group-row"><div class="col-md-4 text-md-right record-heading">Emergency Contact Details</div></div>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Name: </label>
                        <div class="col-md-6">
                            <input type='text' name='emergency_contact_name'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Contact Number: </label>
                        <div class="col-md-6">
                            <input type='tel' name='emergency_contact_number'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Relationship: </label>
                        <div class="col-md-6">
                            <input type='text' name='relationship'>
                        </div>
                    </div>
                </div>
                <hr>

                <hr>
                <div class="form-row justify-content-center">
                    <div class="col-md-2"><input type='submit' class="btn btn-rounded-primary" value='Register'></div>
                    <div class="col-md-2"><button class="btn btn-rounded-light"><a href='{{ url()->previous() }}'>Cancel</a></button></div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
