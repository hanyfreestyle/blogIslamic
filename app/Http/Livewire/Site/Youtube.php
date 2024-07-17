<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;

class Youtube extends Component
{
    public $view = false;
    public $vcode ;
    public $title ;

    public function render()
    {
        return view('livewire.site.youtube');
    }

    public function loadVideo(){
        $this->view = true;
    }

}
