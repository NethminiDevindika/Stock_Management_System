@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title text-info text-uppercase">Reports</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <div class="small-box bg-info">
                                    <div class="inner text-center">
                                        <h5>Stock Report</h5><br>
                                    </div>
                                    <a href="/reports/stock-report" target="_self" class="small-box-footer">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="small-box bg-info">
                                    <div class="inner text-center">
                                        <h5> Stock Valuation Report</h5><br>
                                    </div>
                                    <a href="/reports/valuation-report" class="small-box-footer" target="_self">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="small-box bg-info">
                                    <div class="inner text-center">
                                        <h5>Stock By Supplier</h5><br>
                                    </div>
                                    <a href="/reports/stock-supplier" class="small-box-footer" target="_self">More info <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop