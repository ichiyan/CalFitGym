@extends('layouts.admin-app')

@section('sidebar')

    @include('partials.admin-sidebar')

@endsection

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product List</h1>
        <!-- <div class="btn-toolbar">
            <div class="btn-group mr-3">
                <button href="{{ route('productForm') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> New Product</button>
            </div>
        </div> -->
        <div class="btn-toolbar">
            <div class="btn-group mr-3">
                <a href="{{ route('productForm') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> New Product </a>
            </div>
        </div>
    </div><!-- End of Page Heading  -->

    <!-- Table  -->
    <div class="card shadow mb-4">

        <div class="card-body">

            <div class="table-responsive" id="inventory-table">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td> # </td>
                            {{-- <td>Image</td> --}}
                            <td> Name </td>
                            <td> Stock </td>
                            <td> Price </td>
                        </tr>
                    </thead>
                    <tbody>

                        @forEach($products as $key => $product)
                                <tr>
                                    <td> {{$key+1}} </td>
                                    <td>
                                        @if($product->item_pic != "default-item.png")
                                            <img src="/storage/items/{{$product->item_pic}}" alt="" style="width: 50px">
                                        @else
                                            <img src="/storage/items/default-item.png" alt="" style="width: 50px">
                                        @endif
                                        {{$product->item_name}}
                                    </td>
                                    <td> {{$stock[$key]}} </td>

                                    <td>
                                    @if($product->has_different_prices == 0)
                                         {{$product->price}}
                                    @else
                                        Prices vary
                                    @endif
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
