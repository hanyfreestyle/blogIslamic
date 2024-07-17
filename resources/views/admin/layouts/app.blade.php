<!DOCTYPE html>
<html lang="en" {!!htmlArDir()!!} >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('adminConfig.title')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    @if(config('adminConfig.pace_progress') == true and config('adminConfig.preloader') == false)
        <link rel="stylesheet" href="{{ defAdminAssets('plugins/pace-progress/themes/black/pace-theme-flat-top.css') }}">
    @endif
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/dropzone/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ defAdminAssets('plugins/sweet/sweetalert2.min.css') }}">
    @yield('StyleFile')

    <link rel="stylesheet" href="{{ defAdminAssets('css/adminlte.css') }}">
    {!! (new \App\Helpers\MinifyTools)->setWebAssets('assets/admin/')->MinifyCss('css/custom_admin.css','Seo',true) !!}

    @if( thisCurrentLocale() == 'ar')
        <link rel="stylesheet" href="{{ defAdminAssets('rtl/css/adminlte-rtl.css') }}">
        <link rel="stylesheet" href="{{ defAdminAssets('rtl/css/custom.css') }}">
        <link rel="stylesheet" href="{{ defAdminAssets('css/custom_ar.css') }}">
        {!! (new \App\Helpers\MinifyTools)->setWebAssets('assets/admin/')->MinifyCss('css/chart.css','Seo',true) !!}
    @elseif( thisCurrentLocale() == 'en')
        <link rel="stylesheet" href="{{ defAdminAssets('css/custom_en.css') }}">
    @endif

    {!! (new \App\Helpers\MinifyTools)->setWebAssets('assets/admin/')->MinifyCss('css/custom_product.css','Seo',true) !!}

</head>

<body class="hold-transition {{ mainBodyStyle() }} {{sidebarCollapse()}} ">
<div class="wrapper">


    @include('admin.layouts.inc.top_navbar')

    @include('admin.layouts.inc.sidebar')

    <div class="content-wrapper">
        <div class="content">
            @yield('content')
        </div>
    </div>



    @if(config('adminConfig.top_navbar_control') == true)
        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
    @endif


    @include('admin.layouts.inc.footer')
</div>

<script src="{{defAdminAssets('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

@yield('JsFileBeforeAdminlte')

<script src="{{defAdminAssets('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/moment/moment.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{defAdminAssets('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/dropzone/min/dropzone.min.js')}}"></script>
<script src="{{defAdminAssets('plugins/sweet/sweetalert2.all.min.js')}}"></script>
{{--<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
<script src="{{defAdminAssets('js/adminlte.min.js')}}"></script>
<script src="{{defAdminAssets('js/custom_file.js') }}"></script>
<script src="{{defAdminAssets('parsley/parsley.js')}}"></script>
<script>
    $(function () {
        $('.DatePickers').daterangepicker({
            singleDatePicker: true,
            autoApply: true,
            //autoUpdateInput: false,
            // autoUpdateInput:true,
            showDropdowns: true,
            minYear: 2022,
            maxYear: parseInt(moment().format('YYYY'),10),

        });

        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        //Date and time picker
        $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges   : {
                    'Today'       : [moment(), moment()],
                    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'LT'
        })

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        })

        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

    })
    /*
 // BS-Stepper Init
 document.addEventListener('DOMContentLoaded', function () {
     window.stepper = new Stepper(document.querySelector('.bs-stepper'))
 })

 // DropzoneJS Demo Code Start
 Dropzone.autoDiscover = false

 // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument

 var previewNode = document.querySelector("#template")
 previewNode.id = ""
 var previewTemplate = previewNode.parentNode.innerHTML
 previewNode.parentNode.removeChild(previewNode)

 var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
     url: "/target-url", // Set the url
     thumbnailWidth: 80,
     thumbnailHeight: 80,
     parallelUploads: 20,
     previewTemplate: previewTemplate,
     autoQueue: false, // Make sure the files aren't queued until manually added
     previewsContainer: "#previews", // Define the container to display the previews
     clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
 })

 myDropzone.on("addedfile", function(file) {
     // Hookup the start button
     file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
 })

 // Update the total progress bar
 myDropzone.on("totaluploadprogress", function(progress) {
     document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
 })

 myDropzone.on("sending", function(file) {
     // Show the total progress bar when upload starts
     document.querySelector("#total-progress").style.opacity = "1"
     // And disable the start button
     file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
 })

 // Hide the total progress bar when nothing's uploading anymore
 myDropzone.on("queuecomplete", function(progress) {
     document.querySelector("#total-progress").style.opacity = "0"
 })

 // Setup the buttons for all transfers
 // The "add files" button doesn't need to be setup because the config
 // `clickable` has already been specified.
 document.querySelector("#actions .start").onclick = function() {
     myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
 }
 document.querySelector("#actions .cancel").onclick = function() {
     myDropzone.removeAllFiles(true)
 }
 // DropzoneJS Demo Code End

  */
</script>




@if(config('adminConfig.pace_progress') == '1' and config('adminConfig.preloader') == false)
    <script src="{{ defAdminAssets('plugins/pace-progress/pace.min.js') }}"></script>
@endif
@yield('AddScript')
@stack('JsCode')
<script>

    async function loadarfont(){
        const font_ar = new FontFace('Tajawal','url({{ defAdminAssets('fonts/Ar/TajawalRegular.woff2') }}');
        await font_ar.load();
        document.fonts.add(font_ar);
        document.body.classList.add('Tajawal');
    };
    loadarfont();

    async function loadarfont_en(){
        const font_en = new FontFace('Poppins','url({{ defAdminAssets('fonts/En/Poppins-Regular.woff2') }}');
        await font_en.load();
        document.fonts.add(font_en);
        document.body.classList.add('Poppins');
    };
    loadarfont_en();
    // display_c7();
</script>
</body>
</html>
