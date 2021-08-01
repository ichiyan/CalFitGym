@extends('layouts.main')

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
<section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">
    <h1>Welcome Back {{$customer->fname}}!</h1>
    <h2>with modern quality equipments to help you get fit</h2>
    <a href="/" class="btn-get-started scrollto">View Subscription Status</a>
    </div>
</section><!-- End Hero -->

@endsection

@section('main')
<main id="main">
    <section class="portfolio">
        <div class="container-fluid">
            <div class="section-title">
                <span>{{$customer->fname}} {{$customer->lname}}</span>
                <h2>{{$customer->fname}} {{$customer->lname}}</h2>
                <p>{{$remaining_days}} days left of subscription left</p>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Profile</h6>
                </div>
                <div class="card-body">
                    <div class="container user-profile">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-img">
                                    <img src="/storage/customers/{{$customer->photo}}" alt=""/>
                                </div>
                            </div>
                            <div class="col col-md-6 align-self-center">
                                <div class="profile-head">
                                    <h5> {{$customer->fname}} {{$customer->lname}}</h5>
                                    {{-- <h6>{{ $member_type->member_type_name  }} Customer</h6> --}}
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
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#purchase-history" role="tab" aria-controls="profile" aria-selected="false">Purchase History</a>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-2 align-self-start">
                                <button class="btn btn-outline-dark"><a href='/'>Home</a></button>
                                <button class="btn btn-danger"><a href="{{route('customerEdit', $customer->id)}}" style="color: white">Edit</a></button>
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
                                        <div class="tab-pane fade" id="purchase-history" role="tabpanel" aria-labelledby="profile-tab">
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
                                                                            {{-- <td> {{$member_type[$membership->member_type_id - 1]->member_type_name}}</td> --}}
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
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@endsection


