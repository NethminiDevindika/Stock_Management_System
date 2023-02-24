<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierModel extends Model
{
    protected $table = 'suppliers';
    protected $fillable = [];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
