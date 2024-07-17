<script type="text/javascript">
    $(document).ready(function () {

        $('.{{$style_name}}').sortable({

            update: function (event, ui) {
                $(this).children().each(function (index) {
                    if ($(this).attr('data-position') != (index+1)) {
                        $(this).attr('data-position', (index+1)).addClass('updated');
                    }
                });

                var positions = [];
                $('.updated').each(function () {
                    positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
                    $(this).removeClass('updated');
                });

                var category_id = $('#category_id').val();
                //alert(category_id);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '{{$url}}',
                    type: 'POST',
                    dataType: 'text',
                    data: {
                        update: 1,
                        positions: positions,
                        categoryid: category_id
                    },
                    success: function (response) {
                        console.log(response);
                    }
                });
            }
        });
    });
</script>
