<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrnDetail extends Model
{
    protected $table = 'grn_details';
    protected $fillable = ['grn_no','product','qty','cost_price'];

    public function products(){
        return $this->hasMany(ProductModel::class,'id','product');
    }
}
