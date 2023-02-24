@extends('layouts.cashier')

@section('content')
    <div class="container-fluid" ng-controller="cashierCtrl" ng-app="cashierApp">
        <div class="mt-3">
            <form action="{{ route('invoice.save') }}" method="post">
                @csrf
                <div class="card bg-gray-light" ng-show="invoice_type ==1">
                    <div class="card-header">
                        <div class="card-title text-uppercase text-info"><b>invoice</b></div>
                        <div class="col-xs-4 float-right text-uppercase">
                        </div>
                    </div>

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

                    <div class="card-body">
                        <div class="form-group card small border border-info">
                            <div class="card-body">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="search" id="keyword" ng-model="keyword" ng-change="searchItem()"
                                               class="form-control" placeholder="Enter item name"
                                               aria-label="search">
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-blue">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group card border border-primary">
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <table class="table table-responsive-lg table-striped">
                                        <thead class="bg-gradient-lightblue text-uppercase">
                                        <tr>
                                            <th>Item code</th>
                                            <th>description</th>
                                            <th>price</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tr ng-repeat="product in products" class="bg-gray-light">
                                            <td>@{{ product['id'] }}</td>
                                            <td>
                                                
                                                @{{ product['description'] }}
                                            </td>
                                            <td>@{{ product['cost_price'] | currency:'LKR ':2 }}</td>
                                            <td>
                                                <button ng-click="selectItem(product)" class="btn btn-success">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group card border border-info">
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <table class="table table-bordered table-responsive-lg">
                                        <thead class="bg-gradient-info text-uppercase">
                                        <tr>
                                            <th>item code</th>
                                            <th>description</th>
                                            <th>price</th>
                                            <th>stock available</th>
                                            <th>qty</th>
                                            <th>total</th>
                                            <th>action</th>
                                        </tr>
                                        </thead>
                                        <tr ng-repeat="x in item_cart">
                                            <td>@{{ x.id }}
                                                <input type="hidden" name="id[]" value="@{{ x.id }}" ng-model="x.id">
                                            </td>
                                            <td>
                                                
                                                @{{ x.description }}
                                                <input type="hidden" name="description[]" value="@{{ x.description }}">
                                            </td>
                                            <td>@{{ x.cost_price |currency:'LKR ':2 }}
                                                <input type="hidden" name="cost_price[]"
                                                       value="@{{ x.cost_price | currency:'LKR ':2 }}">
                                            </td>
                                            <input type="hidden" name="cost_price[]" value="@{{ x.cost_price | currency:'LKR ':2 }}">
                                            <td>@{{ x.stock }}</td>
                                            <td><input type="number" name="qty[]" ng-model="x.qty" class="form-control"
                                                       min="1" max="@{{ x.stock }}"></td>
                                            <td>@{{ x.cost_price * x.qty |currency:'LKR ':2 }}</td>
                                            <td>
                                                <button type="button" ng-click="itemRemove(index)"
                                                        class="btn btn-danger">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                    <input type="hidden" name="item_in_cart" value="@{{ item_cart }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group card border border-primary border">
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-8">
                                        <label for="">Remarks</label>
                                        <textarea name="remark" class="form-control" id="remark" cols="60"
                                                  rows="5"></textarea>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="pull-right">
                                            <label for="">Total Amount</label>
                                            <input type="text" class="form-control" id="total_amount"
                                                   name="total_amount"
                                                   value="@{{ getTotalAmount() |currency :'LKR ':2 }}" readonly>
                                        </div>
                                        
                                        
                                        
                                    </div>
                                </div>
                                <div class="form-group float-right">
                                    <input type="submit" value="Create Invoice" class="btn btn-success btn-lg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <form action="{{ route('invoice.credit') }}" method="post">
                @csrf
                <div class="card bg-gray-light" ng-show="invoice_type ==2">
                    <div class="card-header">
                        <div class="card-title text-uppercase text-info"><b>invoice</b></div>
                        <div class="col-xs-4 float-right text-uppercase">
                            <label for="type_invoice" class="control-label">Invoice</label>
                            <input type="radio" class="radio-inline" id="type_invoice" ng-model="invoice_type" value="1"
                                   name="invoice_type" ng-init="invoice_type = 1">
                        </div>
                    </div>

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

                    
                        
                        

                        
         
                
                </div>
            </form>
        </div>
    </div>
    <script>

        $('div.alert').delay(2000).slideUp(300);
        var app = angular.module("cashierApp", []);

        app.controller("cashierCtrl", function ($scope, $http) {

            $scope.item_cart = [];
            $scope.items_cart = [];

            $scope.searchItem = function () {
                var keyword = $('#keyword').val();

                $http({
                    url: '/cashier/product-list',
                    method: 'post',
                    data: {
                        keyword: keyword
                    }
                }).then(function (response) {
                    $scope.products = response.data;
                });
                console.log($scope.products);
            };

            $scope.searchCItem = function () {
                var keyword1 = $('#keyword1').val();

                $http({
                    url: '/cashier/credit-product-list',
                    method: 'post',
                    data: {
                        keyword1: keyword1
                    }
                }).then(function (response) {
                    $scope.products = response.data;
                });
                console.log($scope.products);
            };

            $scope.selectItem = function (x) {
                $scope.item_cart.push({
                    id: x.id,
                    description: x.description,
                    cost_price: x.cost_price,
                    stock: x.stock.qty,
                    qty: 0,
                });
                $('#keyword').val('');
                $scope.products = [];
            };

            $scope.selectCItem = function (x) {
                $scope.items_cart.push({
                    id: x.id,
                    description: x.description,
                    
                    cost_price: x.cost_price,
                   
                    stock: x.stock.qty,
                    qty: 0,
                });
                $('#keyword1').val('');
                $scope.products = [];
            };

            $scope.itemRemove = function (index) {
                $scope.item_cart.splice(index, 1);
            };

            $scope.itemRemove1 = function (index) {
                $scope.items_cart.splice(index, 1);
            };

            $scope.getTotalAmount = function () {
                var total_amount = 0;
                for (var i = 0; i < $scope.item_cart.length; i++) {
                    var product = $scope.item_cart[i];
                    total_amount += (product.cost_price * product.qty);
                }
                return total_amount;
            };

            $scope.getCTotalAmount = function () {
                var total_amount = 0;
                for (var i = 0; i < $scope.items_cart.length; i++) {
                    var product = $scope.items_cart[i];
                    total_amount += (product.cost_price * product.qty);
                }
                return total_amount;
            };

            $scope.balance = function () {
                var total_amount = Number($('#total_amount').val().replace(/[^0-9\.]+/g, ""));
                var discount = $('#discount').val();
                var payed_amount = $('#payed_amount').val();
                var balance = payed_amount - (total_amount - discount);
                console.log(balance);
                return balance;
            };

            $scope.dueAmount = function () {
                var total_amount = Number($('#Total_amount').val().replace(/[^0-9\.]+/g, ""));
                var Discount = $('#discount').val();
                var Payed_amount = $('#payed_amount').val();
                var due_amount = total_amount - Discount - Payed_amount;
                console.log(due_amount);
                return due_amount;
            };
        });

        function showTime() {
            var date = new Date();
            var h = date.getHours(); // 0 - 23
            var m = date.getMinutes(); // 0 - 59
            var s = date.getSeconds(); // 0 - 59
            var session = "AM";

            if (h == 0) {
                h = 12;
            }

            if (h > 12) {
                h = h - 12;
                session = "PM";
            }

            h = (h < 10) ? "0" + h : h;
            m = (m < 10) ? "0" + m : m;
            s = (s < 10) ? "0" + s : s;

            var time = h + ":" + m + ":" + s + " " + session;
            document.getElementById("MyClockDisplay").innerText = time;
            document.getElementById("MyClockDisplay").textContent = time;

            setTimeout(showTime, 1000);

        }

        showTime();

        $('.itemName').select2({
            placeholder: 'Select an item',
            ajax: {
                url: '/cashier/productt-list',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.description,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $(function () {

            $("#select2-multi").select2({
                placeholder: "Select a customer",
                initSelection: function (element, callback) {
                }
            });
        });


    </script>
    <style>
        .clock {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
            color: #11feba;
            font-size: 20px;
            font-family: Orbitron;
            letter-spacing: 7px;
        }
    </style>
@stop
