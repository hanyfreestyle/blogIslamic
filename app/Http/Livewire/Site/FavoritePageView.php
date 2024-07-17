<?php

namespace App\Http\Livewire\Site;

use App\AppPlugin\Customers\Models\UsersCustomersWishList;
use App\AppPlugin\Product\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class FavoritePageView extends Component {

    protected $listeners = ['cart_updated' => 'render'];

    public function render() {

        $UserProfile = Auth::guard('customer')->user();
        $idList = UsersCustomersWishList::where('customer_id',$UserProfile->id)->pluck('product_id');
        $facCount = Cart::instance('wishlist')->content();

        $products = Product::defWep()
            ->whereIn('id', $idList)
            ->with('categories')
            ->with('tags')
            ->with('brand')
            ->orderby('price','desc')
            ->paginate(12);

        return view('livewire.site.favorite-page-view', compact('products','facCount'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   removeFromCart
    public function removeCard($product_id) {
        $UserProfile = Auth::guard('customer')->user();
        $deletePro = UsersCustomersWishList::where('customer_id',$UserProfile->id)->where('product_id',$product_id)->first();
        $deletePro->delete();
        $this->emit('cart_updated');
        Cache::forget('CashWishList');
    }

}
