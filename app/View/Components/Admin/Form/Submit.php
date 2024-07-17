<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Submit extends Component {

    public $type;
    public $name;
    public $text;
    public $size;
    public $bg;
    public $outline;
    public $buttonBackGround;
    public $dir;

    public function __construct
    (
        $type = 'submit',
        $name = 'B1',
        $text = 'Hany',
        $size = '',#btn-lg
        $bg = 'p',
        $outline = false,
        $dir = '',
    ) {
        $this->type = $type;
        $this->name = $name;
        $this->size = $size;

        $this->dir = $dir;
        $this->bg = getBgColor($bg);


        if ($text == 'Add') {
            $this->text = __('admin/form.button_add');
        } elseif ($text == 'Edit') {
            $this->text = __('admin/form.button_edit');
        } elseif ($text == 'Update') {
            $this->text = __('admin/form.button_update');
        } else {
            $this->text = $text;
        }

        if ($outline) {
            $this->buttonBackGround = 'btn-outline-' . $this->bg;
        } else {
            $this->buttonBackGround = 'btn-' . $this->bg;
        }


        if ($dir == '') {
            if (LaravelLocalization::getCurrentLocale() == "ar") {
                $this->dir = 'float-left';
            } else {
                $this->dir = 'float-right';
            }
        } else {
            $this->dir = 'float-' . $dir;
        }


    }

    public function render(): View|Closure|string {
        return view('components.admin.form.submit');
    }
}
