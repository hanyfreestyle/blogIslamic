@if($from == 'header')
  @if(Route::currentRouteName() == 'Shop_CartConfirm' or Route::currentRouteName() == 'Shop_CartView')
    @if($cart_count == 0)
      <a class="pr cb chp db" href="{{route('Shop_CartView')}}">
        <i class="las la-shopping-cart pr"></i>
      </a>
    @else
      <a class="pr cb chp db" href="{{route('Shop_CartView')}}">
        <i class="las la-shopping-cart pr">
          <span class="op__0 ts_op pa tcount bgb br__50 cw tc">{{$cart_count}}</span>
        </i>
      </a>
    @endif
  @else
    @if($cart_count == 0)
      <a class="push_side pr cb chp db" href="#" data-id="#nt_cart_canvas">
        <i class="las la-shopping-cart pr"></i>
      </a>
    @else
      <a class="push_side pr cb chp db" href="#" data-id="#nt_cart_canvas">
        <i class="las la-shopping-cart pr">
          <span class="op__0 ts_op pa tcount bgb br__50 cw tc">{{$cart_count}}</span>
        </i>
      </a>
    @endif
  @endif


@elseif($from == 'footer')
  @if(Route::currentRouteName() == 'Shop_CartConfirm' or Route::currentRouteName() == 'Shop_CartView')
    @if($cart_count == 0)
      <a href="{{route('Shop_CartView')}}">
        <div class="toolbar_icon"></div>
        <span class="kalles_toolbar_label">{{__('web/menu.sticky_cart')}}</span>
      </a>
    @else
      <a href="{{route('Shop_CartView')}}">
        <div class="toolbar_icon"><span class="jsccount toolbar_count">{{$cart_count}}</span></div>
        <span class="kalles_toolbar_label">{{__('web/menu.sticky_cart')}}</span>
      </a>
    @endif

  @else
    @if($cart_count == 0)
      <a href="#" class="push_side" data-id="#nt_cart_canvas">
        <div class="toolbar_icon"></div>
        <span class="kalles_toolbar_label">{{__('web/menu.sticky_cart')}}</span>
      </a>
    @else
      <a href="#" class="push_side" data-id="#nt_cart_canvas">
        <div class="toolbar_icon"><span class="jsccount toolbar_count">{{$cart_count}}</span></div>
        <span class="kalles_toolbar_label">{{__('web/menu.sticky_cart')}}</span>
      </a>
    @endif
  @endif

@endif
