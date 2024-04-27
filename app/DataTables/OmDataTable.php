<?php
namespace App\DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\QuotationsMaster;
use App\QuotationsDetail;

class OmDataTable
{
    public function all()
    {
        $data =[];
        $data = QuotationsMaster::with('details')->where('company_id',1)->get();

        // echo '<pre>';print_r($data->toArray()); die;

        return $data;

        // $data = QuotationsMaster::with('details')->get();
        // // dd($data);
        // $data->map(function($in_date){
        //     if ($in_date->session != null) {
        //         $in_date['session']->map(function($item){
        //             $item['potential_revenue'] = $item->total_spots * $item->price_per_person;
        //             return $item;
        //         });
        //         $in_date['active_sessions'] = count($in_date->session);
        //         $in_date['potential_revenue'] = $in_date->session->sum('potential_revenue');
        //     }else{
        //         $in_date['active_sessions'] = 0;
        //     }
        // });
        // return $data;
    }

    public function getExercise($id)
    {
        $data =[];
        $data = QuotationsMaster::where('id',$id)->with('details','termsconditions')->get();
        return $data[0];
    }
}
