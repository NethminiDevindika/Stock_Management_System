@extends('layouts.admin')

@section('content')
    <div class="container" ng-controller="stockSupplierCtrl" ng-app="stockSupplierApp">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title text-info text-uppercase">STOCK BY SUPPLIER</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9">
                                <form action="{{ route('supplierStock.search') }}" method="get">
                                    @csrf
                                    <div class="form-group row" id="search">
                                        <div class="col-lg-6">
                                            <select name="supplier" id="supplier" class="form-control" required>
                                                <option value="" selected disabled>Select Supplier</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="submit" class="btn btn-primary btn-sm float-left">
                                                <i class="fa fa-search">Search</i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="form-group">
                            <table class="table table-bordered table-responsive-sm">
                                <thead class="bg-warning text-center">
                                <tr class="text-uppercase text-center">
                                    <th>Product Code</th>
                                    <th>Item Category</th>
                                    <th>Main Category</th>
                                    <th>Supplier</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                </tr>
                                </thead>
                                <?php
                                $qty = 0;
                                $total_qty = 0;
                                ?>
                                @foreach ($stocks as $stock)
                                    <?php
                                    $qty =$stock->qty;
                                    $total_qty += $qty;
                                    ?>
                                    @foreach ($stock->products as $product)
                                        <tr class="text-center bg-light">
                                            <td>{{ $stock->product }}</td>
                                            <td>{{ $product->brands->brand_name }}</td>
                                            <td>{{ $product->categories->category_name }}</td>
                                            <td>{{ $product->suppliers->company_name }}</td>
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
        var app = angular.module('stockSupplierApp', []);
        app.controller('stockSupplierCtrl', function ($scope, $http) {
            $scope.print = function () {
                window.print();
            }
        });

        $('#btn').click(function () {
            $('.table').tableToCSV({
                filename: "stock_supplier"
            });


        });

        function exportPdf() {
            window.open('/reports/downloadPDF/', '_self');
        }

        function getSuppliers() {
            $.getJSON("/supplier/list", function (data) {

                $.each(data, function (key, val) {
                    $('#supplier').append("<option value='" + val.id + "'>" + val.company_name + "</option>");
                })
            });
        }

        $(function () {
            getSuppliers();
        });
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