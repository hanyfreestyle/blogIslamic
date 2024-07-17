<div class="form-group {{$addClass}} col-lg-{{$col}}">
  @if($labelView == true)
    <label class="def_form_label col-form-label label_{{$ldir}} font-weight-light">{{$label}}
      @if($req)<span class="required_Span">*</span>@endif
    </label>
  @endif

  <input id="{{$id}}" type="text" class="form-control dir_{{$tdir}} @error($reqname) is-invalid is_invalid_{{$key}} @enderror"
         name="{{$key}}[{{$name}}]" @if($holder)  placeholder="{{$placeholder}}" @endif value="{{$value}}">

  @if($errors->has($reqname))
    <span class="invalid-feedback" role="alert">
        <strong>{{ str_replace($newreqname, $label, $errors->first($reqname)) }}</strong>
        </span>
  @endif
</div>
