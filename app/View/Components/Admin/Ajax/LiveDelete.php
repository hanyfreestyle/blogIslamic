<?php

namespace App\View\Components\Admin\Ajax;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LiveDelete extends Component
{

    public $url;
    public function __construct(
        $url = null,
    )
    {
        $this->url = $url;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.ajax.live-delete');
    }
}
