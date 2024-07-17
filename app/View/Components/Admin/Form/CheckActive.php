<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckActive extends Component {
    public $col;
    public $name;
    public $lable;
    public $row;
    public $pageView;
    public $defstatus;

    public function __construct(
        $col = 'col-lg-3',
        $name = '',
        $lable = null,
        $row = array(),
        $pageView = '',
        $defstatus = true,
    ) {

        $this->col = $col;
        $this->name = $name;
        $this->lable = $lable;
        $this->row = $row;
        $this->pageView = $pageView;
        $this->defstatus = $defstatus;

        if ($lable == null) {
            $this->lable = __('admin/def.status_active');
        }
    }

    public function render(): View|Closure|string {
        return view('components.admin.form.check-active');
    }
}
