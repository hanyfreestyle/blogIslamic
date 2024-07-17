<?php

namespace App\View\Components\Site\Contact;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{

    public $row;
    public $formType;
    public $formTitle;
    public $requestType;
    public $colrow;
    public $defroute;

    public $option_6;
    public $option_7;

    public function __construct(
        $row = array(),
        $formType = 'contact',
        $formTitle = '',
        $requestType = null,
        $colrow = "col-lg-6 col-12",
        $defroute = "ContactSaveForm",


        $option_6 = null,
        $option_7 = null,
    )
    {
        $this->row = $row;
        $this->formType = $formType;
        $this->colrow = $colrow;

        if($this->formType == 'contact'){
            $this->formTitle = __('web/contact.form_h1_contact');
            $this->requestType = 1;
        }elseif ($this->formType == 'request'){
            $this->formTitle =__('web/contact.form_h1_request');
            $this->requestType = 2;
        }elseif ($this->formType == 'meeting'){
            $this->formTitle = __('web/contact.form_h1_meeting');
            $this->requestType = 3;
        }






        $this->defroute = $defroute;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string
    {
        return view('components.site.contact.form');
    }
}
