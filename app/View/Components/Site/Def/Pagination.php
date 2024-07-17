<?php

namespace App\View\Components\Site\Def;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pagination extends Component
{
    public $rows;

    public function __construct(
        $rows =array(),
    )
    {
        $this->rows = $rows ;
    }

    public function render(): View|Closure|string
    {
        return view('components.site.def.pagination');
    }
}
