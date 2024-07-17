<div>
    @if($product->on_stock )
        <x-temp.cart.price-print :price="$product_price" :regular-price="$product_regular_price"/>
    @else
        <div class="product_info">
            <div class="mb__5 print_price">
                {{__('web/product.label_out_of_stock')}}
            </div>
        </div>
    @endif
    @if($viewDes)
        <div class="pr_short_des">
            <p class="mg__0"> {!! $productInfo['short_des'] !!}</p>
        </div>
    @endif


    @if($product->on_stock )
        <div wire:loading>
            <div class="col-lg-12 w_100 text-center d-block">
                <img src="{{url('assets/web/img/loading_cart.gif')}}">
            </div>
        </div>

        <div class="dnX" wire:loading.remove>

            @foreach ($product->attributes as $attribute)
                @if($attribute->pivot->values != null)
                    <h3 class="radio_inputs_h3">{{ucfirst($attribute->name)}}</h3>
                    <div class="radio-inputs">
                        @foreach ($values->whereIn('id',json_decode($attribute->pivot->values, true)) as $value)
                            <label>
                                <input wire:click="updateVariant()" wire:model="variants.{{$attribute->id}}" type="radio" value="{{$value->id}}" class="radio-input">
                                <span class="radio-tile"><span class="radio-label">{{ucfirst($value->name)}}</span></span>
                            </label>
                        @endforeach
                    </div>
                @endif
            @endforeach
            {{--        {{$variants_slug}}--}}

            @if($simpleProduct == true)
                @if($cart->where('id', $product->id)->count())
                    <x-temp.cart.but-increase-add-to-cart :cart="$cart" :product-id="$product->id"/>
                @else
                    <button wire:click="addSimpleProduct({{$product->id}})" data-time="6000" data-ani="shake"
                            class="add_to_cart_button button truncate w__100 mt__20 order-4 d-inline-block animated">
                        <span class="txt_add ">{{__('web/product.but_add_to_cart')}}</span>
                    </button>
                @endif
            @else

                @if($variantsProduct == true)
                    @if($cart->where('id', $variants_id)->count())
                        <x-temp.cart.but-increase-add-to-cart :cart="$cart" :product-id="$variants_id"/>
                    @else
                        <button wire:click="addVariantsProduct({{$variants_id}})" wire:loading.remove data-time="6000" data-ani="shake"
                                class="add_to_cart_button button truncate w__100 mt__20 order-4 d-inline-block animated">
                            <span class="txt_add">{{__('web/product.but_add_to_cart')}}</span>
                        </button>
                    @endif
                @else
                    <div class="btn btn_disabled w-100">{{__('web/product.but_add_to_cart')}}</div>
                @endif

            @endif
        </div>

    @endif


</div>
