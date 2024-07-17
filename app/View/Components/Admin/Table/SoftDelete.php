<?php

namespace App\View\Components\Admin\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SoftDelete extends Component
{
    public $type;
    public $row;

    public function __construct(
        $type = "t",
        $row = array(),
    )
    {
        $this->type = $type;
        $this->row = $row;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.table.soft-delete');
    }
}
