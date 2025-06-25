@extends('layouts.app')
@section('title')
| Quotation
@endsection
@section('style')
<style>
.row.wrapper.border-bottom.white-bg.page-heading { display: none;}
li.nav-header { display: none;}
ul#side-menu { display: none;}
.slideFile {    width: 100%; }​
.row {
    margin-top: -5px !important;
}

hr {
    margin-top: 5px !important;
    margin-bottom: 5px !important;
}
/* .ibox-title {
    height: 15px !important;
} */
.table {
    margin-bottom: 0px;
}
.text-center {
    margin-bottom: 20px;
}
/* .content_right { text-align: right;}
.wizard > .steps a{background-color: #366490 ;color: #fff ;}
.wizard > .content > .body {width: 100%;background-color: #e5edf3;}
.wizard > .steps > ul > li {width: auto;}
.wizard > .content > .body ul {padding-left: 45px;} */
</style>
@endsection

@section('top-content')
<div class="col-lg-10">
    <h2><a href="{{ url('/om') }}">Om Electricals</a> / Details</h2>
</div>
@endsection

@section('content')
@php
    // dd($data);
@endphp
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">

                    <div class="text-center" style="margin-bottom: -20px">
                        @if($quotation->is_laterpad_image)
                            <img alt="image" class="img-fluid" src="{{ env('APP_URL').'/public/img/OMLatterPade.png' }}" style="max-width: 100%;" />
                        @else
                            <h2><b>Om Electricals</b></h2>
                            <h4>  Govt. Approved Contractor,</h4>
                            <h5> S/28 Swagat Enclave, Opp. Dediyasan G.I.D.C.,  Modhera Road, Mehsana-384002. </h5> <hr>
                        @endif
                        <h4><b> Quotation - {{ $quotation->quotation_number}} </b></h4>
                        <button type="button" class="btn btn-sm btn-success m-t-n-xs no-print" id="toggleButton"> <i class="fa fa-plus"></i> Show/Hide Price Comparison</button>
                    </div>

                    <div class="row"></div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="wrapper wrapper-content animated fadeInRight">
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            {{-- @if(!$quotation->is_laterpad_image)
                                            <h5>From:</h5>
                                            <address>
                                                <strong>Om Electrical,</strong><br>
                                                @if($quotation->licence) {{$quotation->licence}},<br> @endif
                                                @if($quotation->address) {{$quotation->address}},<br> @endif
                                                <abbr title="Phone">P:</abbr> (123) 601-4590
                                            </address>
                                            @endif --}}
                                            <span>To:</span>
                                            <address>
						                        @if($quotation->client_company) <strong>{{$quotation->client_company}}</strong>,<br>@endif
                                                @if($quotation->client_name)<strong>{{$quotation->client_name}},</strong><br> @endif
                                                @if($quotation->client_address) {{$quotation->client_address}},<br> @endif
                                                @if($quotation->rfq_number) RFQ Number : {{$quotation->rfq_number}},<br> @endif
                                                {{-- <br><abbr title="Phone">P:</abbr> (120) 9000-4321 --}}
                                            </address>
                                        </div>

                                        <div class="col-sm-6 text-right">
                                            <p>
                                                <span><strong>Date:</strong> {{$quotation->date}}</span><br />
                                                <span><strong>Valid Untill:</strong> {{$quotation->valid_until}}</span>
                                            </p>
                                        </div>
                                    </div>
                                    {{-- <div class="ibox-title">
                                        <h5>Subject : Quotation for material supply</h5>
                                    </div> --}}
                                    <div class="table-responsive">
                                        <table class="table invoice-table">
                                            <thead>
                                                <tr>
                                                    {{-- <th>Item List</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Price</th>
                                                    <th>Tax</th>
                                                    <th>Total Price</th> --}}
                                                    {{-- <th>Sr.No</th>
                                                    <th>Material </th>
                                                    <th>HSN/SAC </th>
                                                    <th>Description</th>
                                                    <th>Make</th>
                                                    <th>Unit.</th>
                                                    <th>Qty.</th>
                                                    <th>Rate.</th>
                                                    <th>Amount</th>
                                                    <th class="togglePriceComparison">GST%</th> --}}
                                                    {{--<th class="togglePriceComparison">GST A.</th>
                                                    <th>Total A.</th> --}}
                                                    {{-- <th class="togglePriceComparison">Including GST Rs</th>
                                                    <th class="togglePriceComparison">Excluding GST Rs</th>
                                                    <th class="togglePriceComparison">Discount%</th>
                                                    <th class="togglePriceComparison">Profit%</th>
                                                    <th class="togglePriceComparison">Transportation charges Rs</th>
                                                    <th class="togglePriceComparison">Final Amount</th>
                                                    <th class="togglePriceComparison">Profit(Original) Rate</th>
                                                    <th class="togglePriceComparison">Purchase Amount </th>
                                                    <th class="togglePriceComparison">Sales Amount </th>
                                                    <th class="togglePriceComparison">Final Benefit</th>
                                                    <th class="togglePriceComparison">Buyers Name</th> --}}
                                                    @php
                                                        // Determine which columns have data
                                                        $columns = [];
                                                        foreach ($data as $key => $values) {
                                                            if (!empty(array_filter($values))) {
                                                                $columns[$key] = $values;
                                                            }
                                                        }
                                                    @endphp

                                                    {{-- Generate table headers --}}
                                                    @foreach(array_keys($columns) as $columnName)
                                                        <th class="{{array_search($columnName, $optional_data) !== false ? 'togglePriceComparison' : '' }}">{{ $columnName }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>

                                                {{-- @foreach ($quotation->details as $key=> $table)
                                                <tr>
                                                    <td>{{ $table->series}}</td>
                                                    <td>{{ $table->material}}</td>
                                                    <td>{{ $table->hsn_sac}}</td>
                                                    <td>{{ $table->description}}</small></td>
                                                    <td class="{{$table->make}}">{{ $table->make}}</td>
                                                    <td>{{ $table->unit}}</td>
                                                    <td>{{ $table->quantity}}</td>
                                                    <td>{{ $table->rate}}</td>
                                                    <td>{{ $table->amount}}</td>
                                                    <td class="togglePriceComparison">{{ $table->gst_percentage}}</td>

                                                    <td class="togglePriceComparison">{{ $table->including_gst}}</td>
                                                    <td class="togglePriceComparison">{{ $table->excluding_gst}}</td>
                                                    <td class="togglePriceComparison">{{ $table->discount_percentage}}</td>
                                                    <td class="togglePriceComparison">{{ $table->profit_percentage}}</td>
                                                    <td class="togglePriceComparison">{{ $table->transportation_charges}}</td>
                                                    <td class="togglePriceComparison">{{ $table->final_amount}}</td>
                                                    <td class="togglePriceComparison">{{ $table->original_rate}}</td>
                                                    <td class="togglePriceComparison">{{ $table->purchase_amount}}</td>
                                                    <td class="togglePriceComparison">{{ $table->sales_amount}}</td>
                                                    <td class="togglePriceComparison">{{ $table->benefit}}</td>
                                                    <td class="togglePriceComparison">{{ $table->buyers_name}}</td>

                                                </tr>
                                                @endforeach --}}

                                                @php
                                                    // Determine the number of rows
                                                    $rowCount = count(reset($columns));

                                                    $columnsKeys = array_keys($columns);
                                                    // dd($rowCount)
                                                @endphp
                                                {{-- Generate table rows --}}
                                                @for($i = 0; $i < $rowCount; $i++)
                                                <tr>
                                                    @foreach($columns as $index => $column)
                                                        <td class="{{array_search($index, $optional_data) !== false ? 'togglePriceComparison' : '' }}">{{ $column[$i] ?? '' }} </td>
                                                    @endforeach
                                                </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                    <table class="table invoice-total">
                                        <tbody>
                                            <tr>
                                                <td><strong>TOTAL Amount:</strong></td>
                                                <td>Rs. {{$extra_info['total_amount']}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>TOTAL GST:</strong></td>
                                                <td>Rs. {{$extra_info['total_gst_amount']}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>TOTAL Amount with GST:</strong></td>
                                                <td>Rs. {{$extra_info['total_amount_and_gst']}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @if(count($quotation->termsconditions) > 0)
                                    <div class="ibox-title">
                                        <h5>Terms And Conditions </h5>
                                    </div>
                                    @foreach($quotation->termsconditions as $key => $term)
                                        <div class="col-sm-12">
                                            <h5>{{ ++$key }}) {{$term->description}}</h5>
                                        </div>
                                        @endforeach
                                    @endif
                                    <br>
                                    <div class="text-center m-t-md">
                                        <h5>If you have any questions about this price quote, please contact.</h5>
                                        <h5>Devis, Mo:- 9408112342, E-mail:- omele11@yahoo.com</h5>
                                        <h4>Thank you for Your Business!</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">

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
                                <p><b>{{$quotation->status}}</b></p>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group"><label class="col-sm-2 control-label">Licence : </label>
                            <div class="col-sm-10">
                                <p>{{$quotation->licence}}</p>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group"><label class="col-sm-2 control-label">Address : </label>
                            <div class="col-sm-10">
                                <p>{{$quotation->address}}</p>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group"><label class="col-sm-2 control-label">Client Company : </label>
                            <div class="col-sm-10">
                                <p>{{$quotation->client_company}}</p>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group"><label class="col-sm-2 control-label">Client Name : </label>
                            <div class="col-sm-10">
                                <p><b>{{$quotation->client_name}} </b></p>
                            </div>
                        </div>
                        </div>

                        <div class="row">
                        <div class="form-group"><label class="col-sm-2 control-label">client_address : </label>
                            <div class="col-sm-10">
                                <p>{{$quotation->client_address}}</p>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div> --}}
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

        function showPriceComparison(val = true) {
            !val
        }
        $('#toggleButton').on('click', function() {
            console.log("🚀 ~ $ ~ function:click")
            // class="togglePriceComparison"
            $('.togglePriceComparison').toggle(); // Toggle the visibility of the section
        });
    });
</script>
@endsection
