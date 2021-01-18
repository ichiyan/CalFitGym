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
                            <button><a href='/admin/customerList'>Back</a></button>
                            Customer information                           
                        </div>
                        <div class="card-header">
                                <div>
                                    <div>Customer Information</div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Firstname: </label>
                                        <div class="col-md-6"> {{$customer->fname}} </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Surname: </label>
                                        <div class="col-md-6"> {{$customer->lname}} </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Birthday: </label>
                                        <div class="col-md-6">{{$customer->birthday}}</div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Height: </label>
                                        <div class="col-md-6"> {{$customer->height}} cm </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Weight: </label>
                                        <div class="col-md-6"> {{$customer->weight}} kgs </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Pre-Existing Conditions: </label>
                                        <div class="col-md-6"> {{$customer->pre_existing_conditions}} </div>
                                    </div>
                                </div>

                                <div>
                                    <div>Contact Details</div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Street Address: </label>
                                        <div class="col-md-6"> {{$customer->street_address}} </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Barangay: </label>
                                        <div class="col-md-6"> {{$customer->barangay}} </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> City: </label>
                                        <div class="col-md-6"> {{$customer->city}} City </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Phone Number: </label>
                                        <div class="col-md-6"> {{$customer->phone_number}} </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Email Address: </label>
                                        <div class="col-md-6"> {{$customer->email_address}} </div>
                                    </div>
                                </div>

                                <div>
                                    <div>Emergency Contact Details: </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Name: </label>
                                        <div class="col-md-6"> {{$customer->emergency_contact_name}} </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Contact Number: </label>
                                        <div class="col-md-6"> {{$customer->emergency_contact_number}} </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-md-right"> Relationship: </label>
                                        <div class="col-md-6"> {{$customer->emergency_contact_relationship}} </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <center class="col-md-6">
                                        <button><a href="{{route('customerEdit', $customer->id)}}">Update</a></button>
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