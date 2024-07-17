<?php

namespace App\View\Components\Site\Contact;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormOnPage extends Component{

    public $row;
    public $defroute;
    public $formId;

    public $option_7;

    public function __construct(
        $row = array(),
        $defroute = "ContactSaveForm",
        $formId = 'form_1',

        $option_7 = null,
    )
    {
        $this->row = $row;
        $this->defroute = $defroute;
        $this->formId = $formId;


        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string
    {
        return view('components.site.contact.form-on-page');
    }
}
