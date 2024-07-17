<?php

namespace App\View\Components\Admin\Ajax;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SortCode extends Component
{
    public $style_name;
    public $url;

    public function __construct(
        $style_name = 'hanySort',
        $url = '#',
    )

    {
        $this->style_name = $style_name;
        $this->url = $url;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.ajax.sort-code');
    }
}
