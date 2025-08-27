<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    public $table = 'purchase_orders';

    public $fillable = ['po_number','quotation_id','description','status','is_active', 'created_by'];

    public function details() {
        return $this->hasMany(PurchaseOrderDetails::class, 'po_id', 'id');
    }
    // public function termsconditions() {
    //     return $this->hasMany(TermsConditions::class, 'quotation_id', 'id');
    // }
}
