@extends('layouts.app')

@section('menu')
    @include('admin.adminmenu')
@endsection

@section('content')
<div class="card">
    <div class="card-header">{{ __('INVENTORY') }}</div>
    <div class="c-body">
        <main class="c-main">
            <div class="container-fluid">
                <div class="fade-in">
                    <div class="card">
                        <div class="card-header">
                            <form>
                                <label>Search: <input type="text" name="search" placeholder="find inventory item"></label>
                            </form>
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href='/admin/inventory'>All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href='/admin/inventory/'>Food</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href='/admin/inventory/'>Active Wear</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href='/admin/inventory/'>Merchandise</a>
                                </li>
                            </ul>
                        </div>
                        <table class="table table-responsive-sm table-hover table-outline mb-0">
                            <tr class="thead-light">
                                <td class="text-center">#</td>
                                <td class="text-center">Name</td>
                                <td class="text-center">Batch #</td>
                                <td class="text-center">Description</td>
                                <td class="text-center">Quantity</td>
                                <td class="text-center">Amount Left</td>
                                <td class="text-center">Batch Arrival</td>
                                <td class="text-center">Expiry Date</td>
                                <td class="text-center">Checked On</td>
                                <td class="text-center">Action</td>
                            </tr>
                        </table>
                    </div>
                </div>  
            </div>
        </main>
    </div>            
</div>
@endsection