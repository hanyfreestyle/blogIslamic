<?php

namespace App\Http\Livewire\Site\Cart;

use App\AppPlugin\Product\Models\AttributeValue;

use App\AppPlugin\Product\Models\Product;
use App\Http\Controllers\WebMainController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddToCartBut extends Component {

    public $productInfo;
    public $product_price;
    public $product_regular_price;
    public $product;
    public $variants = array();

    public $simpleProduct = false;
    public $variantsProduct = false;
    public $variant_id;
    public $viewDes = true;
    public $variants_id = 0;
    public $variants_slug = 'hany';


//    public $variants_id = null;

    public function getListeners() {
        return $this->listeners + ['refreshAddToCardBut' . $this->product->id => 'render',];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function mount() {
        $this->product_price = $this->product->price;
        $this->product_regular_price = $this->product->regular_price;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function render() {

        $values = WebMainController::CashAttributeValueList();
        $cart = Cart::content();


        if(count($this->product->attributes) == 0) {
            $this->simpleProduct = true;
        } else {
            if(count($this->variants) == 0) {
                $this->variantsProduct = false;
            }
        }

        return view('livewire.site.cart.add-to-cart-but', compact('values', 'cart'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function updateVariant() {

        $variants = $this->variants;
        sort($variants);
        $variants_slug = implode('-', $variants);
        $variants_slug = "-" . $variants_slug . "-";

        $productAdd = Product::where('parent_id', $this->product->id)->where('variants_slug_id', $variants_slug)
            ->with('mainPro')->first();

//        $this->variants_slug = $variants_slug;

        if($productAdd != null) {
            $this->variantsProduct = true;
            $this->variants_id = $productAdd->id;
            $this->product_price = $productAdd->price;
            $this->product_regular_price = $productAdd->regular_price;
        } else {
            $this->variantsProduct = false;
            $this->product_price = $this->product->price;
            $this->product_regular_price = $this->product->regular_price;
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function addSimpleProduct() {
        Cart::add($this->product->id, $this->product->name, 1, $this->product->price, [
            'price' => $this->product->price,
            'regular_price' => $this->product->regular_price,
            'this_id' => $this->product->id,
        ])->associate('App\AppPlugin\Product\Models\Product');

        $this->emit('update_cart_count');
        $this->emit('update_cart_sidebar');
        $this->emit('refreshAddToCardBut' . $this->product->id);
        $this->emit('refreshAddToCardButHover' . $this->product->id);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function increaseProduct($rowId) {
        $cart = Cart::content();
        $thisId = $cart->where('id', $rowId)->first()->options->this_id;
        Cart::update($cart->where('id', $rowId)->first()->rowId, $cart->where('id', $rowId)->first()->qty + 1);
        $this->emit('update_cart_count');
        $this->emit('update_cart_sidebar');
        $this->emit('refreshAddToCardBut' . $thisId);
        $this->emit('refreshAddToCardButHover' . $thisId);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function decreaseProduct($rowId) {
        $cart = Cart::content();
        $thisId = $cart->where('id', $rowId)->first()->options->this_id;
        Cart::update($cart->where('id', $rowId)->first()->rowId, $cart->where('id', $rowId)->first()->qty - 1);
        $this->emit('update_cart_count');
        $this->emit('update_cart_sidebar');
        $this->emit('refreshAddToCardBut' . $thisId);
        $this->emit('refreshAddToCardButHover' . $thisId);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function removeFromCart($rowId) {
        $cart = Cart::content();
        $thisId = $cart->where('id', $rowId)->first()->options->this_id;
        $cart->where('id', $rowId)->first()->rowId;
        Cart::remove($cart->where('id', $rowId)->first()->rowId);
        $this->emit('update_cart_count');
        $this->emit('update_cart_sidebar');
        $this->emit('refreshAddToCardBut' . $thisId);
        $this->emit('refreshAddToCardButHover' . $thisId);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function addVariantsProduct($variants_id) {
        $productAdd = Product::where('id', $variants_id)->with('mainPro')->first();
        $values = WebMainController::CashAttributeValueList();

        $productVariants = explode('-', $productAdd->variants_slug_id);
        $text = " - ";
        foreach ($productVariants as $variant) {
            if(intval($variant) > 0){
                $text .= $values->where('id', $variant)->first()->name . " -";
            }
        }
        $text = rtrim($text, " -");


        Cart::add($productAdd->id, $productAdd->mainPro->name, 1, $productAdd->price, [
            'price' => $productAdd->price,
            'regular_price' => $productAdd->regular_price,
            'v_name' => $text,
            'this_id' => $productAdd->parent_id,
        ])->associate('App\AppPlugin\Product\Models\Product');

        $this->emit('update_cart_count');
        $this->emit('update_cart_sidebar');
        $this->emit('refreshAddToCardBut' . $productAdd->parent_id);

    }


}
