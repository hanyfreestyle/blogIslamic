<?php

namespace App\View\Components\Admin\Hmtl;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmMassage extends Component {

    public function __construct() {

    }


    public function render(): View|Closure|string {
        return view('components.admin.hmtl.confirm-massage');
    }
}
