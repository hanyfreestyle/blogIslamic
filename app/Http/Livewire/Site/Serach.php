<?php

namespace App\Http\Livewire\Site;

use App\AppPlugin\Product\Models\Product;
use Livewire\Component;

class Serach extends Component {

    public $search;
    public $type = 'on_page';
    public $open = 1;

//    protected $queryString = ['search'];


    public function render() {
        if($this->search != null and trim(strlen($this->search)) > 2) {
            $this->open = 0;
            $products = Product::whereTranslationLike('name', '%' . trim($this->search) . '%')->take(30)->get();
        } else {
            $this->open = 1;
//            $products = Product::where('id',0)->take(30)->get();
            $products = [];
        }

        return view('livewire.site.serach', compact('products'));
    }
}
