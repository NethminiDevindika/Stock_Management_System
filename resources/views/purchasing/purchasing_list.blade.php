@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Purchase List
                        </div>
                        <div class="text-info text-uppercase">
                            <a href="/purchase/new-purchase" target="_self">
                                <button type="button" class="btn btn-success btn-sm float-right">
                                    <i class="fa fa-plus">New Purchase</i>
                                </button>
                            </a>
                        </div>
                    </div>
                    @if(session('alert'))
                        <div class="alert alert-success">
                            <button type="button"
                                    class="close"
                                    data-dismiss="alert"
                                    aria-hidden="true">
                            </button>
                            {{ session('alert') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('purchase.search') }}" method="post">
                            <div class="form-group row">
                                @csrf
                                <div class="col-md-2">
                                    <input type="text" name="search" class="form-control" placeholder="Enter GRN No">
                                </div>
                                <div class="col-md-3">
                                    <select name="supplier" id="supplier" class="form-control">
                                        <option value="" selected disabled>Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="options" id="options" class="form-control">
                                        <option value="" selected disabled>Pending/Paid</option>
                                        <option value="1">PENDING</option>
                                        <option value="2">PAID</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control"
                                           name="created_at" id="created_at">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-sm float-left form-control">
                                        <i class="fa fa-search">Search</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="form-group row">
                            <table class="table table-borderless table-responsive-lg">
                                <thead class="bg-gradient-navy">
                                <tr class="text-uppercase">
                                    <th>Purchasing No</th>
                                    <th class="text-center">Supplier</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody class="bg-light">
                                @foreach($purchasings as $key=>$purchasing)
                                    <tr>
                                        <td>{{$purchasing->id}}</td>
                                        <td class="text-center">{{$purchasing->suppliers->company_name}}</td>
                                        <td class="text-center">{{$purchasing->created_at}}</td>
                                        <td class="text-center">
                                            @if($purchasing->status == \App\PurchaseHeader::PURCHASE_PENDING)
                                                <span class="badge badge-pill badge-danger font-weight-bold">PENDING PAYMENT</span>
                                            @elseif($purchasing->status == \App\PurchaseHeader::PURCHASE_COMPLETED)
                                                <span class="badge badge-pill badge-success font-weight-bold">PAID</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="/purchase/purchase-view/{{ $purchasing->id }}"
                                               class="btn btn-warning btn-sm" target="_self"><i
                                                        class="fa fa-eye">View</i></a>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            {{ $purchasings->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('div.alert').delay(2000).slideUp(300);

        function imageUpload(input, index) {

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
                            $('#product_image_' + index)
                                .attr('src', e.target.result);
                        }
                    }

                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

