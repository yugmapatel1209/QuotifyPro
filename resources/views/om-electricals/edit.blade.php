@extends('layouts.app')
@section('title')
| Edit Om Quotation
@endsection

@section('top-content')
<div class="col-lg-10">
    <h2><a href="{{ url('/exercises') }}">Om Electricals</a> / Edit</h2>
</div>
@endsection
@section('style') 
{{-- <link href="{{env('APP_URL').'/'.'public/css/plugins/summernote/summernote.css' }}" rel="stylesheet"> --}}
{{-- <link href="{{env('APP_URL').'/'.'public/css/plugins/summernote/summernote-bs3.css'}}" rel="stylesheet"> --}}
<style>
    .ibox-tools a { font-size:17px; }
    .ibox { box-shadow: 0px 3px 10px 1px #e6e6e6; }
</style>
@endsection
@section('content')
@php
    // d($data);
    $qut_number = explode('/', $Quotation->quotation_number  );
    $qut_number1 = $qut_number[1];
    
    $days = explode(' ', $Quotation->valid_until  );
    $valid = $days[0];
    $day = $days[1];
@endphp
<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-content">
                {{-- @include('flash::message') --}}
                {{-- {!! Form::model($exercise, ['route' => ['exercises.update', $exercise->ExercisesMasterId], 'method' => 'patch','id' => 'form' ,'class' => 'form-horizontal' , 'enctype' => 'multipart/form-data' ]) !!}  --}}
                {{-- {!! Form::model($Quotation, ['url' => ['update_om', $Quotation->id], 'method' => 'post','id' => 'form' ,'class' => 'form-horizontal' ]) !!}  --}}
                <form role="form" id="form" class="form-horizontal" action="{!! url('update_om', $Quotation->id) !!}" method="POST" enctype="multipart/form-data">  
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Licence</label>
                        <div class="col-sm-10">
                            <input type="text" data-provide="typeahead" 
                                {{-- data-source='["item 1","item 2","item 3"]' --}}
                                data-source='{{$data['licence']}}' placeholder="licence..." class="form-control" name="licence" id="licence" value="{!! $Quotation->licence !!}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Address </label>
                        <div class="col-lg-10 col-sm-10">
                            <textarea class="form-control" id="address" name="address" placeholder="Add Address" >{!! $Quotation->address !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Client Company </label>
                        <div class="col-sm-10">
                            <input type="text" data-provide="typeahead" data-source='{{$data['client_company']}}' placeholder="Company..." class="form-control" id="client_company" name="client_company" value="{!! $Quotation->client_company !!}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Client Name </label>
                        <div class="col-sm-10">
                            <input type="text" data-provide="typeahead" data-source='{{$data['client_name']}}' placeholder="Client..." class="form-control" id="client_name" name="client_name" value="{!! $Quotation->client_name !!}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Client Address </label>
                        <div class="col-lg-10 col-sm-10">
                            <textarea class="form-control" id="client_address" name="client_address" placeholder="Add Client Address" >{!! $Quotation->client_address !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">RFQ Number </label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="rfq_number" name="rfq_number" placeholder="Add RFQ number" value="{!! $Quotation->rfq_number !!}"/>
                        </div>
                        <label class="control-label col-sm-1">Date </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="date" name="date" placeholder="Select date" required value="{!! $Quotation->date !!}"/>
                        </div>
                    </div>
                    
                    <div class="form-group ExercisePrices"> 
                        <label  class="control-label col-sm-2"> Quotation Number</label>
                        <div class="col-sm-5">
                            <div class="input-group m-b"><span class="input-group-addon">@php echo date("Y",strtotime("-1 year")) .'-'.date("Y") .'/'; @endphp</span> <input type="text"  placeholder="Quotation Number" name="quotation_number" id="quotation_number" value="{!! $qut_number1 !!}"  class="form-control" required></div>    
                        </div>
                        <label class="control-label col-sm-1">Valid Until </label>

                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="valid_until" name="valid_until" placeholder="Valid Until" value="{!! $valid !!}" required/>
                        </div>
                        <div class="col-sm-2 col-sm-2">
                            <select class="form-control" id="valid_until" name="valid_until1" required>
                                <option value="Day(s)"<?php if($day == 'Day(s)') { ?> selected="selected"<?php } ?>>Day(s)</option>
                                <option value="Week"<?php if($day == 'Week') { ?> selected="selected"<?php } ?>>Week</option>
                                <option value="Month(s)"<?php if($day == 'Month(s)') { ?> selected="selected"<?php } ?>>Month(s)</option>
                                <option value="Year(s)"<?php if($day == 'Year(s)') { ?> selected="selected"<?php } ?>>Year(s)</option>
                            </select>
                        </div> 
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline i-checks"> <input type="checkbox" value="1" name="is_active" id="is_active" checked> Yes </label>     
                            <input type="hidden" name="is_publish" id="is_publish" value='0' >
                        </div>    
                    </div>
                    <div class="Consecutive ">
                        {{-- <div class="text-center m-t-md" ><h3>Quotation Table</h3></div> --}}
                        <div class="form-group">
                            <label class="control-label col-sm-2 "></label>
                            <div class="col-sm-2 "><h3>Quotation Table</h3></div>
                        </div>
                        @foreach ($Quotation->details as $i => $table)
                        <div class="form-group exers removeclass{{$i}}">
                            <?php $p = $i + 1?>
                            <label class="control-label col-sm-2 slide">Row #{{$p}}</label>
                            <div class="col-sm-10">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-content">
                                        <a class="close-link binded pull-right" onclick="remove_exercise_fields('{{$i}}')"><i class="fa fa-times"></i></a>
                                        <div class="form-group">
                                            <label class="col-sm-2 row_detail">Row Detail #{{$p}}</label>
                                            <input type="hidden" id="quotations_detail_ids" name="quotations_detail_ids[{{$i}}]" value="{!! $table->id !!}">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-1">Description </label>
                                            <div class="col-lg-11 col-sm-10">
                                                <textarea class="form-control" id="description" name="description[{{$i}}]" placeholder="Add description">{!! $table->description !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-1">Material </label>
                                            <div class="col-sm-5">
                                                <input type="text" data-provide="typeahead" data-source='{{$data['material']}}' placeholder="Material..." class="form-control" id="material" name="material[{{$i}}]" value="{!! $table->material !!}" />
                                            </div>
                                            <label class="control-label col-sm-1">HSN/SAC </label>
                                            <div class="col-sm-5">
                                                <input type="text" data-provide="typeahead" data-source='{{$data['hsn_sac']}}' placeholder="hsn/sac..." class="form-control" id="hsn_sac" name="hsn_sac[{{$i}}]" value="{!! $table->hsn_sac !!}" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-1">Make </label>
                                            <div class="col-sm-5">
                                                <input type="text" data-provide="typeahead" data-source='{{$data['make']}}' placeholder="Make..." class="form-control" id="make" name="make[{{$i}}]" value="{!! $table->make !!}" />
                                            </div>
                                            <label class="control-label col-sm-1">Unit </label>
                                            <div class="col-sm-5">
                                                <input type="text" data-provide="typeahead" data-source='{{$data['unit']}}' placeholder="Unit..." class="form-control" id="unit" name="unit[{{$i}}]" value="{!! $table->unit !!}" required />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-1">Quantity </label>
                                            <div class="col-sm-3">
                                                <input type="number" placeholder="Quantity" class="form-control" id="quantity" name="quantity[{{$i}}]" value="{!! $table->quantity !!}" required/>
                                            </div>
                                            <label class="control-label col-sm-1">Rate </label>
                                            <div class="col-sm-3">
                                                <input type="number" placeholder="Rate" class="form-control" id="rate" name="rate[{{$i}}]"  value="{!! $table->rate !!}" required/>
                                            </div>
                                            <label class="control-label col-sm-1">GST% </label>
                                            <div class="col-sm-3">
                                                <select class="form-control" id="gst_percentage" name="gst_percentage[{{$i}}]" >
                                                    
                                                    <option value="5%"<?php if($table->gst_percentage == '5%') { ?> selected="selected"<?php } ?>>5%</option>
                                                    <option value="12%"<?php if($table->gst_percentage == '12%') { ?> selected="selected"<?php } ?>>12%</option>
                                                    <option value="18%"<?php if($table->gst_percentage == '18%') { ?> selected="selected"<?php } ?>>18%</option>
                                                    <option value="28%"<?php if($table->gst_percentage == '28%') { ?> selected="selected"<?php } ?>>28%</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div id="exercises_fields"></div>
                        <div class="form-group">
                            <div class="col-sm-2 "></div>
                            <div class="col-sm-2 ">
                                <button type="button" class="btn btn-sm btn-success m-t-n-xs" onclick="exercises_fields()"><i class="fa fa-plus"></i> Add More Slide</button>
                            </div>
                        </div>
                    </div>
                    
                    {{-- <div class="progress progress-bar-default" id="UploadProgress">
                        <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="43" role="progressbar" class="progress-bar">
                            <span class="sr-only percent">0% Complete (success)</span>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label class="control-label col-sm-2 "></label>
                        <div class="col-sm-2 "><h3>Terms Conditions</h3></div>
                    </div>
                    @foreach ($Quotation->termsconditions as $i => $terms)
                    <div class="form-group notes removeclass{{$i}}"> 
                        @if ($i === 0) 
                        <label class="control-label col-sm-3 text-right">Terms and Conditions </label> 
                        @else 
                        <div class="col-sm-3 "></div>
                        @endif
                        <input type="hidden" id="TermsId" name="TermsId[{{$i}}]" value="{!! $terms->id !!}">
                        
                        <div class="form-group col-sm-7">    
                            <input type="text" class="form-control netDescription" id="description{{$i}}" name="terms_description[{{$i}}]" value="{{ $terms->description }}" placeholder="Terms Conditions" required>
                        </div>
                        <div class="form-group col-sm-1">
                            <button class="btn btn-danger" type="button" onclick="remove_terms_fields('{{$i}}');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button>
                        </div>
                    </div>
                    @endforeach
                    
                    <div id="notes_fields">
                    </div>
                    <div class="form-group"> 
                        <div class="col-sm-2 "></div>
                        <div class="col-sm-2 ">
                            <button type="button" class="btn btn-sm btn-success m-t-n-xs" onclick="notes_fields()"><i class="fa fa-plus"></i> Add More Conditions</button>
                        </div>
                    </div>
                    
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a href="{!! url('exercises') !!}" class="btn btn-white">Cancel</a>
                            <button class="btn btn-primary" type="submit" >Save changes</button>
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
<script src="{{env('APP_URL').'/'.'public/js/plugins/summernote/summernote.min.js'}}"></script>
<script>
    
var mem = $('#date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: "yyyy-mm-dd"
        });
    var len =$('.exers').length;
    function exercises_fields() {
        len++;
        var objTo = document.getElementById('exercises_fields');
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group exers removeclass"+len);
        var rdiv = 'removeclass'+len;
        divtest.innerHTML = '<label class="control-label col-sm-2 slide">Row #1</label>\
                            <div class="col-sm-10">\
                                <div class="ibox float-e-margins">\
                                    <div class="ibox-content">\
                                        <a class="close-link binded pull-right" onclick="remove_exercise_fields('+len+')"><i class="fa fa-times"></i></a>\
                                        <div class="form-group">\
                                            <label class="col-sm-2 row_detail">Row Detail #1</label>\
                                            <input type="hidden" id="quotations_detail_ids" name="quotations_detail_ids['+len+']" value="0">\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="control-label col-sm-1">Description </label>\
                                            <div class="col-lg-11 col-sm-10">\
                                                <textarea class="form-control" id="description" name="description['+len+']" placeholder="Add description"></textarea>\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="control-label col-sm-1">Material </label>\
                                            <div class="col-sm-5">\
                                                <input type="text" data-provide="typeahead" data-source="{{$data['material']}}" placeholder="Material..." class="form-control" id="material" name="material['+len+']" />\
                                            </div>\
                                            <label class="control-label col-sm-1">HSN/SAC </label>\
                                            <div class="col-sm-5">\
                                                <input type="text" data-provide="typeahead" data-source="{{$data['hsn_sac']}}" placeholder="hsn/sac..." class="form-control" id="hsn_sac" name="hsn_sac['+len+']" />\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="control-label col-sm-1">Make </label>\
                                            <div class="col-sm-5">\
                                                <input type="text" data-provide="typeahead" data-source="{{$data['make']}}" placeholder="Make..." class="form-control" id="make" name="make['+len+']" />\
                                            </div>\
                                            <label class="control-label col-sm-1">Unit </label>\
                                            <div class="col-sm-5">\
                                                <input type="text" data-provide="typeahead" data-source="{{$data['unit']}}" placeholder="Unit..." class="form-control" id="unit" name="unit['+len+']" required/>\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="control-label col-sm-1">Quantity </label>\
                                            <div class="col-sm-3">\
                                                <input type="number" placeholder="Quantity" class="form-control" id="quantity" name="quantity['+len+']" required/>\
                                            </div>\
                                            <label class="control-label col-sm-1">Rate </label>\
                                            <div class="col-sm-3">\
                                                <input type="number" placeholder="Rate" class="form-control" id="rate" name="rate['+len+']" required/>\
                                            </div>\
                                            <label class="control-label col-sm-1">GST% </label>\
                                            <div class="col-sm-3">\
                                                <select class="form-control" id="gst_percentage" name="gst_percentage['+len+']" >\
                                                    <option value="5%" > 5%</option>\
                                                    <option value="12%" > 12%</option>\
                                                    <option value="18%" > 18%</option>\
                                                    <option value="28%" > 28%</option>\
                                                </select>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>';
            
        objTo.appendChild(divtest);
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
    }
    function remove_exercise_fields(rid) {
        if($('.exers').length > 1) {
            $('.removeclass'+rid).remove();
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
    var terms_len =$('.notes').length;
    function notes_fields() {
        terms_len++;
        // alert('as' + terms_len );
        var objTo = document.getElementById('notes_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group notes removeclass"+terms_len);
        var rdiv = 'removeclass'+terms_len;
        divtest.innerHTML = '<div class="col-sm-3"></div>\
                <input type="hidden" id="TermsId" name="TermsId['+terms_len+']" value="0">\
                <div class="form-group col-sm-7">\
                    <input type="text" class="form-control netDescription" id="description'+terms_len+'" name="terms_description['+terms_len+']" value="" placeholder="Terms and Conditions" required >\
                </div>\
                <div class="form-group col-sm-1">\
                    <button class="btn btn-danger" type="button" onclick="remove_terms_fields('+ terms_len +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button>\
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
        // alert('asa' + rid);
        if($('.notes').length > 1) {
            $('.removeclass'+rid).remove();
        }
    }
    var v= $("#form").validate({
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
                number:true,
                maxlength:5,
            },
            VerbalPrice: {
                number:true,
                maxlength:5,
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
                digits: true
            },
            STitle: {
                required: true,
                maxlength: 30,
                minlength: 5,
            },
            'Title[0]': {
                required: true,
            },
            'File[0]': {
                required: true,
            },
            Title: {
                required: true,
                maxlength: 30,
                minlength: 5,
            },
            // File: {
            //     required: true,
            // }
        },
        messages:{
            'Title[]': {
                'required':'Title is required',
            },  
            'File[]': {
                'required':'File is required',
            }      
        }, 
    });
    $(document).ready(function () {
        $('audio').on("play", function (me) {
            $('audio').each(function (i,e) {
            if (e !== me.currentTarget) {
                this.pause(); 
            }
            });
        });
        summernote_edior();
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
    
</script>
@endsection