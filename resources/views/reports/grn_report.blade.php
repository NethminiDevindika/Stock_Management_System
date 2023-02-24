@extends('layouts.admin')

@section('content')
    <div class="container" ng-controller="grnCtrl" ng-app="grnApp">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title text-info text-uppercase">GRN REPORT</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group card" id="header">
                            <div class="card-body">
                                <form action="{{ route('grnR.search') }}" method="get" id="grnform">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 small">
                                            <label for="">Select Date</label>
                                            <input type="date" class="form-control"
                                                   name="created_at" id="created_at">
                                        </div>
                                        <div class="col-lg-3 small">
                                            <label for="">From</label>
                                            <input type="date" class="form-control"
                                                   placeholder="From"
                                                   name="from" id="from"/>
                                        </div>
                                        <div class="col-lg-3 small">
                                            <label for="">To</label>
                                            <input type="date" class="form-control"
                                                   placeholder="To"
                                                   name="to" id="to"/>
                                        </div>
                                        <div class="col-lg-2 pt-4 mt-1">
                                            <button type="submit" class="btn btn-primary btn-sm" ng-click="submitForm()">Search
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> 
                        <div class="card" id="card2">
                            <div class="card-body">
                                <table class="table table-bordered table-responsive-sm">
                                    <thead class="bg-warning text-center">
                                    <tr class="text-uppercase text-center">
                                        <th>GRN No</th>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Cost Price</th>
                                        <th colspan="2">Qty</th>
                                    </tr>
                                    </thead>
                                    @if (isset($grns))
                                        @foreach ($grns as $grn)
                                            @foreach ($grn->details as $detail)
                                                @foreach ($detail->products as $product)
                                                    <tr class="text-center bg-light">
                                                        <td>{{ $grn->id }}</td>
                                                        <td>{{ $grn->created_at }}</td>
                                                        <td>{{ $product->description }}</td>
                                                        <td align="right">Rs.{{ $product->cost_price }}.00</td>
                                                        <td colspan="2">{{ $detail->qty }}</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
                        <div class="btn-group-sm float-right" role="group">
                            <button id="btn" type="button" class="btn btn-success"><i class="fa fa-file-excel"> csv</i></button>
                            <button type="button" class="btn btn-primary" ng-click="print()"><i class="fa fa-print"> print</i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var app = angular.module('grnApp', []);
        app.controller('grnCtrl', function ($scope, $http) {

            $scope.print = function () {
                window.print();
            };


            $scope.submitForm = function () {
                $('#grnform').submit();
            };
        });

        $('#btn').click(function () {
            $('.table').tableToCSV({
                filename: "grn_report"
            });


        });

        function exportPdf() {
            window.open('/reports/downloadPDF/', '_self');
        }
    </script>
    <style>
        @media print {

            #header {
                visibility: hidden;
            }

            #card2 {
                margin-top: -150px;
            }

            .main-footer {
                visibility: hidden;
            }

            button {
                visibility: hidden;
            }
        }
    </style>
@stop