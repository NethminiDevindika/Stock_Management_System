<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $fillable = ['description','cost_price','reorder_level','img_url'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function suppliers(){
        return $this->hasOne(SupplierModel::class,'id','supplier');
    }

    public function categories(){
        return $this->hasOne(CategoryModel::class,'id','category');
    }

    public function brands(){
        return $this->hasOne(BrandModel::class,'id','brand');
    }

    public function units(){
        return $this->hasOne(UnitModel::class,'id','unit');
    }

    public function stock(){
        return $this->belongsTo(StockModel::class,'id','product');
    }

}
