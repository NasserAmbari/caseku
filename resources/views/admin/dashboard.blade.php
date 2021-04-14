@extends('layout.master')

@section('header')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
@endsection

@section('aside')
<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="#" class="d-block">
                Hello, {{Session::get('name')}}
            </a>
        </div>
    </div>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="{{ route('admin') }}" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <!-- <li class="nav-item">
                <a href="{{ route('listStockProduct') }}" class="nav-link">
                    <i class="fas fa-box nav-icon"></i>
                    <p>Stocks</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('listOrder') }}" class="nav-link">
                    <i class="fas fa-pallet nav-icon"></i>
                    <p>Order</p>
                </a>
            </li>

                        <li class="nav-item">
                <a href="{{ route('listUser') }}" class="nav-link">
                    <i class="fas fa-user nav-icon"></i>
                    <p>User</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cubes"></i>
                    <p>
                        Master Data
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                <li class="nav-item">
                        <a href="{{ route('listCaseType') }}" class="nav-link">
                            <i class="fas fa-mobile nav-icon"></i>
                            <p>Case Types</p>
                        </a>
                    </li>

                    <li class="nav-item active">
                        <a href="{{ route('listPhoneBrand') }}" class="nav-link">
                            <i class="fas fa-copyright nav-icon"></i>
                            <p>Phone Brands</p>
                        </a>
                    </li>

                    <li class="nav-item active">
                        <a href="{{ route('listPhoneType') }}" class="nav-link">
                            <i class="fas fa-mobile-alt nav-icon"></i>
                            <p>Phone Types</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('listOrderSource') }}" class="nav-link">
                            <i class="fab fa-sourcetree nav-icon"></i>
                            <p>Order Source</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('listPaymentMethod') }}" class="nav-link">
                            <i class="fas fa-money-check-alt nav-icon"></i>
                            <p>Payment Method</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('listShippingMethod') }}" class="nav-link">
                            <i class="fas fa-shipping-fast nav-icon"></i>
                            <p>Shipping Method</p>
                        </a>
                    </li>

                </ul>
            </li> -->


            <!-- <li class="nav-header">EXAMPLES</li> -->


        </ul>
    </nav>
</div>
@endsection

@section('mainHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Blank Page</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('mainContent')

@endsection

@section('javascript')
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
@endsection
