<?php

namespace App\View\Components\Admin\Lang;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddNewList extends Component
{

    public $pageData;
    public $isactive;

    public function __construct(
        $pageData = array(),
        $isactive = true,
    )
    {
        $this->pageData = $pageData;
        $this->isactive = $isactive;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.lang.add-new-list');
    }
}
