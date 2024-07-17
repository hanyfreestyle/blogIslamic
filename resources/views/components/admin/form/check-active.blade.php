<div class="{{$col}}">
  <div class="form-group clearfix">
    <div class="icheck-primary d-inline">
      @if($pageView == "Add")
        <input name="{{$name}}" id="{{$name}}" class="icheck-primary d-inline"  type="checkbox" @if($defstatus) checked="" @endif  >
      @else
        <input name="{{$name}}" id="{{$name}}" class="icheck-primary d-inline" type="checkbox" @if($row->$name) checked="" @endif>
      @endif
      <label for="{{$name}}"></label>
      <span class="font-weight-bold">{{$lable}}</span>
    </div>
  </div>
</div>
