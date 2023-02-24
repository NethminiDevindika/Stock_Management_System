<?php

namespace App\Http\Controllers;

use App\InvoiceDetail;
use App\InvoiceHeader;
use App\ProductModel;
use App\StockModel;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        $products = ProductModel::all();
        return view('cashier.index', compact('products'));
    }


    //function for view stock report
    public function stockReport()
    {
        $stocks = StockModel::orderBy('id', 'desc')->paginate(100);
        return view('cashier.stock_report', compact('stocks'));
    }


    //function for search stocks
    public function searchStock(Request $request)
    {
        $search = $request->input('search');
        if ($search != null) {
            $stocks = StockModel::where('product', $search)->paginate(10);
            if (count($stocks) > 0) {
                return view('cashier.stock_report', compact('stocks'));
            } else {
                return view('cashier.stock_report')->withMessage('No result found');
            }
        }

    }

    //function for get product list
    public function getProductList(Request $request)
    {
        $search = $request->input('keyword');
        $products = ProductModel::with('stock')
            ->where('description', 'LIKE', "%{$search}%")
            ->limit(10)
            ->get();

        return $products;
    }

    //function for create invoice
    public function createInvoice(Request $request)
    {
        //$request->validate([
         //   'paid_amount' => ['numeric'],
        //]);

        $invoice_details = json_decode($request->input('item_in_cart'));

        try {
            if (!empty($invoice_details)) {
                $invoice_header = InvoiceHeader::create([
                    'remark' => $request->remark,
                    'total_amount' => floatval(preg_replace('/[^\d\.]/', '', $request->total_amount)),
                   
                   'status' => InvoiceHeader::FULL_PAID,
                ]);

                $invoice_header_id = $invoice_header->id;

                foreach ($invoice_details as $invoice_detail) {

                    $stock = StockModel::where('product', $invoice_detail->id)->first();
                    $stock->update([
                        'qty' => $stock->qty - $invoice_detail->qty
                    ]);
                    InvoiceDetail::create([
                        'invoice' => $invoice_header_id,
                        'product' => $invoice_detail->id,
                        'cost_price' => $invoice_detail->cost_price,
                        'qty' => $invoice_detail->qty
                    ]);
                }

                InvoiceHeader::findOrFail($invoice_header_id)->update([
                    'invoice' => InvoiceHeader::INVOICE_CODE . '-' . $invoice_header_id
                ]);
                return redirect()->back()->with('alert', 'Invoice successfully created');
            } else {
                return redirect()->back()->with('alert', 'Error');
            }
        } catch (Exception $e) {
            return false;
        }
    }

    //function for get product list to credit invoice
    public function getCProductList(Request $request)
    {
        $search = $request->input('keyword1');
        $products = ProductModel::with('stock')
            ->where('description', 'LIKE', "%{$search}%")
            ->limit(10)
            ->get();

        return $products;
    }

    
    //function for invoice list
    public function invoices()
    {
        $invoices = InvoiceHeader::orderBy('id', 'desc')->paginate(50);
        return view('cashier.credit_invoice_list', compact('invoices'));
    }

    //function for search invoice
    public function searchInvoice(Request $request)
    {
        $search = $request->input('search');

        $invoices = InvoiceHeader::with('details');
        $options = $request->options;

        if ($request->search) {
            $invoices->where('invoice', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
                //->orWhere('invoice', 'LIKE', "%{$search}%");
           
        }

     


        if ($request->created_at) {
            $invoices->where('created_at', 'LIKE', "%{$request->created_at}%");
        }
        $invoices = $invoices->paginate(5);
        return view('cashier.credit_invoice_list', compact('invoices', 'options'));
    }

    //function for view invoice
    public function viewInvoice($invoice)
    {
        $invoices = InvoiceHeader::findOrFail($invoice);
        return view('cashier.invoice_view', compact('invoices'));
    }

    
}
