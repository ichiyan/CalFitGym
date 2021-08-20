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
    <h1>Our Products</h1>
    <h2></h2>
    <a href="#products" class="btn-get-started scrollto">Learn More</a>
    </div>
</section><!-- End Hero -->

@endsection

@section('main')

<main id="main">

    <section id="products" class="portfolio">
        <div class="container">
            <div class="section-title">
                <span>Products</span>
                <h2>Products</h2>
            </div>

            <div class="row" data-aos="fade-up">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul class="products-tabs" id="portfolio-flters">
                        <li class="@if (str_contains(url()->current(), 'products/1')) products-active @endif"><a href='/products/1'>Supplements & Refreshments</a></li>
                        <li class="@if (str_contains(url()->current(), 'products/3')) products-active @endif"><a href='/products/3'>Active Wear</a></li>
                        <li class="@if (str_contains(url()->current(), 'products/4')) products-active @endif"><a href='/products/4'>Gym Essentials</a></li>
                        <li class="@if (str_contains(url()->current(), 'products/5')) products-active @endif"><a href='/products/5'>Merchandise</a></li>
                    </ul>
                </div>
            </div>



            <div class="container">


                <div class="row" style="margin-top: 2rem;" data-aos="fade-up" data-aos-delay="100">

                    @foreach ($products as $product)

                        <div class="col-xl-4 col-lg-5 col-md-7 mb-5" style="display:flex; flex-wrap:wrap;">
                            <div class="bg-white rounded shadow-sm"><img src="{{ asset ('storage/items/'.$product->item_pic) }}" alt="" class="img-fluid card-img-top">
                                <div class="p-4">
                                        @if ($product->is_customizable == 1)
                                            <center><span class="badge badge-pill badge-primary" style="display: inline;">Customizable</span>
                                        @endif

                                        @if ($batches[$product->id] > 0)
                                            @if ($product->is_customizable == 0) <center> <span class="badge badge-pill badge-success" style="display: inline;">Available ({{$batches[$product->id]}})</span> </center> @else <span class="badge badge-pill badge-success" style="display: inline;">Available ({{$batches[$product->id]}})</span> </center> @endif
                                        @else
                                            @if ($product->is_customizable == 0) <center> <span class="badge badge-pill badge-danger" style="display: inline;">Unavailable</span> </center>@else <span class="badge badge-pill badge-danger" style="display: inline;">Unavailable</span> </center> @endif
                                        @endif

                                            <br>

                                        <h5 class="text-dark d-flex align-self-center justify-content-around" style="text-align: center; "><b>{{$product->item_name}}</b></h5>

                                        @if ($product->price != null)
                                            <h4 class="d-flex align-self-center justify-content-around" style="color: rgba(221, 0, 0, 0.9)">&#8369  {{ number_format($product->price, 2, '.', ',') }}</h4>
                                            <br>
                                        @endif
                                        <p class="small text-muted mb-0" style="font-size: 16px;">{{$product->description}}</p>

                                        <br>
                                        @if ($product->measurement != null)
                                             <p class="small text-muted mb-0" style="font-size: 16px;"><b>Measurements: </b>{{$product->measurement}}</p>
                                        @endif

                                        @if ($product->weight_volume != null)
                                            @if ($product->category_id == 2 || $product->category_id == 4)
                                                <p class="small text-muted mb-0" style="font-size: 16px;"><b>Volume: </b>{{$product->weight_volume}}</p>
                                            @else
                                                 <p class="small text-muted mb-0" style="font-size: 16px;"><b>Weight: </b>{{$product->weight_volume}}</p>
                                            @endif
                                        @endif


                                        @if ($product->has_variations == 1)
                                            <hr>
                                           @foreach ($variation_category as $var_cat)
                                                @php $flag = $var_cat->id @endphp
                                                @foreach ($variations as $variation)
                                                    @if ($variation->item_id == $product->id &&  $variation->variation_category_id == $var_cat->id &&  $flag == $var_cat->id)
                                                        <p class="small text-muted mb-0" style="font-size: 16px; display:inline;
                                                        word-wrap: break-word;"><b>{{$var_cat->category_name}}s: </b> <span style="font-size: 20px; font-weight: 600;">&#183</span> </p>
                                                        @foreach ($variations as $variation)
                                                            @if ($variation->item_id == $product->id  &&  $variation->variation_category_id == $var_cat->id)
                                                                <p class="small text-muted mb-0" style="font-size: 16px; display:inline;
                                                                word-wrap: break-word;">{{$variation->name}}
                                                                @if ($var_cat->price_priority == 1) <span style="color: rgba(221, 0, 0, 0.9)"> (&#8369  {{ number_format($variation->price, 2, '.', ',') }}) </span> @endif
                                                                <span style="font-size: 20px; font-weight: 600;">&#183</span></p>
                                                                @if ($variation->description != null)
                                                                    <p class="small text-muted mb-0" style="font-size: 16px; display:inline;
                                                                    word-wrap: break-word;"> <span style="font-size:14px;"> ( {{$variation->description}} ) </span><span style="font-size: 20px; font-weight: 600;">&#183</span> </p> <br>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        <br>
                                                        @php  $flag= $var_cat->id + 1 @endphp
                                                    @endif

                                                @endforeach
                                            @endforeach
                                        @endif
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>

            </div>

        </div>
    </section>

</main><!-- End #main -->

@endsection


