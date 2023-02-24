<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    protected $table = 'brands';
    protected $fillable = [];

    public function products(){
        return $this->hasOne(ProductModel::class,'brand','id');
    }

} 