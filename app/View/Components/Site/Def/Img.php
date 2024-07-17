<?php

namespace App\View\Components\Site\Def;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Img extends Component
{

    public $lazyActive;
    public $type;

    public $row;
    public $name;

    public $alt;

    public $def;
    public $defName;


    public $class;
    public $w;
    public $h;



    public function __construct(
        $lazyActive = true,
        $type = 'Normal',

        $row = array(),
        $name = "photo_thum_1",

        $def = null,
        $defName = "photo_thum_1",



        $alt = "name",

        $class = null,
        $w = null,
        $h = null,

    )
    {
        $this->type = $type;
        $this->lazyActive = $lazyActive;

        $this->alt = $alt;
        $this->row = $row;
        $this->name = $name;

        $this->def = $def;
        $this->defName = $defName;

        $this->name = $name;
        $this->class = $class;
        $this->w = $w;
        $this->h = $h;

    }


    public function render(): View|Closure|string
    {
        return view('components.site.def.img');
    }
}
