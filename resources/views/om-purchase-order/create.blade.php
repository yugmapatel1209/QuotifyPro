@extends('layouts.app')
@section('title')
    | Create Purchase Order
@endsection

@section('top-content')
    <div class="col-lg-10">
        <h2><a href="{{ url('/ompo') }}">Purchase Order </a> / Add</h2>
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
    

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script> -->
    @php
        
        // $quotation_number = $data['quotation_number'];
        $po_number = $data['po_number'];

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

                    <form role="form" id="form" class="form-horizontal" action="{!! route('ompo.store') !!}"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Purchase Order Number </label>
                            <div class="col-sm-10">
                                <input type="text" data-provide="typeahead" data-source='{{ $data['po_number'] }}'
                                    placeholder="Purchase Order number..." class="form-control" id="po_number"
                                    name="po_number" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Quotation Number </label>
                            <div class="col-sm-10">
                                
                                <select name="quotation_id" id="quotation_id" class="form-control">
                                    <option value="">Select Quotation</option>
                                    @foreach($data['quotations'] as $quotation)
                                        <option value="{{ $quotation->id }}">{{ $quotation->quotation_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label class="control-label col-sm-2">Quotation Number </label>
                            <div class="col-sm-10">
                                <input type="text" data-provide="typeahead" data-source='{{ $data['quotation_number'] }}'
                                    placeholder="Client..." class="form-control" id="quotation_id" name="quotation_id" />
                            </div>
                        </div>  --}}
                        {{-- <div class="form-group">
                            <label class="control-label col-sm-2">Description </label>
                            <div class="col-lg-10 col-sm-10">
                                <textarea class="form-control" id="description" name="description" placeholder="Purchase order description"></textarea>
                            </div>
                        </div> --}}            
                       <div class="form-group"> <label  class="control-label col-sm-2">Purchase Order Description  <span style="color: red">*</span></label> 
                            <div class="col-sm-10"> 
                                <textarea class="summernote_editor form-control" id="description" name="description" > Purchase order description</textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{!! url('ompo') !!}" class="btn btn-white">Cancel</a>
                                <button class="btn btn-primary" type="submit">Save changes</button>
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
    $(document).ready(function() {
        $('#quotation_id').select2({
            placeholder: "Select or search quotation",
            allowClear: true
        });
    });
    var len = 1;

    
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
    
    summernote_editor();

    // $('#description').summernote({
    //     height: 200, // set editor height
    //     placeholder: 'Purchase order description'
    // });
    </script>
@endsection
