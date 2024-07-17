<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormDef extends Component {

    public $formRoute;
    public $printErr;
    public $pageData;
    public $fullErr;
    public $option_3;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $formRoute = null,
        $printErr = true,
        $pageData = array(),
        $fullErr = null,
        $option_3 = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->formRoute = $formRoute;
        $this->printErr = $printErr;
        $this->pageData = $pageData;
        $this->fullErr = $fullErr;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.admin.form.form-def');
    }
}
