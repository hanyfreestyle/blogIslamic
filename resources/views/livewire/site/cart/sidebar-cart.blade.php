<div class="mini_cart_wrap">

  <div class="mini_cart_content fixcl-scroll">

    <div class="col-lg-12 mt__70 search_loading text-center" wire:loading>
      <img src="{{url('assets/web/img/loading.gif')}}">
    </div>

    <div class="fixcl-scroll-content" wire:loading.remove>

      {{--      <div class="cart_threshold cart_thres_js">--}}
      {{--        <div class="cart_thres_2">--}}
      {{--          <span class="cr fwm">{{__('web/cart.mass_free_1')}}</span> {{__('web/cart.mass_free_2')}}--}}
      {{--          <span class="cr fwm mn_thres_js">{{$WebConfig['pro_free_shipping_amount']}} {!! __('web/product.label_currency_s') !!}</span>--}}
      {{--        </div>--}}
      {{--      </div>--}}

      @if(count($cartList) == 0)
        <div class="empty tc mt__70"><i class="las la-shopping-bag pr mb__10"></i>
          <p>{{__('web/cart.title_empty')}}</p>
          <p class="return-to-shop mt__30 mb__15">
            <a class="button button_primary tu js_add_ld" href="{{route('page_ShopView')}}">{{__('web/cart.but_return')}}</a>
          </p>
        </div>
      @else
        <div class="mini_cart_items js_cat_items_x lazyload">
          @foreach($cartList as $product)
            <div class="mini_cart_item flex  al_center pr oh">
              <a href="{{productSlugForCart($product)}}" class="mini_cart_img">
                <img class="w__100 lazyload"  width="120" height="153" src="{{productPhotoForCart($product)}}">
              </a>
              <div class="mini_cart_info">
                <a href="{{productSlugForCart($product)}}" class="mini_cart_title truncate">{{$product->name}} {{$product->options->v_name ?? '' }}</a>
                <div class="mini_cart_meta">
                  <div class="cart_meta_price price">
                    <div class="cart_price cart_price_sidebar">
                      @if($product->options->sale_price)
                        <del>{{ number_format($product->options->sale_price) }} {!! __('web/product.label_currency_s') !!}</del>
                      @endif
                      <ins>{{number_format($product->options->price)}} {!! __('web/product.label_currency_s') !!}</ins>
                    </div>
                  </div>
                </div>
                <div class="mini_cart_actions mini_cart_actions_side_bar">
                  <x-temp.cart.but-increase :product="$product"/>
                  <a href="#" wire:click="removeFromCart({{$product->id}})" class="cart_ac_remove">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="3 6 5 6 21 6"></polyline>
                      <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                      <line x1="10" y1="11" x2="10" y2="17"></line>
                      <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
  @if(count($cartList) > 0)
    <div class="mini_cart_footer js_cart_footer">
      <div class="total row fl_between al_center">
        <div class="col-auto"><strong>{{__('web/cart.title_subtotal')}}</strong></div>
        <div class="col-auto tr js_cat_ttprice">
          <div class="cart_tot_price">{{number_format($subtotal)}}  {!! __('web/product.label_currency_s') !!}</div>
        </div>
      </div>
      <a href="{{route('Shop_CartView')}}" class="button btn-cart mt__10 mb__10 js_add_ld d-inline-flex justify-content-center align-items-center cd-imp">{{__('web/cart.but_view_cart')}}</a>
      <a href="{{route('Shop_CartConfirm')}}"
         class="button btn-checkout mt__10 mb__10 js_add_ld d-inline-flex justify-content-center align-items-center text-white">{{__('web/cart.but_place_order')}}</a>
    </div>
  @endif

</div>
