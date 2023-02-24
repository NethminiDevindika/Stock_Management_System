@extends('layouts.cashier')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header bg-gradient-navy">
                        <div class="card-title text-info text-uppercase">
                            Invoice List
                        </div>
                        <div class="text-info text-uppercase">
                            <a href="/cashier/index" target="_self">
                                <button type="button" class="btn btn-success btn-sm float-right">
                                    <i class="fa fa-plus">Invoice</i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <table class="table table-borderless table-responsive-sm">
                                <thead class="bg-gradient-navy text-center">
                                <tr class="text-uppercase text-center">
                                    <th>Invoice No</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Total Amount</th>
                                    <th>Date</th>
                                   
                                   
                                </tr>
                                </thead>
                                <tbody class="bg-light">
                                @foreach($invoices as $key=>$invoice)
                                    <tr class="text-center bg-light">
                                        <td>{{$invoice->invoice}}</td>
                                        <td>{{$invoice->description}}</td> 
                                        <td>LKR: {{$invoice->cost_price}}.00</td>
                                        <td>{{$invoice->qty}}</td> 
                                        <td>LKR: {{$invoice->total_amount}}.00</td>
                                        <td>{{$invoice->created_at}}</td>
                                        
                                     
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                            {{ $invoices->links() }}
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

