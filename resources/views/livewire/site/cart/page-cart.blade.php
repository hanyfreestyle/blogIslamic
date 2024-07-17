<div class="kalles-section cart_page_section container mt__20">

  @if(count($cartList) > 0)

    <div class="cart_header">
      <div class="row al_center">
        <div class="col-5">{{__('web/cart.table_product')}}</div>
        <div class="col-2 tc">{{__('web/cart.table_price')}}</div>
        <div class="col-2 tc">{{__('web/cart.table_quantity')}}</div>
        <div class="col-2 tc">{{__('web/cart.table_pro_total')}}</div>
        <div class="col-1 tc tr_md"></div>
      </div>
    </div>

    <div class="col-lg-12 cart_page_loading text-center" wire:loading>
      <img src="{{url('assets/web/img/loading.gif')}}">
    </div>

    <div wire:loading.remove>
      <div class="cart_items js_cat_items">
        @foreach($cartList as $product)
          <div class="cart_item js_cart_item">

            <div class="row al_center">
              <div class="col-12 col-md-12 col-lg-5">
                <div class="page_cart_info flex al_center">
                  <a href="{{productSlugForCart($product)}}">
                    <div class="cart_photo">
                      <img class="lazyload lz_op_ef" src="{{productPhotoForCart($product)}}" alt>
                    </div>
                  </a>

                  <div class="mini_cart_body ml__15">
                    <h5 class="mini_cart_title mg__0 mb__5"><a href="{{productSlugForCart($product)}}">{{$product->name}} {{$product->options->v_name ?? '' }}</a></h5>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-3 col-lg-2 tc">
                <div class="cart_meta_prices price">
                  <div class="cart_price"><span class="dn">{{__('web/cart.table_price')}}</span>  {{number_format($product->price)}} {!! __('web/product.label_currency_s') !!}</div>
                </div>
              </div>
              <div class="col-12 col-md-3 col-lg-2 tc mini_cart_actions">
                <x-temp.cart.but-increase :product="$product"/>
              </div>
              <div class="col-12 col-md-3 col-lg-2 tc">
                <div class="cart_meta_prices price">
                  <div class="cart_price"><span class="dn">{{__('web/cart.table_pro_total')}}</span> {{number_format($product->price * $product->qty)}} {!! __('web/product.label_currency_s') !!} </div>
                  <div class="mini_cart_tool dn remove_mobile">
                    <a href="#" wire:click="removeFromCart({{$product->id}})" class="cart_ac_remove js_cart_rem">
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
              <div class="col-12 col-md-3 col-lg-1 tc d-none d-md-block">
                <div class="mini_cart_tool tc">
                  <a href="#" wire:click="removeFromCart({{$product->id}})" class="cart_ac_remove js_cart_rem">
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
          </div>
        @endforeach
      </div>

      <div class="mt__5 mb__100 row justify-content-md-center">
        <div class="col-lg-12">
          <h5 class="TotalOrder">{{__('web/cart.review_total')}} <span>{{number_format($subtotal)}}  {!! __('web/product.label_currency_s') !!}</span></h5>
        </div>

        <div class="col-lg-12 text-center cart_confirm_but">
            <a href="{{route('Shop_CartConfirm')}}" class="mb__10 btn login">
              <i class="las la-shopping-cart"></i> {{__('web/cart.but_place_order')}}
            </a>
       </div>
      </div>

    </div>


  @else
    <div class="container mb__50">
      <div class="row">
        <div class="col-lg-12">
          <div class="empty_mainPage text-center">
            <i class="las la-shopping-bag pr mb__10"></i>
            <p>{{__('web/cart.title_empty')}}</p>
            <p class="return-to-shop mb__15">
              <a class="button button_primary tu js_add_ld" href="{{route('page_ShopView')}}">{{__('web/cart.but_return')}}</a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <x-temp.footer-icon/>
  @endif
</div>