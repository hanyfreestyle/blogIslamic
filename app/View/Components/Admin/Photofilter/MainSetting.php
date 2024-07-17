<?php

namespace App\View\Components\Admin\Photofilter;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainSetting extends Component
{
    public $row;
    public $isactive;
    public $rowDataSize;

    public function __construct(
        $row = array(),
        $rowDataSize = array(),
        $isactive = true,
    )
    {
        $this->row = $row;
        $this->rowDataSize = $rowDataSize;
        $this->isactive = $isactive;
    }
    public function render(): View|Closure|string
    {
        return view('components.admin.photofilter.main-setting');
    }
}
