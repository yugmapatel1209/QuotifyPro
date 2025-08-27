<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrderDetails extends Model
{
    public $table = 'purchase_order_details';
    use SoftDeletes;
    protected $softDelete = true;

    public $fillable = [
        'po_id',      
        'series',
        'material',
        'hsn_sac',
        'description',
        'make',
        'delivery',
        'quantity',
        'unit',
        'rate',
        'amount',
        'gst_percentage',
        'buyers_name',
        'gst_amount',
        'total_amount',
        'is_active'       
    ];

}
