<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LablePrint extends Component
{
    public $col;
    public $title;
    public $des;

    public function __construct(
        $col = 'col-lg-3',
        $title = null,
        $des = null,

    )
    {
        $this->col = $col;
        $this->title = $title;
        $this->des = $des;

    }
    public function render(): View|Closure|string
    {
        return view('components.admin.form.lable-print');
    }
}
