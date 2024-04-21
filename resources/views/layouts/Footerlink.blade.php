<!-- Mainly scripts -->
{{-- <script src="{{env('APP_URL').'/'.'public/js/jquery-2.1.1.js'}}"></script> --}}
{{-- update jquery script fo manage the datatable at 30-01-2019 by YP --}}
{{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}
<script src="{{ asset('public/js/jquery-3.3.1.js') }}"></script>


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> --}}
<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('public/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('public/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('public/js/plugins/jeditable/jquery.jeditable.js') }}"></script>
{{-- <script src="{{env('APP_URL').'/'.'public/js/plugins/dataTables/dataTables.bootstrap.js'}}"></script>
<script src="{{env('APP_URL').'/'.'public/js/plugins/dataTables/dataTables.responsive.js'}}"></script>
<script src="{{env('APP_URL').'/'.'public/js/plugins/dataTables/dataTables.tableTools.min.js'}}"></script> --}}

<script src="{{ asset('public/js/jquery.dataTables.min.js') }}"></script>
{{-- latest for mobile app--}}
{{-- <script src="{{env('APP_URL').'/'.'public/js/datatables.min.js'}}"></script> --}}
{{-- changed at 30-01-2019 for web view  --}}
<script src="{{ asset('public/js/dataTables.bootstrap.min.js') }}"></script>
<script>
    if ($(window).width() < 1200) { 
        $.getScript(APP_URL + "/public/js/datatables.min.js");
    } else {
        $.getScript(APP_URL + "/public/js/dataTables.bootstrap.min.js");
    }
</script>        

{{-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script> --}}

<!-- Peity -->
{{-- <script src="{{env('APP_URL').'/'.'public/js/plugins/peity/jquery.peity.min.js'}}"></script> --}}
{{-- <script src="{{env('APP_URL').'/'.'public/js/demo/peity-demo.js'}}"></script> --}}

<!-- Custom and plugin javascript -->
<script src="{{ asset('public/js/inspinia.js')}}"></script>
<script src="{{ asset('public/js/plugins/pace/pace.min.js') }}"></script>

<!-- jQuery UI -->
{{-- disable this js for set the summernote js.  Enable it if required in future --}}
{{-- <script src="{{env('APP_URL').'/'.'public/js/plugins/jquery-ui/jquery-ui.min.js'}}"></script> --}}

<!-- Toastr -->
<script src="{{ asset('public/js/plugins/toastr/toastr.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7"></script> --}}

<!-- Jquery Validate -->
<script src="{{ asset('public/js/plugins/validate/jquery.validate.min.js') }} "></script>
<!-- Custom My Js -->
<script src="{{ asset('public/js/script.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('public/js/plugins/iCheck/icheck.min.js') }}"></script>
<!-- Steps -->
<script src="{{ asset('public/js/plugins/staps/jquery.steps.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone.min.js"></script>


<script src="{{ asset('public/js/bootstrap3-typeahead.min.js') }}"></script>
<script src="{{ asset('public/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>