<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermsConditions extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    
    public $table = 'terms_conditions';
    
    public $fillable = ['quotation_id', 'description', 'extra'];

}
