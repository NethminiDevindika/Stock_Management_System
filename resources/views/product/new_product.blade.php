@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <form action="{{ route('product.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Product 
                            </div>
                            <div class="text-info text-uppercase float-right">
                                <a href="/product/product-list" target="_self">
                                    <button type="button" class="btn btn-sm btn-success">
                                        <i class="fa fa-list">Product List</i>
                                    </button>
                                </a>
                            </div>
                        </div>
                        @if (session('alert'))
                            <div class="alert alert-success">
                                <button type="button"
                                        class="close"
                                        data-dismiss="alert"
                                        aria-hidden="true"
                                >&times;</button>
                                {{ session('alert') }}
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="category" class="col-md-4 col-form-label text-md-right">Main Category</label>

                                            <div class="col-md-6">
                                                <select id="category" type="text"
                                                        class="form-control @error('category') is-invalid @enderror"
                                                        name="category"
                                                        value="{{ old('category') }}">
                                                </select>

                                                @error('category')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="btn btn-sm btn-dark" data-toggle="modal"
                                                        data-target="#categoryModal" data-whatever="@mdo">
                                                    <i class="fa fa-plus-circle"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="brand" class="col-md-4 col-form-label text-md-right">Item Category</label>

                                            <div class="col-md-6">
                                                <select id="brand" type="text"
                                                        class="form-control @error('brand') is-invalid @enderror"
                                                        name="brand"
                                                        value="{{ old('brand') }}">
                                                </select>

                                                @error('brand')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="btn btn-sm btn-dark" data-toggle="modal"
                                                        data-target="#brandModal" data-whatever="@mdo">
                                                    <i class="fa fa-plus-circle"></i>
                                                </button>
                                            </div>
                                        </div> 



                                        <div class="form-group row">
                                            <label for="supplier" class="col-md-4 col-form-label text-md-right">Supplier</label>

                                            <div class="col-md-6">
                                                <select id="supplier" type="text"
                                                       class="form-control @error('supplier') is-invalid @enderror"
                                                       name="supplier"
                                                       value="{{ old('supplier') }}">
                                                </select>

                                                @error('supplier')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                                            <div class="col-md-6">
                                                <input id="description" type="text"
                                                       class="form-control @error('description') is-invalid @enderror"
                                                       name="description"
                                                       value="{{ old('description') }}">

                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="cost_price" class="col-md-4 col-form-label text-md-right">Cost Price</label>

                                            <div class="col-md-6">
                                                <input id="cost_price" type="number"
                                                       class="form-control @error('cost_price') is-invalid @enderror"
                                                       name="cost_price"
                                                       value="{{ old('cost_price') }}">

                                                @error('cost_price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="unit" class="col-md-4 col-form-label text-md-right">Assets Unit</label>

                                            <div class="col-md-6">
                                                <select id="unit" type="text"
                                                        class="form-control @error('unit') is-invalid @enderror"
                                                        name="unit"
                                                        value="{{ old('unit') }}">
                                                </select>

                                                @error('unit')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="btn btn-sm btn-dark" data-toggle="modal"
                                                        data-target="#unitModal" data-whatever="@mdo">
                                                    <i class="fa fa-plus-circle"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="reorder_level" class="col-md-4 col-form-label text-md-right">Re-order Quantity</label>

                                            <div class="col-md-6">
                                                <input id="reorder_level" type="number"
                                                       class="form-control @error('reorder_level') is-invalid @enderror"
                                                       name="reorder_level"
                                                       value="{{ old('reorder_level') }}">

                                                @error('reorder_level')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card col-lg-4">
                                    <div class="card-body">
                                        <div class="form-group" style="padding-top: 20px">
                                            <img id="product_image" class="img-thumbnail" width="200"
                                                 src="{{ asset('img/no_image.jpg') }}"
                                                 alt="product_image"/>
                                            <p>choose image</p>
                                            <input type="file" name="image" id="itempic" onchange="imageUpload(this); "/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row float-right" style="padding-top: 20px">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        Add Product
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade small" id="categoryModal" role="dialog" tabindex="-1" aria-labelledby="categoryModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="categoryForm">
                        <div class="modal-header bg-info small">
                            <h5 class="modal-title" id="exampleModalLabel">New Main Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-lable="Close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category" class="col-form-label">Description</label>
                                <input type="text" class="form-control" id="category_name" name="category_name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"
                                    onclick="saveCategory()" id="cat">
                                Save
                            </button>
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade small" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="brandModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="brandForm">
                        <div class="modal-header bg-info small">
                            <h5 class="modal-title" id="exampleModalLabel">New Item Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="brand_name" class="col-form-label">Description</label>
                                <input type="text" class="form-control" id="brand_name" name="brand_name">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" onclick="saveBrand()" id="bra" data-dismiss="modal">
                                Save
                            </button>
                            <input type="hidden" name="_token" value="{{Session::token()}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade small" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="unitModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header bg-info small">
                        <h5 class="modal-title" id="exampleModalLabel">New Unit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="unit_name" class="col-form-label">Unit type</label>
                            <input type="text" class="form-control" id="unit_name" name="unit_name">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveUnit()" data-dismiss="modal">
                            Save
                        </button>
                        <input type="hidden" name="_token" value="{{Session::token()}}">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script type="text/javascript">
        $('div.alert').delay(2000).slideUp(300);

        function saveCategory() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var category_name = $('#category_name').val();
            console.log(category_name)
            $.ajax({
                url: '/product/category/save-category',
                method: 'post',
                data: {
                    category_name: category_name
                }

            }).done(function (response) {

                $('#category_name').val('');
                $('#category').html('');
                getCategories();

            });
        }

        function saveBrand() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var brand_name = $('#brand_name').val();
            console.log(brand_name)
            $.ajax({
                url: '/product/brand/save-brand',
                method: 'post',
                data: {
                    brand_name: brand_name
                }

            }).done(function (response) {

                $('#brand_name').val('');
                $('#brand').html('');
                getBrands();

            });
        }

        function saveUnit() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var unit_name = $('#unit_name').val();
            console.log(unit_name)
            $.ajax({
                url: '/product/unit/save-unit',
                method: 'post',
                data: {
                    unit_name: unit_name
                }

            }).done(function (response) {

                $('#unit_name').val('');
                $('#unit').html('');
                getUnits();

            });
        }

        $(function () {
            getSuppliers();
            getCategories();
            getBrands();
            getUnits();
        });

        function imageUpload(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var img = new Image();
                    img.src = e.target.result;

                    var w;
                    var h;
                    var s;
                    img.onload = function (ev) {
                        w = this.width;
                        h = this.height;
                        s = input.files[0].size;
                        if (s >= 100000 || h > w) {
                            setTimeout(function () {
                                sweetAlert("Oops...", "Attachment should smaller than 100 kb and same width, height!", "error");
                            }, 500);

                            this.value = "400";
                            $('#itempic').val('')
                        } else {
                            $('#product_image')
                                .attr('src', e.target.result);
                        }
                    }

                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function getSuppliers() {
            $.getJSON("/product/supplier/supplier-list", function (data) {

                $.each(data, function (key, val) {
                    $('#supplier').append("<option value='" + val.id + "'>" + val.company_name + "</option>");
                })
            });
        }

        function getCategories() {
            $.getJSON("/product/category/category-list", function (data) {
                $.each(data, function (key, val) {
                    $('#category').append("<option value='" + val.id + "'>" + val.category_name + "</option>");
                })
            })
        }

        function getBrands() {
            $.getJSON("/product/brand/brand-list", function (data) {

                $.each(data, function (key, val) {
                    $('#brand').append("<option value='" + val.id + "'>" + val.brand_name + "</option>");
                })
            })
        }

        function getUnits() {
            $.getJSON("/product/unit/unit-list", function (data) {

                $.each(data, function (key, val) {
                    $('#unit').append("<option value='" + val.id + "'>" + val.unit_name + "</option>");
                })
            })
        }
    </script>
@endsection
