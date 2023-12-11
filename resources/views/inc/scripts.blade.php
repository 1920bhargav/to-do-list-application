<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('plugins/blockui/jquery.blockUI.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{asset('plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{asset('assets/js/script.js')}}"></script>
<script src="{{asset('plugins/apex/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/dash_2.js')}}"></script>
<script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
<script src="{{asset('plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
<script src="{{asset('assets/js/forms/bootstrap_validation/bs_validation_script.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{asset('plugins/input-mask/input-mask.js')}}"></script>
<script src="{{asset('plugins/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('plugins/noUiSlider/nouislider.min.js')}}"></script>
<script src="{{asset('plugins/flatpickr/custom-flatpickr.js')}}"></script>
<script src="{{asset('plugins/noUiSlider/custom-nouiSlider.js')}}"></script>
<script src="{{asset('plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js')}}"></script> 
<script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
<script src="{{asset('plugins/jquery-validate/jquery.validate.min.js')}}"></script>
<script src="{{asset('plugins/jquery-confirm/jquery-confirm.min.js')}}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.8/jquery.jgrowl.min.js"></script> -->
<script src='http://ksylvest.github.io/jquery-growl/javascripts/jquery.growl.js' type='text/javascript'></script>
@yield('page_scripts')
