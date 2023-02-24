@extends('layouts.admin')

@section('content')
    <div class="container" ng-controller="purchasingCtrl" ng-app="purchasingApp">
        <div class="row">
            <div class="col-md-12 mt-3">
                <form action="{{ route('purchase.complete') }}" method="post">
                    @csrf
                    <div class="card" id="main">
                        <div class="card-header">
                            @if ($purchasings->status == \App\PurchaseHeader::PURCHASE_COMPLETED)
                                <button class="btn btn-primary btn-sm" id="print" ng-click="print()">
                                    <i class="fa fa-print">Print</i>
                                </button>
                            @endif
                            <div class="card-title float-right font-weight-bold">PURCHASE NOTE</div>
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
                                                <label for="" class="float-right"><b>PURCHASE:</b>{{ $purchasings->id }}
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <span class="medium"><b>Sri Lanka Light Infantry Regiment-SL Army, rhqslli@gmail.com</b></span>
                                                <label for="" class="float-right"><b>DATE:</b>{{ $purchasings->created_at }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body form-group">
                                    <div class="row small">
                                        <div class="col-sm-12 form-group">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="" class="font-weight-bold float-left">SUPPLIER :</label>
                                                        <span>{{ $purchasings->suppliers->company_name }}</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="font-weight-bold float-left">ADDRESS :</label>
                                                        <span>{{ $purchasings->suppliers->address }}</span>
                                                    </div>
                                            
                                                    <div class="form-group">
                                                        <label for="" class="font-weight-bold float-left">TELEPHONE
                                                            :0</label>
                                                        <span>{{ $purchasings->suppliers->telephone }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card form-group">
                                        <div class="card-body small">
                                            <table class="table table-bordered table-responsive-sm">
                                                <tr class="bg-light">
                                                    <th>ITEM CODE</th>
                                                    <th>ITEM NAME</th>
                                                    <th>UNIT CP</th>
                                                    <th>QTY</th>
                                                    <th>TOTAL CP</th>
                                                </tr>
                                                <?php
                                                $total_cost = 0;
                                                ?>
                                                @foreach ($purchasings->details as $purchasing)

                                                    @foreach ($purchasing->products as $product)

                                                        <?php
                                                        $cost = $product->cost_price * $purchasing->qty;
                                                        $total_cost += $cost;
                                                        ?>
                                                        <tr>
                                                            <td>{{ $product->id }}</td>
                                                            <td>{{ $product->description }}</td>
                                                            <td>LKR: {{ number_format($product->cost_price,2) }}</td>
                                                            <td>{{ $purchasing->qty }}</td>
                                                            <td>LKR: {{ number_format($cost,2) }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                                <tr class="bg-light">
                                                    <td colspan="4" class="font-weight-bold">TOTAL</td>
                                                    <td>LKR: {{ number_format($total_cost,2) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    @if ($purchasings->status == \App\PurchaseHeader::PURCHASE_COMPLETED)
                                        <img src="{{ asset('img/paid.jpg') }}" alt="" class="small float-left ml-4 mt-2"
                                             width="150">
                                    @endif
                                    @if ($purchasings->status == \App\PurchaseHeader::PURCHASE_PENDING)
                                        <div class="form-group card">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-lg-8">
                                                        <label for="">Remarks</label>
                                                        <textarea name="" id="" cols="60" rows="4"
                                                                  class="form-control float-right"
                                                                  disabled>{{ $purchasings->remark }}</textarea>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="pull-right">
                                                            <label for="">Total</label>
                                                            <input type="text" class="form-control" name="total_amount"
                                                                   id="total_amount"
                                                                   value="LKR: {{ number_format($purchasings->total_amount,2) }}"
                                                                   disabled>
                                                        </div>
                                                        <div class="pull-right">
                                                            <label for="">Payment Due</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   value="LKR: {{ number_format($purchasings->total_amount - $purchasings->payed_amount,2) }}"
                                                                   disabled>
                                                        </div>
                                                        <div class="pull-right">
                                                            <label for="">Enter Amount</label>
                                                            <input type="text" name="payment" id="payment"
                                                                   class="form-control"
                                                            >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row float-right">
                                                    <input type="submit" class="btn btn-primary float-right"
                                                           value="Complete"
                                                    >
                                                </div>
                                                <input type="hidden" name="purchaseId" value="{{ $purchasings->id }}">
                                            </div>
                                        </div>
                                    @endif
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
        var app = angular.module('purchasingApp', []);

        app.controller('purchasingCtrl', function ($scope) {
            $scope.print = function () {
                window.print();
            };

        });
    </script>
    <style>
        @media print {

            #print {
                visibility: hidden;
            }

            .main-footer {
                visibility: hidden;
            }
        }
    </style>
@endsection