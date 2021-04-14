@extends('layout.master')

@section('header')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bootstrap-select.min.css') }}">
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
                <a href="{{ route('listStockProduct') }}" class="nav-link active">
                    <i class="fas fa-box nav-icon"></i>
                    <p>Stocks</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('listManualOrder') }}" class="nav-link">
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
            <h1>List Stock</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('superUser') }}">Home</a></li>
                <li class="breadcrumb-item active">List Stock</li>
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

                    <div class="col-xl-4 offset-xl-7 ">
                        <form style="margin-bottom:0!important;" action="{{ route('listStockProduct') }}">
                            <div class="input-group mb-3" style="margin-bottom:0!important;">
                                @if(isset($searching))
                                <input type="text" name="searching" class="form-control" placeholder="Search"
                                    aria-label="Search" aria-describedby="basic-addon1" value="{{ $searching }}">
                                @else
                                <input type="text" name="searching" class="form-control" placeholder="Search"
                                    aria-label="Search" aria-describedby="basic-addon1">
                                @endif
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fas fa-search"></i></span>
                                </div>
                                <input type="hidden" value="searching">
                            </div>
                        </form>
                    </div>


                </div>
            </div>

            <div class="card-body table-responsive p-0" style="min-height: 300px; max-height:500px">
                <table class="table table-head-fixed text-nowrap table-hover">
                    <thead>
                        <tr>
                            <th style="width:1rem;">@sortablelink('id', 'ID')</th>
                            <th style="width:20rem;">@sortablelink('phone_type_id','Phone Type')</th>
                            <th style="width:20rem;">@sortablelink('phone_brand_id','Phone Brand')</th>
                            <th style="width:20rem;">@sortablelink('case_type_id','Case Type')</th>
                            <th>@sortablelink('stock','Stock')</th>

                            <th style="text-align:end;">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($list_stocks as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->phone_type }}</td>
                            <td>{{ $data->phone_brand }}</td>
                            <td>{{ $data->case_type }}</td>
                            <td>{{ $data->stock }}</td>
                            <td style="text-align:end;">
                                <a class="updateData" data-target="#updateModal" data-toggle="modal"
                                    data-attr="{{ route('getEditStockProductData', ['id' => $data->id]) }}"><i
                                        class="fas fa-edit" style="margin-right:0.5rem;"></i></a>
                                <a class="deleteData" data-target="#deleteModal" data-toggle="modal"
                                    data-attr="{{ $data->id }}"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                </table>

                </body>

                </html>
                </tbody>
                </table>
            </div>
            <br>

            {{ $list_stocks->appends(\Request::except('page'))->render() }}

        </div>
    </div>
</div>

<div class="modal fade" id="createModal" tab-inde="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Add New Stock Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="overflow:visible;">
                <form action="{{ route('storeStockProductData') }}" method="POST">
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="createbrandphone">Brand Phone</label>
                            <select class="selectpicker" name="brandphone" data-live-search="true" data-size="4"
                                data-container="body" data-dropup-auto="false" data-width="100%" id="selectbrandphone"
                                title="Pilih Brand Dulu">
                                @foreach($phone_brand as $data)
                                <option value="{{ $data->id }}">{{ $data->phone_brand }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="createtypephone">Type Phone</label>
                            <select class="selectpicker" name="typephone" data-live-search="true" data-size="4"
                                data-container="body" data-dropup-auto="false" data-width="100%"
                                id="selectcreatetypephone" disabled title="Choose Brand Phone First">
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="createtypephone">Case Type</label>
                        <select class="selectpicker" name="casetype" data-live-search="true" data-size="4"
                            data-container="body" data-dropup-auto="false" data-width="100%" id="selectcreatecasetype">
                            @foreach($case_type as $data)
                            <option value="{{ $data->id }}">{{ $data->case_type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock">
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>

        </div>

    </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="updateModal">Update Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('updateStockProductData') }}" method="POST">
                @method('PATCH')
                <div class="modal-body" style="overflow: visible;">
                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="updatephonebrand">Brand Phone</label>
                            <select class="selectpicker" name="updatephonebrand" data-live-search="true" data-size="4"
                                data-container="body" data-dropup-auto="false" data-width="100%"
                                id="selectupdatephonebrand" title="Pilih Brand Dulu">
                                @foreach($phone_brand as $data)
                                <option value="{{ $data->id }}">{{ $data->phone_brand }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="updatephonetype">Type Phone</label>
                            <select class="selectpicker" name="updatephonetype" data-live-search="true" data-size="4"
                                data-container="body" data-dropup-auto="false" data-width="100%"
                                id="selectupdatephonetype" title="Choose Brand Phone First">
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="updatecasetype">Case Type</label>
                        <select class="selectpicker" name="updatecasetype" data-live-search="true" data-size="4"
                            data-container="body" data-dropup-auto="false" data-width="100%" id="selectupdatecasetype">
                            @foreach($case_type as $data)
                            <option value="{{ $data->id }}">{{ $data->case_type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="updatestock">Stock</label>
                        <input type="number" class="form-control" id="updatestock" name="stock">
                    </div>

                    <input type="hidden" name="id" id="updateid">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnUpdate">Save</button>
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

            <form action="{{ route('deleteStockProductData') }}" method="POST">
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

@endsection

@section('javascript')
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap-select.min.js') }}"></script>
<script>
    const allUpdateButton = document.querySelectorAll('.updateData');
    const phoneStock = document.querySelector('#updatestock');
    const id = document.querySelector('#updateid');

    const getData = async (url, cb) => {
        try {
            response = await fetch(url);
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
                        const options = "<option " + "value='" + elm.id + "'>" + elm
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
                        $('select[name=updatephonebrand]').selectpicker('val',
                            result.idbrand);
                        $('select[name=updatecasetype]').selectpicker('val',
                            result.case_type_id);
                        $('select[name=updatephonetype]').selectpicker('val',
                            result.phone_type_id);
                        $('.selectpicker').selectpicker('refresh');
                        phoneStock.value = result.stock;
                        id.value = result.id;
                    })
                });
            });
        });
    });

    $('#selectbrandphone').change(() => {
        const idBrand = $('#selectbrandphone').selectpicker('val');
        const uri = `{{ route('getTypePhone') }}/${idBrand}`;

        getData(uri, (result) => {
            if (result.length === 0) {
                $('#selectcreatetypephone')
                    .selectpicker({
                        title: 'Datanya Kosong Bujang :('
                    })
                    .prop('disabled', true)
                    .selectpicker('render')
                    .html(' ')
                    .selectpicker("refresh");
            } else {
                $('#selectcreatetypephone').find('option').remove();

                result.forEach(elm => {
                    const options = "<option " + "value='" + elm.id + "'>" + elm.phone_type +
                        "</option>";
                    $('#selectcreatetypephone').append(options);
                });
                $('#selectcreatetypephone')
                    .prop('disabled', false)
                    .selectpicker({
                        title: 'Pilih dah datanya'
                    })
                    .selectpicker('render')
                    .selectpicker('refresh');
            }
        })
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
                    const options = "<option " + "value='" + elm.id + "'>" + elm.phone_type +
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
