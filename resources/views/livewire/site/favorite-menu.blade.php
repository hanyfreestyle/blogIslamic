<div>
  @if($fromwhere == 'topmenu')
    @if($facCount > 0 )
      <span class="op__0 ts_op pa tcount bgb br__50 cw tc">{{$facCount}}</span>
    @endif
  @endif
  @if($fromwhere == 'footer')
    @if($facCount > 0 )
      <span class="jswcount toolbar_count">{{$facCount}}</span>
    @endif
  @endif
</div>
