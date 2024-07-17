<?php

namespace App\View\Components\Admin\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionBut extends Component
{
    public $row;
    public $type;
    public $po;
    public $modelid;

    public function __construct(
        $row = array(),
        $type = null,
        $po = 'button',
        $modelid = null,

    )
    {
        $this->row = $row;
        $this->type = $type;
        $this->po = $po;
        $this->modelid = $modelid;

    }

    public function render(): View|Closure|string
    {
        return view('components.admin.table.action-but');
    }
}
