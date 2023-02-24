<?php

namespace App\Http\Controllers;

use App\ProductModel;
use App\PurchaseDetail;
use App\PurchaseHeader;
use App\SupplierModel;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function newPurchase()
    {
        return view('purchasing.new_purchasing');
    }

    //function for get product list to purchase create
    public function getProductList(Request $request)
    {
        $search = $request->input('keyword');
        $supplier = $request->input('supplier');
        $products1 = ProductModel::where('supplier', $supplier)->limit(5)->get();
        if (isset($search)) {
            $products = $products1->where('description', 'LIKE', "%{$search}%")
                ->orWhere('barcode', 'LIKE', "%{$search}%")
                ->limit(5)
                ->get();
            return $products;
        }
        return $products1;
    }


    //function for save purchase
    public function savePurchase(Request $request)
    {
        $purchase_details = json_decode($request->input('item_in_cart'));

        try {
            if (!empty($purchase_details)) {
                $total_amount = floatval(preg_replace('/[^\d\.]/', '', $request->total_amount));
                $purchase_header = PurchaseHeader::create([
                    'supplier' => $request->supplier,
                    'remark' => $request->remark,
                    'total_amount' => $total_amount,
                    'payed_amount' => $request->payed_amount,
                    'status' => $request->payed_amount == $total_amount ? PurchaseHeader::PURCHASE_COMPLETED : PurchaseHeader::PURCHASE_PENDING,
                ]);

                $purchase_header_id = $purchase_header->id;

                foreach ($purchase_details as $purchase_detail) {
                    PurchaseDetail::create([
                        'purchase_header' => $purchase_header_id,
                        'item_code' => $purchase_detail->id,
                        'cost_price' => $purchase_detail->cost_price,
                        'qty' => $purchase_detail->qty,
                    ]);
                }
                return redirect()->back()->with('alert', 'Purchase Note successfully created');
            } else {
                return redirect()->back()->with('alert', 'Error');
            }
        } catch (Exception $e) {
            return false;
        }
    }

    //function for get grn list
    public function purchasings()
    {
        $suppliers = SupplierModel::all('id','company_name');
        $purchasings = PurchaseHeader::orderBy('id', 'desc')->paginate(10);
        return view('purchasing.purchasing_list', compact('purchasings','suppliers'));
    }

    //function for view of a purchase
    public function viewPurchase($purchasing)
    {
        $purchasings = PurchaseHeader::findOrFail($purchasing);
        return view('purchasing.purchasing_view', compact('purchasings'));
    }

    //complete purchase
    public function completePurchase(Request $request){

        $purchaseId = $request->post('purchaseId');
        $purchasings = PurchaseHeader::findOrFail($purchaseId);
        $payed_amount = $purchasings->payed_amount + $request->payment;

        $purchasings->update([
            'payed_amount' => $payed_amount,
            'status' => $payed_amount == $purchasings->total_amount? PurchaseHeader::PURCHASE_COMPLETED:PurchaseHeader::PURCHASE_PENDING,
        ]);
        return redirect()->back()->with('alert','Purchase Note successfully updated');
    }

    //function for search purchase by purchase no
    public function searchPurchase(Request $request)
    {
        $search = $request->input('search');

        $purchasings = PurchaseHeader::with('details');
        if ($request->search){
            $purchasings->where('id',$search);
        }
        if ($request->created_at){
            $purchasings->where('created_at','LIKE',"%{$request->created_at}%");
        }
        if ($request->supplier){
            $purchasings->where('supplier',$request->supplier);
        }
        if ($request->options){
            $purchasings->where('status',$request->options);
        }
        $purchasings = $purchasings->paginate(10);
        $suppliers = SupplierModel::all();
        return view('purchasing.purchasing_list',compact('purchasings','suppliers'));
    }

}
