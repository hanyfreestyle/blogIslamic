<div class="form-group col-lg-{{$col}} {{$style}}">
  @if($labelView)
    <label for="{{$id}}">{{$label}} @if($req) <span>*</span>@endif</label>
  @endif
  <select id="{{$id}}" name="{{$name}}" class="form-control @error($name) is-invalid @enderror">
    @if($holder)
      <option value="">{{$holderText}}</option>
    @endif
    @if($type == 'normal')
      @foreach ($sendArr as  $key => $value)
        <option value="{{ $value[$sendid] }}" @if ($value[$sendid] == $sendvalue) selected @endif>{{ $value[$printValName] }}</option>
      @endforeach
    @endif
  </select>

  @error($name)
  <div class="invalid-feedback">
    <strong>{{ \App\Helpers\AdminHelper::error($message,$name,$label) }}</strong>
  </div>
  @enderror
</div>