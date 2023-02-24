<?php

namespace App\Http\Controllers;

use App\BrandModel;
use App\CategoryModel;
use App\ProductModel;
use App\SupplierModel;
use App\UnitModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function newProduct()
    {
        return view('product.new_product');
    }

    public function saveProduct(Request $request)
    {
        $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'cost_price' => ['required', 'numeric'],
            'reorder_level' => ['required', 'numeric']
        ]);

        $product = new ProductModel();
        $product->category = $request->post('category');
        $product->brand = $request->post('brand');
        $product->supplier = $request->post('supplier');
        $product->description = $request->post('description');
        $product->cost_price = $request->post('cost_price');
        $product->unit = $request->post('unit');
        $product->reorder_level = $request->post('reorder_level');
        $product->save();


        $id = $product->id;

        $file = $request['image'];
        if ($file != null) {
            $p = $product->barcode;
            $file_extension = $file->getClientOriginalExtension();
            $file_name = $p . '.' . $file_extension;
            $item = ProductModel::findOrFail($id);
            $item->img_url = $file_name;
            $item->save();

            $destinationPath = 'uploads/products';
            $file->move($destinationPath, $file_name);
        }

        return redirect()->back()->with('alert', 'Product Successfully Created');

    }

    public function saveCategory(Request $request)
    {
        $category = new CategoryModel();
        $category->category_name = $request->post('category_name');
        $category->save();
    }

    public function getCategory()
    {
        $categories = CategoryModel::all('id', 'category_name');
        return $categories;
    }

    public function saveBrand(Request $request)
    {
        $brand = new BrandModel();
        $brand->brand_name = $request->post('brand_name');
        $brand->save();
    }

    public function getBrand()
    {
        $brands = BrandModel::all('id', 'brand_name');
        return $brands;
    }

    public function saveUnit(Request $request)
    {
        $unit = new UnitModel();
        $unit->unit_name = $request->post('unit_name');
        $unit->save();
    }

    public function getUnit()
    {
        $units = UnitModel::all('id', 'unit_name');
        return $units;
    }

    public function getSupplier()
    {
        $suppliers = SupplierModel::all('id', 'company_name');
        return $suppliers;
    }

    public function products()
    {
        $products = ProductModel::paginate(10);
        $categories = CategoryModel::all();
        $brands = BrandModel::all();
        $suppliers = SupplierModel::all();
        return view('product.product_list', compact('products','categories','brands','suppliers'));
    }

    public function deleteProduct($product)
    {
        $delete = ProductModel::where('id', $product)->delete();

        if ($delete == 1) {
            $success = true;
            $message = "Product deleted successfully";
        } else {
            $success = true;
            $message = "Product not found";
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);

        return redirect('/product/product-list');
    }

    public function updateProduct(Request $request)
    {

        $request->validate([
            'description' => ['required', 'string', 'max:255'],
            'cost_price' => ['required', 'numeric'],
            'reorder_level' => ['required', 'numeric']
        ]);

        $productId = $request->post('productId');
        $product = ProductModel::findOrFail($productId);
        $product->category = $request->post('category');
        $product->brand = $request->post('brand');
        $product->supplier = $request->post('supplier');
        $product->description = $request->post('description');
        $product->cost_price = $request->post('cost_price');
        $product->unit = $request->post('unit');
        $product->reorder_level = $request->post('reorder_level');
        $product->save();

        $id = $product->id;

        $file = $request['image'];
        if ($file != null) {
         //   $p = $product->barcode;
            $file_extension = $file->getClientOriginalExtension();
            $file_name = $p . '.' . $file_extension;
            $item = ProductModel::findOrFail($id);
            $item->img_url = $file_name;
            $item->save();

            $destinationPath = 'uploads/products';
            $file->move($destinationPath, $file_name);
        }

        return redirect('/product/product-list')->with('alert', 'Product Successfully Updated');
    }

    //function for search product  by product id
    public function searchProduct(Request $request)
    {
        $search = $request->input('search');

        $products = ProductModel::with('stock');

        if ($request->search) {
            $products->where('id', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
        }
        if ($request->category) {
            $products->where('category', $request->category);
        }
        if ($request->brand) {
            $products->where('brand', $request->brand);
        }
        if ($request->supplier) {
            $products->where('supplier', $request->supplier);
        }
        $products = $products->paginate(10);
        $categories = CategoryModel::all();
        $brands = BrandModel::all();
        $suppliers = SupplierModel::all();

        return view('product.product_list', compact('products', 'categories', 'brands', 'suppliers'));
    }
}
