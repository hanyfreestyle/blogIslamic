<?php

namespace App\View\Components\Site\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component {

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
    public $sendArr;
    public $sendid;
    public $sendvalue;
    public $printValName;

    public function __construct(
        $row = array(),
        $col = 6,
        $style = null,
        $label = 'label',
        $name = 'name',
        $id = null,
        $type = 'normal',
        $holder = true,
        $holderText = null,
        $labelView = true,
        $req = true,
        $value = null,
        $sendArr = array(),
        $sendid = 'id',
        $sendvalue = null,
        $printValName = 'name',
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
            $this->holderText = __('admin/form.pls_select') ." ". $this->label;
        } else {
            $this->holderText = $holderText;
        }

        $this->labelView = $labelView;
        $this->req = $req;
        $this->value = $value;
        $this->sendArr = $sendArr;
        $this->sendid = $sendid;
        $this->sendvalue = $sendvalue;
        $this->printValName = $printValName;
    }

    public function render(): View|Closure|string {
        return view('components.site.form.select');
    }
}
