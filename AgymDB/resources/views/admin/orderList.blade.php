@extends('layouts.admin-app')

@section('sidebar')

    @include('partials.admin-sidebar')

@endsection

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Orders</h1>
        <div class="btn-toolbar">
            <div class="btn-group mr-3">
                <a href="/admin/order/new" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> New Order</a>
            </div>
        </div>
    </div><!-- End of Page Heading  -->

    <!-- Table  -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Orders Taken</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td> # </td>
                            <td> Buyer Name </td>
                            <td> Date </td>
                            <td> Price </td>
                            <td> Amount Received </td>
                            <td> Change </td>
                            <td> No. of Items </td>
                            <td> Action </td>
                        </tr>
                    </thead>
                    <tbody>
                        @forEach($orders as $key => $order)
                            <tr>
                                <td> {{$key+1}} </td>

                                @forEach($buyers as $person)
                                    @if($order->customer_id == $person->id)
                                        <td> {{$person->fname}}  {{$person->lname}} </td>
                                    @endif
                                @endforeach

                                <td> {{$order->order_date}} </td>
                                <td> &#8369 {{ number_format( $order->total_price , 2, '.', ',') }}</td>
                                <td> &#8369 {{ number_format( $order->amount_received , 2, '.', ',') }}</td>
                                <td> &#8369 {{ number_format( $order->change , 2, '.', ',') }} </td>
                                <td> {{$count[$key]}} </td>

                                <td>
                                    {{-- <button><a href="/admin/order/{{$order->id}}/show">Details</a></button> --}}
                                    <button type="button" class="btn btn-sm btn-info"><a href="/admin/order/{{$order->id}}/show" style="color: white">Details</a></button>
                                </td>

                            </tr>
                         @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
