<?php

namespace App\Http\Livewire\Site\Cart;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProCardAddToCart extends Component {

    public $product;

    public function getListeners() {
        return $this->listeners + ['refreshAddToCardButHover' . $this->product->id => 'render',];
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
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   AddToCart
    public function AddToCart() {

        Cart::add($this->product->id, $this->product->name, 1, $this->product->price, [
            'price' => $this->product->price,
            'regular_price' => $this->product->regular_price,
            'this_id' => $this->product->id,
        ])->associate('App\AppPlugin\Product\Models\Product');

        $this->emit('update_cart_count');
        $this->emit('update_cart_sidebar');
        $this->emit('refreshAddToCardBut' . $this->product->id);
    }

    public function render() {
        $cart = Cart::content();
        return view('livewire.site.cart.pro-card-add-to-cart',compact('cart'));
    }
}
