<script>
    $(".status_but").bootstrapSwitch({
        'size': 'mini',
        'onSwitchChange': function(event, state){
            var inputId = $(this).attr('thisid');

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '{{ $url }}',
                type: 'POST',
                dataType: 'text',
                data: {
                    send_id: inputId,
                },
                success: function (response) {
                    console.log(response);
                }
            });
        },
    });
</script>
