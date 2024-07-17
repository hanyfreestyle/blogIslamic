<div class="row text-center text-lg-start">
  <x-admin.file-manager.photo-col-row :photo-url="$photoUrl" :view-type="$viewType" :db-photos="$db_photos"/>
</div>
<script>
    $('.removeOrUpdatePhoto').click(function () {
        var path = $(this).attr('id');
        var thisContext = this;
        // alert(thisContext);
        $.ajax({
            url: '{{route('admin.fileManager.updatePhoto')}}',
            data: {"path": path},
            success: function (data) {
                $(thisContext).closest(".parent_div").fadeOut(300);
                // console.log(data);
            }
        });
    });
</script>
