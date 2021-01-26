@extends('layouts.admin-order')

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
            <div class="btn-group mr-3">
                <a href="/admin/orderList" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-clipboard-list fa-sm text-white-50"></i> Orders</a>
            </div>
        </div>
    </div><!-- End of Page Heading  -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
        </div>

        <div class="card-body">
            <hr>
            <div class="form-group row">
                <div class="col-md-2 col-form-label text-md-right"> Order ID: {{$order->id}} </div>
                <div class="col-md-4 col-form-label text-md-right"> Buyer ID: {{$customer->id}} </div>
                <div class="col-md-4 col-form-label text-md-right"> Name: {{$customer->fname}}  {{$customer->lname}} </div>
            </div>
            <hr>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td> # </td>
                            <td> Product Name </td>
                            <td> Customization </td>
                            <td> Price </td>
                            <td> Quantity </td>
                            <td> Amount</td>
                        </tr>
                    </thead>
                    <tbody>

                        @forEach($basket as $key => $basket_item)
                            <tr>
                                <td> {{$key+1}} </td>
                                @if($basket_item->membership_id == NULL)
                                    @forEach($products as $product)
                                        @if($basket_item->item_id == $product->id)
                                            <td>
                                                 {{$product->item_name}}
                                                 @if($product->has_variations == 1)
                                                    @forEach ($variations as $variation)
                                                        @if($basket_item->id == $variation->item_id)
                                                            @if($basket_item->variation_id == $variation->id)
                                                                ( {{$variation->name}} )
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>

                                            <td>
                                                <div class="container">
                                                    @if($basket_item->customize_id != NULL)
                                                        @forEach($customizations as $custom)
                                                            @if($basket_item->customize_id == $custom->id)
                                                            Color: {{$custom->color}} <br> Message: {{$custom->message}}
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    <ul>
                                                        @forEach ($chosen_var as $c_var)
                                                            @if($c_var->basket_id == $basket_item->id)
                                                                <li>
                                                                    @forEach ($variation_category as $var_cat)
                                                                        @if($var_cat->id == $c_var->variation_category_id)
                                                                            {{$var_cat->category_name}} :
                                                                        @endif
                                                                    @endforeach
                                                                    {{$c_var->name}}
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </td>

                                                    @if($product->has_different_prices == 0)
                                                        <td>{{$product->price}} </td>
                                                        <td> {{$basket_item->quantity}} </td>
                                                        <td> {{$product->price * $basket_item->quantity }} </td>
                                                    @else
                                                        @forEach ($variation_category as $var_cat)
                                                            @forEach ($chosen_var as $variation)
                                                                @if($var_cat->id == $variation->variation_category_id  && $basket_item->item_id == $variation->item_id)
                                                                    @if($var_cat->price_priority == 1)
                                                                        <td>{{$variation->price}} </td>
                                                                        <td> {{$basket_item->quantity}} </td>
                                                                        <td> {{$variation->price * $basket_item->quantity }} </td>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                        @endif
                                     @endforeach
                                @else  <!-- basket entry contains membership not product -->
                                    @foreach($memberships as $membership)
                                        @if($basket_item->membership_id == $membership->id)
                                            <td> {{$member_type[$membership->member_type_id - 1]->member_type_name}}</td>
                                            <td>
                                                @if($member_type[$membership->member_type_id - 1]->has_trainer == 1)
                                                    Trainer:  {{$trainer->fname}}  {{$trainer->lname}}
                                                @endif
                                            </td>
                                            <td> {{$member_type[$membership->member_type_id - 1]->member_type_price}} </td>
                                            <td> 1 </td>
                                            <td> {{$member_type[$membership->member_type_id - 1]->member_type_price}} </td>
                                        @endif
                                    @endforeach


                                @endif
                            </tr>
                        @endforeach
                    </tbody>

                    <tbody>
                        <tr></tr>
                        <tr></tr>
                        <tr class="no-border">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2"><b>Total Price:</b></td>
                            <td><b>&#8369 {{ number_format( $order->total_price , 2, '.', ',') }}</b></td>
                        </tr>
                        <tr class="no-border">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2"><b>Amount Received:</b></td>
                            <td><b>&#8369 {{ number_format( $order->amount_received , 2, '.', ',') }}</b></td>
                        </tr>
                        <tr class="no-border">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2"><b>Change:</b></td>
                            <td><b>&#8369 {{ number_format( $order->change, 2, '.', ',') }}</b></td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>

    </div>

 @endsection
