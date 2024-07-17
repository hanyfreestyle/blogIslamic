<?php

namespace App\View\Components\Site\Html;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmMassage extends Component {

    public $row;
    public $isactive;
    public $addFormError;


    public function __construct(
        $row = array(),
        $isactive = true,
        $addFormError = true,

    ) {
        $this->row = $row;
        $this->isactive = $isactive;
        $this->addFormError = $addFormError;

    }

    public function render(): View|Closure|string {
        return view('components.site.html.confirm-massage');
    }
}
