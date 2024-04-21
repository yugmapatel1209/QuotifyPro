<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuotationsDetail extends Model
{
    public $table = 'quotations_detail';
    use SoftDeletes;
    protected $softDelete = true;

    public $fillable = ['parent_id','quotation_id', 'series', 'material','hsn_sac','description','make','quantity','unit','rate','amount','gst_percentage','gst_amount','total_amount','extra','is_active'];

}
