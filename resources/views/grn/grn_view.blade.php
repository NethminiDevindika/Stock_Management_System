@extends('layouts.admin')

@section('content')
    <div class="container" ng-controller="grnCtrl" ng-app="grnApp">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card" id="main">
                    <div class="card-header">
                        @if ($grns->status == \App\GrnHeader::GRN_APPROVED || $grns->status == \App\GrnHeader::GRN_REJECTED)
                            <button class="btn btn-primary btn-sm" id="print" ng-click="print()">
                                <i class="fa fa-print">Print</i>
                            </button>
                        @endif
                        <div class="card-title float-right font-weight-bold">SUPPLIER INVOICE</div>
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
                                            <label for="" class="float-right"><b>GRN:</b>{{ $grns->id }}</label>
                                        </div>
                                        <div class="form-group">
                                            <span class="medium"><b>Sri Lanka Light Infantry Regiment, rhqslli@gmail.com</b></span>
                                            <label for="" class="float-right"><b>DATE:</b>{{ $grns->created_at }}
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="float-right"><b>INVOICE:</b>{{ $grns->invoice }}
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
                                                    <span>{{ $grns->suppliers->company_name }}</span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="font-weight-bold float-left">ADDRESS :</label>
                                                    <span>{{ $grns->suppliers->address }}</span>
                                                </div>
                                    
                                                <div class="form-group">
                                                    <label for="" class="font-weight-bold float-left">TELEPHONE
                                                        :0</label>
                                                    <span>{{ $grns->suppliers->telephone }}</span>
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
                                            @foreach ($grns->details as $grn)

                                                @foreach ($grn->products as $product)

                                                    <?php
                                                    $cost = $product->cost_price * $grn->qty;
                                                    $total_cost += $cost;
                                                    ?>
                                                    <tr>
                                                        <td>{{ $product->id }}</td>
                                                        <td>{{ $product->description }}</td>
                                                        <td>LKR: {{ number_format($product->cost_price,2) }}</td>
                                                        <td>{{ $grn->qty }}</td>
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
                                @if ($grns->status == \App\GrnHeader::GRN_APPROVED)
                                    <img src="{{ asset('img/approved.jpg') }}" alt="" class="small float-left"
                                         width="250">
                                @endif
                                @if ($grns->status === \App\GrnHeader::GRN_REJECTED)
                                    <img src="{{ asset('img/rejected.png') }}" alt="" class="small float-left"
                                         width="250">
                                @endif
                                <div class="form-group float-right">
                                    <label for="" class="col-form-label">Remarks</label>
                                    <textarea name="" id="" cols="60" rows="3" class="form-control float-right" readonly>{{ $grns->remarks }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                @if ($grns->status == \App\GrnHeader::GRN_PENDING)
                                    <input type="submit" class="btn btn-primary float-right" value="Approve"
                                           ng-click="approveGrn({{ $grns->id }})">
                                    <input type="button" class="btn btn-danger float-right mr-2" value="Reject"
                                           ng-click="rejectGrn({{ $grns->id }})">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('div.alert').delay(2000).slideUp(300);
        var app = angular.module('grnApp', []);

        app.controller('grnCtrl', function ($scope) {
            $scope.print = function () {
                window.print();
            };


            $scope.approveGrn = function (grn) {
                bootbox.dialog({
                    message: "Do ypu want to approve this GRN?",
                    buttons: {
                        confirm: {
                            label: 'Yes',
                            className: 'btn-primary',
                            callback: function () {
                                window.open('/grn/grn-approve/' + grn, '_self');
                            }
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-danger',
                        }
                    }
                });
            };

            $scope.rejectGrn = function (grn) {
                bootbox.dialog({
                    message: "Do you want to reject this GRN?",
                    buttons: {
                        confirm: {
                            label: 'Yes',
                            className: 'btn-primary',
                            callback: function () {
                                window.open('/grn/grn-reject/' + grn, '_self')
                            }
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-danger',
                        }
                    }
                });
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