@if($type == 'admin')
    <script type="text/javascript">
        $("#rowAdder").click(function () {
            newRowAdd =
             '<div id="row" class="row">' +
             '<div class="col-3"><input type="text" class="form-control dir_en" value="" name="key[]"></div>' +
             '<div class="col-4"><input type="text" class="form-control dir_ar" value="" name="ar[]"></div>' +
             '<div class="col-4"><input type="text" class="form-control dir_en" value="" name="en[]"></div>' +
             '<div class="col-1"><button class="btn btn-danger" id="DeleteRow" type="button"><i class="fas fa-trash"></i></button></div>' +
             '<div class="row col-12"> <hr/> </div>'+
             '</div>';
            $('#newinput').append(newRowAdd);
        });
        $("body").on("click", "#DeleteRow", function () {
            $(this).parents("#row").remove();
        })
    </script>

@elseif($type == 'web')
    <script type="text/javascript">
        $("#rowAdder").click(function () {
            newRowAdd =
             '<div id="row" class="row">' +
             '<div class="col-3"><input type="text" class="form-control dir_en" value="" name="key[]"></div>' +
             '<div class="col-4"><textarea type="text" class="form-control dir_ar" value="" name="ar[]"></textarea></div>' +
             '<div class="col-4"><textarea type="text" class="form-control dir_en" value="" name="en[]"></textarea></div>' +
             '<div class="col-1"><button class="btn btn-danger" id="DeleteRow" type="button"><i class="fas fa-trash"></i></button></div>' +
             '<div class="row col-12"> <hr/> </div>'+
             '</div>';
            $('#newinput').append(newRowAdd);
        });
        $("body").on("click", "#DeleteRow", function () {
            $(this).parents("#row").remove();
        })
    </script>
@endif