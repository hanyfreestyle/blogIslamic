<?php

namespace App\View\Components\Admin\Hmtl;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TestMeta extends Component {

    public $row;
    public $isactive;
    public $option_1;
    public $option_2;
    public $option_3;


    public function __construct(
        $row = array(),
        $isactive = false,
        $option_1 = null,
        $option_2 = null,
        $option_3 = null,

    ) {
        $this->row = $row;
        $this->isactive = $isactive;
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;
        $this->option_3 = $option_3;

    }

    public function render(): View|Closure|string {
        return view('components.admin.hmtl.test-meta');
    }
}
