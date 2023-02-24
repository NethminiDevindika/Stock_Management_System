@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Product List
                        </div>
                        <div class="text-info text-uppercase">
                            <a href="/product/new-product"><button type="button" class="btn btn-success btn-sm float-right"><i class="fa fa-plus">New Product</i></button></a>
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
                        <form action="{{ route('product.search') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <input type="text" name="search" class="form-control" placeholder="Enter product code or description">
                                </div>
                                <div class="col-md-4">
                                    <select name="supplier" id="supplier" class="form-control">
                                        <option value="" selected disabled>Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <select name="category" id="category" class="form-control">
                                        <option value="" selected disabled>Select Main Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="brand" id="brand" class="form-control">
                                        <option value="" selected disabled>Select Item Category</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary btn-sm float-left">
                                        <i class="fa fa-search">Search</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="form-group row">
                            <table class="table table-borderless table-responsive-lg">
                                <thead class="bg-gradient-navy">
                                <tr class="text-uppercase">
                                    <th>ID</th>
                                    <th>Main Category</th>
                                    <th>Item Category</th>
                                    <th>Description</th>
                                    <th>Supplier</th>
                                    <th>View</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody class="bg-light">
                                @if ($products)
                                    @foreach ($products as  $key=> $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->categories->category_name }}</td>
                                            <td>{{ $product->brands->brand_name}}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $product->suppliers->company_name }}</td>
                                            <td><button class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#productModal_{{$key}}" data-whatever="@mdo" id="view_{{$key}}"><i class="fa fa-eye">View</i></button></td>
                                            <td><button onclick="deleteProduct({{ $product->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
                                        </tr>
                                        <div class="modal fade" id="productModal_{{$key}}" tabindex="-1" role="dialog"
                                             aria-labelledby="productModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form action="/product/product-update" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" class="form-control" value="{{$product->id}}" name="productId">
                                                        <div class="modal-header bg-info">
                                                            <h5 class="modal-title" id="productModalLabel">Update Product</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body small">
                                                            <div class="form-group">
                                                                <label for="description"
                                                                       class="col-form-label">DESCRIPTION:</label>
                                                                <input type="text" class="form-control small"
                                                                       name="description"
                                                                       id="description_{{$key}}" value="{{$product->description}}">
                                                                <input type="hidden" name="id" value="{{$product->id}}">
                                                            </div>

                                                                <div class="form-group col-lg-6">
                                                                    <label for="category"
                                                                           class="col-form-label">MAIN CATEGORY:</label>
                                                                    <select name="category" id="category_{{$key}}"
                                                                            class="form-control">
                                                                        @foreach ($products as $product)
                                                                            @if ($product->categories->id == $product->category)
                                                                                <option value="{{$product->categories->id}}" selected>{{$product->categories->category_name}}</option>
                                                                            @else
                                                                                <option value="{{$product->categories->id}}">{{$product->categories->category_name}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-lg-6">
                                                                    <label for="brand"
                                                                           class="col-form-label">ITEM CATEGORY:</label>
                                                                    <select name="brand" id="brand_{{$key}}"
                                                                            class="form-control">
                                                                        @foreach ($products as $product)
                                                                            @if ($product->brands->id == $product->brand)
                                                                                <option value="{{$product->brands->id}}" selected>{{$product->brands->brand_name}}</option>
                                                                            @else
                                                                                <option value="{{$product->brands->id}}">{{$product->brands->brand_name}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group col-lg-6">
                                                                    <label for="supplier"
                                                                           class="col-form-label">SUPPLIER:</label>
                                                                    <select name="supplier" id="supplier" class="form-control">
                                                                        @foreach ($products as $product)
                                                                            @if ($product->suppliers->id == $product->supplier)
                                                                                <option value="{{$product->suppliers->id}}" selected>{{$product->suppliers->company_name}}</option>
                                                                            @else
                                                                                <option value="{{$product->suppliers->id}}">{{$product->suppliers->company_name}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-lg-6">
                                                                    <label for="unit"
                                                                           class="col-form-label">ASSETS UNIT:</label>
                                                                    <select name="unit" id="unit" class="form-control">
                                                                        @foreach ($products as $product)
                                                                            @if ($product->units->id == $product->unit)
                                                                                <option value="{{$product->units->id}}" selected>{{$product->units->unit_name}}</option>
                                                                            @else
                                                                                <option value="{{$product->units->id}}">{{$product->units->unit_name}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label for="reorder_level"
                                                                           class="col-form-label">RE-ORDER QUANTITY:</label>
                                                                    <input type="number" class="form-control" id="reorder_level" name="reorder_level"
                                                                           value="{{$product->reorder_level}}">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-lg-6">
                                                                    <label for="cost_price"
                                                                           class="col-form-label">COST PRICE:</label>
                                                                    <input type="number" class="form-control" id="cost_price"
                                                                           value="{{$product->cost_price}}" name="cost_price">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                                                        class="fa fa-times"> Close</i></button>
                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save">
                                                                    Update</i></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('div.alert').delay(2000).slideUp(300);

        function deleteProduct(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value === true) {

                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "{{url('/product/product-delete')}}/" + id,
                        data: {_token: CSRF_TOKEN},
                        dataType: 'JSON',
                        success: function (results) {

                            if (results.success === true) {
                                swal("Done!", results.message, "success");
                                location.reload();
                            } else {
                                swal("Error!", results.message, "error");
                            }
                        }
                    });
                } else {
                    result.dismiss;
                }

            })


        }

        function imageUpload(input,index) {

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

                            this.value = "";
                            $('#itempic').val('')
                        } else {
                            $('#product_image_'+index)
                                .attr('src', e.target.result);
                        }
                    }

                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

