<script>
    $(document).ready(function() {
        $('.liveDelete_daleteBtn').on('click', function(e) {
            var formid = $(this).attr('id');
            var parent = $(this).closest('tr');
            // alert(parent);
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'post',
                url: '{{route($url)}}',
                data: {
                    update: 1,
                    thisId: formid,
                },
                success: function (response) {
                    console.log(response);
                    parent.fadeOut(300,function() {
                        parent.remove();
                    });
                }
            });
        });
    })
</script>
