<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CkeditorJave extends Component {
    public $loadfile;
    public $arlang;
    public $arname;
    public $enlang;
    public $enname;
    public $height;

    public function __construct(
        $loadfile = true,
        $arlang = true,
        $arname = "ar[des]",
        $enlang = true,
        $enname = "en[des]",
        $height = 450,
    ) {
        $this->loadfile = $loadfile;
        $this->arlang = $arlang;
        $this->arname = $arname;
        $this->enlang = $enlang;
        $this->enname = $enname;
        $this->height = $height;

    }

    public function render(): View|Closure|string {
        return view('components.admin.form.ckeditor-jave');
    }
}
