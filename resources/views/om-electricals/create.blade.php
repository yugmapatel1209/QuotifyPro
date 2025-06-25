@extends('layouts.app')
@section('title')
    | Create Quotation
@endsection

@section('top-content')
    <div class="col-lg-10">
        <h2><a href="{{ url('/om') }}">Om Electricals</a> / Add</h2>
    </div>
@endsection
@section('style')
    {{-- <link href="{{env('APP_URL').'/'.'public/css/plugins/summernote/summernote.css' }}" rel="stylesheet"> --}}
    <link href="{{ env('APP_URL') . '/' . 'public/css/plugins/summernote1/summernote.css' }}" rel="stylesheet">
    {{-- <link href="{{env('APP_URL').'/'.'public/css/plugins/summernote/summernote-bs3.css'}}" rel="stylesheet"> --}}
    <style>
        .note-editor {
            background-color: #f3f3f3 !important;
        }

        .ibox-tools a {
            font-size: 17px;
        }

        .ibox {
            box-shadow: 0px 3px 10px 1px #e6e6e6;
        }
    </style>
@endsection
@section('content')
    <script src="{{ env('APP_URL') . '/' . 'public/js/Custom-addEditQutotation.js' }}" > </script>
    @php
        $licence = $data['licence'];
        $client_company = $data['client_company'];
        $client_name = $data['client_name'];

        // echo '<pre>'; print_r($data); die;

    @endphp
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                {{-- <div class="ibox-title">
                <h5>Add New Exercise</h5>
            </div> --}}
                <div class="ibox-content">
                    {{-- @include('flash::message') --}}

                    <form role="form" id="form" class="form-horizontal" action="{!! route('om.store') !!}"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Client Company </label>
                            <div class="col-sm-10">
                                <input type="text" data-provide="typeahead" data-source='{{ $data['client_company'] }}'
                                    placeholder="Company..." class="form-control" id="client_company"
                                    name="client_company" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Client Name </label>
                            <div class="col-sm-10">
                                <input type="text" data-provide="typeahead" data-source='{{ $data['client_name'] }}'
                                    placeholder="Client..." class="form-control" id="client_name" name="client_name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">RFQ Number </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="rfq_number" name="rfq_number"
                                    placeholder="Add RFQ number" />
                            </div>
                            <label class="control-label col-sm-1">Date </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="date" name="date"
                                    placeholder="Select date" required />
                            </div>
                        </div>

                        <div class="form-group ExercisePrices">
                            <label class="control-label col-sm-2"> Quotation Number</label>
                            <div class="col-sm-5">
                                <div class="input-group m-b"><span class="input-group-addon">@php echo date("Y").'-'.  date("Y",strtotime("+1 year")) .'/'; @endphp</span> <input
                                        type="text" placeholder="Quotation Number" name="quotation_number"
                                        id="quotation_number" value="" class="form-control" required></div>
                            </div>
                            <label class="control-label col-sm-1">Valid Until </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="valid_until" name="valid_until"
                                    placeholder="Valid Until" required />
                            </div>
                            <div class="col-sm-2 col-sm-2">
                                <select class="form-control" id="valid_until" name="valid_until1" required>
                                    <option value="Day(s)"> Day(s)</option>
                                    <option value="Week"> Week</option>
                                    <option value="Month(s)"> Month(s)</option>
                                    <option value="Year(s)"> Year(s)</option>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="form-group"><label class="col-sm-2 control-label">Is Laterpad Image</label>
                            <div class="col-sm-10">
                                <label class="checkbox-inline i-checks">
                                    <input type="checkbox" value="1" name="is_laterpad_image" id="is_laterpad_image" checked> Yes
                                    </label>
                            </div>
                        </div> -->
                        <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                <label class="checkbox-inline i-checks">
                                    <input type="checkbox" value="1" name="is_active" id="is_active" checked> Yes
                                    </label>
                                <input type="hidden" name="IsPublish" id="IsPublish" value='0'>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Need Extra Price Comparison</label>
                            <div class="col-sm-10">
                                <label class="checkbox-inline i-checks">
                                    <input type="checkbox"  name="need_extra_price_comparison" id="need_extra_price_comparison"> Yes
                                    <input type="hidden" id="need_extra_price_comparison_value" value='0'>
                                </label>
                            </div>
                        </div>
                        <!-- <div class="form-group price_comparison_section_1">
                            <label class="col-sm-2 control-label">Buyers Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="buyers_name" name="buyers_name"
                                placeholder="Add buyer name if you selected the price comparison"  />
                            </div>
                        </div> -->
                        <div class="Consecutive" id="Consecutive">
                            {{-- <div class="text-center m-t-md" ><h3>Quotation Table</h3></div> --}}
                            <div class="form-group">
                                <label class="control-label col-sm-2 "></label>
                                <div class="col-sm-2 ">
                                    <h3>Quotation Table</h3>
                                </div>
                            </div>
                            <div class="form-group exers removeclass1">
                                <label class="control-label col-sm-2 slide">Row #1</label>
                                <div class="col-sm-10">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-content">
                                            <a class="close-link binded pull-right" onclick="remove_exercise_fields(1)"><i
                                                    class="fa fa-times"></i></a>
                                            <div class="form-group">
                                                <label class="col-sm-2 row_detail">Row Detail #1</label>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-1">Description </label>
                                                <div class="col-lg-11 col-sm-10">
                                                    <textarea class="form-control" id="description" name="description[1]" placeholder="Add description"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-1">Material </label>
                                                <div class="col-sm-5">
                                                    <input type="text" data-provide="typeahead"
                                                        data-source='{{ $data['material'] }}' placeholder="Material..."
                                                        class="form-control" id="material" name="material[1]" />
                                                </div>
                                                <label class="control-label col-sm-1">HSN/SAC </label>
                                                <div class="col-sm-5">
                                                    <input type="text" data-provide="typeahead"
                                                        data-source='{{ $data['hsn_sac'] }}' placeholder="hsn/sac..."
                                                        class="form-control" id="hsn_sac" name="hsn_sac[1]" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-1">Make </label>
                                                <div class="col-sm-5">
                                                    <input type="text" data-provide="typeahead"
                                                        data-source='{{ $data['make'] }}' placeholder="Make..."
                                                        class="form-control" id="make" name="make[1]" />
                                                </div>
                                                <label class="control-label col-sm-1">Delivery </label>
                                                <div class="col-sm-5">
                                                    <input type="text" data-provide="typeahead"
                                                        placeholder="Delivery time frame..."
                                                        class="form-control" id="delivery" name="delivery[1]" />
                                                </div>
                                            </div>
                                            <div class="form-group">

                                                <label class="control-label col-sm-1">Unit </label>
                                                <div class="col-sm-5">
                                                    <input type="text" data-provide="typeahead"
                                                        data-source='{{ $data['unit'] }}' placeholder="Unit..."
                                                        class="form-control" id="unit" name="unit[1]" required />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-1">Quantity </label>
                                                <div class="col-sm-3">
                                                    <input type="number" placeholder="Quantity" class="form-control"
                                                        id="quantity_1" name="quantity[1]" required />
                                                </div>
                                                <label class="control-label col-sm-1">Rate </label>
                                                <div class="col-sm-3">
                                                    <input type="number" placeholder="Rate" class="form-control"
                                                        id="rate" name="rate[1]" required />
                                                </div>
                                                <label class="control-label col-sm-1">GST% </label>
                                                <div class="col-sm-3">
                                                    <select class="form-control" id="gst_percentage_1"
                                                        name="gst_percentage[1]">
                                                        <option value="5"> 5%</option>
                                                        <option value="12"> 12%</option>
                                                        <option value="18"> 18%</option>
                                                        <option value="28"> 28%</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div>
                                            </div>
                                            <br>
                                            <div class="price_comparison_section">
                                                <div class="form-group">
                                                    <label class="col-sm-2">Price Comparison section</label>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-2">Including GST </label>
                                                            <div class="col-sm-3">
                                                                <input type="number" placeholder="Including GST Amount in RS" class="form-control including_gst" id="including_gst_1" name="including_gst[1]" />
                                                            </div>
                                                            <label class="control-label col-sm-2">Excluding GST</label>
                                                            <div class="col-sm-3">
                                                                <input type="nuber" placeholder="Excluding GST Amount in RS" class="form-control excluding_gst" id="excluding_gst_1" name="excluding_gst[1]" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-2">Discount% </label>
                                                            <div class="col-sm-3">
                                                                <input type="number" min="0" max="100" placeholder="%" class="form-control discount_percentage" value="0" id="discount_percentage_1" name="discount_percentage[1]" />
                                                            </div>
                                                            <label class="control-label col-sm-2">Profit% </label>
                                                            <div class="col-sm-3">
                                                                <input type="number" min="0" max="100" placeholder=" %" class="form-control profit_percentage" id="profit_percentage_1" value="0"  name="profit_percentage[1]" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-sm-2">Transportation charges</label>
                                                            <div class="col-sm-3">
                                                                <input type="number" placeholder="Charges in Rs" class="form-control transportation_charges" value="0" id="transportation_charges_1" name="transportation_charges[1]" />
                                                            </div>
                                                        </div>
                                                         <div class="form-group">
                                                            <label class="control-label col-sm-2">Buyers Name</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" placeholder="" class="form-control buyers_name" value="" id="buyers_name_1" name="buyers_name[1]" />
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td><strong>Final Amount :</strong></td>
                                                                    <td>Rs. <span class="final_amount_1"></span>  </td>
                                                                    <input type="hidden" placeholder="Final Amount" class="form-control" id="final_amount_1" name="final_amount[1]" />
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Profit(Original) Rate :</strong></td>
                                                                    <td>Rs. <span class="original_rate_1"></span> </td>
                                                                    <input type="hidden" placeholder="Original Rate" class="form-control" id="original_rate_1" name="original_rate[1]" />
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Purchase Amount :</strong></td>
                                                                    <td>Rs. <span class="purchase_amount_1"></span></td>
                                                                    <input type="hidden" placeholder="Purchase Amount" class="form-control" id="purchase_amount_1" name="purchase_amount[1]" />
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Sales Amount :</strong></td>
                                                                    <td>Rs. <span class="sales_amount_1"></span> </td>
                                                                    <input type="hidden" placeholder="Sales Amount" class="form-control"  id="sales_amount_1" name="sales_amount[1]" />
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Transportation charges :</strong></td>
                                                                    <td>Rs. <span class="transportation_charges_view_1"></span> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Final Benefit :</strong></td>
                                                                    <td>Rs. <span class="benefit_1"></span> </td>
                                                                    <input type="hidden" placeholder="Benefit In Rs" class="form-control" id="benefit_1" name="benefit[1]" />
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="exercises_fields"></div>
                                <div class="form-group">
                                    <div class="col-sm-2 "></div>
                                    <div class="col-sm-2 ">
                                        <button type="button" class="btn btn-sm btn-success m-t-n-xs"
                                            onclick="exercises_fields()"><i class="fa fa-plus"></i> Add More
                                            Slide</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2 "></label>
                                <div class="col-sm-2 ">
                                    <h3>Terms Conditions</h3>
                                </div>
                            </div>
                            <div class="form-group notes removeclassnotes1">
                                <label class="control-label col-sm-3 text-right">Terms and Conditions </label>
                                <input type="hidden" id="TermsId" name="TermsId[1]" value="0">

                                <div class="form-group col-sm-7">
                                    <input type="text" class="form-control netDescription" id="description1"
                                        name="terms_description[1]" value=""
                                        placeholder="Terms Conditions Description" required>
                                </div>
                                <div class="form-group col-sm-1">
                                    <button class="btn btn-danger" type="button" onclick="remove_terms_fields(1);">
                                        <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button>
                                </div>
                            </div>

                            <div id="notes_fields">
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 "></div>
                                <div class="col-sm-2 ">
                                    <button type="button" class="btn btn-sm btn-success m-t-n-xs"
                                        onclick="notes_fields()"><i class="fa fa-plus"></i> Add More Conditions</button>
                                </div>
                            </div>
                            {{-- <div class="progress progress-bar-default" id="UploadProgress">
                        <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="43" role="progressbar" class="progress-bar">
                            <span class="sr-only percent">0% Complete (success)</span>
                        </div>
                    </div> --}}
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a href="{!! url('om') !!}" class="btn btn-white">Cancel</a>
                                    <button class="btn btn-primary" type="submit">Save changes</button>
                                    {{-- <button class="btn btn-primary" type="button" id="save_draft" >Save as Draft</button> --}}
                                    {{-- <button class="btn btn-primary" type="button" id="save_publish" >Save changes</button> --}}
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
    var len = 1;
    function exercises_fields() {
        len++;
        // alert('as' + len );
        var objTo = document.getElementById('exercises_fields');
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group exers removeclass" + len);
        var rdiv = 'removeclass' + len;
        divtest.innerHTML = '<label class="control-label col-sm-2 slide">Row #1</label>\
                            <div class="col-sm-10">\
                                <div class="ibox float-e-margins">\
                                    <div class="ibox-content">\
                                        <a class="close-link binded pull-right" onclick="remove_exercise_fields(' + len + ')"><i class="fa fa-times"></i></a>\
                                        <div class="form-group">\
                                            <label class="col-sm-2 row_detail">Row Detail #1</label>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="control-label col-sm-1">Description </label>\
                                            <div class="col-lg-11 col-sm-10">\
                                                <textarea class="form-control" id="description" name="description[' + len + ']" placeholder="Add description"></textarea>\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="control-label col-sm-1">Material </label>\
                                            <div class="col-sm-5">\
                                                <input type="text" data-provide="typeahead" data-source="{{ $data['material'] }}" placeholder="Material..." class="form-control" id="material" name="material[' + len + ']" />\
                                            </div>\
                                            <label class="control-label col-sm-1">HSN/SAC </label>\
                                            <div class="col-sm-5">\
                                                <input type="text" data-provide="typeahead" data-source="{{ $data['hsn_sac'] }}" placeholder="hsn/sac..." class="form-control" id="hsn_sac" name="hsn_sac[' + len + ']" />\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="control-label col-sm-1">Make </label>\
                                            <div class="col-sm-5">\
                                                <input type="text" data-provide="typeahead" data-source="{{ $data['make'] }}" placeholder="Make..." class="form-control" id="make" name="make[' + len + ']" />\
                                            </div>\
                                            <label class="control-label col-sm-1">Delivery </label>\
                                            <div class="col-sm-5">\
                                                <input type="text" data-provide="typeahead" placeholder="Delivery time frame..." class="form-control" id="delivery" name="delivery['+ len + ']" />\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="control-label col-sm-1">Unit </label>\
                                            <div class="col-sm-5">\
                                                <input type="text" data-provide="typeahead" data-source="{{ $data['unit'] }}" placeholder="Unit..." class="form-control" id="unit" name="unit[' + len + ']" required />\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="control-label col-sm-1">Quantity </label>\
                                            <div class="col-sm-3">\
                                                <input type="number" placeholder="Quantity" class="form-control" id="quantity_'+ len+'" name="quantity[' + len + ']" required />\
                                            </div>\
                                            <label class="control-label col-sm-1">Rate </label>\
                                            <div class="col-sm-3">\
                                                <input type="number" placeholder="Rate" class="form-control" id="rate" name="rate[' + len + ']" required />\
                                            </div>\
                                            <label class="control-label col-sm-1">GST% </label>\
                                            <div class="col-sm-3">\
                                                <select class="form-control" id="gst_percentage_'+ len + '" name="gst_percentage[' + len + ']">\
                                                    <option value="5"> 5%</option>\
                                                    <option value="12"> 12%</option>\
                                                    <option value="18"> 18%</option>\
                                                    <option value="28"> 28%</option>\
                                                </select>\
                                            </div>\
                                        </div>\
                                        <div>\
                                        </div>\
                                        <br>\
                                        <div class="price_comparison_section">\
                                            <div class="form-group">\
                                                <label class="col-sm-2">Price Comparison section</label>\
                                            </div>\
                                            <div class="form-group">\
                                                <div class="col-sm-8">\
                                                    <div class="form-group">\
                                                        <label class="control-label col-sm-2">Including GST </label>\
                                                        <div class="col-sm-3">\
                                                            <input type="number" placeholder="Including GST Amount in RS" class="form-control including_gst" id="including_gst_'+ len+'" name="including_gst['+len+']" />\
                                                        </div>\
                                                        <label class="control-label col-sm-2">Excluding GST</label>\
                                                        <div class="col-sm-3">\
                                                            <input type="nuber" placeholder="Excluding GST Amount in RS" class="form-control excluding_gst" id="excluding_gst_'+ len+'" name="excluding_gst['+len+']" />\
                                                        </div>\
                                                    </div>\
                                                    <div class="form-group">\
                                                        <label class="control-label col-sm-2">Discount% </label>\
                                                        <div class="col-sm-3">\
                                                            <input type="number" min="0" max="100" placeholder="%" class="form-control discount_percentage" value="0" id="discount_percentage_'+ len+'" name="discount_percentage['+len+']" />\
                                                        </div>\
                                                        <label class="control-label col-sm-2">Profit% </label>\
                                                        <div class="col-sm-3">\
                                                            <input type="number" min="0" max="100" placeholder=" %" class="form-control profit_percentage" id="profit_percentage_'+ len+'" value="0" name="profit_percentage['+len+']" />\
                                                        </div>\
                                                    </div>\
                                                    <div class="form-group">\
                                                        <label class="control-label col-sm-2">Transportation charges</label>\
                                                        <div class="col-sm-3">\
                                                            <input type="number" placeholder="Charges in Rs" class="form-control transportation_charges" value="0" id="transportation_charges_'+ len+'" name="transportation_charges['+len+']" />\
                                                        </div>\
                                                    </div>\
                                                     <div class="form-group">\
                                                        <label class="control-label col-sm-2">Buyers Name</label>\
                                                        <div class="col-sm-8">\
                                                            <input type="text" placeholder="Buyers Name" class="form-control buyers_name" value="" id="buyers_name'+ len+'" name="buyers_name['+len+']" />\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                                <div class="col-sm-4">\
                                                    <table class="table">\
                                                        <tbody>\
                                                            <tr>\
                                                                <td><strong>Final Amount :</strong></td>\
                                                                <td>Rs. <span class="final_amount_'+ len+'"></span> </td>\
                                                                <input type="hidden" placeholder="Final Amount" class="form-control" id="final_amount_'+ len+'" name="final_amount['+len+']" />\
                                                            </tr>\
                                                            <tr>\
                                                                <td><strong>Profit(Original) Rate :</strong></td>\
                                                                <td>Rs. <span class="original_rate_'+ len+'"></span> </td>\
                                                                <input type="hidden" placeholder="Original Rate" class="form-control" id="original_rate_'+ len+'" name="original_rate['+len+']" />\
                                                            </tr>\
                                                            <tr>\
                                                                <td><strong>Purchase Amount :</strong></td>\
                                                                <td>Rs. <span class="purchase_amount_'+ len+'"></span></td>\
                                                                <input type="hidden" placeholder="Purchase Amount" class="form-control" id="purchase_amount_'+ len+'" name="purchase_amount['+len+']" />\
                                                            </tr>\
                                                            <tr>\
                                                                <td><strong>Sales Amount :</strong></td>\
                                                                <td>Rs. <span class="sales_amount_'+ len+'"></span> </td>\
                                                                <input type="hidden" placeholder="Sales Amount" class="form-control" id="sales_amount_'+ len+'" name="sales_amount['+len+']" />\
                                                            </tr>\
                                                            <tr>\
                                                                <td><strong>Transportation charges :</strong></td>\
                                                                <td>Rs. <span class="transportation_charges_view_'+ len+'"></span> </td>\
                                                            </tr>\
                                                            <tr>\
                                                                <td><strong>Final Benefit :</strong></td>\
                                                                <td>Rs. <span class="benefit_'+ len+'"></span> </td>\
                                                                <input type="hidden" placeholder="Benefit In Rs" class="form-control" id="benefit_'+ len+'" name="benefit['+len+']" />\
                                                            </tr>\
                                                        </tbody>\
                                                    </table>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>';

        objTo.appendChild(divtest);
        if(!$('#need_extra_price_comparison').prop('checked')) {
            $(".price_comparison_section").hide();
            $(".price_comparison_section_1").hide();
        }

        $('.row_detail').each(function (index) {
            var no = index + 1;
            var html = 'Row Detail #' + no;
            $(this).html(html);
        });
        $('.slide').each(function (index) {
            var no = index + 1;
            var html = ' Row #' + no;
            $(this).html(html);
        });

        // $("#including_gst_" + len).on("keyup", function () {
        //     var GST = $("#gst_percentage_" + len).val();
        //     var quantity = parseFloat($('#quantity').val());
        //     var purchasePrice = parseFloat($('#purchasePrice').val());

        //     var gstvalue = '';
        //     var excludingGst;
        //     if (GST == 5) {
        //         gstvalue = 1.05;
        //     } else if (GST == 12) {
        //         gstvalue = 1.12;
        //     } else if (GST == 18) {
        //         gstvalue = 1.18;
        //     } else if (GST == 28) {
        //         gstvalue = 1.28
        //     }
        //     excludingGst = ($(this).val() / gstvalue);
        //     $("#excluding_gst_" + len).val(excludingGst);

        // });

        // $("#discount_percentage_" + len).on("keyup", function () {
        //     console.log('current len ::', len)
        //     var discountPercentage = $("#discount_percentage_" + len);
        //     var excludingGst = $("#excluding_gst_" + len).val();
        //     var finalAmount = (excludingGst - (excludingGst * discountPercentage));
        //     $("#final_amount_" + len).val(finalAmount);
        // });

    }
    function remove_exercise_fields(rid) {
        if ($('.exers').length > 1) {
            $('.removeclass' + rid).remove();
            $('.slide').each(function (index) {
                var no = index + 1;
                var html = ' Row #' + no;
                $(this).html(html);
            });
            $('.row_detail').each(function (index) {
                var no = index + 1;
                var html = 'Row Detail #' + no;
                $(this).html(html);
            });
        }
    }
    var terms_len = 1;
    function notes_fields() {
        terms_len++;
        // alert('as' + terms_len );
        var objTo = document.getElementById('notes_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group notes removeclassnotes" + terms_len);
        var rdiv = 'removeclassnotes' + terms_len;
        divtest.innerHTML = '<div class="col-sm-3"></div>\
                <input type="hidden" id="TermsId" name="TermsId[' + terms_len + ']" value="0">\
                <div class="form-group col-sm-7">\
                    <input type="text" class="form-control netDescription" id="description' + terms_len +
            '" name="terms_description[' + terms_len + ']" value="" placeholder="Terms and Conditions" required >\
                </div>\
                <div class="form-group col-sm-1">\
                    <button class="btn btn-danger" type="button" onclick="remove_terms_fields(' + terms_len + ');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button>\
                </div>';

        objTo.appendChild(divtest)
        $('.netDescription').each(function () {
            console.log($(this));
            $('#form').validate();
            $(this.id).rules("add", {
                required: true
            });
        });
    }
    function remove_terms_fields(rid) {
        if ($('.notes').length > 1) {
            $('.removeclassnotes' + rid).remove();
        }
    }
    var v = $("#form").validate({
        // submitHandler: function() {
        //     // alert('val');
        //     $('body').css('overflow','hidden');
        //     $('.new_loader').show();
        //     $('#form').submit();
        // },
        rules: {
            CCHI: {
                required: true,
                number: true
            },
            ATA: {
                required: true,
                digits: true
            },
            NBCMI: {
                required: true,
                digits: true
            },
            WrittenPrice: {
                // required: true,
                number: true,
                maxlength: 5,
                min: 1,
            },
            VerbalPrice: {
                // required: true,
                number: true,
                maxlength: 5,
                min: 1,
            },
            ScenarioDescription: {
                required: true,
                maxlength: 400,
                minlength: 20,
            },
            SScenarioDescription: {
                required: true,
                maxlength: 50,
                minlength: 10,
                // max: 23
            },
            ApproxTime: {
                // required: true,
                number: true,
                // digits: true,
                maxlength: 15,
                min: 1,
            },
            STitle: {
                required: true,
                maxlength: 30,
                minlength: 5,
            },
            'Title[1]': {
                required: true,
                maxlength: 30,
                minlength: 5,
            },
        },
        messages: {
            'Title[]': {
                'required': 'Title is required',
            },
            'File[]': {
                'required': 'File is required',
            }
        }
    });
    </script>
@endsection
