<?php

namespace App\Http\Livewire\Site\Cart;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class MenuIcon extends Component {

    protected $listeners = ['update_cart_count' => 'render'];

    public $from = 'header';

    public function render() {
        $cart_count = Cart::content()->count();

        if($cart_count > 99) {
            $cart_count = 99;
        }
        return view('livewire.site.cart.menu-icon', compact('cart_count'));
    }

}
