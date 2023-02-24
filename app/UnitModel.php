<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitModel extends Model
{
    protected $table = 'units';
    protected $fillable = [];

    public function products(){
        return $this->hasOne(ProductModel::class,'unit','id');
    }
}