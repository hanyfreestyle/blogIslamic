<div class="form-group col-lg-4">
    <label class="def_form_label col-form-label font-weight-light">{{$label}}
        <span class="required_Span">*</span>
    </label>
    <div class="input-group my-colorpicker2">
        <input type="text" name="{{$name}}" value="{{$value}}"  class="form-control text-left @error($name) is-invalid @enderror">
        <div class="input-group-append">
            <span class="input-group-text" ><i class="fas fa-square" style="color: {{$value}}" ></i></span>
        </div>
        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ \App\Helpers\AdminHelper::error($message,$name,$label) }}</strong>
        </span>
        @enderror
    </div>
</div>
