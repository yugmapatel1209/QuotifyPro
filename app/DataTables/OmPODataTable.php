<?php
namespace App\DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetails;
use App\Models\QuotationsMaster;

class OmPODataTable
{
    public function all()
    {
        $data =[];
        $data = PurchaseOrder::with('details')->orderBy('id', 'DESC')->get();
        // echo '<pre>';print_r($data->toArray()); die;
        return $data;
    }

    public function getPurchaseOrder($id)
    {
        $data =[];
        $data = PurchaseOrder::where('id',$id)->with('details')->orderBy('id', 'DESC')->get();      
        // echo '<pre>'; print_r($data[0]->toarray()); die;
        return $data[0];
    }

    public function getQuotation($id)
    {
        $data =[];
        $data = QuotationsMaster::where('id',$id)->with('details','termsconditions')->orderBy('id', 'DESC')->get();
        return $data[0];
    }
    
}
