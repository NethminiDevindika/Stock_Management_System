<?php

namespace App\Http\Controllers;

use App\GrnDetail;
use App\GrnHeader;
use App\ProductModel;
use App\StockModel;
use App\SupplierModel;
use Illuminate\Http\Request;

class GrnController extends Controller
{
    public function newGrn()
    {
        return view('grn.new_grn');
    }

    //function for get product list to grn create
    public function getProductList(Request $request)
    {
        $search = $request->input('keyword');
        $supplier = $request->input('supplier');
        $products1 = ProductModel::where('supplier', $supplier)->limit(5)->get();
        if (isset($search)) {
            $products = $products1->where('description', 'LIKE', "%{$search}%")
                ->limit(5)
                ->get();
            return $products;
        }
        return $products1;
    }

    //function for save grn
    public function saveGrn(Request $request)
    {
        $grn_details = json_decode($request->input('item_in_cart'));

        try {
            if (!empty($grn_details)) {
                $grn_header = GrnHeader::create([
                    'supplier' => $request->supplier,
                    'invoice' => $request->invoice,
                    'total_cost' => floatval(preg_replace('/[^\d\.]/', '', $request->total_cost)),
                    'remarks' => $request->remarks,
                    'status' => GrnHeader::GRN_PENDING,
                ]);

                $grn_header_id = $grn_header->id;

                foreach ($grn_details as $grn_detail) {
                    GrnDetail::create([
                        'grn_no' => $grn_header_id,
                        'product' => $grn_detail->id,
                        'qty' => $grn_detail->qty,
                        'cost_price' => $grn_detail->cost_price,
                    ]);
                }
                return redirect()->back()->with('alert', 'GRN successfully created');
            } else {
                return redirect()->back()->with('alert', 'Error');
            }
        } catch (Exception $e) {
            return false;
        }
    }

    //function for get grn list
    public function grns()
    {
        $suppliers = SupplierModel::all();
        $grns = GrnHeader::orderBy('id', 'desc')->paginate(10);
        return view('grn.grn_list', compact('grns','suppliers'));
    }

    //function for view of a GRN
    public function viewGrn($grn)
    {
        $grns = GrnHeader::findOrFail($grn);
        return view('grn.grn_view', compact('grns'));
    }

    //function for approve grn and update stock
    public function approveGrn($grn)
    {
        $grns = GrnHeader::findOrFail($grn);

        foreach ($grns->details as $grn) {
            $stock = StockModel::where('product', $grn->product)->first();

            if (!$stock) {
                StockModel::create([
                    'qty' => $grn->qty,
                    'product' => $grn->product
                ]);
                $grns->update([
                    'status' => GrnHeader::GRN_APPROVED,
                ]);
            } else {
                StockModel::findOrFail($stock->id)
                    ->update([
                        'qty' => $stock->qty + $grn->qty
                    ]);
                $grns->update([
                    'status' => GrnHeader::GRN_APPROVED,
                ]);
            }
        }

        return redirect()->back()->with('alert', 'Grn successfully approved');
    }


    //function for reject grn
    public function rejectGrn($grn)
    {
        $grns = GrnHeader::findOrFail($grn);

        $grns->update([
            'status' => GrnHeader::GRN_REJECTED,
        ]);
        return redirect()->back()->with('alert', 'Grn successfully rejected');
    }


    //function for search grn by grn_no
    public function searchGrn(Request $request)
    {
        $search = $request->input('search');

        $grns = GrnHeader::with('details');

        if ($request->search){
            $grns->where('id',$search);
        }
        if ($request->created_at){
            $grns->where('created_at','LIKE',"%{$request->created_at}%");
        }
        if ($request->supplier){
            $grns->where('supplier',$request->supplier);
        }
        if ($request->options) {
            $grns->where('status', $request->options);
        }
        $grns = $grns->paginate(10);
        $suppliers = SupplierModel::all();

        return view('grn.grn_list',compact('grns','suppliers'));
    }
}
