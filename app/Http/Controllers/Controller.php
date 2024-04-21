<?php

namespace App\Http\Controllers;

use App\QuotationsDetail;
use App\QuotationsMaster;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function getLicences() {
        return  QuotationsMaster::select('licence')->distinct()->where('licence','!=','')->get()->pluck('licence');
        // return QuotationsMaster::select('licence')->groupBy('licence')->get()->toArray();
    }
    function getClientCompany() {
        // return QuotationsMaster::pluck('client_company');
        return QuotationsMaster::select('client_company')->distinct()->where('client_company','!=','')->get()->pluck('client_company');
    }
    function getClientName() {
        // return QuotationsMaster::pluck('client_name');
        return QuotationsMaster::select('client_name')->distinct()->where('client_name','!=','')->get()->pluck('client_name');
    }
    function getMaterial() {
        return QuotationsDetail::select('material')->distinct()->where('material','!=','')->get()->pluck('material');
    }
    function getMake() {
        return QuotationsDetail::select('make')->distinct()->where('make','!=','')->get()->pluck('make');
    }
    function getUnit() {
        return QuotationsDetail::select('unit')->distinct()->where('unit','!=','')->get()->pluck('unit');
    }
    function getHSNSAC() {
        return QuotationsDetail::select('hsn_sac')->distinct()->where('hsn_sac','!=','')->get()->pluck('hsn_sac');
    }
}
