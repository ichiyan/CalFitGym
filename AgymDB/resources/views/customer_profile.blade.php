@extends('layouts.cust-app')

@section('topnav')

<nav class="nav-menu d-none d-lg-block">
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/#about">About</a></li>
        <li><a href="/#services">Services</a></li>
        <li><a href="/facility">Facility</a></li>
        <li class="active" ><a href="/products/1">Products</a></li>
        <li><a href="/#rates">Rates</a></li>
        <li><a href="/#contact">Contact</a></li>
        @if (Route::has('login'))
            @auth
                <li><a href="{{ url('/home') }}">My Account</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            @else
            <li><a href="{{ route('login') }}">Log In</a></li>
            <li><a href="{{ route('register') }}">Register</a></li><!-- Here for testing. Remove later -->
            @endauth

        @endif

    </ul>
</nav>

@endsection

@section('hero')

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center" style="height: 300px;"></section><!-- End Hero -->

@endsection

@section('main')
<div id="main">
        <div class="row mx-4">
            <div class=" col-2 mr-4 " style="height: 256px; margin-top:-7%; ">
                <img class="rounded-circle z-depth-2 img-fluid mb-4" alt="70x70" src="https://mdbootstrap.com/img/Photos/Avatars/img%20(31).jpg" data-holder-rendered="true">
                <h2>{{$customer->fname}} {{$customer->lname}}</h2>
            </div>
            
            <div class="card shadow col-9 my-4 ">
                <div class="card-body py-4">
                    <div class="container user-profile">
                        <div class="row">
                            <div class="col align-self-center">
                                <div class="profile-head">
                                    <h5>
                                        @if($remaining_days > 20)
                                            <span style="height: 15px; width: 15px; border-radius: 50%; display: inline-block; background-color:lime;}"></span>
                                        @elseif ($remaining_days > 5)
                                            <span style="height: 15px; width: 15px; border-radius: 50%; display: inline-block; background-color:yellow;}"></span>
                                        @else
                                            <span style="height: 15px; width: 15px; border-radius: 50%; display: inline-block; background-color:red;}">c</span>
                                        @endif
                                        {{$remaining_days}} days left of subscription left
                                    </h5>
                                    {{-- <h6>{{ $member_type->member_type_name}} Custome    r</h6> --}}
                                    <p class="proile-rating">Membership:<span> {{ \Carbon\Carbon::parse($customer->start_date)->format('M d Y')}}  -  {{ \Carbon\Carbon::parse($customer->end_date)->format('M d Y')}}</span></p>
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
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#remarks" role="tab" aria-controls="profile" aria-selected="false">Remarks</a>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <div class="align-self-start">
                                <button class="btn btn-outline-dark"><a href='/'>Home</a></button>
                                <button class="btn btn-danger"><a href="/" style="color: white">Edit</a></button>
                            </div>
                        </div>
                            <div class="row justify-content-center p-4">
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
                                        <div class="tab-pane fade" id="purchase-history" role="tabpanel" aria-labelledby="profile-tab">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>

            <!-- Purchase History -->
            <div class=" col-2 mr-4 ">
            </div>

            <div class="card shadow col-9 my-4 table-responsive p-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Purchase History</h6>
                    </div>
                    <!-- Accordion -->
                    <div class="card-body" id="accordion">
                        @php $count = 0; @endphp
                        @forEach($orderss as $order)
                        
                        <div class="card-header" id="heading{{$order->id}}" data-toggle="collapse" data-target="#collapse{{$order->id}}" aria-expanded="true" aria-controls="collapse{{$order->id}}">
                            <p class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$order->id}}" aria-expanded="true" aria-controls="collapse{{$order->id}}">
                                    {{ \Carbon\Carbon::parse($order->order_date)->format('M d, Y @ h:i A')}}
                                </button>
                            </p>
                        </div>
                        @if($count == 0)
                            <div   div id="collapse{{$order->id}}" class= "collapse show" aria-labelledby="heading{{$order->id}}" data-parent="#accordion">
                            @php $count = 1; @endphp
                        @else
                            <div id="collapse{{$order->id}}" class= "collapse" aria-labelledby="heading{{$order->id}}" data-parent="#accordion">
                        @endif
                           
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
                                            @if($order->id == $basket_item->order_id)
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
                                            @endif
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
                        @endforeach
                    </div>
                </div>
            </div>
            
        </div>
</main><!-- End #main -->

@endsection


