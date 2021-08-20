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
            <h6 class="m-0 font-weight-bold text-primary">Customer Profile</h6>
        </div>
        <div class="card-body">
            <div class="container user-profile">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="{{ asset ('storage/customers/'.$customer->photo) }}" alt=""/>
                        </div>
                    </div>
                    <div class="col col-md-6 align-self-center">
                        <div class="profile-head">
                            <h5> {{$customer->fname}} {{$customer->lname}}</h5>
                            <h6>{{ $member_type->member_type_name  }} Customer</h6>
                            <p class="proile-rating">Membership:<span> {{$customer->start_date}}  -  {{$customer->end_date}}</span></p>
                            @if ($customer->member_type_id != '1')
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#details" role="tab" aria-controls="profile" aria-selected="false">Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#emergency-contact" role="tab" aria-controls="profile" aria-selected="false">Emergency Contact</a>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="col col-md-2 align-self-start">
                        <button class="btn-rounded-light"><a href='{{ url()->previous() }}'>Back</a></button>
                        <button class="btn btn-rounded-primary"><a href="{{route('customerEdit', $customer->id)}}" style="color: white">Edit</a></button>
                    </div>
                </div>
                    <div class="row justify-content-end">
                        <div class="col-md-8">
                            <div class="tab-content profile-tab" id="myTabContent">
                                @if ($customer->member_type_id != '1')
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Birthday</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$customer->birthday}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Address</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$customer->street_address}}, {{$customer->barangay}}, {{$customer->city}} City</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Phone</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$customer->phone_number}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Email-Address</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$customer->email_address}}</p>
                                                    </div>
                                                </div>
                                        </div>
                                    @endif
                                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Height</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$customer->height}} cm</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Weight</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$customer->weight}} kg</p>
                                        </div>
                                    </div>
                                    @if ($customer->member_type_id == '3')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Trainer</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$trainer->fname}}  {{$trainer->lname}}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <div class="tab-pane fade" id="emergency-contact" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Name</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$customer->emergency_contact_name}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Phone</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$customer->emergency_contact_number}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Relationship</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{$customer->emergency_contact_relationship}}</p>
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
