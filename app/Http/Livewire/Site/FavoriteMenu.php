<?php

namespace App\Http\Livewire\Site;

use App\AppPlugin\Customers\Models\UsersCustomersWishList;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FavoriteMenu extends Component {

    public $fromwhere = 'topmenu';

    protected $listeners = ['cart_updated' => 'render'];

    public function render() {

        if(Auth::guard('customer')->check()){
            $UserProfile = Auth::guard('customer')->user();
            $facCount = UsersCustomersWishList::where('customer_id',$UserProfile->id)->count();
        }else{
            $facCount = "";
        }

        if($facCount > 99) {
            $facCount = 99;
        }
        return view('livewire.site.favorite-menu')->with(["facCount" => $facCount]);
    }
}
