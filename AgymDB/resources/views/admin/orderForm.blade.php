@extends('layouts.app')

@section('menu')
    @include('admin.adminmenu')
@endsection

@section('content')
<div class="card">
    <div class="card-header">{{ __('PURCHASING') }}</div>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <div class="card">
                        <div class="card-header">
                            Order Form
                        </div>
                        <div class="card-header">
                            @if($total_price == 0)
                            <form method='' action='/admin/order/find'>
                                
                                <label>ID: <input type="text" name="id" ></label>
                                <label>First Name: <input type="text" name="fname" ></label>
                                <label>Last Name: <input type="text" name="lname" ></label>
                                <input type='submit' value='Find'>
                            </form>
                            @endif
                        </div>

                        @if($id == NULL || $id==0)
                            <div class="card-header"> Find customer who will order </div>
                        @else
                            <div class="card-header">
                                <div class="form-group row">
                                    <div class="col-md-2 col-form-label text-md-right"> Order ID: {{$order_id}} </div>
                                    <div class="col-md-4 col-form-label text-md-right"> Buyer ID: {{$person->id}} </div>
                                    <div class="col-md-4 col-form-label text-md-right"> Name: {{$person->fname}}  {{$person->lname}} </div>
                                </div>

                                <div class="form-group row">
                                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                                        <tr class="thead-light">
                                            <td> # </td>
                                            <td> Product Name </td>
                                            <td> Price </td>
                                            <td> Quantity </td>
                                            <td> Customization </td>
                                            <td>  </td>
                                        </tr>

                                        @if($basket != NULL)
                                            @forEach($basket as $key => $basket_item)
                                            <tr class="thead-light">
                                                <td> {{$key+1}} </td>    

                                                @if($basket_item->membership_id == NULL)
                                                    @forEach($products as $product)
                                                        @if($basket_item->item_id == $product->id)
                                                            <td> {{$product->item_name}} </td>

                                                            <td>
                                                                @if($product->has_different_prices == 0)
                                                                    {{$product->price}}
                                                                @else
                                                                    @forEach ($variation_category as $var_cat)
                                                                        @forEach ($chosen_var as $variation)
                                                                            @if($var_cat->id == $variation->variation_category_id  && $basket_item->item_id == $variation->item_id)
                                                                                    @if($var_cat->price_priority == 1 && $basket_item->id == $variation->basket_id)
                                                                                        {{$variation->price}}
                                                                                    @endif
                                                                            @endif
                                                                        @endforeach
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
                                                            @else
                                                                @if($product->is_customizable == 1 )
                                                                <div id='{{$basket_item->id}}' style='display:none;'><form method='' action='/admin/order/customize' >
                                                                    <input type='text' name='color' placeholder='Color'>
                                                                    <input type='text' name='message' placeholder='Message'>
                                                                    <input type='hidden' name='person_id' value='{{$person->id}}'>
                                                                    <input type='hidden' name='basket_item_id' value='{{$basket_item->id}}'>
                                                                    <input type='submit' value='+'>
                                                                </form></div>
                                                                <button onclick="showBorrowerFunction({{$basket_item->id}})"> + Add customization </button>
                                                                @endif
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
                                                                            <form method='post' action='/admin/order/{{$c_var->id}}/remove_variation'>
                                                                                {{csrf_field()}}
                                                                                <input type='hidden' name='_method' value='DELETE'>
                                                                                <input type='hidden' name='person_id' value='{{$person->id}}'>
                                                                                <input type='hidden' name='basket_item_id' value='{{$basket_item->id}}'>
                                                                                <input type='submit' value=' - '>
                                                                            </form>
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                                <ul>

                                                            @if($product->has_variations == 1)
                                                                @forEach ($variation_category as $var_cat)
                                                                    <form method='' action='/admin/order/variation' >
                                                                        <select name='{{$var_cat->category_name}}' required>
                                                                            <option> -- {{$var_cat->category_name}} -- </option>
                                                                            @forEach ($variations as $variation)
                                                                                @if($var_cat->id == $variation->variation_category_id  && $basket_item->item_id == $variation->item_id)
                                                                                    <option value='{{$variation->id}}'> {{$variation->name}} </option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                        <input type='hidden' name='person_id' value='{{$person->id}}'>
                                                                        <input type='hidden' name='basket_item_id' value='{{$basket_item->id}}'>
                                                                        <input type='submit' value='Choose'>
                                                                    </form>
                                                                @endforeach
                                                            @endif
                                                            </td>
                                                            
                                                            <td>
                                                                <form method='post' action='/admin/order/{{$basket_item->id}}/delete'>
                                                                    {{csrf_field()}}
                                                                    <input type='hidden' name='_method' value='DELETE'>
                                                                    <input type='hidden' name='person_id' value='{{$person->id}}'>
                                                                    <input type='hidden' name='order_id' value='{{$order_id}}'>
                                                                    <input type='submit' value=' - '>
                                                                </form>
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
                                                                <form method='' action='/admin/order/trainer' >
                                                                    <select name='trainer' required>
                                                                        <option> -- Trainer -- </option>
                                                                        @forEach ($trainers as $trainer)
                                                                            @if($customer_details->assigned_employee_id == $trainer->id)
                                                                                <option value='{{$trainer->id}}' selected> {{$trainer->fname}}  {{$trainer->lname}} </option>
                                                                            @else
                                                                                <option value='{{$trainer->id}}'> {{$trainer->fname}}  {{$trainer->lname}} </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                    <input type='hidden' name='person_id' value='{{$person->id}}'>
                                                                    <input type='hidden' name='membership_id' value='{{$basket_item->membership_id}}'>
                                                                    <input type='submit' value='Change'>
                                                                </form>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                <form method='post' action='/admin/order/{{$basket_item->id}}/delete'>
                                                                    {{csrf_field()}}
                                                                    <input type='hidden' name='_method' value='DELETE'>
                                                                    <input type='hidden' name='person_id' value='{{$person->id}}'>
                                                                    <input type='hidden' name='order_id' value='{{$order_id}}'>
                                                                    
                                                                    <input type='submit' value=' - '>
                                                                </form>
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </tr>
                                            @endforeach
                                        @endif

                                        <tr id='new_order_item'><form method='' action='/admin/order/create' >
                                            <td>  </td>

                                            <td>
                                                <select name='product_id' required>
                                                    <option> -- Product -- </option>
                                                    @forEach ($products as $product)
                                                        <option value='{{$product->id}}'> {{$product->item_name}} (Php. {{$product->price}}) </option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td>  </td> <!-- product price -->
                                            <td> <input type='text' name='quantity' placeholder='quantity' required> </td>
                                            <td></td> <!-- customization -->

                                            <td>
                                                <input type='hidden' name='person_id' value='{{$person->id}}'>
                                                <input type='hidden' name='order_id' value='{{$order_id}}'>
                                                <input type='submit' value='Check'>
                                            </td>
                                        </form></tr>

                                        @if($employee_details == NULL)
                                            <tr id='new_membership'><form method='' action='/admin/order/renew' >
                                                <td> </td>

                                                <td>
                                                    <select name='membership_type_id' required>
                                                        <option> -- Membership -- </option>
                                                        @forEach ($member_type as $mem_type)
                                                            <option value='{{$mem_type->id}}'> {{$mem_type->member_type_name}} (Php. {{$mem_type->member_type_price}} )</option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td>  </td> <!-- product price -->
                                                <td> <input type='text' name='quantity' value=1 required> </td>
                                                <td></td> <!-- customizations -->

                                                <td>
                                                    <input type='hidden' name='person_id' value='{{$person->id}}'>
                                                    <input type='hidden' name='order_id' value='{{$order_id}}'>
                                                    <input type='submit' value='Apply'>
                                                </td>
                                            </form></tr>
                                        @endif

                                    </table>

                                    <div>
                                        <button onclick="showBorrowerFunction('new_order_item')"> + Order another item </button>
                                        @if($employee_details == NULL)
                                            <button onclick="showBorrowerFunction('new_membership')"> + Order membership </button>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="card-header">
                                <div class="form-group row">
                                        <div class="col-md-4 col-form-label text-md-right"> Total Price:  </div>
                                        <div class="col-md-6 col-form-label text-md-right"> {{$total_price}} </div>
                                </div>

                                <div class="form-group row">
                                    <form method='' action='/admin/order/pay' >
                                        <input type='hidden' name='person_id' value='{{$person->id}}'>
                                        <input type='hidden' name='order_id' value='{{$order_id}}'>
                                        Amount Recieved: <input type='text' name='payment' required>
                                        <input type='submit' value='Complete Transaction'>
                                    </form>
                                </div>

                                <div class="form-group row">
                                    <form method='post' action='/admin/order/{{$order_id}}/cancel' >
                                        {{csrf_field()}}
                                        <input type='hidden' name='_method' value='DELETE'>
                                        <input type='hidden' name='person_id' value='{{$person->id}}'>
                                        <input type='hidden' name='order_id' value='{{$order_id}}'>
                                        <input type='submit' value='Cancel'>
                                    </form>
                                </div>
                            </div>
                            
                            </div> <!--end card-header -->
                        @endif
                    </div>
                </div>  
            </div>
        </main>
    </div>            
</div>

<style>
#new_order_item {
    display:none;
}
#customizations{
    display:none;
}
#new_membership{
    display:none;
}
</style>
<script>
    function showBorrowerFunction(id) {
		document.getElementById(id).style.display = "block";
	}
</script>
@endsection