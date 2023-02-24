@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            GRN List
                        </div>
                        <div class="text-info text-uppercase">
                            <a href="/grn/new-grn" target="_self">
                                <button type="button" class="btn btn-success btn-sm float-right">
                                    <i class="fa fa-plus">New GRN</i>
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
                        <form action="{{ route('grn.search') }}" method="post">
                            <div class="form-group row">
                                @csrf
                                <div class="col-lg-3">
                                    <input type="text" name="search" class="form-control" placeholder="Enter GRN No">
                                </div>
                                <div class="col-md-2">
                                    <select name="supplier" id="supplier" class="form-control">
                                        <option value="" selected disabled>Select Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="options" id="options" class="form-control">
                                        <option value="" selected disabled>Pending/Approved/Rejected</option>
                                        <option value="1">PENDING</option>
                                        <option value="2">APPROVED</option>
                                        <option value="3">REJECTED</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="date" class="form-control"
                                           name="created_at" id="created_at">
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
                                    <th>GRN</th>
                                    <th class="text-center">Supplier</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody class="bg-light">
                                @foreach($grns as $key=>$grn)
                                    <tr>
                                        <td>{{$grn->id}}</td>
                                        <td class="text-center">{{$grn->suppliers->company_name}}</td>
                                        <td class="text-center">{{$grn->created_at}}</td>
                                        <td class="text-center">
                                            @if($grn->status == \App\GrnHeader::GRN_PENDING)
                                                <span class="badge badge-pill badge-primary font-weight-bold">PENDING</span>
                                            @elseif($grn->status == \App\GrnHeader::GRN_APPROVED)
                                                <span class="badge badge-pill badge-success font-weight-bold">APPROVED</span>
                                            @elseif($grn->status == \App\GrnHeader::GRN_REJECTED)
                                                <span class="badge badge-pill badge-danger font-weight-bold">REJECTED</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="/grn/grn-view/{{ $grn->id }}" class="btn btn-warning btn-sm"><i
                                                        class="fa fa-eye">View</i></a>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            {{ $grns->links() }}
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

