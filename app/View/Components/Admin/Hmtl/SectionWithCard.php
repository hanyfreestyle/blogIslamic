<?php

namespace App\View\Components\Admin\Hmtl;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SectionWithCard extends Component
{

    public function __construct(

    )
    {

    }


    public function render(): View|Closure|string
    {
        return view('components.admin.hmtl.section-with-card');
    }
}
