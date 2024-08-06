<script>
    $(document).ready(function() {
        $('.{{$className}}').on('click', function(e) {
            var formid = $(this).attr('id');

            Swal.fire({
                title: '{!! $sTitle !!}',
                text: "{!! $sText !!}",
                icon: '{{$icon}}',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{!! $bConfirm !!}',
                cancelButtonText: '{!! $bCancel !!}'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = formid ;
                }
            })
        });
    })
</script>
