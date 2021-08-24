@extends('layouts.admin-order')

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
                            <form method='' action='/admin/order/find'>

                                <label>Customer ID: <input type="text" name="id" ></label>
                                <label>Customer First Name: <input type="text" name="fname" ></label>
                                <label>Customer Last Name: <input type="text" name="lname" ></label>
                                <input type='submit' value='Find'>
                            </form>
                        </div>
                        <div class="card-header">
                            @if($id == NULL)
                                <div> Choose customer </div>
                            @else
                            <div>
                                <div>Order Form</div>

                                <div class="form-group row">
                                    <div class="col-md-2 col-form-label text-md-right"> Order ID: {{$order_id}} </div>
                                    <div class="col-md-4 col-form-label text-md-right"> Customer ID: {{$customer->id}} </div>
                                    <div class="col-md-4 col-form-label text-md-right"> Name: {{$customer->fname}}  {{$customer->lname}} </div>
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
                                            @forEach($basket as $key => $item)
                                            <tr class="thead-light">
                                                <td> {{$key+1}} </td>

                                                @if($item->membership_id == NULL)
                                                    @forEach($products as $product)
                                                        @if($item->item_id == $product->id)
                                                        <td> {{$product->item_name}} </td>
                                                        <td> {{$product->price}} </td>
                                                        <td> {{$item->quantity}} </td>

                                                        <td>
                                                        @if($item->customize_id != 0)
                                                            @forEach($customizations as $custom)
                                                                @if($item->customize_id == $custom->id)
                                                                <td> Color: {{$custom->color}} <br> Message: {{$custom->message}} </td>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            @if($product->id > 8)
                                                            <div id='customize'><form method='' action='/admin/order/customize' >
                                                                <input type='text' name='color' placeholder='Color'>
                                                                <input type='text' name='message' placeholder='Message'>
                                                                <input type='hidden' name='person_id' value='{{$customer->id}}'>
                                                                <input type='hidden' name='item_id' value='{{$item->id}}'>
                                                                <input type='submit' value='+'>
                                                            </form></div>
                                                            <button onclick="showBorrowerFunction('customize')"> + Add customization </button>
                                                            @endif
                                                        @endif
                                                        </td>

                                                        <td>
                                                        <form method='post' action='/admin/order/{{$item->id}}/delete'>
                                                            {{csrf_field()}}
                                                            <input type='hidden' name='_method' value='DELETE'>
                                                            <input type='hidden' name='person_id' value='{{$customer->id}}'>
                                                            <input type='hidden' name='order_id' value='{{$order_id}}'>
                                                            <input type='submit' value=' - '>
                                                        </form>
                                                        </td>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @forEach($memberships as $membership)
                                                        @if($item->membership_id == $membership->id)
                                                        <td> {{$member_type[$membership->member_type_id - 1]->member_type_name}} </td>
                                                        <td> {{$member_type[$membership->member_type_id - 1]->member_type_price}} </td>

                                                        <td> 1 </td>

                                                        <td>
                                                        @if($membership->member_type_id == 3)
                                                        <form method='' action='/admin/order/trainer' >
                                                            <select name='trainer' required>
                                                                <option> -- Trainer -- </option>
                                                                @forEach ($trainers as $trainer)
                                                                    @if($customer->assigned_employee_id == $trainer->id)
                                                                        <option value='{{$trainer->id}}' selected> {{$trainer->fname}}  {{$trainer->lname}} </option>
                                                                    @else
                                                                        <option value='{{$trainer->id}}'> {{$trainer->fname}}  {{$trainer->lname}} </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            <input type='hidden' name='person_id' value='{{$customer->id}}'>
                                                            <input type='submit' value='Change'>
                                                        </form>
                                                        @endif
                                                        </td>

                                                        <td>
                                                        <form method='post' action='/admin/order/{{$item->id}}/delete'>
                                                            {{csrf_field()}}
                                                            <input type='hidden' name='_method' value='DELETE'>
                                                            <input type='hidden' name='person_id' value='{{$customer->id}}'>
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
                                                            <option value='{{$product->id}}'> {{$product->item_name}} </option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td>  </td> <!-- product price -->
                                                <td> <input type='text' name='quantity' placeholder='quantity' required> </td>

                                                <td></td>

                                                <td>
                                                    <input type='hidden' name='person_id' value='{{$customer->id}}'>
                                                    <input type='hidden' name='order_id' value='{{$order_id}}'>
                                                    <input type='submit' value='Check'>
                                                </td>
                                        </form></tr>

                                        <tr id='new_membership'><form method='' action='/admin/order/renew' >
                                                <td> {{$order_id}} </td>

                                                <td>
                                                    <select name='membership_type_id' required>
                                                        <option> -- Membership -- </option>
                                                        @forEach ($member_type as $mem_type)
                                                            <option value='{{$mem_type->id}}'> {{$mem_type->member_type_name}} </option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td>  </td> <!-- product price -->
                                                <td> <input type='text' name='quantity' value=1 required> </td>

                                                <td></td> <!-- customizations -->

                                                <td>
                                                    <input type='hidden' name='person_id' value='{{$customer->id}}'>
                                                    <input type='hidden' name='order_id' value='{{$order_id}}'>
                                                    <input type='submit' value='Check'>
                                                </td>
                                        </form></tr>

                                    </table>
                                    <div>
                                        <button onclick="showBorrowerFunction('new_order_item')"> + Order another item </button>
                                        <button onclick="showBorrowerFunction('new_membership')"> + Order membership </button>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="card-header">
                            <div class="form-group row">
                                    <div class="col-md-4 col-form-label text-md-right"> Total Price:  </div>
                                    <div class="col-md-6 col-form-label text-md-right"> {{$total_price}} </div>
                            </div>
                            <div class="form-group row"><form method='' action='{{ route('completeTransaction') }}' >
                                    <input type='hidden' name='person_id' value='{{$customer->id}}'>
                                    <input type='hidden' name='order_id' value='{{$order_id}}'>
                                    Amount Recieved: <input type='text' name='payment' required>
                                    <input type='submit' value='Complete Transaction'>
                            </form></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    function showBorrowerFunction(id) {
		document.getElementById(id).style.display = "block";
	}
</script>
@endsection
