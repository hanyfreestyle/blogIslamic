<script>
    $(document).ready(function() {
        $("#{{$id}}").select2({
            ajax: {
                url: "{{route($PrefixTags.'.TagsSearch')}}",
                dataType: 'json',
                data: function (params) {
                    var query = {
                        search: params.term,
                        type: 'TagsSearch',
                    }
                    return query;
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            },
            cache: false,
            placeholder: 'Search for a user...',
            tags: {{$newTags}},
            tokenSeparators: [','],
            minimumInputLength: {{$length}},
            createTag: function (params) {
                var term = $.trim(params.term);
                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: true
                }
            },
        });
    }).on('select2:select', function (e) {
        var data = e.params.data;
        if(data.newTag === true){
            $.ajax({
                url:"{{route($PrefixTags.'.TagsOnFly')}}",
                method:"get",
                data:{newTagData:data},
                success:function(response) {
                    if (response.addDone === true){
                        $("#{{$id}}").find('[value="'+e.params.data.id+'"]').replaceWith('<option selected value="'+response.id+'">'+e.params.data.text+'</option>');
                    }
                }
            });
        }
    });
</script>