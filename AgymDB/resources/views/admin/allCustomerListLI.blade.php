@extends('layouts.admin-app')

@section('sidebar')

    @include('partials.admin-sidebar')

@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customers</h1>
        <div class="btn-toolbar">
            <div class="btn-group mr-3">
                <a href="{{ route('register') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> New Customer</a>
            </div>
        </div>
    </div><!-- End of Page Heading  -->

    <!-- Table  -->
    <div class="card shadow mb-4">

        @include('partials.customerList-tabs')

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <p class="count-heading">Number of logged in customers: <span>{{ $count }}</span></p>
                    <thead>
                        <tr>
                            <td>Log</td>
                            <td>#</td>
                            <td>Name</td>
                            <td>Age</td>
                            <td>Email Address</td>
                            <td>Contact No.</td>
                            <td>Membership</td>
                            <td>End Date</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @forEach ($customers as $value => $customer)
                            @if($today->diffInDays($customer->end_date, false) > 0 && $log[$value]->exit == NULL)
                                <tr>
                                    <td>
                                         <a href="/admin/log/{{$log[$value]->id}}/edit"><span class="log-btn login" data-toggle="tooltip" data-placement="top" title="click to logout"></span></a>
                                    </td>

                                    <td> {{$customer->id}} </td>
                                    <td> {{$customer->fname}}   {{$customer->lname}} </td>
                                    <td> {{$age[$value]}} </td>
                                    <td> {{$customer->email_address}} </td>
                                    <td> {{$customer->phone_number}} </td>

                                    <td>
                                        @foreach($member_type as $type)
                                            @if($type->id == $customer->member_type_id)
                                                {{$type->member_type_name}}
                                            @endif
                                        @endforeach
                                    </td>

                                    <td>{{ $customer->end_date }}</td>

                                    <td>
                                        <button type="button" class="btn btn-sm btn-info"><a href="{{route('customerDetail', $customer->id)}}" style="color: white">Info</a></button>
                                        <button type="button" class="btn btn-sm btn-primary"><a href="{{route('customerEdit', $customer->id)}}" style="color: white">Edit</a></button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
