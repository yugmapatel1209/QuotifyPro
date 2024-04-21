<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuotationsMaster extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    public $table = 'quotations_master';
    
    public $fillable = ['licence', 'address', 'client_company','client_name','client_address','rfq_number','date','quotation_number','valid_until','detail_amount','discount','final_amount','company_id','is_active'];

    public function details() {
        return $this->hasMany('App\QuotationsDetail', 'quotation_id', 'id');
    }
    public function termsconditions() {
        return $this->hasMany('App\TermsConditions', 'quotation_id', 'id');
    }
}
