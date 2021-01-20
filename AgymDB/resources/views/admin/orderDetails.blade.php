@extends('layouts.app')

@section('menu')
    @include('admin.adminmenu')
@endsection

@section('content')
<div class="card">
    <div class="card-header">{{ __('CUSTOMERS') }}</div>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <div class="card">
                        <div class="card-header">
                            Order Form
                        </div>
                        <div class="card-header">
                            <div class="form-group row">
                                <div class="col-md-2 col-form-label text-md-right"> Order ID: {{$order->id}} </div>
                                <div class="col-md-4 col-form-label text-md-right"> Buyer ID: {{$customer->id}} </div>
                                <div class="col-md-4 col-form-label text-md-right"> Name: {{$customer_details->fname}}  {{$customer_details->lname}} </div>
                            </div>

                            <div class="form-group row">
                                <table class="table table-responsive-sm table-hover table-outline mb-0">
                                    <tr class="thead-light">
                                        <td> # </td>
                                        <td> Product Name </td>
                                        <td> Price </td>
                                        <td> Quantity </td>
                                        <td> Customization </td>
                                    </tr>

                                    @forEach($basket as $key => $basket_item)
                                        <tr class="thead-light">
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
                                                            @if($product->has_different_prices == 0)
                                                                {{$product->price}}
                                                            @else
                                                                @forEach ($variations as $variation)
                                                                    @if($basket_item->variation_id == $variation->id)
                                                                            {{$variation->price}}
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </td>

                                                        <td> {{$basket_item->quantity}} </td>

                                                        <td>
                                                            @if($basket_item->customize_id != NULL)
                                                                @forEach($customizations as $custom)
                                                                    @if($basket_item->customize_id == $custom->id)
                                                                    Color: {{$custom->color}} <br> Message: {{$custom->message}}
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endforeach
                                            @else <!-- basket entry contains membership not product -->
                                                @forEach($memberships as $membership)
                                                    @if($basket_item->membership_id == $membership->id)
                                                        <td> {{$member_type[$membership->member_type_id - 1]->member_type_name}} </td>
                                                        <td> {{$member_type[$membership->member_type_id - 1]->member_type_price}} </td>
                                                        <td> 1 </td>

                                                        <td>
                                                            @if($member_type[$membership->member_type_id - 1]->has_trainer == 1)
                                                                {{$trainer->fname}}  {{$trainer->lname}}
                                                            @endif
                                                        </td>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="card-header">
                            <div class="form-group row">
                                <div class="col-md-4 col-form-label text-md-right"> Total Price:  </div>
                                <div class="col-md-6 col-form-label text-md-right"> {{$order->total_price}} </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4 col-form-label text-md-right"> Amount Recieved: </div>
                                <div class="col-md-6 col-form-label text-md-right"> {{$order->amount_received}} </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4 col-form-label text-md-right"> Change: </div>
                                <div class="col-md-6 col-form-label text-md-right"> {{$order->change}} </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </main>
    </div>            
</div>
@endsection