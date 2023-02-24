<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $table = 'invoice_details';
    protected $fillable = ['invoice_no', 'product', 'cost_price' ,'qty'];

    public function products(){
        return $this->hasMany(ProductModel::class,'id','product');
    }
}
