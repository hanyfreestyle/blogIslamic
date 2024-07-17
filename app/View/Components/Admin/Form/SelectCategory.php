<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectCategory extends Component {

    public $name;
    public $label;
    public $labelView;
    public $sendvalue;
    public $req;
    public $col;
    public $sendArr;
    public $selectType;
    public $printValName;
    public $forcategory;

    public function __construct(
        $name = "",
        $label = "",
        $sendvalue = "",
        $req = true,
        $col = "col-lg-4",
        $sendArr = array(),
        $selectType = 'normal',
        $printValName = 'name',
        $forcategory = true,
        $labelView = true,

    ) {
        $this->name = $name;
        $this->label = $label;
        $this->sendvalue = $sendvalue;
        $this->req = $req;
        $this->col = $col;
        $this->sendArr = $sendArr;
        $this->selectType = $selectType;
        $this->printValName = $printValName;
        $this->forcategory = $forcategory;
        $this->labelView = $labelView;
    }


    public function render(): View|Closure|string {
        return view('components.admin.form.select-category');
    }
}
