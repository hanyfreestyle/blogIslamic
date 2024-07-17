<div class="{{$colrow}}">
    <div class="form-group row">
        <label class="def_form_label col-lg-5 font-weight-light ">{{$label}}</label>
        <div class="col-lg-7 pl-2 pr-2">
            <div class="custom-control custom-switch custom-switch-sm">
                <input  type="checkbox" name="{{$name}}" @if($value == '1' or $value == 'on') checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
            </div>
        </div>
    </div>
</div>
