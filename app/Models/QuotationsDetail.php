<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuotationsDetail extends Model
{
    public $table = 'quotations_detail';
    use SoftDeletes;
    protected $softDelete = true;

    public $fillable = [
        'parent_id',
        'quotation_id',
        'series',
        'material',
        'hsn_sac',
        'description',
        'make',
        'quantity',
        'unit',
        'rate',
        'amount',
        'gst_percentage',
        'gst_amount',
        'total_amount',
        'extra',
        'is_active',
        'delivery',
        'including_gst',
        'excluding_gst',
        'discount_percentage',
        'final_amount',
        'profit_percentage',
        'original_rate',
        'purchase_amount',
        'sales_amount',
        'transportation_charges',
        'benefit',
        'buyer_name',
    ];

}
