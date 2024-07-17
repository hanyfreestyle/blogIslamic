<div class="{{$noLabel}} form-group {{$colrow}} {{($horizontalLabel) ? 'row' : '' }} {{$topclass}}">
    @if ($labelview)
        <div class="{{($horizontalLabel) ? 'col-sm-6' : '' }}">
            <label class="def_form_label col-form-label label_{{$dir}} font-weight-light {{($horizontalLabel) ? 'font-weight-normal' : '' }}" for="{{$id}}">{{$label}}
                @if($req)
                    <span class="required_Span">*</span>
                @endif
            </label>
        </div>
    @endif

    <div class="{{($horizontalLabel) ? 'col-sm-6' : '' }}">
        <input type="{{$type}}" class="{{$inputclass}} {{$tdir}} form-control  @error($name) is-invalid @enderror"
               id="{{$id}}" name="{{$name}}"  @if($placeholder) placeholder="{{$label}}" @endif
               @if(!is_null($step))
               step="{{$step}}"
               @endif
               @if(!is_null($max))
               max="{{$max}}"
               @endif
               @if(!is_null($maxlength))
               maxlength="{{$maxlength}}"
               @endif
               @if(!is_null($pattern))
               pattern="{{$pattern}}"
               @endif
               value="{{$value}}"
               {{($required) ? 'required' : '' }}
               {{($disabled) ? 'disabled' : '' }}
{{--               dir="auto"--}}
               @if($type == 'password')
               autocomplete="off" readonly onfocus="this.removeAttribute('readonly');"
            @endif
        >
        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ \App\Helpers\AdminHelper::error($message,$name,$label) }}</strong>
        </span>
        @enderror

    </div>
</div>
