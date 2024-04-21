<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuotationsMaster extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    public $table = 'quotations_master';

    public $fillable = ['licence', 'address', 'client_company','client_name','client_address','rfq_number','date','quotation_number','valid_until','detail_amount','discount','final_amount','company_id','is_active','is_laterpad_image'];

    public function details() {
        return $this->hasMany(QuotationsDetail::class, 'quotation_id', 'id');
    }
    public function termsconditions() {
        return $this->hasMany(TermsConditions::class, 'quotation_id', 'id');
    }
}
