<?php

namespace App\View\Components\Admin\Lang;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddNewButton extends Component {
    public $row;
    public $modelid;
    public $tip;

    public function __construct(
        $row = array(),
        $modelid = null,
        $tip = true,
    ) {
        $this->row = $row;
        $this->modelid = $modelid;
        $this->tip = $tip;
    }

    public function render(): View|Closure|string {
        return view('components.admin.lang.add-new-button');
    }
}
