<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
use Auth;
use App\DataTables\OmDataTable;
use App\Models\QuotationsDetail;
use App\Models\QuotationsMaster;
use App\Models\TermsConditions;
use Yajra\DataTables\Facades\DataTables;

class QuotationController extends Controller
{
    public function __construct(OmDataTable $dataTable)
    {
        // date_default_timezone_set('Asia/Kolkata');
        header("Access-Control-Allow-Origin: *");
        $this->dataTable = $dataTable;
        $this->middleware('preventBackHistory');
        $this->middleware('auth');
    }
    public function index(Request $request) {

        if ($request->ajax()) {
            return DataTables::of($this->dataTable->all($request))->make(true);
        }
        return view('om-electricals.index');
    }

    public function create()
    {
        $data = [];
        $data['licence'] = $this->getLicences();
        $data['client_company'] = $this->getClientCompany();
        $data['client_name'] = $this->getClientName();
        $data['material'] = $this->getMaterial();
        $data['make'] = $this->getMake();
        $data['unit'] = $this->getUnit();
        $data['hsn_sac'] = $this->getHSNSAC();
        return view('om-electricals.create', compact('data'));
    }
    public function store(Request $request)
    {
        
        $input = [];
        $input = $request->all();
        $input['valid_until'] = $request->valid_until . ' ' . $request->valid_until1;
        $input['is_active'] = isset($request['is_active']) ? 1 : 0;
        $input['is_laterpad_image'] = isset($request['is_laterpad_image']) ? 1: 0;
        $input['final_amount'] = 1000000;
        if($request->quotation_number) {
            $input['quotation_number'] = date("Y",strtotime("-1 year")) .'-'.date("Y") .'/'.$input['quotation_number'];
        }
        // return  $input;
        // dd($request->all());  die;
        $QuotationsMaster = QuotationsMaster::create($input);
        $QuotationsMasterId = $QuotationsMaster->id;
        // $ExercisesMasterId = 1;
        // dd($input['is_laterpad_image']);
        $count = 1;
        if(count($request->quantity) > 0) {
            foreach($request->quantity as $key => $quantity) {
            //    dd($request->all());
                $mode_data= [];
                $mode_data['quotation_id'] = $QuotationsMasterId;
                $mode_data['series'] = $count++;
                $mode_data['material'] = $request->material[$key];
                $mode_data['hsn_sac'] =  $request->hsn_sac[$key];
                $mode_data['description'] =  $request->description[$key];
                $mode_data['make'] =  $request->make[$key];
                $mode_data['delivery'] =  $request->delivery[$key];
                $mode_data['quantity'] =  $request->quantity[$key];
                $mode_data['unit'] =  $request->unit[$key];
                $mode_data['rate'] =  $request->rate[$key];
                $mode_data['amount'] = $amount = $request->rate[$key] * $request->quantity[$key];
                $mode_data['gst_percentage'] = $per =  $request->gst_percentage[$key];
                $mode_data['profit_percentage'] =  $per = $request->profit_percentage[$key];
                $per = str_replace('%', '', $per);
                $mode_data['gst_amount'] = $gst_amount = ( $amount * $per ) / 100;
                $mode_data['total_amount'] = $gst_amount + $amount;
                // $total_duration = $total_duration + $Duration + 10;
                QuotationsDetail::create($mode_data);
            }
            $count_table_amount = QuotationsDetail::select('total_amount')->where('quotation_id',$QuotationsMasterId)->get();
            $count_amount = 0;
            foreach($count_table_amount as $key => $amount) {
                $count_amount = $count_amount + $amount['total_amount'];
            }
            QuotationsMaster::where('id',$QuotationsMasterId)->update(['detail_amount' => $count_amount , 'discount' => '0' ,'final_amount' => $count_amount]);
        }

        if(count($request->terms_description) > 0) {
            foreach($request->terms_description as $key => $terms) {
                TermsConditions::create(['quotation_id' => $QuotationsMasterId,'description' => $terms , 'extra' => $key]);
            }
        }

        //Flash::success('Exercise added successfully.');
        return redirect(route('om.index'));
    }

    public function show($id)
    {
        $tr_modes = QuotationsMaster::where('id',$id)->first();
        if (empty($tr_modes)) {
            // Flash::error('Exercise not found');
            return redirect(route('om.index'))->with('error', 'Quotation not found');
        }
        // Check this function in OmDataTable .
        $quotation = $this->dataTable->getExercise($id);
        // da($quotation);
        return view('om-electricals.show')->with('quotation', $quotation);
    }

    public function edit($id)
    {
        $quotations = QuotationsMaster::where('id',$id)->first();
        if (empty($quotations)) {
            return redirect(route('om.index'))->with('error', 'Quotation not found');
        }
        $Quotation = $this->dataTable->getExercise($id);
        $data = [];
        $data['licence'] = $this->getLicences();
        $data['client_company'] = $this->getClientCompany();
        $data['client_name'] = $this->getClientName();
        $data['material'] = $this->getMaterial();
        $data['make'] = $this->getMake();
        $data['unit'] = $this->getUnit();
        $data['hsn_sac'] = $this->getHSNSAC();

        return view('om-electricals.edit',  compact('Quotation','data'));
    }
    public function update($id, Request $request)
    {
        // echo '<Dasdsd>'; die;
        // echo '<pre>';  print_r($request->all()); die;
        $quotation_id = $id;
        $tr_modes = QuotationsMaster::where('id',$id)->first();
        if (empty($tr_modes)) {
            // Flash::error('Exercise not found');
            return redirect(route('om.index'));
        }

        $input = [];
        // $input = $request->all();
        $input['licence'] =  $request->licence;
        $input['address'] =  $request->address;
        $input['client_company'] =  $request->client_company;
        $input['client_name'] =  $request->client_name;
        $input['client_address'] =  $request->client_address;
        $input['rfq_number'] =  $request->rfq_number;
        $input['date'] =  $request->date;
        $input['valid_until'] = $request->valid_until . ' ' . $request->valid_until1;
        $input['is_active'] = isset($request->is_active) ? 1 : 0;
        $input['is_laterpad_image'] = isset($request['is_laterpad_image']) ? 1: 0;
        if($request->quotation_number) {
            $input['quotation_number'] = date("Y",strtotime("-1 year")) .'-'.date("Y") .'/'.$request->quotation_number;
        }
        $ExercisesMaster = QuotationsMaster::where('id',$id)->update($input);
        $ids =$request->quotations_detail_ids;
        //Delete Older Quotaion
        // $delete_quotation = QuotationsDetail::where('quotation_id', $quotation_id)->delete(); //delete all older entries
        $existing_quotation = QuotationsDetail::where('quotation_id', $quotation_id)->select('id')->get();
        foreach ($existing_quotation as $table) {
            if (!in_array($table->id, $ids)) {
                echo '<Br> delete olders entry : ' . $table->id;
                $delete_table = QuotationsDetail::where('id', $table->id)->delete();
            }
        }

        $count = 1;
        if(count($request->quantity) > 0) {
            foreach($request->quantity as $key => $quantity) {
                $mode_data= [];
                $mode_data['quotation_id'] = $quotation_id;
                $mode_data['series'] = $count++;
                $mode_data['material'] = $request->material[$key];
                $mode_data['hsn_sac'] =  $request->hsn_sac[$key];
                $mode_data['description'] =  $request->description[$key];
                $mode_data['make'] =  $request->make[$key];
                $mode_data['quantity'] =  $quantity;
                $mode_data['unit'] =  $request->unit[$key];
                $mode_data['rate'] =  $request->rate[$key];
                $mode_data['amount'] = $amount = $request->rate[$key] * $quantity;
                $mode_data['gst_percentage'] = $per =  $request->gst_percentage[$key];
                $mode_data['profit_percentage'] = $per =  $request->profit_percentage[$key];
                $per = str_replace('%', '', $per);
                $mode_data['gst_amount'] = $gst_amount = ( $amount * (int) $per ) / 100;
                $mode_data['total_amount'] = $gst_amount + $amount;

                if($request->quotations_detail_ids[$key] > 0) {
                    QuotationsDetail::where(['id' => $request->quotations_detail_ids[$key] ])->update($mode_data);
                } else {
                    echo '<br>create new entry';
                    QuotationsDetail::create($mode_data);
                }
                $count_table_amount = QuotationsDetail::select('total_amount')->where('quotation_id',$id)->get();
                $count_amount = 0;
                foreach($count_table_amount as $key => $amount) {
                    $count_amount = $count_amount + $amount['total_amount'];
                }
                QuotationsMaster::where('id',$id)->update(['detail_amount' => $count_amount , 'discount' => '0' ,'final_amount' => $count_amount]);
            }
        }

        if($request->terms_description && count($request->terms_description) > 0) {
            $existing_terms = TermsConditions::where('quotation_id', $quotation_id)->select('id')->get();
            $existing_termsIds= [];
            foreach ($existing_terms as $term) {
                if (!in_array($term->id, $request->TermsId)) {
                    // $existing_termsIds[] = $term->id;
                    $delete_term = TermsConditions::where('id', $term->id)->delete();   //delete notes
                } else {
                }
            }

            // $existing_termsIds =  implode(',',$existing_termsIds);

            foreach($request->terms_description as $key => $description) {
                if($request->TermsId[$key] > 0) {
                    $update_terms = TermsConditions::where('id',$request->TermsId[$key])->update(['quotation_id' => $quotation_id,'description'=>$description , 'extra' => $key]);
                } else {
                    $create_terms = TermsConditions::create(['quotation_id' => $quotation_id,'description' => $description ,'extra' => $key]);
                }
            }
        }
        return redirect(route('om.index'))->with('success','Quotation Updated successfully.');
    }
    public function destroy($id)
    {
        // $ExercisesMaster = ExercisesMaster::find($id);
        // if (empty($ExercisesMaster)) {
        //     Flash::error('Exercise not found');
        //     return redirect(route('exercises.index'));
        // }
        // // ExercisesMaster::destroy($id);
        // ExercisesMaster::where('ExercisesMasterId', $id)->update(['IsDelete' => 1]);
        // return $this->responseSuccess('Deleted Successfully.');
    }

}
