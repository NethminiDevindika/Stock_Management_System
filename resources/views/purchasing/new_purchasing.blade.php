@extends('layouts.admin')

@section('content')
    <div class="container" ng-controller="purchasingCtrl" ng-app="purchasingApp">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <form action="{{ route('purchase.save') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Purchasing
                            </div>
                            <div class="text-info text-uppercase float-right">
                                <a href="/purchase/purchase-list" target="_self">
                                    <button type="button" class="btn btn-success btn-sm"><i class="fa fa-list">Purchasing
                                            List</i></button>
                                </a>
                            </div>
                        </div>

                        @if (session('alert'))
                            <div class="alert alert-success">
                                <button type="button"
                                        class="close"
                                        data-dismiss="alert"
                                        aria-hidden="true"
                                >&times;
                                </button>
                                {{ session('alert') }}
                            </div>
                        @endif

                        <div class="card-body">
                            <div class="form-group card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="">Supplier</label>
                                            <select name="supplier" id="supplier" class="form-control"
                                                    ng-change="selectSupplier()" ng-model="supplier"
                                                    required></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <div class="form-group card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                           
                                        </div> 
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <table class="table table-striped small table-responsive-lg">
                                                <tr>
                                                    <th>Item code</th>
                                                    <th>Description</th>
                                                    <th>Price</th>
                                                    <th></th>
                                                </tr>
                                                <tr ng-repeat="product in products">
                                                    <td>@{{ product['id'] }}</td>
                                                    <td>
                                                        <span>
                                                            <img ng-if="product.img_url != null"
                                                                 src="/uploads/@{{ product['img_url'] }}" alt=""
                                                                 width="20" class="img-rounded">
                                                            <img ng-if="product-img_url == null"
                                                                 src="{{asset('img/no_image.jpg')}}" alt="" width="20"
                                                                 class="img-rounded">
                                                        </span>
                                                        @{{ product['description'] }}
                                                    </td>
                                                    <td>@{{ product['cost_price'] | currency:'LKR ':2 }}</td>
                                                    <td>
                                                        <button ng-click="selectItem(product)"><i
                                                                    class="fa fa-check text-primary"></i></button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-striped small table-responsive-lg">
                                                <tr>
                                                    <th class="text-right">Item Code</th>
                                                    <th class="text-right">Description</th>
                                                    <th class="text-right">Price</th>
                                                    <th class="text-right">Qty</th>
                                                    <th class="text-right">Total</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                                <tr ng-repeat="x in item_cart">
                                                    <td class="text-right">@{{ x.id }}<input type="hidden" name="id[]"
                                                                                             value="@{{ x.id }}"
                                                                                             ng-model="x.id"></td>
                                                    <td class="text-right">
                                                        <span>
                                                            <img ng-if="x.img_url != null"
                                                                 src="/uploads/@{{ x['img_url'] }}" alt=""
                                                                 width="20" class="img-rounded">
                                                            <img ng-if="x.img_url == null"
                                                                 src="{{asset('img/no_image.jpg')}}" alt="" width="20"
                                                                 class="img-rounded">
                                                        </span>
                                                        @{{ x.description }}
                                                        <input type="hidden" name="description[]"
                                                               value="@{{ x.description }}">
                                                    </td>
                                                    <td class="text-right">@{{ x.cost_price |currency:'LKR ':2 }}<input
                                                                type="hidden" name="cost_price[]"
                                                                value="@{{ x.cost_price |currency:'LKR ':2 }}"></td>
                                                    <td class="text-right"><input type="number" name="qty[]"
                                                                                  ng-model="x.qty" class="text-right">
                                                    </td>
                                                    <td class="text-right">@{{ x.cost_price * x.qty |currency:'LKR ':2
                                                        }}
                                                    </td>
                                                    <td class="text-right">
                                                        <button type="button" ng-click="itemRemove($index)">
                                                            <i class="text-danger">X</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>
                                            <input type="hidden" name="item_in_cart" value="@{{ item_cart }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group card">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-lg-8">
                                            <label for="">Remarks</label>
                                            <textarea name="remark" id="remark" cols="60" rows="4"
                                                      class="form-control"></textarea>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="pull-right">
                                                <label for="">Total Amount</label>
                                                <input type="text" class="form-control" name="total_amount"
                                                       id="total_amount" readonly
                                                       value="@{{ getTotalCost() |currency:'LKR ':2 }}">
                                            </div>
                                            <div class="pull-right">
                                                <label for="">Paid Amount</label>
                                                <input type="text" name="payed_amount" id="payed_amount"
                                                       ng-model="payed_amount"
                                                       class="form-control" ng-change="payedAmount()">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row float-right">
                                        <input type="submit" class="btn btn-primary" value="Save">
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
        var app = angular.module("purchasingApp", []);

        app.controller("purchasingCtrl", function ($scope, $http, $filter) {


            $scope.dateOptions = {
                changeYear: true,
                changeMonth: true,
                dateFormat: 'yy-mm-dd'
            };

            $scope.item_cart = [];

            $scope.searchItem = function (supplier) {
                var keyword = $('#keyword').val();
                $http({
                    url: '/purchase/product-list',
                    method: 'post',
                    data: {
                        keyword: keyword,
                        supplier: supplier,
                    }
                }).then(function (response) {
                    $scope.products = response.data;
                });
            };

            $scope.selectSupplier = function () {
                var supplier = $('#supplier').val();
                $scope.searchItem(supplier);
            };

            $scope.selectItem = function (x) {

                $scope.item_cart.push({
                    id: x.id,
                    description: x.description,
                    cost_price: x.cost_price,
                    img_url: x.img_url,
                    qty: 0,
                });
                $('#keyword').val('');
                $scope.products = [];

            }

            $scope.itemRemove = function (index) {
                $scope.item_cart.splice(index, 1);
            }

            $scope.getTotalCost = function () {
                var total = 0;
                for (var i = 0; i < $scope.item_cart.length; i++) {
                    var product = $scope.item_cart[i];
                    total += (product.cost_price * product.qty);
                }
                return total;
            }
        });

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
@endsection
