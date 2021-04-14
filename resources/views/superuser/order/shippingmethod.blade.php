@extends('layout.master')

@section('header')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
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

            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
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
                        <a href="{{ route('listShippingMethod') }}" class="nav-link active">
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
            <h1>List Shipping Method</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('superUser') }}">Home</a></li>
                <li class="breadcrumb-item active">Shipping Method</li>
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
                        <form style="margin-bottom:0!important;" action="{{ route('listShippingMethod') }}">
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
                            <th style="width:20rem;">@sortablelink('shipping_method','Shipping Method')</th>
                            <th style="text-align:end;">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($shipping_method as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->shipping_method }}</td>
                            <td style="text-align:end;">
                                <a class="updateData" data-target="#updateModal" data-toggle="modal"
                                    data-attr="{{ route('getEditShippingMethodData', ['id' => $data->id]) }}"><i
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

            {{ $shipping_method->appends(\Request::except('page'))->render() }}

        </div>
    </div>
</div>

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createShippingMethod"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="createShippingMethod">Add New Shipping Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('storeShippingMethodData') }}" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="createNewShippingMethod">Shipping Method</label>
                        <input type="input" class="form-control" id="createNewShippingMethod" name="shippingmethod">
                    </div>
                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateShippingMethod"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="updateShippingMethod">Update Shipping Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('updateShippingMethodData') }}" method="POST">
                @method('PATCH')
                <div class="modal-body">

                    <div class="form-group">
                        <label for="updateNewShippingMethod">Update Shipping Method</label>
                        <input type="input" class="form-control" id="updateNewShippingMethod" name="shippingmethod">
                    </div>

                </div>

                <input type="hidden" name="id" id="updateid">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="delete"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="delete">Delete Shipping Method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('deleteShippingMethodData') }}" method="POST">
                @method('DELETE')

                <div class="modal-body">
                    Yakin Teh Mau Hapus ini ?
                </div>

                <input type="hidden" name="id" id="deleteid">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" id="btnCreateCaseType">Delete</button>
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
@toastr_js
@toastr_render

<script>
    const allUpdateButton = document.querySelectorAll('.updateData');
    const shippingMethod = document.querySelector('#updateNewShippingMethod');
    const id = document.querySelector('#updateid');

    allUpdateButton.forEach((elm, idx) => {
        elm.addEventListener('click', () => {
            const url = elm.getAttribute('data-attr');

            getEditData(url, (result) => {
                console.log(result);
                shippingMethod.value = result.shipping_method;
                id.value = result.id;
            });
        });
    });

    const getEditData = async (url, cb) => {
        response = await fetch(url);
        result = await response.json();
        cb(result);
    }

    const allDeleteButton = document.querySelectorAll('.deleteData');
    const deleteInput = document.querySelector("#deleteid");

    allDeleteButton.forEach((elm, idx) => {
        elm.addEventListener('click', () => {
            const id = elm.getAttribute('data-attr');
            deleteInput.value = id;
            console.log(deleteInput);
        })
    });

</script>



@endsection
