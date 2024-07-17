<?php

namespace App\View\Components\Admin\Lang;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteButton extends Component
{
    public $row;
    public function __construct(
        $row = array(),
    )
    {
        $this->row = $row;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.lang.delete-button');
    }
}
