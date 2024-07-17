<div class="form-group {{$addClass}} col-lg-{{$col}}">
    @if($labelView == true)
        <label class="def_form_label col-form-label label_{{$ldir}} font-weight-light">{{$label}}
            @if($req)<span class="required_Span">*</span>@endif
        </label>
    @endif

    <textarea id="{{$key}}_{{$name}}" class="form-control  dir_{{$tdir}} @error($reqname) is-invalid is_invalid_area_{{$key}} @enderror" rows="5"
              name="{{$key}}[{{$name}}]" @if($holder) placeholder="{{$placeholder}}" @endif>{{$value}}</textarea>

    @if($errors->has($reqname))
        <span class="invalid-feedback" role="alert">
        <strong>{{ str_replace($newreqname, $label, $errors->first($reqname)) }}</strong>
        </span>
    @endif
</div>
