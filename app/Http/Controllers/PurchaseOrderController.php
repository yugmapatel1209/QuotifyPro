<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flash;
use Auth;
use App\DataTables\OmPODataTable;
use App\Models\PurchaseOrderDetails;
use App\Models\PurchaseOrder;
use App\Models\TermsConditions;
use App\Models\QuotationsMaster;
use Yajra\DataTables\Facades\DataTables;

class PurchaseOrderController extends Controller
{
    public function __construct(OmPODataTable $dataTable)
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
        return view('om-purchase-order.index');
    }

    public function create()
    {
        $data = [];
        // $data['quotation_number'] = $this->getQuotationNumber();
        $data['quotations'] = $this->getQuotations();
        $data['po_number'] = $this->getPOId();
        
        //  echo '<pre>';  print_r($data['quotations']->toArray()); die;
        // dd($data['quotations']->toArray());  die;
        return view('om-purchase-order.create', compact('data'));
    }
    public function store(Request $request)
    {        
        $input = [];
        $input = $request->all();
        $input['po_number'] = $request->po_number ? $request->po_number : '';
        $input['quotation_id'] = $request->quotation_id ? $request->quotation_id : '';
        $input['description'] = $request->description ? $request->description : '';       
        // dd($request->all());  die;
        $PurchaseOrder = PurchaseOrder::create($input);
        
        $quotations = QuotationsMaster::where('id',$request->quotation_id)->first();
        $Quotation = $this->dataTable->getQuotation($request->quotation_id);
        $data = [];
        $data['id'] = $PurchaseOrder->id;
        $data['quotation_id'] = $request->quotation_id ? $request->quotation_id : '';
        $data['description'] = $request->description ? $request->description : '';
        $data['po_number'] = $input['po_number'];
        $data['licence'] = $this->getLicences();
        $data['client_company'] = $this->getClientCompany();
        $data['client_name'] = $this->getClientName();
        $data['material'] = $this->getMaterial();
        $data['make'] = $this->getMake();
        $data['unit'] = $this->getUnit();
        $data['hsn_sac'] = $this->getHSNSAC();
        //Flash::success('Exercise added successfully.');
        // return redirect(route('ompo.createPODetails', compact('data') );
        return view('om-purchase-order.createPODetails', compact('Quotation', 'data'));
    }

    public function store1(Request $request)
    {
       
        $input = [];
        $input = $request->all();
        $input['rfq_number'] = $request->rfq_number ? $request->rfq_number : '';
        $input['valid_until'] = $request->valid_until . ' ' . $request->valid_until1;
        $input['is_active'] = isset($request['is_active']) ? 1 : 0;
        $input['is_laterpad_image'] = isset($request['is_laterpad_image']) ? 1: 0;
        $input['need_extra_price_comparison'] = isset($request['need_extra_price_comparison']) ? 1: 0;
        $input['buyers_name'] = '';
        $input['final_amount'] = 1000000;
        if($request->quotation_number) {
            $input['quotation_number'] =date("Y") .'-'.date("Y",strtotime("+1 year")) .'/'.$input['quotation_number'];
        }
        // return  $input;
        // dd($request->all());  die;
        $QuotationsMaster = PurchaseOrder::create($input);
        $QuotationsMasterId = $QuotationsMaster->id;
        // $ExercisesMasterId = 1;
        // dd($input['is_laterpad_image']showTable);
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
                $mode_data['profit_percentage'] =  $request->profit_percentage[$key];
                $per = str_replace('%', '', $per);
                $mode_data['gst_amount'] = $gst_amount = ( $amount * $per ) / 100;
                $mode_data['total_amount'] = $gst_amount + $amount;
                // Price Comparison section
                $mode_data['including_gst'] = $request->including_gst[$key];
                $mode_data['excluding_gst'] = $request->excluding_gst[$key];
                $mode_data['discount_percentage'] = $request->discount_percentage[$key];
                $mode_data['profit_percentage'] = $request->profit_percentage[$key];
                $mode_data['transportation_charges'] = $request->transportation_charges[$key];
                $mode_data['final_amount'] = $request->final_amount[$key];
                $mode_data['original_rate'] = $request->original_rate[$key];
                $mode_data['purchase_amount'] = $request->purchase_amount[$key];
                $mode_data['sales_amount'] = $request->sales_amount[$key];
                $mode_data['benefit'] = $request->benefit[$key];
                $mode_data['buyers_name'] = $request->buyers_name[$key];

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
        $tr_modes = PurchaseOrder::where('id',$id)->first();
        if (empty($tr_modes)) {
            // Flash::error('Exercise not found');
            return redirect(route('om.index'))->with('error', 'Quotation not found');
        }
        // Check this function in OmDataTable .
        $quotation = $this->dataTable->getPurchaseOrder($id);

        $data = [
            'Sr.No' => [],
            'Material' => [],
            'HSN/SAC' => [],
            'Description' => [],
            'Make' => [],
            'Unit' => [],
            'Qty' => [],
            'Rate' => [],
            'Amount' => [],
            'GST%' => [],
            'Delivery' => [],
            'Including GST Rs' => [],
            'Excluding GST Rs' => [],
            'Discount%' => [],
            'Profit%' => [],
            'Transportation charges Rs' => [],
            'Final Amount' => [],
            'Profit(Original) Rate' => [],
            'Purchase Amount' => [],
            'Sales Amount' => [],
            'Final Benefit' => [],
            'Buyers Name' => []
        ];
        $total_amount = 0;
        $total_amount_gst = 0;

        foreach ($quotation->details as $obj) {
            $data['Sr.No'][] = $obj->series;
            $data['Material'][] = $obj->material;
            $data['HSN/SAC'][] = $obj->hsn_sac;
            $data['Description'][] = $obj->description;
            $data['Make'][] = $obj->make;
            $data['Unit'][] = $obj->unit;
            $data['Qty'][] = $obj->quantity;
            $data['Rate'][] = $obj->rate;
            $data['Amount'][] = $obj->amount;
            $data['GST%'][] = $obj->gst_percentage;
            // $data['Including GST Rs'][] = $obj->gst_amount;
            // $data['total_amount'][] = $obj->total_amount;
            $data['Delivery'][] = $obj->delivery;
            $data['Including GST Rs'][] = $obj->including_gst;
            $data['Excluding GST Rs'][] = $obj->excluding_gst;
            $data['Discount%'][] = $obj->discount_percentage;
            $data['Profit%'][] = $obj->profit_percentage;
            $data['Transportation charges Rs'][] = $obj->transportation_charges;
            $data['Final Amount'][] = $obj->final_amount;
            $data['Profit(Original) Rate'][] = $obj->original_rate;
            $data['Purchase Amount'][] = $obj->purchase_amount;
            $data['Sales Amount'][] = $obj->sales_amount;
            $data['Final Benefit'][] = $obj->benefit;
            $data['Buyers Name'][] = $obj->buyers_name;
            $total_amount = $total_amount + $obj->amount;
            $total_amount_gst = $total_amount_gst + (($obj->gst_percentage / 100) * $obj->amount); 
            // $total_amount_and_gst = $total_amount_and_gst + ;
        }
        $extra_info['total_amount'] = $total_amount;
        $extra_info['total_gst_amount'] = $total_amount_gst;
        $extra_info['total_amount_and_gst'] = $total_amount + $total_amount_gst;

        $optional_data = ['Including GST Rs', 'Excluding GST Rs','Discount%','Profit%','Transportation charges Rs','Final Amount','Profit(Original) Rate','Purchase Amount','Sales Amount','Final Benefit', 'Buyers Name'];
        // dd($extra_info);
        return view('om-purchase-order.show',  compact('quotation','data', 'optional_data', 'extra_info'));
        // return view('om-purchase-order.show')->with('quotation', $quotation);
    }

    public function edit($id)
    {
        $quotations = PurchaseOrder::where('id',$id)->first();
        if (empty($quotations)) {
            return redirect(route('om.index'))->with('error', 'Quotation not found');
        }
        $Quotation = $this->dataTable->getPurchaseOrder($id);
        $data = [];
        $data['licence'] = $this->getLicences();
        $data['client_company'] = $this->getClientCompany();
        $data['client_name'] = $this->getClientName();
        $data['material'] = $this->getMaterial();
        $data['make'] = $this->getMake();
        $data['unit'] = $this->getUnit();
        $data['hsn_sac'] = $this->getHSNSAC();
        // dd($Quotation->details);
        return view('om-purchase-order.edit',  compact('Quotation','data'));
    }
    public function update($id, Request $request)
    {
        // echo '<Dasdsd>'; die;
        // echo '<pre>';  print_r($request->all()); die;
        $quotation_id = $id;
        $tr_modes = PurchaseOrder::where('id',$id)->first();
        if (empty($tr_modes)) {
            // Flash::error('Exercise not found');
            return redirect(route('om.index'));
        }

        $input = [];
        // $input = $request->all();

        // $input['licence'] =  $request->licence;
        // $input['address'] =  $request->address;

        $input['client_company'] =  $request->client_company;
        $input['client_name'] =  $request->client_name;
        $input['client_address'] =  $request->client_address;
        $input['rfq_number'] =  $request->rfq_number;
        $input['date'] =  $request->date;
        $input['valid_until'] = $request->valid_until . ' ' . $request->valid_until1;
        $input['is_active'] = isset($request->is_active) ? 1 : 0;
        $input['is_laterpad_image'] = isset($request['is_laterpad_image']) ? 1: 0;
        $input['need_extra_price_comparison'] = isset($request['need_extra_price_comparison']) ? 1: 0;
        $input['buyers_name'] = '';


        //dought
        if($request->quotation_number) {
            //$input['quotation_number'] =date("Y") .'-'.date("-Y",strtotime("+1 year"))  .'/'.$request->quotation_number;
            $input['quotation_number'] = date("Y") . '-' . date("Y", strtotime("+1 year")) . '/' . $request->quotation_number;
        }
        $ExercisesMaster = PurchaseOrder::where('id',$id)->update($input);
        $ids =$request->quotations_detail_ids;
        //Delete Older Quotation
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
                $mode_data['delivery'] =  $request->delivery[$key];
                $mode_data['quantity'] =  $quantity;
                $mode_data['unit'] =  $request->unit[$key];
                $mode_data['rate'] =  $request->rate[$key];
                $mode_data['amount'] = $amount = $request->rate[$key] * $quantity;
                $mode_data['gst_percentage'] = $per =  $request->gst_percentage[$key];
                $mode_data['profit_percentage'] = $per =  $request->profit_percentage[$key];
                $per = str_replace('%', '', $per);
                $mode_data['gst_amount'] = $gst_amount = ( $amount * (int) $per ) / 100;
                $mode_data['total_amount'] = $gst_amount + $amount;
                // Price Comparison section
                $mode_data['including_gst'] = $request->including_gst[$key];
                $mode_data['excluding_gst'] = $request->excluding_gst[$key];
                $mode_data['discount_percentage'] = $request->discount_percentage[$key];
                $mode_data['profit_percentage'] = $request->profit_percentage[$key];
                $mode_data['transportation_charges'] = $request->transportation_charges[$key];
                $mode_data['final_amount'] = $request->final_amount[$key];
                $mode_data['original_rate'] = $request->original_rate[$key];
                $mode_data['purchase_amount'] = $request->purchase_amount[$key];
                $mode_data['sales_amount'] = $request->sales_amount[$key] ?? null;
                $mode_data['benefit'] = $request->benefit[$key] ?? null;
                $mode_data['buyers_name'] = $request->buyers_name[$key] ?? null;
                // if($request->quotations_detail_ids[$key] > 0) {
                if (isset($request->quotations_detail_ids[$key]) && $request->quotations_detail_ids[$key] > 0) {
                    PurchaseOrder::where(['id' => $request->quotations_detail_ids[$key] ])->update($mode_data);
                } else {
                    echo '<br>create new entry';
                    PurchaseOrder::create($mode_data);
                }
                $count_table_amount = PurchaseOrder::select('total_amount')->where('quotation_id',$id)->get();
                $count_amount = 0;
                foreach($count_table_amount as $key => $amount) {
                    $count_amount = $count_amount + $amount['total_amount'];
                }
                PurchaseOrder::where('id',$id)->update(['detail_amount' => $count_amount , 'discount' => '0' ,'final_amount' => $count_amount]);
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
