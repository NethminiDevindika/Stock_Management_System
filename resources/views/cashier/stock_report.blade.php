@extends('layouts.cashier')

@section('content')
    <div class="container-fluid" ng-app="stockApp" ng-controller="stockCtrl">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header bg-gradient-navy">
                        <div class="card-title text-info text-uppercase">STOCK REPORT</div>
                    </div>
                    </div>
                        <div class="form-group">
                            <table class="table table-bordered table-responsive-sm">
                                <thead class="bg-warning text-center">
                                <tr class="text-uppercase text-center">
                                    <th>Product Code</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                </tr>
                                </thead>
                                @foreach ($stocks as $stock)
                                    @foreach ($stock->products as $product)
                                        <tr class="text-center bg-light">
                                            <td>{{ $stock->product }}</td>
                                            <td>{{ $product->brands->brand_name }}</td>
                                            <td>{{ $product->categories->category_name }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $stock->qty }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </table>
                            {{ $stocks->links() }}
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
        var app = angular.module('stockApp', []);
        app.controller('stockCtrl', function ($scope, $http) {
            $scope.print = function () {
                window.print();
            }
        });

        $('#btn').click(function () {
            $('.table').tableToCSV({
                filename: "stock_report"
            });


        });

        function exportPdf() {
            window.open('/reports/downloadPDF/', '_self');
        }

    </script>
    <style>
        @media print {

            #search {
                visibility: hidden;
            }

            button {
                visibility: hidden;
            }

        }
    </style>
@stop