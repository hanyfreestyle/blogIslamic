<?php

namespace App\View\Components\Admin\Photofilter;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextSetting extends Component
{

    public $row;
    public $isactive;

    public function __construct(
        $row = array(),
        $isactive = true,
    )
    {
        $this->row = $row;
        $this->isactive = $isactive;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.photofilter.text-setting');
    }
}
