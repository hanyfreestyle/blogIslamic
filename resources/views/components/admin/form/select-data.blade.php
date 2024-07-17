<div class="{{$col}}">
    <div class="form-group">
        @if($labelview)
            <label class="def_form_label col-form-label font-weight-light">
                {{$label}}
                @if($req)
                    <span class="required_Span">*</span>
                @endif
            </label>
        @endif

        <select class="form-control select2 custom-select @error($name) is-invalid @enderror " id="{{$id}}" name="{{$name}}" style="width: 100%;">
            <option value="">{{$label}}</option>
            @foreach ($sendArr as  $key => $value)

                @if($value['is_active'] or $value[$sendid] == $sendvalue )
                    <option value="{{ $value[$sendid] }}" @if ($value[$sendid] == $sendvalue) selected @endif>{{ $value[$printName] }}</option>
                @endif

            @endforeach
        </select>

        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ \App\Helpers\AdminHelper::error($message,$name,$label) }}</strong>
        </span>
        @enderror

    </div>
</div>
