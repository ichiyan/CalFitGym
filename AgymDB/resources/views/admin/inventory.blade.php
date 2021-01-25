@extends('layouts.admin-app')

@section('sidebar')

    @include('partials.admin-sidebar')

@endsection

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Inventory</h1>
        <div class="btn-toolbar">
            <div class="btn-group mr-3">
                <button onclick="showBorrowerFunction('new_batch')"   class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> New Product Batch</button>
            </div>
        </div>
    </div><!-- End of Page Heading  -->

    <!-- Table  -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link  @if (str_contains(url()->current(), 'admin/inventoryList/all')) active @endif" href='/admin/inventoryList/all'>All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @if (str_contains(url()->current(), 'admin/inventoryList/1')) active @endif" href='/admin/inventoryList/1'>Supplements & Refreshments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @if (str_contains(url()->current(), 'admin/inventoryList/3')) active @endif" href='/admin/inventoryList/3'>Active Wear</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @if (str_contains(url()->current(), 'admin/inventoryList/4')) active @endif" href='/admin/inventoryList/4'>Gym Essentials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @if (str_contains(url()->current(), 'admin/inventoryList/5')) active @endif" href='/admin/inventoryList/5'>Merchandise</a>
                </li>
            </ul>
        </div>


        <div class="card-body">

            <div class="container" id="new_batch">
                <form method='' action='/admin/inventory/create'>
                    @csrf
                    <div class="row">
                        <div class="form-group col-4">
                            <label>Choose Product:</label>
                            <select name='product_id' class="form-control" required>
                                <option> -- Product -- </option>
                                @forEach ($products as $product)
                                    <option value='{{$product->id}}'> {{$product->item_name}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-2">
                            <label>Batch Amount:</label>
                            <input class="form-control"  type='number' name='batch_amount' required>
                        </div>

                        <div class="form-group col-3">
                            <label>Date: </label>
                            <input class="form-control" type='date' name='expiry_date' required>
                        </div>

                        <div class="form-group col-2">
                            <button id="check" type="submit" value="Check" class="btn btn-primary shadow-sm"><i class="fas fa-check-circle text-white-50"></i> Check</button>
                        </div>

                    </div>
                </form>
            </div>


            <div class="table-responsive" id="inventory-table">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td> # </td>
                            <td> Name </td>
                            <td> Batch # </td>
                            <td> Batch Amount </td>
                            <td> Amount Left </td>
                            <td> Arrival Date </td>
                            <td> Expiry Date </td>
                            <td> Checked On </td>
                        </tr>
                    </thead>
                    <tbody>

                        @forEach($batches as $key => $batch)
                                <tr>
                                    <td> {{$key+1}} </td>
                                    <td> {{$batch->item_name}}  </td>
                                    <td> {{$batch->id}} </td>
                                    <td> {{$batch->batch_amount}} </td>
                                    <td> {{$batch->amt_left_batch}} </td>
                                    <td> {{$batch->date_received}} </td>
                                    <td> {{$batch->expiry_date}} </td>
                                    <td> {{$batch->updated_at}} </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<style>
    #new_batch {
        display:none;
    }
</style>

    <script>
        function showBorrowerFunction(id) {
            document.getElementById(id).style.display = "block";
            document.getElementById('inventory-table').style.display = "none";
        };

        $('#check').click(function(){
            document.getElementById('inventory-table').style.display = "block";

        });


    </script>

@endsection
