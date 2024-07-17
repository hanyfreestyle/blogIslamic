<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class FilterBlank extends Component {

    public $row;
    public $formName;
    public $getSessionData;


    public function __construct(
        $row = array(),
        $formName = null,


    ) {
        $this->row = $row;
        $this->formName = $formName;
        $this->getSessionData = Session::get($this->formName);
    }

    public function render(): View|Closure|string {
        return view('components.admin.form.filter-blank');
    }
}
