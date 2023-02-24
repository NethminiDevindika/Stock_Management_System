<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockModel extends Model
{
    protected $table = 'stock';
    protected $fillable = ['qty','product'];

    public function products(){
        return $this->hasMany(ProductModel::class,'id', 'id');
    }


}
