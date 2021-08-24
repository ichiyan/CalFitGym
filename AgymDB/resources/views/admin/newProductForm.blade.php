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
            <form method='post' action='/products/new/create' enctype="multipart/form-data">
                @csrf
                {{-- <input type='hidden' name='_method' value='PUT'> --}}
                <div>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="profile-img">
                                <img id="profile-pic-preview"  src="/storage/customers/default-profile.png" alt=""/>
                                <!-- CHANGE DEFAULT PHOTO OF PRODUCT -->
                                <div class="file btn btn-lg btn-primary">
                                    Change Photo
                                    <input id="profile-pic"  type="file" accept="image/*" name="prod_image" onchange="loadFile(event)"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right">Category: </label>
                        <div class="col-md-6">
                            <select  id="select-product" class="form-control selectpicker" data-live-search="true" data-live-search-style="startsWith" name='category' required>
                                    <option> -- </option>
                                    @forEach ($categories as $category)
                                        <option value='{{$category->id}}'> {{$category->category}} </option>
                                    @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Name: </label>
                        <div class="col-md-6">
                            <input type='text' name='item_name' required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Price: </label>
                        <div class="col-md-6">
                            <input type='number' name='price'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right">Does it have variations? </label>
                        <div class="col-md-6">
                            <select  id="select-product" class="form-control selectpicker" data-live-search="true" data-live-search-style="startsWith" name='variations' required>
                                    <option> -- </option>
                                    <option value=0> NO </option>
                                    <option value=1> YES </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right">Does the variations have different prices? </label>
                        <div class="col-md-6">
                            <select  id="select-product" class="form-control selectpicker" data-live-search="true" data-live-search-style="startsWith" name='diff_prices' required>
                                    <option> -- </option>
                                    <option value=0> NO </option>
                                    <option value=1> YES </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right">Is the product customizable? </label>
                        <div class="col-md-6">
                            <select  id="select-product" class="form-control selectpicker" data-live-search="true" data-live-search-style="startsWith" name='customizable' required>
                                    <option> -- </option>
                                    <option value=0> NO </option>
                                    <option value=1> YES </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Weight per Piece: </label>
                        <div class="col-md-6">
                            <input type='number' name='weight_volume'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Dimensions: </label>
                        <div class="col-md-6">
                            <input type='number' name='measurement'>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-right"> Description: </label>
                        <div class="col-md-6">
                            <input type='text' name='description' required>
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
