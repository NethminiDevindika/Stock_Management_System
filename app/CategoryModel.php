<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $fillable = [];

    public function products(){
        return $this->hasMany(ProductModel::class,'category','id');
    }
}
