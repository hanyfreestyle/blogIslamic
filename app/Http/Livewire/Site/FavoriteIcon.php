<?php

namespace App\Http\Livewire\Site;

use App\AppPlugin\Customers\Models\UsersCustomersWishList;
use App\AppPlugin\Product\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class FavoriteIcon extends Component {

    public $product;
    public $fromwhere = 'card';

    public function getListeners() {
        return $this->listeners + ['refreshIcon' . $this->product->id => 'render',];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #       render
    public function render() {
        if(Auth::guard('customer')->check()) {
            $UserProfile = Auth::guard('customer')->user();

            $wishList = Cache::remember('CashWishList', cashDay(7), function () use($UserProfile) {
                return UsersCustomersWishList::where('customer_id', $UserProfile->id)->get();;
            });

            return view('livewire.site.favorite-icon', ['wishList' => $wishList]);
        }else{
            return view('livewire.site.favorite-icon', ['wishList' => 'login']);
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   addToWishList
    public function addToWishList($product_id) {
        if(Auth::guard('customer')->check()) {
            $UserProfile = Auth::guard('customer')->user();
            $saveData = UsersCustomersWishList::where('customer_id',$UserProfile->id)->where('product_id',$product_id)->firstOrNew();
            $saveData->customer_id = $UserProfile->id ;
            $saveData->product_id = $product_id ;
            $saveData->save() ;
            $this->emit('cart_updated');
            $this->emit('refreshIcon' . $product_id);
            Cache::forget('CashWishList');
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   removeFromWishList
    public function removeFromWishList($product_id) {
        if(Auth::guard('customer')->check()) {
            $UserProfile = Auth::guard('customer')->user();
            $saveData = UsersCustomersWishList::where('customer_id',$UserProfile->id)->where('product_id',$product_id)->first();
            if($saveData){
                $saveData->delete() ;
            }
            $this->emit('cart_updated');
            $this->emit('refreshIcon' . $product_id);
            Cache::forget('CashWishList');
        }
    }

}
