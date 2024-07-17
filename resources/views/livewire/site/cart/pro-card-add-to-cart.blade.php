<div>
  @if($cart->where('id', $product->id)->count())

      <x-temp.cart.but-increase-add-to-cart :from-card="true" :cart="$cart" :product-id="$product->id"/>

  @else
    <a wire:click="AddToCart({{$product->id}})" wire:loading.remove class="pr pr_atc cd br__40 bgw tc dib cb chp ttip_nt tooltip_top_left">
      <span class="tt_txt">{{__('web/product.but_quick_shop')}}</span>
      <i class="iccl iccl-cart"></i><span>{{__('web/product.but_quick_shop')}}</span>
    </a>
  @endif

</div>
