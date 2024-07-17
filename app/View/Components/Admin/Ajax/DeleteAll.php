<?php

namespace App\View\Components\Admin\Ajax;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteAll extends Component
{

    public $po;
    public $isactive;
    public $dir;


    public function __construct(
        $po = 'button',
        $isactive = true,
        $dir = 'float-left',

    )
    {
        $this->po = $po;
        $this->isactive = $isactive;
        $this->dir = $dir;

    }

    public function render(): View|Closure|string
    {
        return view('components.admin.ajax.delete-all');
    }
}
