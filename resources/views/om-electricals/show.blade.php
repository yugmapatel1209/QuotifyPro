@extends('layouts.app')
@section('title')
| View Om Quotation
@endsection
@section('style')
<style>
.row.wrapper.border-bottom.white-bg.page-heading { display: none;}
li.nav-header { display: none;}
ul#side-menu { display: none;}
.slideFile {    width: 100%; }​
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
    // da($quotation);
@endphp
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">

                    <div class="text-center m-t-md">
                        <h2><b> Quotation - {{ $quotation->quotation_number}} </b></h2>
                        <h3> {{ $quotation->licence}}</h3>
                    </div>
                    <div class="row"></div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="wrapper wrapper-content animated fadeInRight">
                                <div class="ibox-content p-xl">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5>From:</h5>
                                            <address>
                                                <strong>Om Electrical,</strong><br>
                                                @if($quotation->licence) {{$quotation->licence}},<br> @endif
                                                @if($quotation->address) {{$quotation->address}},<br> @endif
                                                {{-- <abbr title="Phone">P:</abbr> (123) 601-4590 --}}
                                            </address>
                                        </div>

                                        <div class="col-sm-6 text-right">
                                            <h4>Quotation No.</h4>
                                            <h4 class="text-navy">{{$quotation->quotation_number}}</h4>
                                            <span>To:</span>
                                            <address>
                                                @if($quotation->client_name)<strong>{{$quotation->client_name}},</strong><br> @endif
                                                @if($quotation->client_company) {{$quotation->client_company}},<br>@endif
                                                @if($quotation->client_address) {{$quotation->client_address}},<br> @endif
                                                @if($quotation->rfq_number) RFQ Number : {{$quotation->rfq_number}},<br> @endif
                                                {{-- <br><abbr title="Phone">P:</abbr> (120) 9000-4321 --}}
                                            </address>
                                            <p>
                                                <span><strong>Date:</strong> {{$quotation->date}}</span><br />
                                                <span><strong>Valid Untill:</strong> {{$quotation->valid_until}}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="ibox-title">
                                        <h5>Subject : Quotation for material supply</h5>
                                    </div>
                                    <div class="table-responsive m-t">
                                        <table class="table invoice-table">
                                            <thead>
                                                <tr>
                                                    {{-- <th>Item List</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Price</th>
                                                    <th>Tax</th>
                                                    <th>Total Price</th> --}}
                                                    <th>Sr.No</th>
                                                    <th>Material </th>
                                                    <th>HSN/SAC </th>
                                                    <th>Description</th>
                                                    <th>Make</th>
                                                    <th>Unit.</th>
                                                    <th>Qty.</th>
                                                    <th>Rate.</th>
                                                    <th>Amount</th>
                                                    {{-- <th>GST%</th>
                                                    <th>GST A.</th>
                                                    <th>Total A.</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($quotation->details as $key=> $table)
                                                <tr>
                                                    <td>{{ $table->series}}</td>
                                                    <td>{{ $table->material}}</td>
                                                    <td>{{ $table->hsn_sac}}</td>
                                                    <td>{{ $table->description}}</small></td>
                                                    <td>{{ $table->make}}</td>
                                                    <td>{{ $table->unit}}</td>
                                                    <td>{{ $table->quantity}}</td>
                                                    <td>{{ $table->rate}}</td>
                                                    <td>{{ $table->amount}}</td>
                                                    {{-- <td>{{ $table->gst_percentage}}</td>
                                                    <td>{{ $table->gst_amount}}</td>
                                                    <td>{{ $table->total_amount}}</td> --}}
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <table class="table invoice-total">
                                        <tbody>
                                            <tr>
                                                <td><strong>Sub Total :</strong></td>
                                                <td>Rs. {{$quotation->detail_amount}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Discount :</strong></td>
                                                <td>Rs. {{$quotation->discount}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>TOTAL :</strong></td>
                                                <td>Rs. {{$quotation->final_amount}}</td>
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
                                        <h4>If you have any questions about this price quote, please contact.</h4>
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
    });
</script>
@endsection
