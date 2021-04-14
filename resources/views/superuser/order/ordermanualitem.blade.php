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
            <h1>List Manual Order Item</h1>
            <p>{{ $code }}</p>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('superUser') }}">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('listManualOrder') }}">List Manual Order</a></li>
                <li class="breadcrumb-item active">{{ $code }}</li>
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

                    @if(!($status == "Done"))
                    <button type="button " class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#createModal">Add New</button>
                    @endif
                    </div>

                    <div class="col-xl-4 offset-xl-7 ">
                        <form style="margin-bottom:0!important;"
                            action="{{ route('listOrderManualItem',['id' => $order_id]) }}">

                            <div class="form-group">
                                <div class="input-group mb-3" style="margin-bottom:0!important;">
                                    @if(isset($searching))
                                    <input type="text" name="searching" class="form-control" placeholder="Search"
                                        aria-label="Search" aria-describedby="basic-addon1" value="{{ $searching }}">
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

                        </form>
                    </div>


                </div>
            </div>

            <div class="card-body table-responsive p-0" style="min-height: 300px; max-height:500px">
                <table class="table table-head-fixed text-nowrap table-hover">
                    <thead>
                        <tr>
                            <td>Brand Phone</td>
                            <td>Type Phone</td>
                            <td>Case Type</td>
                            <td>Image</td>
                            <td>Amount</td>
                            <td>Price</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>

                    <tbody>{{$order}}
                        @foreach($order as $data)
                        <tr>
                            <td data-toggle="tooltip" data-placement="bottom"
                                style="max-width: 11rem; overflow: hidden; text-overflow: ellipsis;">
                                {{ $data->phone_brand }}
                            </td>

                            <td data-toggle="tooltip" data-placement="bottom" 
                                style="max-width: 11rem; overflow: hidden; text-overflow: ellipsis;">
                                {{ $data->phone_type }}
                            </td>

                            <td data-toggle="tooltip" data-placement="bottom" 
                                style="max-width: 11rem; overflow: hidden; text-overflow: ellipsis;">
                                {{ $data->case_type  }}
                            </td>

                            <td data-toggle="tooltip" data-placement="bottom" 
                                style="overflow: hidden; text-overflow: ellipsis;">
                                <img src="/images/orderitems/{{$data->image}}">
                            </td>

                            <td data-toggle="tooltip" data-placement="bottom" 
                                style="max-width: 11rem; overflow: hidden; text-overflow: ellipsis;">
                                {{ $data->amount }}
                            </td>

                            <td data-toggle="tooltip" data-placement="bottom"
                                style="max-width: 11rem; overflow: hidden; text-overflow: ellipsis;">
                                Rp. {{ number_format($data->amount*$data->price,2,',','.') }}
                            </td>

                            <td>
                                <div class="row">

                                    @if($data->status=="Pre-Order")
                                    <div class="col-xl-12">
                                        <span>{{ $data->status }}</span>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                                role="progressbar" aria-valuenow="33" aria-valuemin="0"
                                                aria-valuemax="100" style="width: 33%"></div>
                                        </div>
                                    </div>
                                    @elseif ($data->status=="Ready To Print")
                                    <div class="col-xl-12">
                                        <span>{{ $data->status }}</span>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                                                role="progressbar" aria-valuenow="67" aria-valuemin="0"
                                                aria-valuemax="100" style="width: 67%"></div>
                                        </div>
                                    </div>
                                    @elseif($data->status=="Ready To Ship")
                                    <div class="col-xl-12">
                                        <span>{{ $data->status }}</span>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                aria-valuemax="100" style="width: 100%"></div>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </td>

                            <td>
                                @if($data->status == "Pre-Order" || $data->status == "Ready To Print")
                                <a class="updateStatusData" data-target="#updateStatusModal" data-toggle="modal"
                                    data-attr="{{ route('getStatusItem', ['id' => $data->id]) }}"
                                    style="margin-right:0.8rem;"><i class="fas fa-arrow-circle-right"></i></a>
                                <a class="deleteData" data-target="#deleteModal" data-toggle="modal"
                                    data-attr="{{ $data->id }}" data-amount="{{ $data->amount }}"
                                    data-status="{{ $data->status }}" data-stock="{{ $data->stock_id }}"><i
                                        class="fas fa-trash-alt"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="4"></td>
                            <td>Total</td>
                            <td>Belum dibuat</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            <br>

        </div>
    </div>
</div>

<div class="modal fade" id="createModal" tab-inde="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('storeManualOrderItemData') }}" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="create-select-brandphone">Brand Phone</label>
                            <select class="selectpicker" name="brandphone" data-live-search="true" data-size="4"
                                data-container="body" data-dropup-auto="false" data-width="100%"
                                id="create-select-brandphone" title="Pilih Brand Dulu">
                                @foreach($phone_brand as $data)
                                <option value="{{ $data->id }}">{{ $data->phone_brand }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="create-select-typephone">Type Phone</label>
                            <select class="selectpicker" name="typephone" data-live-search="true" data-size="4"
                                data-container="body" data-dropup-auto="false" data-width="100%"
                                id="create-select-typephone" disabled title="Choose Brand Phone First">
                            </select>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="create-select-casetype">Case Type</label>
                            <select class="selectpicker" name="casetype" data-live-search="true" data-size="4"
                                data-container="body" data-dropup-auto="false" data-width="100%"
                                id="create-select-casetype">
                                @foreach($case_type as $data)
                                <option value="{{ $data->id }}">{{ $data->case_type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="create-amount">Amount</label>
                            <input type="number" class="form-control" id="create-amount" disabled name="amount">
                        </div>
                    </div>

                    <div class="form-group d-flex flex-column">
                        <label for="create-image">Image</label>
                        <input type="file" name="image" class="py-1">
                    </div>

                    <div class="form-group" id="create-checkstock-container">
                    </div>
            </div>

            <input type="hidden" name="status" id="create-status">
            <input type="hidden" name="stockid" id="create-stockid">
            <input type="hidden" name="orderid" value="{{ request()->id }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" disabled id="check-item">Check Item</button>
                <button type="submit" class="btn btn-primary" disabled id="create-newitem">Save changes</button>
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

            <form action="{{ route('deleteManualOrderItemData') }}" method="POST">
                @method('DELETE')

                <div class="modal-body">
                    Yakin Teh Mau Hapus ini ?
                </div>

                <input type="hidden" name="id" id="delete-id">
                <input type="hidden" name="amount" id="delete-amount">
                <input type="hidden" name="status" id="delete-status">
                <input type="hidden" name="stockid" id="delete-stockid">
                <input type="hidden" name="orderid" id="deleteorderid" value="{{ $order_id }}">
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

            <form action="{{ route('updateStatusDataItem') }}" method="POST">
                @method('PATCH')

                <div class="modal-body" id="update-status-container">

                </div>

                <input type="hidden" name="amount" id="update-amount">
                <input type="hidden" name="id" id="update-statusid">
                <input type="hidden" name="orderid" value="{{ request()->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info" id="btn-updatestatus"></button>
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

    const allUpdateButton = document.querySelectorAll('.updateData');
    const id = document.querySelector('#updateid');

    const createTypePhone = document.querySelector('#create-select-typephone');
    const createBrandPhone = document.querySelector('#create-select-brandphone');
    const createCaseType = document.querySelector('#create-select-casetype');
    const createAmount = document.querySelector('#create-amount');
    const createStatus = document.querySelector('#create-status');
    const createStockId = document.querySelector('#create-stockid');

    const btnCheckItem = document.querySelector('#check-item');
    const btnNewItem = document.querySelector('#create-newitem');
    const urlCheckData = "{{ route('checkItem') }}";

    let stockData;

    const alertMessage = (msg, type) => {
        if (type === 'danger') {
            return `<div class="alert alert-danger" role="alert">
                        ${msg}
                    </div>`
        } else if (type === 'info') {
            return `<div class="alert alert-info" role="alert">
                        ${msg}
                    </div>`
        } else if (type === 'success') {
            return `<div class="alert alert-success" role="alert">
                        ${msg}
                    </div>`
        }
    }

    const getData = async (url, cb) => {
        try {
            response = await fetch(url);
            result = await response.json();
            cb(result);
        } catch (error) {
            console.log('Fetch error: ', error);
        }
    }

    const checkItem = async (url, data, cb) => {
        const init = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }
        try {
            response = await fetch(url, init);
            result = await response.json();
            cb(result);
        } catch (error) {
            console.log('Fetch error: ', error);
        }
    }

    allUpdateButton.forEach((elm, idx) => {
        elm.addEventListener('click', () => {
            const url = elm.getAttribute('data-attr');
            getData(url, (result) => {
                const uri = `{{ route('getTypePhone') }}/${result.idbrand}`;
                $('#selectupdatephonetype').find('option').remove();
                const renderNew = (res, cb) => {
                    res.forEach(elm => {
                        const options = "<option " + "value='" + elm
                            .id + "'>" + elm
                            .phone_type + "</option>";
                        $('#selectupdatephonetype').append(options);
                    });
                    $('#selectupdatephonetype')
                        .selectpicker('render')
                        .selectpicker('refresh');
                    cb();
                }
                getData(uri, (res) => {
                    renderNew(res, () => {
                        $('select[name=updatephonebrand]')
                            .selectpicker('val',
                                result.idbrand);
                        $('select[name=updatecasetype]')
                            .selectpicker('val',
                                result.case_type_id);
                        $('select[name=updatephonetype]')
                            .selectpicker('val',
                                result.phone_type_id);
                        $('.selectpicker').selectpicker('refresh');
                        phoneStock.value = result.stock;
                        id.value = result.id;
                    })
                });
            });
        });
    });

    $('#create-select-brandphone').change(() => {
        const idBrand = $('#create-select-brandphone').selectpicker('val');
        const uri = `{{ route('getTypePhone') }}/${idBrand}`;

        getData(uri, (result) => {
            if (result.length === 0) {
                $('#create-select-typephone')
                    .selectpicker({
                        title: 'Datanya Kosong Bujang :('
                    })
                    .prop('disabled', true)
                    .selectpicker('render')
                    .html(' ')
                    .selectpicker("refresh");
                btnCheckItem.disabled = true;
                btnNewItem.disabled = true;
                createAmount.disabled = true;
            } else {
                $('#create-select-typephone').find('option').remove();
                result.forEach(elm => {
                    const options = "<option " + "value='" + elm.id + "'>" + elm
                        .phone_type +
                        "</option>";
                    $('#create-select-typephone').append(options);
                });
                $('#create-select-typephone')
                    .prop('disabled', false)
                    .selectpicker({
                        title: 'Pilih dah datanya'
                    })
                    .selectpicker('render')
                    .selectpicker('refresh');
                btnCheckItem.disabled = true;
                btnNewItem.disabled = true;
                createAmount.disabled = true;

            }
        })
    });

    $('#create-select-typephone').change(() => {
        btnCheckItem.disabled = false;
        btnNewItem.disabled = true;
        createAmount.disabled = true;
        createAmount.value = "";
        stockData = null;
    })

    $('#create-select-casetype').change(() => {
        btnNewItem.disabled = true;
        createAmount.disabled = true;
        createAmount.value = "";
        stockData = null;
    });

    $('#selectupdatephonebrand').change(() => {
        const idBrand = $('#selectupdatephonebrand').selectpicker('val');
        const uri = `{{ route('getTypePhone') }}/${idBrand}`;

        getData(uri, (result) => {
            console.log(result);
            if (result.length === 0) {
                $('#selectupdatephonetype')
                    .selectpicker({
                        title: 'Datanya Kosong Bujang :('
                    })
                    .prop('disabled', true)
                    .selectpicker('render')
                    .html(' ')
                    .selectpicker("refresh");
            } else {
                $('#selectupdatephonetype').find('option').remove();
                result.forEach(elm => {
                    const options = "<option " + "value='" + elm.id + "'>" + elm
                        .phone_type +
                        "</option>";
                    $('#selectupdatephonetype').append(options);
                });
                $('#selectupdatephonetype')
                    .prop('disabled', false)
                    .selectpicker({
                        title: 'Pilih dah datanya'
                    })
                    .selectpicker('render')
                    .selectpicker('refresh');
            }
        })
    });

    btnCheckItem.addEventListener('click', () => {
        const data = {
            phone_type: createTypePhone.value,
            phone_brand: createBrandPhone.value,
            case_type: createCaseType.value,
            _token: "{{ csrf_token() }}"
        }

        checkItem(urlCheckData, data, (result) => {
            const createCheckStockContainer = document.querySelector('#create-checkstock-container');
            const textTypePhone = $('#create-select-typephone option:selected').text();
            const textBrandPhone = $('#create-select-brandphone option:selected').text();
            if (result.length === 0) {
                createCheckStockContainer.innerHTML = alertMessage(
                    `${textBrandPhone} ${textTypePhone} is not available`, "danger");
                btnNewItem.disabled = false;
                createAmount.disabled = false;

                createStatus.value = 'Pre-Order';
                createStockId.value = null;

            } else if (result.length > 0 && result[0].stock === 0) {
                createCheckStockContainer.innerHTML = alertMessage(
                    `${textBrandPhone} ${textTypePhone} is Empty, Restock right now`, "info");
                btnNewItem.disabled = false;
                createAmount.disabled = false;

                createStatus.value = 'Pre-Order';
                createStockId.value = result[0].id;

            } else if (result.length > 0 && result[0].stock > 0) {
                createCheckStockContainer.innerHTML = alertMessage(
                    `${textBrandPhone} ${textTypePhone}, has ${result[0].stock} items available`,
                    "success");
                btnNewItem.disabled = false;
                createAmount.disabled = false;

                createStatus.value = 'Ready To Print';
                createStockId.value = result[0].id;
                stockData = result[0].stock;
            }
        });
    });

    createAmount.addEventListener('input', () => {
        console.log(`Value Input ${createAmount.value}, Stock Data ${stockData}`);
        if (createAmount.value <= stockData && createStatus.value === "Ready To Print") {
            btnNewItem.disabled = false;
        } else if (createStatus.value === "Pre-Order") {
            btnNewItem.disabled = false;
        } else {
            btnNewItem.disabled = true;
        }
    });

    const allDeleteButton = document.querySelectorAll('.deleteData');
    const deleteInput = document.querySelector("#delete-id");
    const deleteStatus = document.querySelector('#delete-status');
    const deleteAmount = document.querySelector('#delete-amount');
    const deleteStock = document.querySelector('#delete-stockid');
    const deleteOrderId = document.querySelector('#deleteorderid');

    allDeleteButton.forEach((elm, idx) => {
        elm.addEventListener('click', () => {
            const id = elm.getAttribute('data-attr');
            const amount = elm.getAttribute('data-amount');
            const status = elm.getAttribute('data-status');
            const stock = elm.getAttribute('data-stock');

            console.log(stock);

            deleteStock.value = stock;
            deleteStatus.value = status;
            deleteAmount.value = amount;
            deleteInput.value = id;
        })
    });

    const allUpdateStatusData = document.querySelectorAll('.updateStatusData');
    const statusInput = document.querySelector('#statusid');
    const updateStatusId = document.querySelector('#update-statusid');
    const updateAmount = document.querySelector('#update-amount')
    const updateStatusContainer = document.querySelector('#update-status-container');
    const btnUpdateStatus = document.querySelector('#btn-updatestatus');

    allUpdateStatusData.forEach((elm, idx) => {
        elm.addEventListener('click', () => {
            const url = elm.getAttribute('data-attr');
            getData(url, (result) => {
                if (result.status === "Pre-Order") {
                    updateStatusContainer.innerHTML = 
                        `Are you sure u've already restock this case ?`;
                    btnUpdateStatus.innerHTML = `Ready To Print`;
                } else if (result.status === "Ready To Print") {
                    updateStatusContainer.innerHTML =
                        `Are you sure u've already print this case ?`;
                    btnUpdateStatus.innerHTML = `Ready To Ship`;
                }
                updateAmount.value = result.amount;
                updateStatusId.value = result.id;
            })
        })
    })

</script>

@toastr_js
@toastr_render
@endsection
