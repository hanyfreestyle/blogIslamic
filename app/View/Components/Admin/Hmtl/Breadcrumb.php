<?php

namespace App\View\Components\Admin\Hmtl;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{

    public $pageData = array();
    public $butView ;
    public function __construct(
        $pageData = array(),
        $butView = true ,
    )
    {
        $this->pageData = $pageData;
        $this->butView = $butView ;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.hmtl.breadcrumb');
    }
}
