<?php

namespace App\View\Components\Site\Def;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Request;
use Illuminate\View\Component;

class ShareButton extends Component
{

    public $row;
    public $links;
    public $facebook;
    public $twitter;
    public $linkedin;
    public $whatsapp;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $row = array(),
        $links = array(),
        $facebook = true,
        $twitter = true,
        $linkedin = true,
        $whatsapp = true,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    )
    {
        $this->row = $row;
        $printName = str_replace(" ","+",$row->name);
        $PageUrl = \Request::fullUrl();
       // $PageUrl = "https://stackoverflow.com";

        $this->facebook = $facebook;
        if ($this->facebook == true){
            $links['facebook'] = 'https://www.facebook.com/sharer/sharer.php?u='.$PageUrl;
        }

        $this->twitter = $twitter;
        if ($this->twitter == true){
            $links['twitter'] = 'https://twitter.com/intent/tweet?text='.$printName.'&url='.$PageUrl;
        }

        $this->linkedin = $linkedin;
        if ($this->linkedin == true){
            $links['linkedin'] = 'https://www.linkedin.com/sharing/share-offsite?mini=true&url='.$PageUrl.'&title='.$printName;
        }

        $this->whatsapp = $whatsapp;
         if ($this->whatsapp == true){
            $links['whatsapp'] = 'https://wa.me/?text='.$PageUrl."%0a".$printName;
        }

        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;

        $this->links = $links;
    }

    public function render(): View|Closure|string
    {
        return view('components.site.def.share-button');
    }
}
