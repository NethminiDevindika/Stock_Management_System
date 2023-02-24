<?php

namespace App\Http\Controllers;

use App\SupplierModel;
use Illuminate\Http\Request;

class SupplierController extends Controller
{

    //function for view of create new supplier
    public function newSupplier(){
        return view('supplier.new_supplier');
    }


    //function for save supplier
    public function saveSupplier(Request $request){

        $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'numeric', 'digits:10'],
            'mobile' => ['required', 'numeric', 'digits:10'],
            'email' => ['email', 'string', 'max:255'],
        ]);

        $supplier = new SupplierModel();
        $supplier->company_name = $request->post('company_name');
        $supplier->address = $request->post('address');
        $supplier->telephone = $request->post('telephone');
        $supplier->mobile = $request->post('mobile');
        $supplier->email = $request->post('email');
        $supplier->status = 1;
        $supplier->save();
        return redirect()->back()->with('alert', 'Supplier Successfully Created');
    }


    //function for get supplier list
    public function suppliers(){
        $suppliers = SupplierModel::paginate(10);
        return view('supplier.supplier_list', compact('suppliers'));
    }


    //function for delete supplier
    public function deleteSupplier($supplier){
        $delete = SupplierModel::where('id', $supplier)->delete();

        if ($delete == 1) {
            $success = true;
            $message = "Supplier deleted successfully";
        } else {
            $success = true;
            $message = "Supplier not found";
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);

        return redirect('/supplier/supplier-list');
    }


    //function for view a supplier
    public function supplierView($supplier){
        $supplier = SupplierModel::findOrFail($supplier);
        return view('supplier.supplier_view', compact('supplier'));
    }


    //function for update supplier
    public function updateSupplier(Request $request){

        $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'numeric', 'digits:10'],
            'mobile' => ['required', 'numeric', 'digits:10'],
            'email' => ['email', 'string', 'max:255'],
        ]);

        $supplierId = $request->post('supplierId');
        $supplier = SupplierModel::findorFail($supplierId);
        $supplier->company_name = $request->post('company_name');
        $supplier->address = $request->post('address');
        $supplier->telephone = $request->post('telephone');
        $supplier->mobile = $request->post('mobile');
        $supplier->email = $request->post('email');
        $supplier->save();
        return redirect()->back()->with('alert', 'Supplier Successfully Updated');
    }

    public function getSupplierList(){
        $supplier = SupplierModel::all('id','company_name')->where('status',0);
        return $supplier;
    }

    //function for search supplier  by supplier name
    public function searchSupplier(Request $request)
    {
        $search = $request->input('search');
        if ($search != null) {
            $suppliers = SupplierModel::where('company_name','LIKE',"%{$search}%")
                ->orWhere('id','LIKE',"{$search}")
                ->paginate(10);
        }

        return view('supplier.supplier_list',compact('suppliers'));
    }
}
