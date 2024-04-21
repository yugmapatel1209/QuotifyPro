@extends('layouts.app')
@section('title')
| Create Exercise
@endsection

@section('top-content')
<div class="col-lg-10">
    <h2><a href="{{ url('/exercises') }}">Exercises</a> / Add</h2>
</div>
@endsection
@section('style') 
{{-- <link href="{{env('APP_URL').'/'.'public/css/plugins/summernote/summernote.css' }}" rel="stylesheet"> --}}
<link href="{{env('APP_URL').'/'.'public/css/plugins/summernote1/summernote.css' }}" rel="stylesheet">
{{-- <link href="{{env('APP_URL').'/'.'public/css/plugins/summernote/summernote-bs3.css'}}" rel="stylesheet"> --}}
<style>
    .note-editor { background-color: #f3f3f3 !important; }
    .ibox-tools a { font-size:17px; }
    .ibox { box-shadow: 0px 3px 10px 1px #e6e6e6; }
    
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            {{-- <div class="ibox-title">
                <h5>Add New Exercise</h5>
            </div> --}}
            <div class="ibox-content">
                @include('flash::message')
                <form role="form" id="form" class="form-horizontal" action="{!! route('exercises.store') !!}" method="POST" enctype="multipart/form-data">  
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2">Language Pair <span style="color: red">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-control" id="LanguagePairId" name="LanguagePairId" required>
                                <option value=''>Select Language Pair ...</option>
                                @if(isset($languagepairs))
                                @foreach($languagepairs as $languagepair)
                                <option value="{{$languagepair->LanguagePairId}}" >{{$languagepair->Name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Field </label>
                        <div class="col-lg-10 col-sm-10">
                            <select class="form-control" id="FieldId" name="FieldId" >
                                <option value='0'>Select Field</option>
                                @if(isset($fields))
                                    @foreach($fields as $field)
                                        <option value="{{$field->FieldId}}" >{{$field->Name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Mode <span style="color: red">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-control" id="ModeId" name="ModeId" required >
                                <option value=''>Select Mode</option>
                                @if(isset($modes))
                                @foreach($modes as $mode)
                                <option value="{{$mode->ModeId}}" >{{$mode->Name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="control-label col-sm-2">Subject </label>
                        <div class="col-sm-10 col-sm-10">
                            <select class="form-control" id="SubjectId" name="SubjectId" >
                                <option value='0'>Select Subject</option>
                                @if(isset($subjects))
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->SubjectId}}" >{{$subject->Name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Scenario <span style="color: red">*</span></label>
                        <div class="col-sm-10">
                            <select class="form-control" id="ScenarioId" name="ScenarioId" required>
                                <option value=''>Select Scenario</option>
                                @if(isset($scenarios))
                                @foreach($scenarios as $scenario)
                                <option value="{{$scenario->ScenarioId}}" >{{$scenario->Name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    {{-- <div class="form-group"> <label  class="control-label col-sm-2">CEU Point <span style="color: red">*</span></label> 
                        <div class="col-sm-4"> 
                            <input type="text" placeholder="CCHI Point" name="CCHI" id="CCHI" class="form-control" required >
                        </div>
                        <div class="col-sm-3"> 
                            <input type="text" placeholder="ATA Point" name="ATA" id="ATA" class="form-control" required >
                        </div>
                        <div class="col-sm-3"> 
                            <input type="text" placeholder="NBCMI Point" name="NBCMI" id="NBCMI" class="form-control" required >
                        </div>
                    </div> --}}
                    
                    <div class="form-group ExercisePrices"> 
                        {{-- <label  class="control-label col-sm-2">Feedback Prices  (In USD$) </label>
                        <div class="col-sm-5">
                            <div class="input-group m-b"><span class="input-group-addon">$</span> <input type="text"  placeholder="Written Feedback Price" name="WrittenPrice" id="WrittenPrice" value=""  class="form-control" ></div>    
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group m-b"><span class="input-group-addon">$</span> <input type="number" placeholder="Verbal Feedback Price" name="VerbalPrice"  id="VerbalPrice" value="" class="form-control" ></div>
                        </div>  --}}
                    </div>
                    <div class="form-group ApproxTimeArea1"> 
                        <label  class="control-label col-sm-2">Approximate Time </label>
                        <div class="col-sm-10">
                            {{-- <input type="time"  class="form-control" value="" placeholder="time in second ex: 120" name="ApproxTime" id="ApproxTime">  --}}
                            <input type="integer"  class="form-control" value="" placeholder="Time in Minutes ex: 5" name="ApproxTime" id="ApproxTime"> 
                        </div>
                    </div>
                    <div class="form-group"><label class="col-sm-2 control-label">Active</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline i-checks"> <input type="checkbox" value="1" name="IsActive" id="IsActive" checked> Yes </label>     
                            <input type="hidden" name="IsPublish" id="IsPublish" value='0' >
                        </div>    
                    </div>
                    <div class="Consecutive ">
                        {{-- <div class="text-center m-t-md">
                            <h3>Consicutive Pre-Session</h3>
                        </div>
                        <div class="form-group"> <label  class="control-label col-sm-2">Title <span style="color: red">*</span></label> 
                            <div class="col-sm-10"> 
                                <input type="text" placeholder="Ex: Pre-Session" name="STitle" id="STitle" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group"> <label  class="control-label col-sm-2">Scenario Description  <span style="color: red">*</span></label> 
                            <div class="col-sm-10"> 
                                <textarea class="summernote_editor form-control" id="ScenarioDescription" name="ScenarioDescription" > Testing Texts</textarea>
                            </div>
                        </div>
                        <div class="text-center m-t-md">
                            <h3>Consicutive Exercises Slides</h3>
                        </div>
                        <div class="form-group exers"> 
                            <label class="control-label col-sm-2">Exercise Slide  <span style="color: red">*</span></label> 
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="Title" name="Title[]" value="" placeholder="Title Ex: Speaker to Audience " required>
                            </div> 
                            <div class="form-group col-sm-6">    
                                <input type="file" class="form-control file_input" id="File1" name="File[]" onchange="getFileDuration()" value="" placeholder="" accept=".mp3,audio/*" required>
                            </div>
                            <div class="form-group col-sm-1">
                                <button class="btn btn-success" type="button"  onclick="exercises_fields()"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
                            </div>
                        </div>
                        <div id="exercises_fields">
                        </div> --}}
                    </div>
                    
                    <div class="Simultaneous ">
                        {{-- <div class="text-center m-t-md">
                            <h3>Simultaneous Exercise Slide</h3>
                        </div>
                        <div class="form-group"> <label  class="control-label col-sm-2">Title <span style="color: red">*</span></label> 
                            <div class="col-sm-10"> 
                                <input type="text" placeholder="Ex: Speaker to Audience" name="STitle" id="STitle" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group"> <label  class="control-label col-sm-2">Scenario Description  <span style="color: red">*</span></label> 
                            <div class="col-sm-10"> 
                                <input type="text" placeholder="Ex: Presentation" name="SScenarioDescription" id="SScenarioDescription" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"> <label  class="control-label col-sm-2">Audio File  <span style="color: red">*</span> </label> 
                            <div class="col-sm-10"> 
                                <input type="file" class="form-control" id="File" name="File"  value="" placeholder="" accept=".mp3,audio/*">
                            </div>
                        </div> --}}
                    </div>

                    <div class="Sight_Translation">
                        {{-- <div class="text-center m-t-md">
                            <h3>Sight Translation Exercise Slide</h3>
                        </div>
                        <div class="form-group"> <label  class="control-label col-sm-2">Title <span style="color: red">*</span></label> 
                            <div class="col-sm-10"> 
                                <input type="text" placeholder="Ex: Scenario" name="Title" id="Title" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group"> <label  class="control-label col-sm-2">Scenario Description  <span style="color: red">*</span></label> 
                            <div class="col-sm-10"> 
                                <input type="text" placeholder="Ex: Presentation" name="ScenarioDescription" id="ScenarioDescription" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"> <label  class="control-label col-sm-2">Scenario Detail Description </label> 
                            <div class="col-sm-10"> 
                                <textarea class="summernote_editor input-block-level" id="ExtraDescription" name="ExtraDescription" > Scenario Detail Description </textarea>
                            </div>
                        </div> --}}
                    </div>
                    {{-- <div class="progress progress-bar-default" id="UploadProgress">
                        <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="43" role="progressbar" class="progress-bar">
                            <span class="sr-only percent">0% Complete (success)</span>
                        </div>
                    </div> --}}
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a href="{!! url('exercises') !!}" class="btn btn-white">Cancel</a>
                            {{-- <button class="btn btn-primary" type="submit" onclick="checkData()">Save changes</button> --}}
                            {{-- <button class="btn btn-primary" type="button" id="save_draft" >Save as Draft</button> --}}
                            <button class="btn btn-primary" type="button" id="save_publish" >Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- <script src="{{env('APP_URL').'/'.'public/js/plugins/summernote/summernote.min.js'}}"></script> --}}
{{-- version 0.8.12 --}}
<script src="{{env('APP_URL').'/'.'public/js/plugins/summernote1/summernote.min.js'}}"></script> 
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.9/summernote.min.js"></script> --}}
<script>
   
    var len = 1;
    
    function exercises_fields() {
        len++;
        // alert('as' + len );
        var objTo = document.getElementById('exercises_fields');
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group exers removeclass"+len);
        var rdiv = 'removeclass'+len;
        divtest.innerHTML = '<label class="control-label col-sm-2 slide">Slide #1</label>\
                            <div class="col-sm-10">\
                                <div class="ibox float-e-margins">\
                                    <div class="ibox-content">\
                                        <a class="close-link binded pull-right" onclick="remove_exercise_fields('+len+')"><i class="fa fa-times"></i></a>\
                                        <div class="form-group">\
                                            <label>Title</label>\
                                            <input type="text" class="form-control title_input" id="Title'+len+'" name="Title['+len+']" value="" placeholder="Title Ex: Speaker to Audience" required>\
                                        </div>\
                                        <div class="form-group">\
                                            <label>File</label>\
                                            <input type="file" class="form-control file_input" id="File'+len+'" name="File['+len+']" value="" placeholder="" accept=".mp3,audio/*" onchange="readAudioURL(this)" required>\
                                            <div id="audio_player'+len+'" class="player" style="display: none;">\
                                                <audio controls="" class="slideFile" id="audio'+len+'" src=""></audio>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>';
            
        objTo.appendChild(divtest);
        $('.title_input').each(function() {
            $(this).rules("add", 
            {
                required: true,
                maxlength: 30,
                minlength: 5,    
            });
        });
        $('.file_input').each(function() {
            $(this).rules("add", {
                required: true,
            });
        });
        
        $('.slide').each(function (index) {
            console.log($(this).html());
            console.log(index);
            var no = index + 2;
            var html = ' Slide #' + no;
            $(this).html(html);
        });
    }
    function remove_exercise_fields(rid) {
        if($('.exers').length > 1) {
            $('.removeclass'+rid).remove();
            $('.slide').each(function (index) {
                console.log($(this).html());
                console.log(index);
                var no = index + 2;
                var html = ' Slide #' + no;
                $(this).html(html);
            });
        }
    }
    /* function checkData() {
       
        length = $('#ExtraDescription').length;
        if(length > 0) {
            var val = $('.note-editable').html();
            console.log( 'val' , val);
            if(val == '') {
                $('#ExtraDescription1Err').removeClass('hide');  //Empty //Display validation
                return false;
            } else {
                $('#ExtraDescription1Err').addClass('hide'); //non Empty //Remove validation
            }
        }
        // v = $("#form").valid();
        if(!v) {
            return false;
        } 
    }    */
    var v= $("#form").validate({
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
                number:true,
                maxlength:5,
                min:1,
            },
            VerbalPrice: {
                // required: true,
                number:true,
                maxlength:5,
                min:1,
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
                number:true,
                // digits: true,
                maxlength:15,
                min:1,
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
        messages:{
            'Title[]': {
                'required':'Title is required',
            },  
            'File[]': {
                'required':'File is required',
            }      
        }
    });
    $('#save_draft').click(function () {
        console.log('draft');
        $('#IsPublish').val(0);
        // $('#STitle').rules('remove');         
        $('[name="STitle"], [name="ScenarioDescription"] , [name="Title"] , [name="VerbalPrice"] , [name="WrittenPrice"]').each(function () {
            $(this).rules('remove');
        });
        // $('[name="Title"]')
        $('.title_input').each(function() {
            $(this).rules("remove");
        });
        $('.file_input').each(function() {
            $(this).rules("remove");
        });
        //  $("#form").valid();  // validation test only
         $('#form').submit();
    });

    $('#save_publish').click(function () {
        console.log('publish');
        $('#IsPublish').val(1);
        $('[name="WrittenPrice"], [name="VerbalPrice"]').each(function () {
            $(this).rules('add', {
                // required: true,
                number:true,
                maxlength:5,
                min:1,
            });
        });
        $('[name="STitle"], [name="Title"]').each(function () {
            $(this).rules('add', {
                required: true,
                maxlength: 30,
                minlength: 5,
            });
        });
        $('[name="ScenarioDescription"] ').each(function () {
            $(this).rules('add', {
                required: true,
                maxlength: 400,
                minlength: 20,
            });
        });
        $('[name="File"] ').each(function () {
            $(this).rules('add', {
                required: true,
            });
        });
        $('.title_input').each(function() {
            $(this).rules("add", 
            {
                required: true,
                maxlength: 30,
                minlength: 5,    
            });
        });
        $('.file_input').each(function() {
            $(this).rules("add", {
                required: true,
            });
        });
        // $('[name="field3"], [name="field4"]').each(function () {
        //     $(this).rules('add', {
        //         required: true
        //     });
        // });
        $('#form').submit(); // validate and submit
    });


    /* var v= $("#form").validate({
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
                number:true,
                maxlength:5,
                min:1,
            },
            VerbalPrice: {
                number:true,
                maxlength:5,
                min:1,
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
                digits: true,
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
            'File[1]': {
                required: true,
            },
            File: {
                required: true,
            },
            Title: {
                required: true,
                maxlength: 30,
                minlength: 5,
            }
        },
        messages:{
            'Title[]': {
                'required':'Title is required',
            },  
            'File[]': {
                'required':'File is required',
            }      
        }
    }); */


    $(document).ready(function() {
        $('audio').on("play", function (me) {
            // alert('d');
            $('audio').each(function (i,e) {
                if (e !== me.currentTarget) {
                    this.pause(); 
                }
            });
        });
        $("option:selected").prop("selected", false);
        // $('.summernote_editor').summernote();
        summernote_edior();
        $('#LanguagePairId').change( function() {
            var id = $('#LanguagePairId').val();
            var name = $('#LanguagePairId option:selected').html();
            
            if(name.indexOf('Other') != -1 || name.indexOf('other') != -1){
                $('#VerbalPrice').val('');
                $('#WrittenPrice').val('');
                $('.ExercisePrices').html('');
            } else {
                //<div class="col-sm-5"><div class="input-group m-b"><span class="input-group-addon">$</span> <input type="number" placeholder="Verbal Feedback Price" name="VerbalPrice"  id="VerbalPrice" value="" class="form-control" ></div></div>
                var html = '<label  class="control-label col-sm-2">Feedback Prices  (In USD$) </label>\
                        <div class="col-sm-5">\
                            <input type="number"  placeholder="Written Feedback Price" name="WrittenPrice" id="WrittenPrice" value=""  class="form-control" >\
                        </div>\
                        <div class="col-sm-5">\
                           <input type="number" placeholder="Verbal Feedback Price" name="VerbalPrice"  id="VerbalPrice" value="" class="form-control" >\
                        </div>';
                $('.ExercisePrices').html(html);
            }
        });
        
        $('#ModeId').change( function() {
            var id = $('#ModeId').val();
            var name = $('#ModeId option:selected').html();

            if(name.indexOf('Consecutive') != -1 || name.indexOf('consecutive') != -1) {
                console.log('Consecutive');
                $('.Sight_Translation').html('');
                $('.Simultaneous').html('');
                $('.Consecutive').html('');
                $('.ApproxTimeArea').html('');
                var Consecutive_html = '';
                Consecutive_html = '<div class="text-center m-t-md" style="display:none"><h3>Pre-Session</h3></div>\
                                <div class="form-group">\
                                <label class="control-label col-sm-2 "></label>\
                                <div class="col-sm-2 "><h3>Pre-Session</h3></div>\
                                </div>\
                            <div class="form-group">\
                            <label class="control-label col-sm-2 ">Slide #1</label>\
                            <div class="col-sm-10">\
                                <div class="ibox float-e-margins">\
                                    <div class="ibox-content">\
                                        <div class="form-group"> <label  >Title <span style="color: red">*</span></label>\
                                                <input type="text" placeholder="Ex: Pre-Session" name="STitle" id="STitle" class="form-control" >\
                                        </div>\
                                        <div class="form-group"> <label >Scenario Description  <span style="color: red">*</span> </label>\
                                            <textarea class="form-control"  rows="3" id="ScenarioDescription" name="ScenarioDescription" > </textarea>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="form-group">\
                                <label class="control-label col-sm-2 "></label>\
                                <div class="col-sm-2 "><h3>Exercises Slides</h3></div>\
                        </div>\
                        <div class="form-group exers removeclass1">\
                            <label class="control-label col-sm-2 slide">Slide #2</label>\
                            <div class="col-sm-10">\
                                <div class="ibox float-e-margins">\
                                    <div class="ibox-content">\
                                        <a class="close-link binded pull-right" onclick="remove_exercise_fields(1)"><i class="fa fa-times"></i></a>\
                                        <div class="form-group">\
                                            <label>Title</label>\
                                            <input type="text" class="form-control title_input" id="Title1" name="Title[1]" value="" maxlength="30" minlength="5" placeholder="Title Ex: Speaker to Audience" >\
                                        </div>\
                                        <div class="form-group">\
                                            <label>File</label>\
                                            <input type="file" class="form-control file_input" id="File1" name="File[1]" value="" placeholder="" accept=".mp3,audio/*" onchange="readAudioURL(this)" >\
                                            <div id="audio_player1" class="player" style="display: none;">\
                                                <audio controls="" class="slideFile" id="audio1" src=""></audio>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                        <div id="exercises_fields"></div>\
                        <div class="form-group">\
                            <div class="col-sm-2 "></div>\
                            <div class="col-sm-2 ">\
                                <button type="button" class="btn btn-sm btn-success m-t-n-xs" onclick="exercises_fields()"><i class="fa fa-plus"></i> Add More Slide</button>\
                            </div>\
                        </div>';
                $('.Consecutive').html(Consecutive_html);
                summernote_edior();
            } else if(name.indexOf('Simultaneous') != -1 || name.indexOf('simultaneous') != -1) {
                console.log('Simultaneous');
                $('.Sight_Translation').html('');
                $('.Simultaneous').html('');
                $('.Consecutive').html('');
                $('.ApproxTimeArea').html('');
                var Simultaneous_html='<div class="text-center m-t-md">\
                            <h3>Simultaneous Exercise Slide</h3>\
                        </div>\
                        <div class="form-group"> <label  class="control-label col-sm-2">Title <span style="color: red">*</span></label>\
                            <div class="col-sm-10">\
                                <input type="text" placeholder="Ex: Speaker to Audience" name="STitle" id="STitle" class="form-control" >\
                            </div>\
                        </div>\
                        <div class="form-group"> <label  class="control-label col-sm-2">Scenario Description  <span style="color: red">*</span></label>\
                            <div class="col-sm-10">\
                                <input type="text" placeholder="Ex: Presentation" name="SScenarioDescription" id="SScenarioDescription" class="form-control" >\
                            </div>\
                        </div>\
                        <div class="form-group"> <label  class="control-label col-sm-2">Audio File  <span style="color: red">*</span></label>\
                            <div class="col-sm-10">\
                                <input type="file" class="form-control" id="File" name="File"  value="" placeholder=""  onchange="readAudioURL(this)" accept=".mp3,audio/*">\
                                <div id="audio_player" class="player" style="display: none;">\
                                    <audio controls="" class="slideFile" id="audio" src=""></audio>\
                                </div>\
                            </div>\
                        </div>';

                $('.Simultaneous').html(Simultaneous_html);

            } else if(name.indexOf('Sight') != -1 || name.indexOf('sight') != -1){
                console.log('Sight Translation');
                $('.Sight_Translation').html('');
                $('.Simultaneous').html('');
                $('.Consecutive').html('');
                $('.ApproxTimeArea').html('');
                var ApproxTimeAreaHtml= '<label  class="control-label col-sm-2">Approximate Time </label>\
                        <div class="col-sm-10">\
                            <input type="text"  class="form-control" value="" placeholder="Time in Minutes ex: 5" name="ApproxTime" id="ApproxTime"> \
                        </div>';
                $('.ApproxTimeArea').html(ApproxTimeAreaHtml);
                var Sight_Translation_html = '<div class="text-center m-t-md">\
                            <h3>Sight Translation Exercise Slide</h3>\
                        </div>\
                        <div class="form-group"> <label  class="control-label col-sm-2">Title <span style="color: red">*</span></label>\
                            <div class="col-sm-10">\
                                <input type="text" placeholder="Ex: Scenario" name="Title" id="Title" class="form-control" >\
                            </div>\
                        </div>\
                        <div class="form-group"> <label  class="control-label col-sm-2">Scenario Description  <span style="color: red">*</span> </label>\
                            <div class="col-sm-10">\
                                <input type="text" placeholder="Ex: Presentation" name="ScenarioDescription" id="ScenarioDescription" class="form-control" >\
                            </div>\
                        </div>\
                        <div class="form-group"> <label  class="control-label col-sm-2">Source Text  <span style="color: red">*</span> </label>\
                            <div class="col-sm-10">\
                                <textarea class="summernote_editor input-block-level" id="ExtraDescription" name="ExtraDescription"> Source Text </textarea>\
                                <label id="ExtraDescription1Err" class="hide" style="color:#cc5965;margin-left:5px;">Description is required.</label>\
                            </div>\
                        </div>';

                $('.Sight_Translation').html(Sight_Translation_html);
                summernote_edior();
            }
        });
        $('#FieldId').change( function() {
            var id = $('#FieldId').val();
            var url = APP_URL +'/getSubjectByField/'+ id ;
            // alert('ch : ' + url);
            $.ajax({
                url: url, 
                type: 'POST', 
                data: { id:id },
                dataType: 'json',
                success: function(response){
                    data_lan = response.ResponseMessage.length;
                    if(data_lan > 0) {
                        data = response.ResponseMessage;
                        $('#SubjectId').html('<option value="0">Select Subject</option>');
                        for(i = 0; i < data_lan ; i++ )
                        {
                            var option = $('<option></option>').text(data[i].Name).val(data[i].SubjectId);
                            $('#SubjectId').append(option);
                        }
                        
                        console.log(' found');
                    } else {
                        $('#SubjectId').html('');
                        var option = $('<option></option>').text('Subject Not Found').val('');
                        $('#SubjectId').append(option);
                    }
                }
            });
        });
        $('#SubjectId').change( function() {
            var id = $('#SubjectId').val();
            var url = APP_URL +'/getScenarioBySubject/'+ id ;
            // alert('ch : ' + url);
            $.ajax({
                url: url, 
                type: 'POST', 
                data: { id:id },
                dataType: 'json',
                success: function(response){
                    data_lan = response.ResponseMessage.length;
                    if(data_lan > 0) {
                        data = response.ResponseMessage;
                        $('#ScenarioId').html('');
                        for(i = 0; i < data_lan ; i++ )
                        {
                            var option = $('<option></option>').text(data[i].Name).val(data[i].ScenarioId);
                            $('#ScenarioId').append(option);
                        }
                        console.log('found');
                    } else {
                        $('#ScenarioId').html('');
                        var option = $('<option></option>').text('Scenario Not Found').val('');
                        $('#ScenarioId').append(option);
                    }
                }
            });
        });
        //IsActive checkbox
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
@endsection