@extends('layouts.admin')

@section('content')
    <div class="container" ng-app="valuationApp" ng-controller="valuationCtrl">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title text-info text-uppercase">STOCK VALUATION REPORT</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <table class="table table-bordered table-responsive-sm">
                                <thead class="bg-warning text-center">
                                <tr class="text-uppercase text-center">
                                    <th>Product Code</th>
                                    <th>Item Category</th>
                                    <th>Main Category</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Unit CP|P</th>
                                    <th>Total CP|P</th>
                                </tr>
                                </thead>
                                <?php
                                $unit_cp = 0;
                         
                                $total_cp = 0;
                            
                                $total_cp_amount = 0;
                          
                                ?>
                                @foreach ($stocks as $stock)
                                    @foreach ($stock->products as $product)
                                        <?php
                                        $unit_cp = $product->cost_price;
                                   
                                        $total_cp = $product->cost_price * $stock->qty;
                                
                                        $total_cp_amount += $total_cp;
                                     
                                        ?>
                                        <tr class="text-center bg-light">
                                            <td>{{ $stock->product }}</td>
                                            <td>{{ $product->brands->brand_name }}</td>
                                            <td>{{ $product->categories->category_name }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $stock->qty }}</td>
                                            <td>{{ number_format($unit_cp,2) }}</td>
                                         
                                            <td>{{ number_format($total_cp,2) }}</td>
                                        
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
        var app = angular.module('valuationApp', []);
        app.controller('valuationCtrl', function ($scope, $http) {
            $scope.print = function () {
                window.print();
            }
        });

        $('#btn').click(function () {
            $('.table').tableToCSV({
                filename: "valuation_report"
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