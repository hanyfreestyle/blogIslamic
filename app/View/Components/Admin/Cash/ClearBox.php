<?php

namespace App\View\Components\Admin\Cash;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ClearBox extends Component
{
    public $key;
    public $title;
    public $icon;

    public function __construct(
        $key = null,
        $title = "",
        $icon = "fa fa-home",
    )
    {
        $this->key = $key;
        $this->title = $title;
        $this->icon = $icon;
    }
    public function render(): View|Closure|string
    {
        return view('components.admin.cash.clear-box');
    }
}
