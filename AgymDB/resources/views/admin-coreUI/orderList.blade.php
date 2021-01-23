@extends('layouts.app')

@section('menu')
    @include('admin.adminmenu')
@endsection

@section('content')
<div class="card">
    <div class="card-header">{{ __('ORDERS') }}</div>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <div class="card">
                        <div class="card-header">
                            <div class="btn-group mr-3">
                                <a href="/admin/order/new" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> New Order</a>
                            </div>
                            <table class="table table-responsive-sm table-hover table-outline mb-0">
                                <tr class="thead-light">
                                    <td class="text-center"> # </td>
                                    <td class="text-center"> Buyer Name </td>
                                    <td class="text-center"> Date </td>
                                    <td class="text-center"> Price </td>
                                    <td class="text-center"> Amount Received </td>
                                    <td class="text-center"> Change </td>
                                    <td class="text-center"> No. of Items </td>
                                    <td class="text-center"> Action </td>
                                </tr>
                                
                                @forEach($orders as $key => $order)
                                    <tr>
                                        <td> {{$key+1}} </td>

                                        @forEach($buyers as $person)
                                            @if($order->customer_id == $person->id)
                                                <td> {{$person->fname}}  {{$person->lname}} </td>
                                            @endif
                                        @endforeach

                                        <td> {{$order->order_date}} </td>
                                        <td> Php. {{$order->total_price}} </td>
                                        <td> Php. {{$order->amount_received}} </td>
                                        <td> Php. {{$order->change}} </td>
                                        <td> {{$count[$key]}} </td>

                                        <td>
                                            <button><a href="/admin/order/{{$order->id}}/show">Details</a></button>
                                        </td>

                                    </tr>
                                @endforeach

                            </table>
                        </div>
                        
                    </div>
                </div>  
            </div>
        </main>
    </div>            
</div>
@endsection