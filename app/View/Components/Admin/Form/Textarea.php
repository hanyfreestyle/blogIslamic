<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component {
    public $id, $name, $label, $placeholder;
    public $topclass, $inputclass;
    public $disabled, $required;
    public $rows;
    public $req;

    public $value;
    public $labelview;
    public $col;

    public function __construct(
        $id = null,
        $name = null,
        $label = 'Input Label',
        $placeholder = null,
        $topclass = null,
        $inputclass = null,
        $disabled = false,
        $required = false,
        $rows = '5',
        $req = true,
        $value = null,
        $labelview = true,
        $col = null,

    ) {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->topclass = $topclass;
        $this->inputclass = $inputclass;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->rows = $rows;
        $this->req = $req;

        $this->value = $value;
        $this->labelview = $labelview;

        if(intval($col) <= 12 and intval($col) != 0 ){
            $this->col = "col-lg-".$col;
        }else{
            $this->col = $col;
        }


    }

    public function render(): View|Closure|string {
        return view('components.admin.form.textarea');
    }
}
