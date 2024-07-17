<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormSection extends Component {

    public $rowData;
    public $pageData;
    public $fullErr;
    public $newRoute;
    public $printErr;

    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $rowData = array(),
        $pageData = null,
        $fullErr = false,
        $newRoute = null,
        $printErr = true,

        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->rowData = $rowData;
        $this->pageData = $pageData;
        $this->fullErr = $fullErr;
        $this->newRoute = $newRoute;
        $this->printErr = $printErr;


        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.admin.form.form-section');
    }
}
