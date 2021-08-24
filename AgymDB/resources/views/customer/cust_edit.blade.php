@extends('layouts.cust-app')

@section('topnav')

<nav class="nav-menu d-none d-lg-block">
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/#about">About</a></li>
        <li><a href="/#services">Services</a></li>
        <li><a href="/facility">Facility</a></li>
        <li><a href="/products/1">Products</a></li>
        <li><a href="/#rates">Rates</a></li>
        <li><a href="/#contact">Contact</a></li>
        @if (Route::has('login'))
            @auth
                <li class="active" ><a href="{{ url('/home') }}">My Account</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            @else
            <li><a href="{{ route('login') }}">Log In</a></li>
            <li><a href="{{ route('register') }}">Register</a></li><!-- Here for testing. Remove later -->
            @endauth

        @endif

    </ul>
</nav>

@endsection

@section('hero')

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center" style="height: 300px;"></section><!-- End Hero -->

@endsection

@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4"></div><!-- End of Page Heading  -->

    <!-- Update Employee Record Form  -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update Customer Record</h6>
        </div>
        <div class="card-body">
            <form method='post' action='{{route('custUpdate',$customer->id)}}' enctype="multipart/form-data">
                {{csrf_field()}}
                <input type='hidden' name='_method' value='PUT'>
                <div>

                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="profile-img">
                                <img id="profile-pic-preview"  src="/storage/customers/{{$customer->photo}}" alt=""/>
                                <div class="file btn btn-lg btn-primary">
                                    Change Photo
                                    <input id="profile-pic"  type="file" accept="image/*" name="cust_image" onchange="readURL(this)"/>
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
                <div class="form-row justify-content-center">
                    <div class="col-md-2"><input type='submit' class="btn btn-rounded-primary" value='Update'></div>
                    <div class="col-md-2"><button class="btn btn-rounded-light"><a href='{{ url()->previous() }}'>Cancel</a></button></div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
