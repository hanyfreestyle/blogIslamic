<?php

namespace App\Http\Livewire\Site\Cart;


use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class SidebarCart extends Component {

    protected $listeners = ['update_cart_sidebar' => 'render'];


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function removeFromCart($rowId) {
        $cart = Cart::content();
        $thisId = $cart->where('id', $rowId)->first()->options->this_id ;

        $cart->where('id', $rowId)->first()->rowId;
        Cart::remove($cart->where('id', $rowId)->first()->rowId);
        $this->emit('update_cart_count');
        $this->emit('update_cart_page');
        $this->emit('refreshAddToCardBut' . $thisId);
        $this->emit('refreshAddToCardButHover' . $thisId);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function increaseProduct($rowId) {
        $cart = Cart::content();
        $thisId = $cart->where('id', $rowId)->first()->options->this_id ;
        Cart::update($cart->where('id', $rowId)->first()->rowId, $cart->where('id', $rowId)->first()->qty + 1);
        $this->emit('update_cart_count');
        $this->emit('update_cart_page');
        $this->emit('refreshAddToCardButHover' . $thisId);
        $this->emit('refreshAddToCardBut' . $thisId);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function decreaseProduct($rowId) {
        $cart = Cart::content();
        $thisId = $cart->where('id', $rowId)->first()->options->this_id ;
        Cart::update($cart->where('id', $rowId)->first()->rowId, $cart->where('id', $rowId)->first()->qty - 1);
        $this->emit('update_cart_count');
        $this->emit('update_cart_page');
        $this->emit('refreshAddToCardButHover' . $thisId);
        $this->emit('refreshAddToCardBut' . $thisId);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function render() {
        $cartList = Cart::content();
        $subtotal = Cart::subtotal();

        return view('livewire.site.cart.sidebar-cart')->with([
            'cartList' => $cartList,
            'subtotal' => $subtotal,
        ]);
    }
}
