<?php

namespace App\View\Components\Site\Js;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LoadWebFont extends Component
{

    public $row;
    public $arFont;
    public $enFont;
    public $fontawesome;
    public $materialicon;

    public function __construct(
        $row = array(),
        $arFont = true,
        $enFont = true,
        $fontawesome = true,
        $materialicon = true,

    )
    {
        $this->row = $row;
        $this->arFont = $arFont;
        $this->enFont = $enFont;
        $this->fontawesome = $fontawesome;
        $this->materialicon = $materialicon;
    }

    public function render(): View|Closure|string
    {
        return view('components.site.js.load-web-font');
    }
}
