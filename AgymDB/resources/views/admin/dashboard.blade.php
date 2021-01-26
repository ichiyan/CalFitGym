@extends('layouts.admin-app')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <div class="btn-toolbar">
                <div class="btn-group mr-3">
                    <a href="/admin/order/new" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> New Order</a>
                </div>
                <div class="btn-group mr-3">
                    <a href="/new/form/customer" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> New Customer</a>
                </div>
                <div class="btn-group mr-3">
                    <a href="/admin/inventoryList/all" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> New Product Batch</a>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">

             <!-- Earnings (Annual) Card Example -->
             <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Earnings (Annual)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"> &#8369 {{$annual_earnings}} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Earnings ( {{$today->monthName}} )</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"> &#8369 {{$monthly_earnings}} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Earnings (Today) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Earnings (Today)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">&#8369 {{$day_earnings}} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logged Customers -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Logged Customers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$logged_customer}} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Content Row -->

         <!-- Content Row -->

         <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Earnings</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Active Memberships</h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                aria-labelledby="dropdownMenuLink">
                                <div class="dropdown-header">Dropdown Header:</div>
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Walk-In
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i>Monthly
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i>Premium
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- End of Content Row -->

         <!-- Content Row -->

         <div class="row">

            <!-- Subscriptions Table -->
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Subscriptions Expiring in the Next 30 Days</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Membership</th>
                                        <th>Expiry Date</th>
                                        <th>Days Left</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @forEach($near_expiry as $value => $expiry)
                                    @if($today->diffInDays($expiry->end_date, false) < 31 && $today->diffInDays($expiry->end_date, false) > 0)
                                    <tr>
                                        <td>
                                        @if($today->diffInDays($expiry->end_date, false) > 0)
                                            @if($log[$value]->exit == NULL)
                                                <a href="/admin/log/{{$log[$value]->id}}/edit"><span class="log-btn login" data-toggle="tooltip" data-placement="top" title="click to logout"></span></a>
                                            @else
                                                <a href="/admin/log/{{$expiry->id}}/create"><span class="log-btn logout" data-toggle="tooltip" data-placement="top" title="click to login"></span></a>
                                            @endif
                                        @else
                                            <span class="log-btn inactive" data-toggle="tooltip" data-placement="top" title="inactive"></span>
                                        @endif
                                        </td>

                                        <td> {{$expiry->id}} </td>
                                        <td> {{$expiry->fname}}   {{$expiry->lname}} </td>

                                        <td>
                                        @foreach($member_type as $type)
                                            @if($type->id == $expiry->member_type_id)
                                                {{$type->member_type_name}}
                                            @endif
                                        @endforeach
                                        </td>

                                        <td> {{\Carbon\Carbon::parse($expiry->end_date)->toFormattedDateString()}} </td>

                                        <td> {{$today->diffInDays($expiry->end_date, false)}} </td>

                                        <td>
                                            <button class="btn btn-sm btn-danger"><a href="#" style="color: white">Notify</a></button>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                               
                            </table>
                        </div>
                    </div>
                </div>
            </div>

         </div>

         <div class="row">

             <!-- Products Table -->
             <div class="col-lg-6 col-mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Products with Less Than 15% In Stock</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>In Stock</th>
                                    </tr>
                                </thead>
                                @forEach($batches as $key => $batch)
                                    @if(($batch->amt_left_batch/$batch->batch_amount) < 0.15)
                                    <tr>
                                        <td> {{$key+1}} </td>

                                        <td>
                                        @forEach($products as $item)
                                            @if($batch->item_id == $item->id)
                                              {{$item->item_name}} 
                                            @endif
                                        @endforeach
                                        </td>

                                        <td> {{$batch->amt_left_batch}} out of {{$batch->batch_amount}} </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Batches Expiring in the Next 30 Days</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered display" id="" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Batch No.</th>
                                        <th>Expiring on</th>
                                        <th>In Stock</th>
                                    </tr>
                                </thead>
                                @forEach($batches as $key => $batch)
                                    @if($today->diffInDays($batch->expiry_date, false) < 31 && $today->diffInDays($batch->expiry_date, false) > 0)
                                    <tr>
                                        <td> {{$key+1}} </td>

                                        <td>
                                        @forEach($products as $item)
                                            @if($batch->item_id == $item->id)
                                              {{$item->item_name}} 
                                            @endif
                                        @endforeach
                                        </td>

                                        <td> {{$batch->id}} </td>
                                        <td> {{\Carbon\Carbon::parse($batch->expiry_date)->toFormattedDateString()}} </td>
                                        <td> {{$batch->amt_left_batch}} </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>

         </div>

    </div>
    <!-- End of Page Content -->
    <script type="text/javascript">
    var chartdata = <?php echo $data['chart_data']; ?>;
    var graphdata = <?php echo $graph['chart_data']; ?>;
    console.log(JSON.stringify(graphdata));
    </script>
@endsection


