<div class="callout {{$color}} reject_mass">
  <h5><i class="{{$icon}}"></i> {{$title}}</h5>
  @foreach($order->orderlog as $log)
    <div class="log_info">

      <p class="log_ref">
        {{__('admin/orders.log_ref_'.$log->log_ref)}}
      </p>

      <p><span>{{__('admin/orders.log_span_user')}}</span> {{$log->user->name}}</p>
      <p><span>{{__('admin/orders.log_span_date')}}</span> {{$log->add_date}}</p>

      @if($order->invoice_number)
        <p><span>{{__('admin/orders.log_invoce_num')}}</span> {{$order->invoice_number}}</p>
      @endif

      @if($log->notes)
        <p>{{$log->notes}}</p>
      @endif
    </div>
  @endforeach
</div>

