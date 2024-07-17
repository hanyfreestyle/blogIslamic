<div class="{{$colrow}}  {{$col}}">
    <div class="form-group">
        @if($labelview)
            <label class="def_form_label col-form-label font-weight-light">
                {{$label}}
                @if($req)
                    <span class="required_Span">*</span>
                @endif
            </label>
        @endif

        <select class="form-control select2 custom-select @error($name) is-invalid @enderror " id="{{$name}}" name="{{$name}}"
                style="width: 100%;">
            <option value="">{{$label}}</option>

            @if($selectType == 'normal')

                @foreach ($sendArr as  $key => $value)
                    <option value="{{ $value[$sendid] }}"
                            @if ($value[$sendid] == $sendvalue) selected @endif> @if($addFilde) {{$value[$addFilde]}} @endif {{ $value[$printValName] }}</option>
                @endforeach

            @elseif($selectType == 'ajax')

                @foreach ($sendArr as  $key => $value)
                    <option value="{{ $value[$sendid] }}" @if ($value[$sendid] == $sendvalue) selected @endif>{{ $value[$printValName] }}</option>
                @endforeach

            @elseif($selectType == 'changeLang')
                @foreach ($sendArr as  $key => $value)
                    <option value="{{ $value['id'] }}"
                            @if ($value['id'] == $sendvalue) selected @endif>{!! $value->translate($applang)->name ?? $value->translate($changelang)->name ?? ''!!}</option>
                @endforeach
            @elseif($selectType == 'selActive')
                <option class="status_unactive" value="0" @if ($sendvalue == 0 ) selected @endif>{{__('admin/def.status_unactive')}}</option>
                <option value="1" @if ($sendvalue == 1) selected @endif>{{__('admin/def.status_active')}}</option>
            @elseif($selectType == 'file')
                @foreach($sendArr as $file)
                    <option value="{{$file}}" @if ($file == $sendvalue) selected @endif>{{pathinfo($file, PATHINFO_BASENAME)}}</option>
                @endforeach
            @endif

        </select>
        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ \App\Helpers\AdminHelper::error($message,$name,$label) }}</strong>
        </span>
        @enderror
    </div>

</div>
