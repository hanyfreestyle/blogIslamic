<?php

namespace App\View\Components\Site\Contact;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Phattarachai\LaravelMobileDetect\Agent;

class CallToActionButton extends Component
{

    public $unit;
    public $viewType;
    public $config;

    public $callhref;
    public $whatsapphref;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $unit = array(),
        $viewType = '',
        $config = array(),

        $callhref = null,
        $whatsapphref = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    )
    {
        $this->unit = $unit;
        $this->viewType = $viewType;
        $this->config = $config;


        $agent = new Agent();
        $this->callhref = "tel:".$config->phone_call;


        $Brek = "%0a";
        $GetMass = "";

        if ($this->unit != null){
            $GetMass .= __('web/contact.mass_whatsapp_1')." ".$unit->name.$Brek;
            $GetMass .= __('web/contact.mass_whatsapp_2')." ".$unit->id.$Brek.$Brek;
            $GetMass .= __('web/contact.mass_whatsapp_3');

        }else{
            $GetMass .= __('web/contact.mass_whatsapp_1')." ".$Brek;
        }
        $Mass = str_replace(" ","+",$GetMass);
        $Mass = str_replace("*","%2A",$Mass);
        $Mass = str_replace("#","%23",$Mass);
        $Whatsapp_Url = 'https://api.whatsapp.com/send/?phone='.$config->whatsapp_send.'&text='.$Mass;
        $this->whatsapphref = $Whatsapp_Url ;


        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string
    {
        return view('components.site.contact.call-to-action-button');
    }
}
