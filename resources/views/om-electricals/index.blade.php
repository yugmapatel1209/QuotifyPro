@extends('layouts.app')
@section('title')
| Om Electricals
@endsection
@section('style')
<style>
/* #ascend-tables tr th:nth-child(4), #ascend-tables tr th:nth-child(5) {
  text-align: center;
}
.table > tbody > tr > td:nth-child(4), .table > tbody > tr > td:nth-child(5), .table > tbody > tr > td:nth-child(6) {
    text-align: center;
} */
</style>
@endsection
@section('top-content')
<div class="col-lg-10">
    <h2>Om Electricals - Quotations</h2>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <form action="{!! route('om.create') !!}" class="device-content-center">
                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs"><strong><i class="fa fa-plus"></i> Add Quotation</strong></button>
                </form>
            </div>
            <div class="ibox-content">
                {{-- @include('flash::message') --}}
                {{-- <form method="POST" id="search-form" class="form-horizontal" role="form">
                    <div class="form-group">
                        <div class="col-md-3">
                            <select class="form-control" id="ModeId" name="ModeId" >
                                <option value=''>All Mode</option>
                                @if(isset($modes))
                                    @foreach($modes as $mode)
                                        <option value="{{$mode->ModeId}}" >{{$mode->Name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" id="FieldId" name="FieldId" >
                                <option value=''>All Field</option>
                                @if(isset($fields))
                                    @foreach($fields as $field)
                                        <option value="{{$field->Name}}" data-id="{{$field->FieldId}}">{{$field->Name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" id="SubjectId" name="SubjectId" >
                                <option value=''>All Subject</option>
                                @if(isset($subjects))
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->Name}}"  data-id="{{$subject->SubjectId}}" >{{$subject->Name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" id="ScenarioId" name="ScenarioId" >
                                <option value=''>All Scenario</option>
                                @if(isset($scenarios))
                                    @foreach($scenarios as $scenario)
                                        <option value="{{$scenario->Name}}" data-id="{{$scenario->ScenarioId}}" >{{$scenario->Name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <select class="form-control" id="LanguagePairId" name="LanguagePairId" >
                                <option value=''>All Language Pair</option>
                                @if(isset($languages))
                                    @foreach($languages as $language)
                                        <option value="{{$language->LanguagePairId}}" >{{$language->Name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" id="Status" name="Status" >
                                <option value=''>All Status</option>
                                <option value="1" >Active</option>
                                <option value="0" >Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-1">
                            <button type="submit" class="btn btn-sm btn-primary ">Apply Filter</button>
                        </div>
                        <div class="col-md-1">
                            <button type="button" onclick="resetFilter()" class="btn btn-sm btn-primary ">Reset</button>
                        </div>
                    </div>
                    <div class="row"></div>

                </form>  --}}
                <table class="table table-striped table-bordered table-hover dataTables-example" id="ascend-tables" style="width:100%">
                    <thead>
                        <tr>
                            <th>Quotation Number</th>
                            <th>Company</th>
                            <th>RFQ</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th style="min-width:80px !important;">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var oTable = '';
    var url = "{{ url('om') }}";
    var oTable = $('#ascend-tables').DataTable({
        responsive:true,
        // processing: true,
        destroy   : true,
        serverSide: true,
        // stateSave : true,
        processing : true,
        "oLanguage": {
            "sLengthMenu": "Display _MENU_ Quotation(s)",
            "sSearch": "<span>Search  </span> _INPUT_", //search
            // "sProcessing": "<div class='new_loader_dt'> <img src='{{env('APP_URL').'/'.'public/img/loading_spinner.gif'}}' alt='logo'> </div>",
            "sProcessing": "<div class='new_loader' style='background:none' ><div class='loading' id='loader'><i class='fa fa-spinner fa-spin spin_style'></i></div></div>",
        },
        "order": [[ 0, "desc" ]],
        // "ordering": false, // disables all column ordering
        searching: true,
        paging: true,
        ajax: {
            url: url,
            type: "get",
            data: function (d) {
                d.LanguagePairId = $('#LanguagePairId').val();
                d.FieldId = $('#FieldId').val();
                d.ModeId = $('#ModeId').val();
                d.SubjectId = $('#SubjectId').val();
                d.ScenarioId = $('#ScenarioId').val();
                d.Status = $('#Status').val();
                // d.Name = $('input[name=Name]').val();
            }
        },
        columns: [
            { data: 'quotation_number' },
            { data: 'client_company' },
            { data: 'rfq_number' },
            { data: 'date' },
            {
                "data": "is_active",
                "render": function (data, type, row) {
                    return row.is_active == 1 ? '<span class="label label-primary">Open</span>' : '<span class="label label-danger">Close</span>';
                }
            },{
                "sortable": false,
                "data": "ExerciseId",
                "render": function (data, type, row) {
                    var button = '<a href="{{ url('om') }}' + '/' + row['id']  + '/edit" class="product-table-info" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>';
                    button += '<a href="{{ url('om') }}' + '/' + row['id'] + '" class="product-table-info" data-toggle="tooltip" title="View" data-original-title="View"><i class="fa fa-eye"></i></a>';
                    button += '<a onclick="deleteData(\'' + row['id'] + '\')"  class="product-table-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>';
                    return button;
                }
            }
        ], 'fnCreatedRow': function (nRow, aData, iDataIndex) {
            $(nRow).attr('id', aData.ExerciseId); // or whatever you choose to set as the id
        }
    });
    $('#search-form').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });
    function resetFilter() {
        $("option:selected").prop("selected", false);
        oTable.draw();
        // e.preventDefault();
    }

    $('select[name="FieldId"]').on("change", function(event){
        var id = $(this).find(':selected').data('id');
        console.log(id);
        var url = APP_URL +'/getSubjectByField/'+ id ;
        $.ajax({
            url: url,
            type: 'POST',
            data: { id:id },
            dataType: 'json',
            success: function(response){
                data_lan = response.ResponseMessage.length;
                if(data_lan > 0) {
                    data = response.ResponseMessage;
                    $('#SubjectId').html("<option value=''>Select Subject</option>");
                    for(i = 0; i < data_lan ; i++ )
                    {
                        var option = $('<option></option>').text(data[i].Name).val(data[i].Name).attr('data-id', data[i].SubjectId);
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
        if (typeof(id) == "undefined") {
            var url1 = APP_URL +'/getScenarioBySubject/'+ id ;
            $.ajax({
                url: url1,
                type: 'POST',
                data: { id:id },
                dataType: 'json',
                success: function(response){
                    data_lan = response.ResponseMessage.length;
                    if(data_lan > 0) {
                        data = response.ResponseMessage;
                        $('#ScenarioId').html('');
                        $('#ScenarioId').html("<option value=''>Select Scenario</option>");
                        for(i = 0; i < data_lan ; i++ )
                        {
                            var option = $('<option></option>').text(data[i].Name).val(data[i].Name).attr('data-id', data[i].ScenarioId);
                            $('#ScenarioId').append(option);
                        }
                    } else {
                        $('#ScenarioId').html('');
                        var option = $('<option></option>').text('Scenario Not Found').val('');
                        $('#ScenarioId').append(option);
                    }
                }
            });
        }

        // oTable.draw();
        // event.preventDefault();
    });
    $('select[name="SubjectId"]').on("change", function(event){
        var id = $(this).find(':selected').data('id');
        var url = APP_URL +'/getScenarioBySubject/'+ id ;
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
                    $('#ScenarioId').html("<option value=''>Select Scenario</option>");
                    for(i = 0; i < data_lan ; i++ )
                    {
                        var option = $('<option></option>').text(data[i].Name).val(data[i].Name).attr('data-id', data[i].ScenarioId);
                        $('#ScenarioId').append(option);
                    }
                } else {
                    $('#ScenarioId').html('');
                    var option = $('<option></option>').text('Scenario Not Found').val('');
                    $('#ScenarioId').append(option);
                }
            }
        });

        // oTable.draw();
        // event.preventDefault();
    });
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
    function deleteData(id) {
        var table = '#ascend-tables';
        var url = '{{url('delete_om')}}';
        deleteRecord(id, url, table);
    }

</script>
@endsection
