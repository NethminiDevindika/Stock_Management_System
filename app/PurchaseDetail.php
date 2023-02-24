<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $table = 'purchase_details';
    protected $fillable = ['purchase_header','item_code','cost_price','qty'];


    public function products(){
        return $this->hasMany(ProductModel::class,'id','item_code');
    }
}
