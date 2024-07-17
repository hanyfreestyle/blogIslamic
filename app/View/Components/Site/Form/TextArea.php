<?php

namespace App\View\Components\Site\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextArea extends Component {

    public $row;
    public $col;
    public $style;
    public $label;
    public $name;
    public $id;
    public $type;
    public $holder;
    public $holderText;
    public $labelView;
    public $req;
    public $value;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $row = array(),
        $col = 6,
        $style = null,
        $label = 'label',
        $name = 'name',
        $id = null,
        $type = 'text',
        $holder = false,
        $holderText = null,
        $labelView = true,
        $req = true,
        $value = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,

    ) {

        $this->row = $row;
        $this->col = $col;
        $this->style = $style;
        $this->label = $label;
        $this->name = $name;

        if($id == null) {
            $this->id = $name;
        } else {
            $this->id = $id;
        }

        $this->type = $type;
        $this->holder = $holder;

        if($holderText == null) {
            $this->holderText = $this->label;
        } else {
            $this->holderText = $holderText;
        }

        $this->labelView = $labelView;
        $this->req = $req;
        $this->value = $value;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.site.form.text-area');
    }
}
