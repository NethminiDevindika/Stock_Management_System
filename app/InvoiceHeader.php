<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceHeader extends Model
{
    protected $table = 'invoice_headers';
    protected $fillable = ['invoice', 'product', 'cost_price', 'qty',
        'remark', 'total_amount'];
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    const FULL_PAID = 2;
    const NOT_FULL_PAID = 1;
    const INVOICE_CODE = 'INV';

    public function details(){
        return $this->hasMany(InvoiceDetail::class,'invoice','id');
    }
}
