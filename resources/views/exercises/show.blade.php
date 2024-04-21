@extends('layouts.app')
@section('title')
| View Exercise
@endsection
@section('style')
<style>
.slideFile {    width: 100%; }​
.content_right {
    text-align: right;
}
.wizard > .steps a{
    background-color: #366490 ;
    color: #fff ;
}
.wizard > .content > .body {
    width: 100%;
    background-color: #e5edf3;
}
.wizard > .steps > ul > li {
    width: auto;
}
.wizard > .content > .body ul {
    padding-left: 45px;
}
</style>
@endsection

@section('top-content')
<div class="col-lg-10">
    <h2><a href="{{ url('/exercises') }}">Exercises</a> / Details</h2>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            {{-- <div class="ibox-title">
                <h5>View Exercise</h5>
            </div> --}}
            <div class="ibox-content">

                <div id="wizard" class=>
                    <h1>Basic Description</h1>
                    <div class="step-content">
                        <div class="text-center m-t-md">
                            <h2>About Exercise</h2>
                        </div>
                        <div class="row"> 
                        <div class="form-group"><label class="col-sm-2 control-label">Status : <br/></label>
                            <div class="col-sm-10">
                                <p><b>{{$exercises->Status}}</b></p>
                            </div>    
                        </div>
                        </div>
                        <div class="row"> 
                        <div class="form-group"><label class="col-sm-2 control-label">Language Pair : </label>
                            <div class="col-sm-10">
                                <p>{{$exercises->languagepairName}}</p>
                            </div>    
                        </div>
                        </div>
                        <div class="row"> 
                        <div class="form-group"><label class="col-sm-2 control-label">Mode : </label>
                            <div class="col-sm-10">
                                <p>{{$exercises->modeName}}</p>
                            </div>    
                        </div>
                        </div>
                        <div class="row"> 
                        <div class="form-group"><label class="col-sm-2 control-label">Field : </label>
                            <div class="col-sm-10">
                                <p>{{$exercises->FieldName}}</p>
                            </div>    
                        </div>
                        </div>
                        <div class="row"> 
                        <div class="form-group"><label class="col-sm-2 control-label">Exercise Name : </label>
                            <div class="col-sm-10">
                                <p><b>{{$exercises->SubjectName}} - {{$exercises->scenarioName}} </b></p>
                            </div>    
                        </div> 
                        </div> 
                        
                        @if($exercises->LanguagePairId == 1)
                        <div class="row"> 
                        <div class="form-group"><label class="col-sm-2 control-label">Written Feedback Price : </label>
                            <div class="col-sm-10">
                                <p>{{$exercises->WrittenPrice}}</p>
                            </div>    
                        </div>   
                        </div>   
                        <div class="row"> 
                        <div class="form-group"><label class="col-sm-2 control-label">Verbal Feedback Price : </label>
                            <div class="col-sm-10">
                                <p>{{$exercises->VerbalPrice}}</p>
                            </div>    
                        </div>                     
                        </div>                     
                        @endif
                        <div class="row"> 
                        <div class="form-group"><label class="col-sm-2 control-label">Exercise Approx Time : </label>
                            <div class="col-sm-10">
                                <p>{{$exercises->Time}}</p>
                            </div>    
                        </div> 
                        </div> 
                    </div>
                    @foreach ($exercises->exercises as $key=> $exercise)
                    <?php
                                     //   echo  html_entity_decode($exercise->ExtraDescription) ;
                                    ?>
                    {{-- <li class=""><a data-toggle="tab" class="tabs" href="#tab-{{$key + 2}}">Exercises Slide {{++$key}}</a></li> --}}
                    <h1>Exercise Slide {{++$key}}</h1>
                    <div class="step-content">
                        <div class="text-center m-t-md">
                            <h2>About Exercise Slide</h2>
                        </div>
                        <div class="row"> 
                        <div class="form-group"><label class="col-sm-2 control-label">Slide Position </label>
                            <div class="col-sm-10">
                                <p><b>{{$exercise->SlidePosition}}</b></p>     
                            </div>    
                        </div>
                        </div>
                        <div class="row"> 
                        <div class="form-group"><label class="col-sm-2 control-label">Title </label>
                            <div class="col-sm-10">
                                <p><b>{{$exercise->Title}}</b></p>     
                            </div>    
                        </div>
                        </div>
                        @if($exercise->ScenarioDescription)                             
                        <div class="row"> 
                        <div class="form-group"><label class="col-sm-2 control-label">Scenario Description </label>
                            <div class="col-sm-10">
                                <p>{{$exercise->ScenarioDescription}}</p>
                            </div>    
                        </div>
                        </div>
                        @endif
                        @if($exercise->ExtraDescription)   
                            <br><br>
                            <div class="row">                           
                            <div class="form-group"><label class="col-sm-2 control-label"><br>Sight Slide Description </label>
                                <div class="col-sm-10"><br>
                                    <p>
                                    <?php
                                        echo  html_entity_decode($exercise->ExtraDescription) ;
                                    ?>
                                    </p>
                                </div>    
                            </div>
                            </div>
                        @endif
                        @if($exercise->File)                             
                            <div class="row"> 
                            <div class="form-group"><label class="col-sm-2 control-label">Type </label>
                                <div class="col-sm-10">
                                    <p>{{$exercise->FileType}}</p>
                                </div>    
                            </div>    
                            </div>    
                            <div class="row"> 
                            <div class="form-group"><label class="col-sm-2 control-label">Duration </label>
                                <div class="col-sm-10">
                                    <p>{{$exercise->Duration}} seconds</p>
                                </div>    
                            </div>    
                            </div>   
                            <div class="row">  
                            <div class="form-group"><label class="col-sm-2 control-label">File </label>
                                <div class="col-sm-10">
                                    <audio controls="" class="slideFile" id="audio{{$key}}"> <source src="{{$exercise->File}}" type="audio/mpeg" preload="none"> </audio>
                                </div>    
                            </div>
                            </div>

                        @endif
                    </div>
                    @endforeach
                </div>

                {{-- <div class="row">
                    <div class="col-lg-12">
                        <div class="panel blank-panel">
                            <div class="panel-heading">
                                <div class="panel-options">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" class="tabs" href="#tab-1">Basic Details</a></li>
                                        @foreach ($exercises->exercises as $key=> $exercise)
                                        <li class=""><a data-toggle="tab" class="tabs" href="#tab-{{$key + 2}}">Exercises Slide {{++$key}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="tab-1" class="tab-pane active">
                                        <div class="form-group"><label class="col-sm-2 control-label">Status </label>
                                            <div class="col-sm-10">
                                                <p><b>{{$exercises->Status}}</b></p>
                                            </div>    
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Language Pair </label>
                                            <div class="col-sm-10">
                                                <p>{{$exercises->languagepairName}}</p>
                                            </div>    
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Mode </label>
                                            <div class="col-sm-10">
                                                <p>{{$exercises->modeName}}</p>
                                            </div>    
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Field </label>
                                            <div class="col-sm-10">
                                                <p>{{$exercises->FieldName}}</p>
                                            </div>    
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Exercise Name </label>
                                            <div class="col-sm-10">
                                                <p><b>{{$exercises->SubjectName}} - {{$exercises->scenarioName}} </b></p>
                                            </div>    
                                        </div>                                     
                                        <div class="form-group"><label class="col-sm-2 control-label">Approx Time</label>
                                            <div class="col-sm-10">
                                                <p>{{$exercises->Time}}</p>
                                            </div>    
                                        </div>
                                    </div>
                                    @foreach ($exercises->exercises as $key => $exercise)
                                    <div id="tab-{{$key + 2}}" class="tab-pane">
                                        <div class="form-group"><label class="col-sm-2 control-label">Slide Position </label>
                                            <div class="col-sm-10">
                                                <p><b>{{$exercise->SlidePosition}}</b></p>     
                                            </div>    
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Title </label>
                                            <div class="col-sm-10">
                                                <p><b>{{$exercise->Title}}</b></p>     
                                            </div>    
                                        </div>
                                        @if($exercise->ScenarioDescription)                             
                                        <div class="form-group"><label class="col-sm-2 control-label">Scenario Description </label>
                                            <div class="col-sm-10">
                                                <p>{{$exercise->ScenarioDescription}}</p>
                                            </div>    
                                        </div>
                                        @endif
                                        @if($exercise->ExtraDescription)   
                                        <br><br>                          
                                        <div class="form-group"><label class="col-sm-2 control-label"><br>Sight Slide Description </label>
                                            <div class="col-sm-10"><br>
                                                <p>
                                                </p>
                                            </div>    
                                        </div>
                                        @endif
                                        @if($exercise->File)                             
                                        <div class="form-group"><label class="col-sm-2 control-label">Type </label>
                                            <div class="col-sm-10">
                                                <p>{{$exercise->FileType}}</p>
                                            </div>    
                                        </div>    
                                        <div class="form-group"><label class="col-sm-2 control-label">Duration </label>
                                            <div class="col-sm-10">
                                                <p>{{$exercise->Duration}} seconds</p>
                                            </div>    
                                        </div>    
                                        <div class="form-group"><label class="col-sm-2 control-label">File </label>
                                            <div class="col-sm-10">
                                                <audio controls="" class="slideFile" id="audio{{$key}}"> <source src="{{$exercise->File}}" type="audio/mpeg" preload="none"> </audio>
                                            </div>    
                                        </div>

                                        @endif
                                    </div>
                                    @endforeach       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  --}}
            </div>
        </div>
    </div>
    
</div>
@endsection

@section('scripts')
    <script>
       
    $(document).ready(function () {
        $("#wizard").steps({
            enableAllSteps: true,
            enableFinishButton: false,
            onCanceled: function (event, currentIndex) {
                parent.history.back();
                return false;
            },
            onStepChanged: function (event, currentIndex , newIndex) {
                $("audio").each(function(){
                    $(this).get(0).pause();
                });
            }
        });
        var focused = true;
        document.addEventListener("visibilitychange", function () {
        focused = !focused;
        if (!focused)
            $("audio").each(function() {
                $(this).get(0).pause();
            });
        });
        $('.tabs').click(function() { //When any link is clicked
            $("audio").each(function(){
                $(this).get(0).pause();
            });
        });
       
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
@endsection