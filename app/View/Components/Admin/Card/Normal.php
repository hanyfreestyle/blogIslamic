<?php

namespace App\View\Components\Admin\Card;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Normal extends Component
{
    public $row;
    public $isactive;
    public $col;
    public $outline;
    public $outline_style;
    public $title;


    public function __construct(
        $row = array(),
        $isactive = true,
        $col = "col-lg-12",
        $outline = true,
        $outline_style = "card-outline",
        $title = null,

    )
    {
        $this->row = $row;
        $this->isactive = $isactive;
        $this->col = $col;
        $this->outline = $outline;
        $this->outline_style = $outline_style;
        $this->title = $title;
        if($this->outline == false){
            $this->outline_style = "";
        }

    }

    public function render(): View|Closure|string
    {
        return view('components.admin.card.normal');
    }
}
