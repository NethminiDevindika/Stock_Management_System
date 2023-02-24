@extends('layouts.cashier')

@section('content')
    <div class="container-fluid" ng-controller="creditCtrl" ng-app="creditApp">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <form action="{{ route('invoice.complete') }}" method="post">
                    @csrf
                    <div class="card" id="main">
                        <div class="card-header">
                            @if ($invoices->status == \App\InvoiceHeader::FULL_PAID)
                                <button class="btn btn-primary btn-sm" id="print" ng-click="print()">
                                    <i class="fa fa-print">Print</i>
                                </button>
                            @endif
                            <div class="card-title float-right font-weight-bold">INVOICE</div>
                        </div>
                        <div class="card-body">
                            @if (session('alert'))
                                <div class="alert alert-success">
                                    <button type="button"
                                            class="close"
                                            data-dismiss="alert"
                                            aria-hidden="true">
                                    </button>
                                    {{ session('alert') }}
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-header">
                                    <div class="row small">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <img src="{{ asset('img/logo_company.png') }}" alt="" class="small"
                                                     width="90">
                                                <label for="" class="float-right"><b>INVOICE:</b>{{ $invoices->invoice }}
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <span class="medium"><b>Sri Lanka Light Infantry Regiment, rhqslli@gmail.com</b></span>
                                                <label for="" class="float-right"><b>DATE:</b>{{ $invoices->created_at }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body form-group">
                                    @if ($invoices->status == \App\InvoiceHeader::NOT_FULL_PAID)
                                        <div class="row small">
                                            <div class="col-sm-12 form-group">
                                                <div class="card">
                                                    <div class="card-body">
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="card form-group">
                                        <div class="card-body small">
                                            <table class="table table-bordered table-responsive-sm">
                                                <tr class="bg-light">
                                                    <th>ITEM CODE</th>
                                                    <th>ITEM NAME</th>
                                                    <th>UNIT PRICE</th>
                                                    <th>QTY</th>
                                                    <th>TOTAL AMOUNT</th>
                                                </tr>
                                                <?php
                                                $total_cost = 0;
                                                ?>
                                                @foreach ($invoices->details as $invoice)

                                                    @foreach ($invoice->products as $product)

                                                        <?php
                                                        $cost = $product->cost_price * $invoice->qty;
                                                        $total_cost += $cost;
                                                        ?>
                                                        <tr>
                                                            <td>{{ $product->id }}</td>
                                                            <td>{{ $product->description }}</td>
                                                            <td>LKR: {{ number_format($product->cost_price,2) }}</td>
                                                            <td>{{ $product->qty }}</td>
                                                            <td>LKR: {{ number_format($cost,2) }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                
                                            </table>
                                        </div>
                                    </div>
                                   
                                                        
                                                        
                                                        
                                                        
                                                   
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>

        $('div.alert').delay(2000).slideUp(300);
        var app = angular.module("creditApp", []);

        app.controller("creditCtrl", function ($scope, $http) {
            $scope.balance = function () {
                var due_amount = Number($('#due_amount').val().replace(/[^0-9\.]+/g, ""));
                var payment = $('#payment').val();

                if (payment > due_amount){
                    var balance = payment - due_amount;
                } else {
                    var balance = 0;
                }
                return balance;
            }
        });


    </script>
@stop