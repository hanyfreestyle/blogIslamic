@if($isActive)
    @if($style)
        <link rel="stylesheet" href="{{ defAdminAssets('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ defAdminAssets('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ defAdminAssets('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @endif

    @if($jscode)
        <script src="{{defAdminAssets('plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{defAdminAssets('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{defAdminAssets('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{defAdminAssets('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
{{--        <script src="{{defAdminAssets('plugins/datatables/currency.js')}}"></script>--}}
{{--        <script src="{{defAdminAssets('plugins/datatables/formatted-numbers.js')}}"></script>--}}

        @if($viewbut)
            <script src="{{defAdminAssets('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
            <script src="{{defAdminAssets('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
            <script src="{{defAdminAssets('plugins/jszip/jszip.min.js')}}"></script>
            <script src="{{defAdminAssets('plugins/pdfmake/pdfmake.min.js')}}"></script>
            <script src="{{defAdminAssets('plugins/pdfmake/vfs_fonts.js')}}"></script>
            <script src="{{defAdminAssets('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
            <script src="{{defAdminAssets('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
            <script src="{{defAdminAssets('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
        @endif
        <script>
            $(function () {
                $('#{{$tablename}}').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "lengthMenu": [10, 25, 50, 75, 100 ],
                    "pageLength":{{$pageLength}},
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "language": {
                        "lengthMenu": "_MENU_",
                        "search": "",
                        "zeroRecords": "Nothing found - sorry",
                        "info": "Showing page _PAGE_ of _PAGES_",
                        "infoEmpty": "No records available",
                        "infoFiltered": "(filtered from _MAX_ total records)"
                    }

                    @if($viewbut)
                    "buttons": [{!! $butlist !!}],
                    @endif

                    @if($viewbut)
                }).buttons().container().appendTo('#MainDataTable_wrapper .col-md-6:eq(0)');
                @else
            });
            @endif
            });
        </script>
    @endif
@endif
