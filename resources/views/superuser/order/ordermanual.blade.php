@extends('layout.master')

@section('header')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bootstrap-select.min.css') }}">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
    integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
    crossorigin="anonymous" />
@toastr_css

@endsection

@section('aside')
<div class="sidebar">

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
                <a href="{{ route('superUser') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('listStockProduct') }}" class="nav-link">
                    <i class="fas fa-box nav-icon"></i>
                    <p>Stocks</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('listManualOrder') }}" class="nav-link active">
                    <i class="fas fa-pallet nav-icon"></i>
                    <p>Manual Order</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-store nav-icon"></i>
                    <p>Marketplace Order</p>
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
            </li>

            <!-- <li class="nav-header">EXAMPLES</li> -->


        </ul>
    </nav>
</div>
@endsection

@section('mainHeader')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>List Manual Order</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('superUser') }}">Home</a></li>
                <li class="breadcrumb-item active">List Manual Order</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('mainContent')
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-xl-1 mb-3 mb-xl-0">
                        <button type="button " class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#createModal">Add New</button>
                    </div>

                    <div class="col-xl-6 offset-xl-5 ">
                        <form style="margin-bottom:0!important;" action="{{ route('listManualOrder') }}">
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <div class="input-daterange input-group" id="datepicker">
                                        @if(isset($start))
                                        <input type="text" value="{{ $start }}" class="input-sm form-control"
                                            name="start" placeholder="From" autocomplete="off" />
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-calendar-day"></i></span>
                                        </div>
                                        <input type="text" value="{{ $end }}" class="input-sm form-control" name="end"
                                            placeholder="To" autocomplete="off" />
                                        @else
                                        <input type="text" class="input-sm form-control" name="start" placeholder="From"
                                            autocomplete="off" />
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fas fa-calendar-day"></i></span>
                                        </div>
                                        <input type="text" class="input-sm form-control" name="end" placeholder="To"
                                            autocomplete="off" />
                                        @endif

                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="input-group mb-3" style="margin-bottom:0!important;">
                                        @if(isset($searching))
                                        <input type="text" name="searching" class="form-control" placeholder="Search"
                                            aria-label="Search" aria-describedby="basic-addon1"
                                            value="{{ $searching }}">
                                        @else
                                        <input type="text" name="searching" class="form-control" placeholder="Search"
                                            aria-label="Search" aria-describedby="basic-addon1">
                                        @endif
                                        <button>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="fas fa-search"></i></span>
                                            </div>
                                        </button>
                                        <input type="hidden" value="searching">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>


                </div>
            </div>

            <div class="card-body table-responsive p-0" style="min-height: 300px;">
                <table class="table table-head-fixed text-nowrap table-hover table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align: middle;">Code</th>
                            <th rowspan="2" style="vertical-align: middle;">Name</th>
                            <th rowspan="2" style="vertical-align: middle;">Contact</th>
                            <th rowspan="2" style="vertical-align: middle;">Address</th>
                            <th rowspan="2" style="vertical-align: middle;">Order</th>
                            <th rowspan="2" style="vertical-align: middle;">Payment</th>
                            <th colspan="2" style="text-align:center;">Shipping</th>
                            <th rowspan="2" style="vertical-align: middle;">Note</th>
                            <th rowspan="2" style="vertical-align: middle;">Shipping Fee</th>
                            <th rowspan="2" style="vertical-align: middle;">Status</th>
                            <th rowspan="2" style="vertical-align: middle;">Action</th>
                        </tr>
                        <tr>
                            <th>Shipping</th>
                            <th>Number Receipt</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($order as $data)
                        <tr>
                            <td data-toggle="tooltip" data-placement="bottom" title="{{ $data->code_order }}"
                                style="max-width: 11rem; overflow: hidden; text-overflow: ellipsis;">
                                <a>{{ $data->code_order }}</a></td>
                            <td data-toggle="tooltip" data-placement="bottom" title="{{ $data->name }}">
                                {{ $data->name }}</td>
                            <td data-toggle="tooltip" data-placement="bottom" title="{{ $data->contact }}">
                                {{ $data->contact }}</td>
                            <td data-toggle="tooltip" data-placement="bottom" title="{{ $data->address }}"
                                style="max-width: 10rem; overflow: hidden; text-overflow: ellipsis;">
                                {{ $data->address }}</td>
                            <td data-toggle="tooltip" data-placement="bottom" title="{{ $data->order_source }}">
                                {{ $data->order_source }}</td>
                            <td data-toggle="tooltip" data-placement="bottom" title="{{ $data->payment_method }}">
                                {{ $data->payment_method }}</td>

                            @if($data->receipt_number)
                            <td data-toggle="tooltip" data-placement="bottom" title="{{ $data->shipping_method }}">
                                {{ $data->shipping_method }}</td>

                            <td data-toggle="tooltip" data-placement="bottom" title="{{ $data->receipt_number }}">
                                {{ $data->receipt_number }}</td>
                            @else
                            <td colspan="2" style="text-align:center;" data-toggle="tooltip" data-placement="bottom"
                                title="{{ $data->shipping_method }}">
                                {{ $data->shipping_method }}</td>
                            @endif

                            <td data-toggle="tooltip" data-placement="bottom" title="{{ $data->note }}"
                                style="max-width: 10rem; overflow: hidden; text-overflow: ellipsis;">
                                {{ $data->note }}</td>
                            <td data-toggle="tooltip" data-placement="bottom" title="{{ $data->shipping_fee }}"
                                style="max-width: 10rem; overflow: hidden; text-overflow: ellipsis;">
                                {{ $data->shipping_fee }}</td>

                            <td style="min-width:10rem">
                                <div class="row">

                                    @if($data->status=="No Items Yet")
                                    <div class="col-xl-12">
                                        <span>{{ $data->status }}</span>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                                role="progressbar" aria-valuenow="25" aria-valuemin="0"
                                                aria-valuemax="100" style="width: 25%"></div>
                                        </div>
                                    </div>
                                    @elseif ($data->status=="On Progress")
                                    <div class="col-xl-12">
                                        <span>{{ $data->status }}</span>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                                                role="progressbar" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100" style="width: 50%"></div>
                                        </div>
                                    </div>
                                    @elseif($data->status=="Ready To Ship")
                                    <div class="col-xl-12">
                                        <span>{{ $data->status }}</span>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                aria-valuemax="100" style="width: 75%"></div>
                                        </div>
                                    </div>
                                    @elseif($data->status=="Done")
                                    <div class="col-xl-12">
                                        <span>{{ $data->status }}</span>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                aria-valuemax="100" style="width: 100%"></div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </td>

                            <td style="text-align:center;">
                                <a class="updateData" data-target="#updateModal" data-toggle="modal"
                                    data-attr="{{ route('getEditManualOrderData', ['id' => $data->id]) }}"><i
                                        class="fas fa-edit" style="margin-right:0.5rem;"></i></a>

                                <a href="{{ route('listOrderManualItem', ['id' => $data->id]) }}"><i
                                        class="fas fa-boxes" style="margin-right:0.5rem;"></i></a>

                                @if($data->status=="No Items Yet")

                                <a class="deleteData" data-target="#deleteModal" data-toggle="modal"
                                    data-attr="{{ $data->id }}"><i class="fas fa-trash-alt"></i></a>

                                @elseif($data->status == "On Progress")

                                @elseif($data->status == "Ready To Ship")
                                @if($data->shipping_method == "Kurir BPP" || $data->shipping_method == "Take Away")
                                <a class="updateStatusData" data-target="#updateStatusModal" data-toggle="modal"
                                    data-attr="{{ $data->id }}"><i class="fas fa-arrow-circle-right"></i></a>
                                @else
                                <a class="updateStatusData" data-target="#updateStatusModal" data-toggle="modal"
                                    data-attr="{{ $data->id }}" data-shipping="{{ $data->shipping_method }}"><i
                                        class="fas fa-arrow-circle-right"></i></a>
                                @endif

                                @elseif($data->status == "Done")
                                <a class="printOrder" href="{{ route('printManualOrder', ['id' => $data->id]) }}" target="_blank"><i
                                        class="fas fa-print"></i></a>

                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>

            {{ $order->appends(\Request::except('page'))->render() }}

        </div>
    </div>
</div>

<div class="modal fade" id="createModal" tab-inde="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add New Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('storeManualOrderData') }}" method="POST">

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="create-name">Nama</label>
                            <input type="text" class="form-control" id="create-name" name="name">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="create-contact">Contact</label>
                            <input type="text" class="form-control" id="create-contact" name="contact">
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="create-selectordersource">Order Source</label>
                            <select class="selectpicker" name="ordersource" data-live-search="true" data-size="4"
                                data-container="body" data-dropup-auto="false" data-width="100%"
                                id="create-selectordersource" title="Order Source">
                                @foreach($order_source as $data)
                                <option value="{{ $data->id }}">{{ $data->order_source }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="create-selectpaymentmethod">Payment Method</label>
                            <select class="selectpicker" name="paymentmethod" data-live-search="true" data-size="4"
                                data-container="body" data-dropup-auto="false" data-width="100%"
                                id="create-selectpaymentmethod" title="Payment Method">
                                @foreach($payment_method as $data)
                                <option value="{{ $data->id }}">{{ $data->payment_method }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="create-selectshippingmethod">Shipping Method</label>
                            <select class="selectpicker" name="shippingmethod" data-live-search="true" data-size="4"
                                data-container="body" data-dropup-auto="false" data-width="100%"
                                id="create-selectshippingmethod" title="Shipping Method">
                                @foreach($shipping_method as $data)
                                <option value="{{ $data->id }}">{{ $data->shipping_method }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="create-container-numberrecipt">

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="create-address">Address</label>
                            <textarea class="form-control" id="create-address" rows="4" name="address"></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="create-note">Note</label>
                            <textarea class="form-control" id="create-note" rows="4" name="note"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="create-address">Fee</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shippingfee" id="radio-paidoff" checked
                                value="Paid Off">
                            <label class="form-check-label" for="radio-paidoff">
                                Paid Off
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shippingfee" id="radio-cod" value="COD">
                            <label class="form-check-label" for="radio-cod">
                                COD
                            </label>
                        </div>
                    </div>


                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="userid" value="{{ Session::get('userId') }}">
                    <input type="hidden" name="user" value="{{ Session::get('name') }}">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="buttin" class="btn btn-success">Add Item</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Update Manual Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('updateManualOrderData') }}" method="POST">
                    @method('PATCH')
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="update-name">Nama</label>
                            <input type="text" class="form-control" id="update-name" name="name">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="update-contact">Contact</label>
                            <input type="text" class="form-control" id="update-contact" name="contact">
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="update-selectordersource">Order Source</label>
                            <select class="selectpicker" name="ordersource" data-live-search="true" data-size="4"
                                data-container="body" data-dropup-auto="false" data-width="100%"
                                id="update-selectordersource" title="Order Source">
                                @foreach($order_source as $data)
                                <option value="{{ $data->id }}">{{ $data->order_source }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="update-selectpaymentmethod">Payment Method</label>
                            <select class="selectpicker" name="paymentmethod" data-live-search="true" data-size="4"
                                data-container="body" data-dropup-auto="false" data-width="100%"
                                id="update-selectpaymentmethod" title="Payment Method">
                                @foreach($payment_method as $data)
                                <option value="{{ $data->id }}">{{ $data->payment_method }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="update-selectshippingmethod">Shipping Method</label>
                            <select class="selectpicker" name="shippingmethod" data-live-search="true" data-size="4"
                                data-container="body" data-dropup-auto="false" data-width="100%"
                                id="update-selectshippingmethod" title="Shipping Method">
                                @foreach($shipping_method as $data)
                                <option value="{{ $data->id }}">{{ $data->shipping_method }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div id="update-container-numberrecipt"></div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="update-address">Address</label>
                            <textarea class="form-control" id="update-address" rows="4" name="address"></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="update-note">Note</label>
                            <textarea class="form-control" id="update-note" rows="4" name="note"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="update-address">Shipping Fee</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shippingfee" id="update-radio-paidoff"
                                checked value="Paid Off">
                            <label class="form-check-label" for="radio-paidoff">
                                Paid Off
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shippingfee" id="update-radio-cod"
                                value="COD">
                            <label class="form-check-label" for="radio-cod">
                                COD
                            </label>
                        </div>
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" id="updateid">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="buttin" class="btn btn-success">Add Item</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="deleteModal">Delete Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('deleteManualOrderData') }}" method="POST">
                @method('DELETE')

                <div class="modal-body">
                    Yakin Teh Mau Hapus ini ?
                </div>

                <input type="hidden" name="id" id="deleteid">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="btnDelete">Delete</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-labelledby="updateStatusModal"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="updateModal">Change Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('updateManualStatusOrderData') }}" method="POST">
                @method('PATCH')

                <div class="modal-body" id="update-contaner-statusorder">

                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="orderid" id="update-status-orderid">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info" id="btn-updatestatus" disabled>Done</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection

@section('javascript')
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap-select.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
    $('.input-daterange').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: true,
        orientation: "bottom auto",
        daysOfWeekHighlighted: "0",
        autoclose: true
    });

    $('[data-toggle="tooltip"]').tooltip();

    const allUpdateButton = document.querySelectorAll('.updateData');
    const allUpdateStatusButton = document.querySelectorAll('.updateStatusData');

    const updateName = document.querySelector('#update-name');
    const updateContact = document.querySelector('#update-contact');
    const updateAddress = document.querySelector('#update-address');
    const updateNote = document.querySelector('#update-note');
    const radioPaidOff = document.querySelector('#update-radio-paidoff');
    const radioCod = document.querySelector('#update-radio-cod');

    const id = document.querySelector('#updateid');

    const updateStatusOrderId = document.querySelector('#update-status-orderid');
    const updateStatusOrderContainer = document.querySelector('#update-contaner-statusorder');
    const btnStatusUpdate = document.querySelector('#btn-updatestatus');
    const updateStatusOrderHTML = `Are u done with this order?`;

    const updateReceiptNumberContainer = document.querySelector('#update-container-numberrecipt');
    const updateReceiptNumberHTML = `<label for="update-numberrecipt">Number Receipt</label>
                                    <input type="text" class="form-control" id="update-numberrecipt" name="receiptnumber">
                                <div id="error-update"></div>`;

    $('#update-selectshippingmethod').on('change', function () {
        if ($(this).val() > 5) {
            updateReceiptNumberContainer.innerHTML = updateReceiptNumberHTML;
            updateReceiptNumberContainer.classList.add("form-group");
        } else {
            updateReceiptNumberContainer.innerHTML = " ";
            updateReceiptNumberContainer.classList.remove("form-group");
        }
    });

    const getData = async (url, cb) => {
        try {
            response = await fetch(url);
            result = await response.json();
            cb(result);
        } catch (error) {
            console.log('Fetch error: ', error);
        }
    }

    allUpdateStatusButton.forEach((elm, idx) => {
        elm.addEventListener('click', () => {
            const dataShipping = elm.getAttribute('data-shipping');
            const orderId = elm.getAttribute('data-attr');
            if (dataShipping === null) {
                updateStatusOrderContainer.innerHTML = updateStatusOrderHTML;
                btnStatusUpdate.disabled = false;
            } else {
                updateStatusOrderContainer.innerHTML = updateReceiptNumberHTML;
                const updateNumberReceipt = document.querySelector('#update-numberrecipt');
                btnStatusUpdate.disabled = true;

                updateNumberReceipt.addEventListener('input', () => {
                    console.log(!updateNumberReceipt.value == "");
                    if (!updateNumberReceipt.value == "") {
                        btnStatusUpdate.disabled = false;
                    } else {
                        btnStatusUpdate.disabled = true;
                    }
                });
            }
            updateStatusOrderId.value = orderId;
        })
    });

    allUpdateButton.forEach((elm, idx) => {
        elm.addEventListener('click', () => {
            const url = elm.getAttribute('data-attr');
            getData(url, (result) => {
                $('#update-selectordersource').selectpicker('val', result.order_source_id);
                $('#update-selectpaymentmethod').selectpicker('val', result.payment_method_id);
                $('#update-selectshippingmethod').selectpicker('val', result
                    .shipping_method_id);
                $('.selectpicker').selectpicker('refresh');

                if (result.shipping_method_id > 5) {
                    updateReceiptNumberContainer.innerHTML = updateReceiptNumberHTML;
                    updateReceiptNumberContainer.classList.add("form-group");
                    const updateNumberReceipt = document.querySelector('#update-numberrecipt');
                    updateNumberReceipt.value = result.receipt_number;
                } else {
                    updateReceiptNumberContainer.innerHTML = " ";
                    updateReceiptNumberContainer.classList.remove("form-group");
                }

                updateName.value = result.name;
                updateContact.value = result.contact;
                updateAddress.value = result.address;
                updateNote.value = result.note;

                if (result.shipping_fee === 'COD') {
                    radioCod.checked = true;
                } else {
                    radioPaidOff.checked = true;
                }

                id.value = result.id;
            });
        });
    });

    const allDeleteButton = document.querySelectorAll('.deleteData');
    const deleteInput = document.querySelector("#deleteid");

    allDeleteButton.forEach((elm, idx) => {
        elm.addEventListener('click', () => {
            const id = elm.getAttribute('data-attr');
            deleteInput.value = id;
        })
    });

</script>

@toastr_js
@toastr_render


@endsection
