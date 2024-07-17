<div class="form-group {{$col}} {{$topclass}}">
    @if ($labelview)
        <label class="def_form_label font-weight-light " for="{{$id}}">{{$label}}
            @if($req)
                <span class="required_Span">*</span>
            @endif
        </label>
    @endif

    <textarea class="form-control {{$inputclass}} @error($name) is-invalid @enderror" rows="{{$rows}}" id="{{$id}}" name="{{$name}}"
              @if($placeholder) placeholder="{{$label}}" @endif {{($required) ? 'required' : '' }}{{($disabled) ? 'disabled' : '' }}>{{$value}}
    </textarea>
    @error($name)
    <span class="invalid-feedback" role="alert">
            <strong> {{ \App\Helpers\AdminHelper::error($message,$name,$label)  }}</strong>
        </span>
    @enderror
</div>
