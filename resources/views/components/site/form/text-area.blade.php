<div class="form-group col-lg-{{$col}} {{$style}}">
  @if($labelView)
    <label for="{{$id}}">{{$label}} @if($req) <span>*</span>@endif</label>
  @endif
  <textarea name="{{$name}}" id="{{$id}}" class="form-control typeTextarea @error($name) is-invalid @enderror" @if($holder) placeholder="{{$holderText}}" @endif >{{$value}}</textarea>
  @error($name)
  <div class="invalid-feedback">
    <strong>{{ \App\Helpers\AdminHelper::error($message,$name,$label) }}</strong>
  </div>
  @enderror
</div>