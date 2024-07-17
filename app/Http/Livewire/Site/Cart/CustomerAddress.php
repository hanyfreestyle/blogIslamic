<?php

namespace App\Http\Livewire\Site\Cart;


use App\AppPlugin\Customers\Models\UsersCustomersAddress;
use Livewire\Component;

class CustomerAddress extends Component {

    public $addresses;
    public $city_id = '';
    public $printAddress;

    public function mount() {
        foreach ($this->addresses as $address) {
            if($address->is_default == 1) {
                $this->printAddress = $address;
            }
        }
    }

    public function render() {
        return view('livewire.site.cart.customer-address');
    }

    public function changeEvent($value) {

        $address = UsersCustomersAddress::where('uuid', $value)
            ->first();
        $this->printAddress = $address;
    }
}
