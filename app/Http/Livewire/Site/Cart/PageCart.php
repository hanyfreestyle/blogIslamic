<?php

namespace App\Http\Livewire\Site\Cart;


use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class PageCart extends Component {

    protected $listeners = ['update_cart_page' => 'render'];

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function removeFromCart($rowId) {
        $cart = Cart::content();
        $cart->where('id', $rowId)->first()->rowId;
        Cart::remove($cart->where('id', $rowId)->first()->rowId);
        $this->emit('update_cart_count');
        $this->emit('update_cart_sidebar');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function increaseProduct($rowId) {
        $cart = Cart::content();
        Cart::update($cart->where('id', $rowId)->first()->rowId, $cart->where('id', $rowId)->first()->qty + 1);
        $this->emit('update_cart_count');
        $this->emit('update_cart_sidebar');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function decreaseProduct($rowId) {
        $cart = Cart::content();
        Cart::update($cart->where('id', $rowId)->first()->rowId, $cart->where('id', $rowId)->first()->qty - 1);
        $this->emit('update_cart_count');
        $this->emit('update_cart_sidebar');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function render() {

        $cartList = Cart::content();
        $subtotal = Cart::subtotal();

        $cartErr = '0';
        $Mass = "";
        $Brek = "%0a";
        $Brek = '<br/>';

        foreach ($cartList as $ProductCart) {
            $Mass .= $ProductCart->name . $Brek;
            $Mass .= $ProductCart->model->sku . $Brek;
            $Mass .= number_format($ProductCart->price) . "x" . $ProductCart->qty . $Brek;
        }

        $Mass .= '---------------------' . $Brek;
        $Mass .= number_format($subtotal) . $Brek;

        $whatsappMass = str_replace(" ", "%20", $Mass);

        return view('livewire.site.cart.page-cart')->with([
            'cartList' => $cartList,
            'subtotal' => $subtotal,
            'whatsappMass' => $whatsappMass,
            'cartErr' => $cartErr,
        ]);

    }
}
