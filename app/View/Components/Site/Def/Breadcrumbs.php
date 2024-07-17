<?php

namespace App\View\Components\Site\Def;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumbs extends Component
{

    public function __construct()
    {

    }


    public function render(): View|Closure|string
    {
        return view('components.site.def.breadcrumbs');
    }
}
