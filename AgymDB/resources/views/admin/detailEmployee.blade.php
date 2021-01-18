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
            <h6 class="m-0 font-weight-bold text-primary">Employee Profile</h6>
        </div>
        <div class="card-body">
            <div class="container user-profile">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-img">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                            </div>
                        </div>
                        <div class="col col-md-6 align-self-center">
                            <div class="profile-head">
                                <h5> {{$employee->fname}} {{$employee->lname}}</h5>
                                <h6></h6>
                                <p class="proile-rating">Employment:<span> {{$employee->date_hired}}  -  {{$employee->date_separated}}</span></p>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#job-details" role="tab" aria-controls="profile" aria-selected="false">Job</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#emergency-contact" role="tab" aria-controls="profile" aria-selected="false">Emergency Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col col-md-2 align-self-start">
                            <button class="btn-rounded-light"><a href='/admin/employeeList'>Back</a></button>                        </div>
                         </div>
                    <div class="row justify-content-end">
                        <div class="col-md-8">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Birthday</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$employee->birthday}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Address</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>Barangay, {{$employee->street_address}}, {{$employee->city}} City</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Phone</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$employee->phone_number}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Email-Address</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$employee->email_address}}</p>
                                                </div>
                                            </div>
                                </div>
                                <div class="tab-pane fade" id="job-details" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Trainees ({{$employee->no_of_trainees}})</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Trainee Names</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Monthly Salary</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>&#8369 {{ number_format( $employee->monthly_salary , 2, '.', ',') }}</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade" id="emergency-contact" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Name</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$employee->emergency_contact_name}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Phone</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$employee->emergency_contact_number}}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Relationship</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{$employee->emergency_contact_relationship}}</p>
                                                </div>
                                            </div>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
