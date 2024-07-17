<?php

namespace App\View\Components\Admin\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class IconWithCount extends Component
{
    public $name ;
    public $icon ;
    public $url ;
    public $count ;

    public function __construct(
        $name = "",
        $icon ="",
        $url ="#",
        $count ="0",

    )
    {
        $this->name = $name ;
        $this->icon = $icon ;
        $this->url = $url ;
        $this->count = $count ;

    }

    public function render(): View|Closure|string
    {
        return view('components.admin.table.icon-with-count');
    }
}
