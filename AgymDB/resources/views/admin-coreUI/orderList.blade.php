@extends('layouts.app')

@section('menu')
    @include('admin.adminmenu')
@endsection

@section('content')
<div class="card">
    <div class="card-header">{{ __('ORDERS') }}</div>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <div class="card">
                        <div class="card-header">
                            <form>
                                <label>Customer Name: <input type="text" name="search" placeholder="find inventory item"></label>
                                <label>Customer ID: <input type="text" name="search" placeholder="find inventory item"></label>
                            </form>
                        </div>
                        <table class="table table-responsive-sm table-hover table-outline mb-0">
                            <tr class="thead-light">
                                <td class="text-center">#</td>
                                <td class="text-center">Product Name</td>
                                <td class="text-center">Price</td>
                                <td class="text-center">Quantity</td>
                                <td class="text-center">Customization</td>
                            </tr>
                        </table>
                    </div>
                </div>  
            </div>
        </main>
    </div>            
</div>
@endsection