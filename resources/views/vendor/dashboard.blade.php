@extends('layouts.vendor')

@section('title')
	Vendor Dashboard
@endsection

@section('content')

    <div class="container-fluid dashboard mt-4">

        <div class="card mb-4 shadow-sm bg-gray-100 border-left-primary">
            <div class="card-body d-sm-flex align-items-center justify-content-between">
                <h4 class="text-success font-weight-bolder">Vendor Dashboard</h4>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm d-print-none" onclick="window.print()">
                    <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                </a>
            </div>
        </div>

        <div id='printMe'>
            <div class="row">

                <!-- Products (without trash) -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="{{ url('vendor/products') }}">
                        <div class="card border-left-success h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Products (Items)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($products) }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fab fa-product-hunt fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Sliders (Ads) -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="{{ url('vendor/manage-ads') }}">
                        <div class="card border-left-success h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ads</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($sliders) }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-ad fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Coupons (All) -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="{{ url('vendor/coupons') }}">
                        <div class="card border-left-success h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Coupons (All)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($coupons) }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-gift fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Orders (All) -->
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="{{ url('vendor/orders') }}">
                        <div class="card border-left-success h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Orders (All)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($orderitems) }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-truck fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>

        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div
                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
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
                        <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
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
                                <i class="fas fa-circle text-primary"></i> Direct
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Social
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> Referral
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')

    {{-- Start bootstarp page level plugins --}}
    <script type="text/javascript" src="{{ asset('assets/sb/vendor/chart.js/Chart.min.js')}}"></script>

    {{-- Start bootstarp Page level custom scripts   --}}
    <script type="text/javascript" src="{{ asset('assets/sb/js/demo/chart-area-demo.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/sb/js/demo/chart-pie-demo.js')}}"></script>

@endsection
