<?php

namespace App\View\Components\Admin\Java;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddNewLangRow extends Component {

    public $type;
    public $isactive;

    public function __construct(
        $type = 'admin',
        $isactive = true,
    ) {
        $this->type = $type;
        $this->isactive = $isactive;
    }

    public function render(): View|Closure|string {
        return view('components.admin.java.add-new-lang-row');
    }
}
