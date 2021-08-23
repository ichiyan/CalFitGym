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
            @if( !($id == null || $id == 0) )
                <div class="btn-group mr-3">
                    <form id="cancel-order-form-{{$order_id}}" method='post' action='/admin/order/{{$order_id}}/cancel' >
                        {{csrf_field()}}
                        <input type='hidden' name='_method' value='DELETE'>
                        <input type='hidden' name='person_id' value='{{$person->id}}'>
                        <input type='hidden' name='order_id' value='{{$order_id}}'>
                        <button type='submit'  class="btn btn-sm btn-secondary shadow-sm"  value='Cancel'><i class="fas fa-times-circle fa-sm text-white-50"></i> Cancel Order</button>
                        {{-- <a href="" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-toggle="modal" data-target="#cancelOrderModal-{{$order_id}}"><i class="fas fa-times-circle fa-sm text-white-50"></i> Cancel Order</a> --}}

                        {{-- <a href="" class="btn btn-sm btn-secondary shadow-sm"  data-toggle="modal" data-target="#cancelOrderModal" style="color: white"> Cancel Order</a> --}}
                    </form>
                </div>
            @else
            <div class="btn-group mr-3">
                <a href="/admin/orderList" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-clipboard-list fa-sm text-white-50"></i> Orders</a>
            </div>
            @endif
        </div>
    </div><!-- End of Page Heading  -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Order Form</h6>
        </div>
        <div class="card-body">
            @if($total_price == 0)
                <div style="@if ($id != 0) display:none; @endif">
                <h6>Find Customer</h6><br>
                <form method='' action='/admin/order/find'>
                    <div class="row">
                        <div class="form-group col-1">
                            <label>ID: </label>
                            <input type="number" class="form-control" name="id">
                        </div>

                        <div class=" form-group col-4">
                            <label>First Name:</label>
                            <select class="form-control selectpicker" data-live-search="true" data-live-search-style="startsWith" name="fname">
                                <option>-- First Name --</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->fname }}">{{ $customer->fname }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-4">
                            <label>Last Name:</label>
                            <select class="form-control selectpicker" data-live-search="true" data-live-search-style="startsWith" name="lname">
                            <option>-- Last Name --</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->lname }}">{{ $customer->lname }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-2 align-self-end">
                            <button type="submit" class="btn btn-primary shadow-sm">Find</button>
                        </div>
                    </div>
                </form>
            </div>
            <hr>
            @endif


            @if ($id == null || $id == 0)
                @if (!(str_contains(url()->current(), 'admin/order/new')))
                    <center><p>Customer not Found</p></center>
                @endif
            @else

                <form method="" action="/admin/order/create">
                    <div class="row">
                        <div class=" form-group col-4">
                            <label>Choose Product:</label>
                            <select  id="select-product" onchange="getMaxQuantity()"  class="form-control selectpicker" data-live-search="true" data-live-search-style="startsWith" name='product_id' required>
                                <option>-- Product --</option>
                                @forEach ($products as $product)
                                here
                                    @if($batches[$product->id] > 0)
                                        @if ($product->has_different_prices == 0)
                                            <option id="{{ $batches[$product->id] }}"  value='{{$product->id}}'> {{$product->item_name}} ( &#8369 {{ number_format( $product->price , 2, '.', ',') }} ) </option>
                                        @else
                                            <option id="{{ $batches[$product->id] }}"  value='{{$product->id}}'> {{$product->item_name}} (
                                            @foreach ($variations as $variation)
                                                @foreach ($variation_category as $var_cat)
                                                    @if ($variation->item_id == $product->id && $variation->variation_category_id == $var_cat->id && $var_cat->price_priority == 1)
                                                          &#8369 {{ number_format( $variation->price , 2, '.', ',') }} <span style="font-size: 25px; font-weight: 700;">&#183</span>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                             ) </option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-1">
                            <label>Quantity</label>
                            <input id="product-order-quantity"  type="number" class="form-control" name="quantity"  min="1" max="" required>
                        </div>

                        <div class="form-group col-4 align-self-end">
                            <button type="submit" class="btn btn-primary shadow-sm" value="Check" style="width: 130px !important;"><i class="fas fa-cart-plus fa-sm text-white-50"></i> Add Item</button>
                            <input type='hidden' name='person_id' value='{{$person->id}}'>
                            <input type='hidden' name='order_id' value='{{$order_id}}'>
                        </div>
                    </div>
                </form>


                @if($employee_details == NULL)
                    <form method='' action='/admin/order/renew' id="" >
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Choose Membership:</label>
                                <select name='membership_type_id' class="form-control selectpicker" data-live-search="true" data-live-search-style="startsWith"  required>
                                    <option> -- Membership -- </option>
                                    @forEach ($member_type as $mem_type)
                                        <option value='{{$mem_type->id}}'> {{$mem_type->member_type_name}} (Php. {{$mem_type->member_type_price}} )</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-1">
                                <label>Quantity</label>
                                <input type='number' class="form-control" name='quantity' value="1" readonly>
                            </div>

                            <div class="form-group col-4 align-self-end">
                                <button type="submit" class="btn btn-warning shadow-sm" value="Apply" style="width: 130px !important;"><i class="fas fa-id-card fa-sm text-white-50"></i> Apply</button>
                                <input type='hidden' name='person_id' value='{{$person->id}}'>
                                <input type='hidden' name='order_id' value='{{$order_id}}'>
                            </div>

                        </div>
                    </form>
                @endif

                <hr>
                <div class="form-group row">
                    <div class="col-md-2 col-form-label text-md-right"> Order ID: {{$order_id}} </div>
                    <div class="col-md-4 col-form-label text-md-right"> Buyer ID: {{$person->id}} </div>
                    <div class="col-md-4 col-form-label text-md-right"> Name: {{$person->fname}}  {{$person->lname}} </div>
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
                                <td> Action </td>
                            </tr>
                        </thead>
                        <tbody>

                            @if($basket != NULL)
                                @forEach($basket as $key => $basket_item)
                                    <tr>
                                        <td>{{$key+1}} </td>

                                        @if($basket_item->membership_id == NULL)
                                            @forEach($products as $product)
                                                @if($basket_item->item_id == $product->id)
                                                    <td>{{$product->item_name}} </td>

                                                    <td>
                                                        <div class="container">
                                                            @if($basket_item->customize_id != NULL)
                                                                @forEach($customizations as $custom)
                                                                    @if($basket_item->customize_id == $custom->id)
                                                                        Color: {{$custom->color}} <br> Message: {{$custom->message}}
                                                                    @endif
                                                                @endforeach

                                                            @else
                                                                @if($product->is_customizable == 1 )
                                                                    <button id="customize-btn"  onclick="showCustomize({{$basket_item->id}})" class="btn btn-primary shadow-sm btn-sm" value="Check"><i class="fas fa-edit fa-sm text-white-50"></i> Add Customization</button>
                                                                    <div class='' id='{{$basket_item->id}}' style='display:none;'>
                                                                        <form method='' action='/admin/order/customize' >
                                                                            <input type='text' name='color' placeholder='Color'>
                                                                            <input type='text' name='message' placeholder='Message'>
                                                                            <input type='hidden' name='person_id' value='{{$person->id}}'>
                                                                            <input type='hidden' name='basket_item_id' value='{{$basket_item->id}}'>
                                                                            <button type="submit" class="btn btn-primary shadow-sm btn-sm" value="Check"><i class="fas fa-plus-circle text-white-50"></i></button>
                                                                            <button  type="button"  onclick="hideCustomize({{$basket_item->id}})" class="btn btn-secondary shadow-sm btn-sm"><i class="fas fa-times-circle text-white-50"></i></button>
                                                                        </form>
                                                                    </div>
                                                                    <br><br>
                                                                @endif
                                                            @endif



                                                            @if($product->has_variations == 1)
                                                                @forEach ($variation_category as $var_cat)
                                                                    @php  $flag= $var_cat->id @endphp
                                                                    @foreach ($variations as $variation)
                                                                        @if($var_cat->id == $variation->variation_category_id  && $basket_item->item_id == $variation->item_id && $flag == $var_cat->id)
                                                                            <form method='' action='/admin/order/variation'>
                                                                                <div class="row">
                                                                                    <div class="col-4">
                                                                                        <select class="form-control height-sm"  name='{{$var_cat->category_name}}' required>
                                                                                            <option> -- {{$var_cat->category_name}} -- </option>
                                                                                            @forEach ($variations as $variation)
                                                                                                @if($var_cat->id == $variation->variation_category_id  && $basket_item->item_id == $variation->item_id)
                                                                                                    <option value='{{$variation->id}}'> {{$variation->name}} </option>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-4">
                                                                                        <button type="submit" class="btn btn-info shadow-sm btn-sm" value="Choose"><i class="fas fa-check-circle text-white-50"></i> Choose</button>
                                                                                        <input type='hidden' name='person_id' value='{{$person->id}}' class="form-control">
                                                                                        <input type='hidden' name='basket_item_id' value='{{$basket_item->id}}' class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                             <br>
                                                                            @php  $flag= $var_cat->id + 1 @endphp
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            @endif



                                                            @forEach ($chosen_var as $c_var)
                                                                @if($c_var->basket_id == $basket_item->id)
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                            @forEach ($variation_category as $var_cat)
                                                                                @if($var_cat->id == $c_var->variation_category_id)
                                                                                    {{$var_cat->category_name}} :
                                                                                @endif
                                                                            @endforeach
                                                                            {{$c_var->name}}
                                                                            </div>
                                                                            <div class="col-6">
                                                                            <form method='post' action='/admin/order/{{$c_var->id}}/remove_variation'>
                                                                                {{csrf_field()}}
                                                                                    <button type="submit" class=" btn btn-danger shadow-sm btn-sm"><i class="fas fa-trash-alt text-white-50"></i></button>
                                                                                    <input type='hidden' name='_method' value='DELETE'>
                                                                                    <input type='hidden' name='person_id' value='{{$person->id}}'>
                                                                                    <input type='hidden' name='basket_item_id' value='{{$basket_item->id}}'>
                                                                            </form>
                                                                            </div>
                                                                        </div>
                                                                @endif
                                                                <br>
                                                            @endforeach
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
                                                                            @if($var_cat->price_priority == 1 && $basket_item->id == $variation->basket_id)
                                                                                <td>{{$variation->price}} </td>
                                                                                <td> {{$basket_item->quantity}} </td>
                                                                                <td> {{$variation->price * $basket_item->quantity }} </td>
                                                                            @endif
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        @endif

                                                    <td>
                                                        <form method='post' action='/admin/order/{{$basket_item->id}}/delete'>
                                                            {{csrf_field()}}
                                                            <input type='hidden' name='_method' value='DELETE'>
                                                            <input type='hidden' name='person_id' value='{{$person->id}}'>
                                                            <input type='hidden' name='order_id' value='{{$order_id}}'>
                                                            {{-- <input type='submit' value=' - '> --}}
                                                            <button type="submit" class="btn btn-danger shadow-sm btn-sm"><i class="fas fa-trash-alt text-white-50"></i></button>
                                                        </form>
                                                    </td>
                                                @endif
                                            @endforeach

                                            @else <!-- basket entry contains membership not product -->
                                                @forEach($memberships as $membership)
                                                    @if($basket_item->membership_id == $membership->id)
                                                        <td> {{$member_type[$membership->member_type_id - 1]->member_type_name}} </td>

                                                        <td>
                                                            @if($member_type[$membership->member_type_id - 1]->has_trainer == 1)
                                                            <div class="container">
                                                                <form method='' action='/admin/order/trainer' >
                                                                    <div class="row">
                                                                        <div class="col-4">
                                                                            <select name='trainer' class="form-control selectpicker select-height" data-live-search="true" data-live-search-style="startsWith"  required>
                                                                                <option> -- Trainer -- </option>
                                                                                @forEach ($trainers as $trainer)
                                                                                    @if($customer_details->assigned_employee_id == $trainer->id)
                                                                                        <option value='{{$trainer->id}}' selected> {{$trainer->fname}}  {{$trainer->lname}} </option>
                                                                                    @else
                                                                                        <option value='{{$trainer->id}}'> {{$trainer->fname}}  {{$trainer->lname}} </option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <input type='hidden' name='person_id' value='{{$person->id}}'>
                                                                            <input type='hidden' name='membership_id' value='{{$basket_item->membership_id}}'>
                                                                            <button type="submit" class="btn btn-info shadow-sm btn-sm" value="Change"><i class="fas fa-check-circle text-white-50"></i> Assign</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            @endif
                                                        </td>

                                                        <td> {{$member_type[$membership->member_type_id - 1]->member_type_price}} </td>

                                                        <td> 1 </td>

                                                        <td> {{$member_type[$membership->member_type_id - 1]->member_type_price}} </td>

                                                        <td>
                                                            <form method='post' action='/admin/order/{{$basket_item->id}}/delete'>
                                                                {{csrf_field()}}
                                                                <input type='hidden' name='_method' value='DELETE'>
                                                                <input type='hidden' name='person_id' value='{{$person->id}}'>
                                                                <input type='hidden' name='order_id' value='{{$order_id}}'>

                                                                {{-- <input type='submit' value=' - '> --}}
                                                                <button type="submit" class="btn btn-danger shadow-sm btn-sm"><i class="fas fa-trash-alt text-white-50"></i></button>

                                                            </form>
                                                        </td>

                                                    @endif
                                                @endforeach
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                        </tbody>

                        @if ($total_price != 0)
                            <tbody>
                                <tr></tr>
                                <tr></tr>
                                <tr class="no-border">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td colspan="2"><b>Total Price:</b></td>
                                    <td><b>&#8369 {{ number_format( $total_price , 2, '.', ',') }}</b></td>
                                </tr>
                                <tr class="no-border">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <form method='' action='/admin/order/pay' >
                                        <div class="row">
                                            <input type='hidden' name='person_id' value='{{$person->id}}'>
                                            <input type='hidden' name='order_id' value='{{$order_id}}'>

                                            <td colspan="3"><label> Amount Recieved: </label>
                                                <input class="form-control" type='text' name='payment' required>
                                            </td>
                                        </tr>
                                        <tr class="no-border">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="3"><input class="form-control btn btn-primary" type='submit' value='Complete Transaction'></td>
                                        </tr>

                                        </div>
                                    </form>
                            </tbody>
                        @endif
                    </table>
                </div>


            @endif
        </div>
    </div>

</div>

   <!-- Cancel Order Modal-->
   {{-- <div class="modal fade" id="cancelOrderModal-{{$order_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancel Order?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Yes" below to confirm cancellation of order.</div>
            <div class="modal-footer">
                <a href=""   class="btn btn-danger" id="confirm-cancel-btn" style="color: white">Yes</a>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div> --}}


<style>


#customizations{
    display:none;
}


</style>

<script>

    function showCustomize(id){
        document.getElementById(id).style.display = "block";
        document.getElementById('customize-btn').style.display = "none";
    }

    function hideCustomize(id, product){
        document.getElementById(id).style.display = "none";
        document.getElementById('customize-btn').style.display = "block";
    }

    function getMaxQuantity(){
        var selected_option_id = $("#select-product").children(":selected").attr("id");
        $("#product-order-quantity").attr({
            "max" : selected_option_id
        });
    };

    $('#confirm-cancel-btn').click(function(){
        var orderID = @JSON($order_id);
        alert('submitting' + orderID);
         $('#cancel-order-form-' + orderID).submit();
});




</script>


@endsection

