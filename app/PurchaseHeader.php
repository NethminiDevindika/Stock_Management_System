<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseHeader extends Model
{
    protected $table = 'purchase_headers';
    protected $fillable = ['supplier', 'remark','total_amount','payed_amount', 'status'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    const PURCHASE_PENDING = 1;
    const PURCHASE_COMPLETED = 2;

    public function details()
    {
        return $this->hasMany(PurchaseDetail::class, 'purchase_header', 'id');
    }

    public function suppliers()
    {
        return $this->hasOne(SupplierModel::class, 'id', 'supplier');
    }
}
