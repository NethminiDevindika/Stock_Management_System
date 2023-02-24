<?php

namespace App\Http\Controllers;


use App\BrandModel;
use App\CategoryModel;
use App\GrnHeader;
use App\InvoiceHeader;
use App\PoHeader;
use App\ProductModel;
use App\ReturnHeader;
use App\StockModel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reports()
    {
        return view('reports.reports');
    }

    public function stockReport()
    {
        $brands = BrandModel::all();
        $categories = CategoryModel::all();
        $stocks = StockModel::orderBy('id', 'desc')->paginate(100);
        return view('reports.stock_report', compact('stocks','brands','categories'));
    }

    public function searchStock(Request $request)
    {
        $stocks = StockModel::with(['products' => function ($query) use ($request) {
            if ($request->search){
                $query->where('description','LIKE',"%{$request->search}%")->orWhere('id',$request->search);
            }
            if ($request->category){
                $query->where('category',$request->category);
            }
            if ($request->brand){
                $query->where('brand',$request->brand);
            }
        }])->paginate(100);
        $categories = CategoryModel::all();
        $brands = BrandModel::all();

        return view('reports.stock_report', compact('stocks','brands','categories'));

    }

    public function grnReport()
    {
        return view('reports.grn_report');
    }

    public function searchGrnReport(Request $request){
        $from = $request->input('from');
        $to = $request->input('to');
        $search = $request->input('search');
        $grns = GrnHeader::with('details');

        if ($request->created_at){
            $grns->where('created_at','LIKE',"%{$request->created_at}%");
        }
        if ($request->from && $request->to){
            $grns->whereBetween('created_at', [$from, $to]);
        }

        $grns = $grns->paginate(10);
        return view('reports.grn_report',compact('grns'));
    }

    public function poReport(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $pos = PoHeader::whereBetween('created_at', [$from, $to])->get();
        return view('reports.po_report', compact('pos'));
    }

    public function stockBySupplier()
    {
        $stocks = StockModel::orderBy('id', 'desc')->paginate(100);
        return view('reports.stock_supplier', compact('stocks'));
    }

    public function searchStockBySupplier(Request $request)
    {
        $search = $request->input('search');
        $supplier = $request->input('supplier');

        $stocks = StockModel::with(['products' => function ($query) use ($supplier) {
            $query->where('supplier', $supplier);
        }])->paginate(100);

        return view('reports.stock_supplier', compact('stocks'));
    }

    public function valuationReport()
    {
        $stocks = StockModel::orderBy('id', 'desc')->paginate(100);
        return view('reports.valuation_report', compact('stocks'));
    }

    public function salesReport(){
        return view('reports.sales_report');
    }

    public function searchSales(Request $request){
        $from = $request->input('from');
        $to = $request->input('to');
        $search = $request->input('search');
        $sales = InvoiceHeader::with('details');

        if ($request->created_at){
            $sales->where('created_at','LIKE',"%{$request->created_at}%");
        }
        if ($request->from && $request->to){
            $sales->whereBetween('created_at', [$from, $to]);
        }

        $sales = $sales->paginate(10);
        return view('reports.sales_report',compact('sales'));
    }

    public function saleProduct(){
        return view('reports.sale_product');
    }

    public function saleProductSearch(Request $request){
        $from = $request->input('from');
        $to = $request->input('to');
        $search = $request->input('search');
        $sales = InvoiceHeader::with('details');


        if ($request->created_at){
            $sales->where('created_at','LIKE',"%{$request->created_at}%");
        }
        if ($request->from && $request->to){
            $sales->whereBetween('created_at', [$from, $to]);
        }

        $sales = $sales->paginate(10);

        return view('reports.sale_product',compact('sales'));
    }

    public function saleSupplier(){
        return view('reports.sale_supplier');
    }

    public function searchSaleSupplier(Request $request){
        $from = $request->input('from');
        $to = $request->input('to');
        $search = $request->input('search');
        $sales = InvoiceHeader::with('details');


        if ($request->created_at){
            $sales->where('created_at','LIKE',"%{$request->created_at}%");
        }
        if ($request->from && $request->to){
            $sales->whereBetween('created_at', [$from, $to]);
        }

        $sales = $sales->paginate(10);

        return view('reports.sale_supplier',compact('sales'));
    }

    public function profitReport(){
        return view('reports.profit_report');
    }

    public function profitSearch(Request $request){
        $from = $request->input('from');
        $to = $request->input('to');
        $search = $request->input('search');
        $sales = InvoiceHeader::with('details');


        if ($request->created_at){
            $sales->where('created_at','LIKE',"%{$request->created_at}%");
        }
        if ($request->from && $request->to){
            $sales->whereBetween('created_at', [$from, $to]);
        }

        $sales = $sales->paginate(10);

        return view('reports.profit_report',compact('sales'));
    }

    public function downloadPdf()
    {
        $stocks = StockModel::all();
        return $stocks;
    }
}
