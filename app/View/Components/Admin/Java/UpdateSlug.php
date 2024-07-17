<?php

namespace App\View\Components\Admin\Java;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UpdateSlug extends Component {

    public $row;
    public $isactive;
    public $viewType;
    public $lang;


    public function __construct(
        $row = array(),
        $isactive = true,
        $viewType = null,
        $lang = null,

    ) {
        $this->row = $row;
        $this->isactive = $isactive;
        $this->viewType = $viewType;
        $this->lang = config('app.web_lang');

    }

    public function render(): View|Closure|string {
        return view('components.admin.java.update-slug');
    }
}
