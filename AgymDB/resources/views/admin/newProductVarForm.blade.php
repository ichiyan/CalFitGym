@extends('layouts.admin-app')

@section('sidebar')

    @include('partials.admin-sidebar')

@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">New Product</h1>
    </div><!-- End of Page Heading  -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Product</h6>
        </div>
        <div class="card-body">
            <form method='post' action='/products/new/var' enctype="multipart/form-data">
                @csrf
                {{-- <input type='hidden' name='_method' value='PUT'> --}}
                <div>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right">Item ID:</label>
                        <div class="col-md-6"> {{$item->id}} </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right">Item Name:</label>
                        <div class="col-md-6"> {{$item->item_name}} </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right">Item ID:</label>
                        <div class="col-md-6"> {{$item->price}} </div>
                    </div>
                    
                    <hr>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right">Category: </label>
                        <div class="col-md-6">
                            <select  id="select-product" class="form-control selectpicker" data-live-search="true" data-live-search-style="startsWith" name='category' required>
                                    <option> -- </option>
                                    @forEach ($variation_categories as $var_category)
                                        <option value='{{$var_category->id}}'> {{$var_category->category_name}} </option>
                                    @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <hr>
                <div class="form-row justify-content-center">
                    <div class="col-md-2"><input type='submit' class="btn btn-rounded-primary" value='Add'></div>
                    <div class="col-md-2"><button class="btn btn-rounded-light"><a href='{{ url()->previous() }}'>Cancel</a></button></div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
