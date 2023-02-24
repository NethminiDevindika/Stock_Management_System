<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::post('/user-login','Auth\LoginController@userLogin')->name('user.login');
Route::post('/user-logout','Auth\LoginController@userLogout')->name('user.logout');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/Aboutus', 'HomeController@aboutUs')->name('Aboutus');

Route::group(['prefix' => 'user'], function () {
    Route::get('/new-user', 'AdminController@newUser')->name('new.user');
    Route::post('/save-user', 'AdminController@saveUser')->name('user.save');
    Route::get('/user-list', 'AdminController@users')->name('user.list');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
});

Route::group(['prefix' => 'location'], function () {
    Route::get('/new-location', 'LocationController@newLocation')->name('new.location');
    Route::post('/save-location', 'LocationController@saveLocation')->name('location.save');
    Route::get('/location-list', 'LocationController@locations')->name('location.list');
    Route::post('/location-delete/{location}', 'LocationController@deleteLocation')->name('location.delete');
    Route::get('/location-view/{location}', 'LocationController@locationView')->name('location.view');
    Route::post('/location-update', 'LocationController@updateLocation')->name('location.update');
});

Route::group(['prefix' => 'supplier'], function () {
    Route::get('/new-supplier', 'SupplierController@newSupplier')->name('new.supplier');
    Route::post('/save-supplier', 'SupplierController@saveSupplier')->name('supplier.save');
    Route::get('/supplier-list', 'SupplierController@suppliers')->name('supplier.list');
    Route::post('/supplier-delete/{supplier}', 'SupplierController@deleteSupplier')->name('supplier.delete');
    Route::get('/supplier-view/{supplier}', 'SupplierController@supplierView')->name('supplier.view');
    Route::post('/supplier-update', 'SupplierController@updateSupplier')->name('supplier.update');
    Route::get('/list', 'SupplierController@getSupplierList')->name('supplier.getList');
    Route::post('/supplier-search', 'SupplierController@searchSupplier')->name('supplier.search');
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/new-product', 'ProductController@newProduct')->name('new.product');
    Route::post('/save-product', 'ProductController@saveProduct')->name('product.save');
    Route::get('/product-list', 'ProductController@products')->name('product.list');
    Route::post('/product-delete/{product}', 'ProductController@deleteProduct')->name('product.delete');
    Route::post('/product-update', 'ProductController@updateProduct')->name('product.update');
    Route::post('/category/save-category', 'ProductController@saveCategory')->name('category.save');
    Route::post('/brand/save-brand', 'ProductController@saveBrand')->name('brand.save');
    Route::post('/unit/save-unit', 'ProductController@saveUnit')->name('unit.save');
    Route::get('/category/category-list', 'ProductController@getCategory')->name('category.list');
    Route::get('/brand/brand-list', 'ProductController@getBrand')->name('brand.list');
    Route::get('/unit/unit-list', 'ProductController@getUnit')->name('unit.list');
    Route::get('/supplier/supplier-list', 'ProductController@getSupplier')->name('supplier.list');
    Route::post('/product-search', 'ProductCOntroller@searchProduct')->name('product.search');
});

Route::group(['prefix' => 'po'], function () {
    Route::get('/new-po', 'PoController@newPo')->name('new.po');
    Route::post('/product-list', 'PoController@getProductList')->name('po.productList');
    Route::post('/save-po', 'PoController@savePo')->name('po.save');
    Route::get('/po-list', 'PoController@pos')->name('po.list');
    Route::get('/po-view/{po}', 'PoController@viewPo')->name('po.view');
    Route::get('/po-approve/{id}', 'PoController@approvePo')->name('po.approve');
    Route::get('/po-reject/{id}', 'PoController@rejectpo')->name('po.reject');
    Route::post('/po-search', 'PoCOntroller@searchPo')->name('po.search');
});

Route::group(['prefix' => 'grn'], function () {
    Route::get('/new-grn', 'GrnController@newGrn')->name('new.grn');
    Route::post('/product-list', 'GrnController@getProductList')->name('grn.productList');
    Route::post('/save-grn', 'GrnController@saveGrn')->name('grn.save');
    Route::get('/grn-list', 'GrnController@grns')->name('grn.list');
    Route::get('/grn-view/{grn}', 'GrnController@viewGrn')->name('grn.view');
    Route::get('/grn-approve/{id}', 'GrnController@approveGrn')->name('grn.approve');
    Route::get('/grn-reject/{id}', 'GrnController@rejectGrn')->name('grn.reject');
    Route::post('/grn-search', 'GrnController@searchGrn')->name('grn.search');
});

Route::group(['prefix' => 'return'], function () {
   Route::get('/new-return', 'ReturnController@newReturn')->name('new.return');
   Route::post('/product-list','ReturnController@getProductList')->name('srn.productList');
   Route::post('/save-return','ReturnController@saveReturn')->name('srn.save');
   Route::get('/return-list','ReturnController@srns')->name('srn.list');
   Route::post('/srn-search','ReturnController@searchSrn')->name('srn.search');
   Route::get('/srn-approve/{id}','ReturnController@approveSrn')->name('srn.approve');
   Route::get('/srn-reject/{id}','returnController@rejectSrn')->name('srn.reject');
   Route::get('/return-view/{srn}','returnController@viewReturn')->name('srn.view');
});

Route::group(['prefix' => 'reports'], function (){
    Route::get('/reports','ReportController@reports')->name('reports');
    Route::get('/stock-report','ReportController@stockReport')->name('stock.report');
    Route::get('/stock-search','ReportController@searchStock')->name('stock.search');
    Route::get('/grn-report','ReportController@grnReport')->name('grn.report');
    Route::get('/grn-search','ReportController@searchGrnReport')->name('grnR.search');
    Route::get('/stock-supplier','ReportController@stockBySupplier')->name('supplier.report');
    Route::get('/stock-supplier-search','ReportController@searchStockBySupplier')->name('supplierStock.search');
    Route::get('/valuation-report','ReportController@valuationReport')->name('valuation.report');
    Route::get('/po-report','ReportController@poReport')->name('po.report');
    Route::get('/sales-report','ReportController@salesReport')->name('sales.report');
    Route::get('/sales-search','ReportController@searchSales')->name('sales.search');
    Route::get('/sale-product','ReportController@saleProduct')->name('sale.product');
    Route::get('/sale-product-search','ReportController@saleProductSearch')->name('saleP.search');
    Route::get('/sale-supplier','ReportController@saleSupplier')->name('sale.supplier');
    Route::get('/profit-report','ReportController@profitReport')->name('profit.report');
    Route::get('/profit-search','ReportController@profitSearch')->name('profit.search');
});

Route::group(['prefix' => 'cashier'], function(){
    Route::get('/index','CashierController@index')->name('cashier.index');
    Route::get('/stock-report','CashierController@stockReport')->name('stock.report');
    Route::get('/stock-search','CashierController@searchStock')->name('cStock.search');
    Route::post('/product-list','CashierController@getProductList')->name('stock.getProducts');
    Route::post('/credit-product-list','CashierController@getCProductList')->name('stock.getCProducts');
    Route::post('/create-invoice','CashierController@createInvoice')->name('invoice.save');
    Route::post('/credit-invoice','CashierController@creditInvoice')->name('invoice.credit');
    Route::get('/invoice-list','CashierController@invoices')->name('invoice.list');
    Route::get('/invoice-search','CashierController@searchInvoice')->name('invoice.search');
    Route::get('/invoice-view/{id}','CashierController@viewInvoice')->name('invoice.view');
    Route::post('/complete-credit-invoice','CashierController@completeCreditInvoice')->name('invoice.complete');
});


Route::group(['prefix' => 'purchase'], function () {
    Route::get('/new-purchase', 'PurchaseController@newPurchase')->name('new.purchase');
    Route::post('/product-list', 'PurchaseController@getProductList')->name('purchase.productList');
    Route::post('/save-purchase', 'PurchaseController@savePurchase')->name('purchase.save');
    Route::get('/purchase-list', 'PurchaseController@purchasings')->name('purchase.list');
    Route::get('/purchase-view/{purchasing}', 'PurchaseController@viewPurchase')->name('purchase.view');
    Route::post('/purchase-complete', 'PurchaseController@completePurchase')->name('purchase.complete');
    Route::post('/purchase-search', 'purchaseController@searchPurchase')->name('purchase.search');
});