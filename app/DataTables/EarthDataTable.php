<?php
namespace App\DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\QuotationsMaster;
use App\QuotationsDetail;

class EarthDataTable
{
    public function all()
    {
        $data =[];
        $data = QuotationsMaster::with('details')->where('company_id',2)->get();

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
        // da($data[0]);
        // foreach($data as $key =>$dt) {

        //     $data[$key]['Date'] = date("Y-m-d", strtotime($dt['CreatedDate']));
        //     $data[$key]['modeName'] = 'Not Found ';
        //     if($dt->mode) {
        //         $data[$key]['modeName'] = $dt->mode->Name;
        //     }
        //     $data[$key]['scenarioName'] = 'Not Found ';
        //     if($dt->scenario) {
        //         $data[$key]['scenarioName'] = $dt->scenario->Name;
        //     }
        //     $data[$key]['SubjectName'] = 'Not Found ';
        //     if($dt->scenario->subject) {
        //         $data[$key]['SubjectName'] = $dt->scenario->subject->Name;
        //     }
        //     $data[$key]['FieldName'] = 'Not Found ';
        //     if($dt->scenario->subject->fields) {
        //         $data[$key]['FieldName'] = $dt->scenario->subject->fields->Name;
        //     }
        //     $data[$key]['languagepairName'] = 'Not Found ';
        //     if($dt->languagepair) {
        //         $data[$key]['languagepairName'] = $dt->languagepair->Name;
        //     }
        //     $data[$key]['Status'] = '';
        //     if($dt->IsActive == 1) {
        //         $data[$key]['Status'] = 'Active';
        //     } else if($dt->IsActive == 0) {
        //         $data[$key]['Status'] = 'Inactive';
        //     }

        //     $data[$key]['Time'] = 0;
        //     if($dt->ApproxTime) {
        //         $data[$key]['Time'] =secToHR($dt->ApproxTime);
        //     }
        //     if($dt->ceu) {
        //         $data[$key]['CCHI'] = $dt->ceu->CCHI;
        //         $data[$key]['ATA'] = $dt->ceu->ATA;
        //         $data[$key]['NBCMI'] = $dt->ceu->NBCMI;
        //     } else {
        //         $data[$key]['CCHI'] = 'Not Found ';
        //         $data[$key]['ATA'] = 'Not Found ';
        //         $data[$key]['NBCMI'] = 'Not Found ';
        //     }
        //     // unset($data[$key]['mode']);
        //     // unset($data[$key]['languagepair']);
        //     // unset($data[$key]['scenario']);
        // }
        // echo '<pre>'; print_r($data[0]->toarray()); die;
        return $data[0];
    }
}
