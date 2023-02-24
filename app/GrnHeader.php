<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GrnHeader extends Model
{
    protected $table = 'grn_headers';
    protected $fillable = ['supplier', 'invoice', 'total_cost', 'remarks', 'status'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    const GRN_PENDING = 1;
    const GRN_APPROVED = 2;
    const GRN_REJECTED = 3;

    public function suppliers()
    {
        return $this->hasOne(SupplierModel::class, 'id', 'supplier');
    }

    public function details()
    {
        return $this->hasMany(GrnDetail::class, 'grn_no', 'id');
    }
}
