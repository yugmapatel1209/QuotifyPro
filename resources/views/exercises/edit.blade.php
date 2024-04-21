@extends('layouts.app')
@section('title')
| Edit Exercise
@endsection

@section('top-content')
<div class="col-lg-10">
    <h2><a href="{{ url('/exercises') }}">Exercises</a> / Edit</h2>
</div>
@endsection
@section('style') 
<link href="{{env('APP_URL').'/'.'public/css/plugins/summernote/summernote.css' }}" rel="stylesheet">
<link href="{{env('APP_URL').'/'.'public/css/plugins/summernote/summernote-bs3.css'}}" rel="stylesheet">
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
                <h5>Edit Exercise</h5>
            </div> --}}
            <div class="ibox-content">
                @include('flash::message')
                {{-- {!! Form::model($exercise, ['route' => ['exercises.update', $exercise->ExercisesMasterId], 'method' => 'patch','id' => 'form' ,'class' => 'form-horizontal' , 'enctype' => 'multipart/form-data' ]) !!}  --}}
                 {!! Form::model($exercise, ['url' => ['update_exercise', $exercise->ExercisesMasterId], 'method' => 'post','id' => 'form' ,'class' => 'form-horizontal','enctype' => 'multipart/form-data' ]) !!} 
                
                <div class="form-group"> <label class="control-label col-sm-2">Language Pair </label> 
                    <div class="col-sm-10"> 
                        <input type="hidden" id="LanguagePairId" name="LanguagePairId"  value="{!! $exercise->languagepair->LanguagePairId !!}">
                        <input type="text" placeholder="" class="form-control"  value="{!! $exercise->languagepairName !!}" required readonly>
                    </div>
                </div>
                <div class="form-group"> <label class="control-label col-sm-2">Mode </label> 
                    <div class="col-sm-10"> 
                        <input type="hidden" id="ModeId" name="ModeId" value="{!! $exercise->mode->ModeId !!}">
                        <input type="text" class="form-control"  value="{!! $exercise->modeName !!}" required readonly>
                    </div>
                </div>
                <div class="form-group"> <label class="control-label col-sm-2">Subject </label> 
                    <div class="col-sm-10"> 
                        <input type="text"  class="form-control"  value="{!! $exercise->SubjectName !!}" required readonly>
                    </div>
                </div>
                <div class="form-group"> <label class="control-label col-sm-2">Scenario </label> 
                    <div class="col-sm-10"> 
                        <input type="hidden" id="ScenarioId" name="ScenarioId" value="{!! $exercise->scenario->ScenarioId !!}">
                        <input type="text" class="form-control"  value="{!! $exercise->scenarioName !!}" required readonly>
                    </div>
                </div>
                
                @if($exercise->LanguagePairId == 1) 
                    <div class="form-group ExercisePrices"> 
                        <label  class="control-label col-sm-2">Feedback Prices  (In USD$) </label>
                        <div class="col-sm-5">
                            <input type="number" placeholder="Written Feedback Price" name="WrittenPrice" id="WrittenPrice" value="<?=str_replace('$', '', $exercise->WrittenPrice)?>"  class="form-control" >
                        </div>
                        <div class="col-sm-5">
                            <input type="number" placeholder="Verbal Feedback Price" name="VerbalPrice"  id="VerbalPrice" value="<?=str_replace('$', '', $exercise->VerbalPrice)?>" class="form-control" >
                        </div>
                    </div>  
                @endif

                <div class="form-group"><label class="col-sm-2 control-label">Active <br/></label>
                    <div class="col-sm-10">
                        <label class="checkbox-inline i-checks"> <input type="checkbox" value="1" name="IsActive" id="IsActive" @if(isset($exercise)){{$exercise->IsActive==1?"checked":""}}@endif> Yes 
                        </label>     
                    </div>    
                </div>
                
                @if($exercise->ModeId == 1) 

                    @foreach ($exercise->exercises as $i => $exercise)
                        @if($i === 0)
                            <div class="text-center m-t-md"><h3>Consicutive Pre-Session</h3></div>
                            <div class="form-group">
                                <label class="control-label col-sm-2 ">Slide #1</label>
                                <div class="col-sm-10">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-content">
                                            <div class="form-group"> <label>Title <span style="color: red">*</span></label>
                                                <input type="hidden" id="ExerciseId" name="ExerciseId" value="{!! $exercise->ExerciseId !!}">
                                                <input type="text" placeholder="Ex: Pre-Session" name="STitle" id="STitle" value="{!! $exercise->Title !!}" class="form-control" required>
                                            </div>
                                            <div class="form-group"> <label>Scenario Description  <span style="color: red">*</span> </label>
                                                <textarea class="form-control"  rows="3" id="ScenarioDescription" name="ScenarioDescription" > {!! $exercise->ScenarioDescription !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center m-t-md">
                                <h3>Consicutive Exercises Slides</h3>
                            </div>
                        @else
                        <div class="form-group exers removeclass{{$i}}">
                                <?php $p = $i + 1?>                            
                                <label class="control-label col-sm-2 slide">Slide #{{$p}}</label>
                                <div class="col-sm-10">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-content">
                                            <a class="close-link binded pull-right" onclick="remove_exercise_fields('{{$i}}')"><i class="fa fa-times"></i></a>
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="hidden" id="ExerciseIds" name="ExerciseIds[{{$i}}]" value="{!! $exercise->ExerciseId !!}">
                                                <input type="text" class="form-control title_input" id="Title{{$i}}" name="Title[{{$i}}]" value="{!! $exercise->Title !!}" maxlength="30" minlength="5" placeholder="Title Ex: Speaker to Audience" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Existing File</label><br>
                                                <audio controls="" class="original_audio" src="{!! $exercise->File !!}"></audio>
                                                <input type="hidden" name="origonal_audio[{{$i}}]" value="{!! $exercise->File !!}">
                                                <br>
                                                <label>Update File</label>
                                                <input type="file" class="form-control " id="File{{$i}}" name="File[{{$i}}]" value="" placeholder="" accept=".mp3,audio/*" onchange="readAudioURL(this)" >
                                                <div id="audio_player{{$i}}" class="player" style="display: none;">
                                                    <audio controls="" class="slideFile" id="audio{{$i}}" src=""></audio>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif 
                    @endforeach
                    <div id="exercises_fields"></div>
                    <div class="form-group">
                        <div class="col-sm-2 "></div>
                        <div class="col-sm-2 ">
                            <button type="button" class="btn btn-sm btn-success m-t-n-xs" onclick="exercises_fields()"><i class="fa fa-plus"></i> Add More Slide</button>
                        </div>
                    </div>

                @elseif($exercise->ModeId == 2)

                    @foreach ( $exercise->exercises as $i => $exercise )
                    <div class="text-center m-t-md">
                        <h3>Simultaneous Exercise Slide</h3>
                    </div>
                    <div class="form-group"> <label  class="control-label col-sm-2">Title <span style="color: red">*</span></label>
                        <div class="col-sm-10">
                            <input type="hidden" id="ExerciseId" name="ExerciseId" value="{!! $exercise->ExerciseId !!}">                   
                            <input type="text" placeholder="Ex: Speaker to Audience" name="STitle" id="STitle" value="{!! $exercise->Title !!}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"> <label  class="control-label col-sm-2">Scenario Description  <span style="color: red">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Ex: Presentation" name="SScenarioDescription" id="SScenarioDescription" class="form-control" value="{!! $exercise->ScenarioDescription !!}" required>
                        </div>
                    </div>
                    <div class="form-group"> <label  class="control-label col-sm-2">Audio File  <span style="color: red">*</span></label>
                        <div class="col-sm-10">
                            <audio controls="" class="original_audio" id="original_audio" src="{!! $exercise->File !!}"></audio>
                            <input type="hidden" name="origonal_audio" value="{!! $exercise->File !!}">
                            <input type="file" class="form-control" id="File" name="File"  value="" placeholder=""  onchange="readAudioURL(this)" accept=".mp3,audio/*">
                            <div id="audio_player" class="player" style="display:none;">
                                <audio controls="" class="slideFile" id="audio" src="{!! $exercise->File !!}"></audio>
                            </div>
                        </div>
                    </div>
                    @endforeach

                @elseif($exercise->ModeId == 3)
                    @foreach ( $exercise->exercises as $i => $exercise )
                    <div class="text-center m-t-md">
                        <h3>Sight Translation Exercise Slide</h3>
                    </div>
                    <div class="form-group"> <label  class="control-label col-sm-2">Title <span style="color: red">*</span></label>
                        <div class="col-sm-10">
                            <input type="hidden" id="ExerciseId" name="ExerciseId" value="{!! $exercise->ExerciseId !!}">
                            <input type="text" placeholder="Ex: Scenario" name="Title" id="Title" class="form-control" value="{!! $exercise->Title !!}" required>
                        </div>
                    </div>
                    <div class="form-group"> <label  class="control-label col-sm-2">Scenario Description  <span style="color: red">*</span> </label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Ex: Presentation" name="ScenarioDescription" id="ScenarioDescription" class="form-control" value="{!! $exercise->ScenarioDescription !!}" required>
                        </div>
                    </div>
                    <div class="form-group"> <label  class="control-label col-sm-2">Scenario Detail Description  <span style="color: red">*</span> </label>
                        <div class="col-sm-10">
                            <textarea class="summernote_editor input-block-level" id="ExtraDescription" name="ExtraDescription"> {!! $exercise->ExtraDescription !!} </textarea>
                            <label id="ExtraDescription1Err" class="hide" style="color:#cc5965;margin-left:5px;">Description is required.</label>
                        </div>
                    </div>
                    @endforeach
                @endif
            <div class="hr-line-dashed"></div>
            
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <a href="{!! url('exercises') !!}" class="btn btn-white">Cancel</a>
                    <button class="btn btn-primary" type="submit" >Save changes</button>
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
    var len =$('.exers').length;
    function exercises_fields() {
        len++;
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
                                            <input type="hidden" id="ExerciseIds" name="ExerciseIds['+len+']" value="0">\
                                            <input type="text" class="form-control title_input" id="Title'+len+'" name="Title[' +len +']" value="" placeholder="Title Ex: Speaker to Audience" required>\
                                        </div>\
                                        <div class="form-group">\
                                            <label>File</label>\
                                            <input type="file" class="form-control" id="File'+len+'" name="File['+len+']" value="" placeholder="" accept=".mp3,audio/*" onchange="readAudioURL(this)" required>\
                                            <div id="audio_player'+len+'" class="player" style="display: none;">\
                                                <audio controls="" class="slideFile" id="audio'+len+'" src=""></audio>\
                                            </div>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>';
            
            objTo.appendChild(divtest);
            $('.slide').each(function (index) {
                var no = index + 2;
                var html = ' Slide #' + no;
                $(this).html(html);
                // $('#form').validate();
                // $(this.id).rules("add", {
                //     required: true
                // });
            });
            $('.title_input').each(function () {
                $(this).rules("add", 
                {
                    required: true,
                    maxlength: 30,
                    minlength: 5,    
                });
            });
            // document.getElementById('File'+len).onchange = setFileInfo;
    }
    function remove_exercise_fields(rid) {
        if($('.exers').length > 1) {
            $('.removeclass'+rid).remove();
            $('.slide').each(function (index) {
                var no = index + 2;
                var html = 'Slide #' + no;
                $(this).html(html);
            });
        }
    }
    function checkData() {
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
        v = $("#form").valid();
        if(!v) {
            return false;
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