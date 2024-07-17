<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component {
    public $type, $id, $name, $label, $placeholder;
    public $topclass, $inputclass;
    public $value, $disabled, $required;
    public $step, $max, $maxlength, $pattern;
    public $req;
    public $horizontalLabel;
    public $colrow;
    public $dir;
    public $labelview;
    public $row;
    public $col;
    public $tdir;
    public $holder;
    public $noLabel;

    public function __construct(
        $type = 'text', $id = null, $name = null,
        $label = 'Input Label', $placeholder = false,
        $topclass = null, $inputclass = null,
        $value = null, $disabled = false, $required = false,
        $step = null, $max = null, $maxlength = null, $pattern = null,
        $req = true,
        $colrow = " col-lg-12 ",
        $horizontalLabel = false,
        $dir = "",
        $labelview = true,
        $row = null,
        $col = null,
        $tdir = null,
        $holder = false,
        $noLabel = null,
    ) {
        $this->type = $type;
        $this->id = $id;
        if ($this->id == null) {
            $this->id = $name;
        }
        $this->name = $name;
        $this->label = $label;

        $this->topclass = $topclass;
        $this->inputclass = $inputclass;

        $this->required = $required;
        $this->disabled = $disabled;
        $this->step = $step;
        $this->max = $max;
        $this->maxlength = $maxlength;
        $this->pattern = $pattern;
        $this->req = $req;
        $this->horizontalLabel = $horizontalLabel;
        $this->colrow = $colrow;
        $this->dir = $dir;


        if ($row != null) {
            $printName = $this->name;
            $this->value = old($printName, $row->$printName);
        } else {
            $this->value = $value;
        }

        if ($col != null) {
            $this->colrow = " col-lg-" . $col;
        } else {
            $this->colrow = $colrow;
        }

        if ($tdir != null) {
            $this->tdir = "dir_" . $tdir;
        }

        if($holder == true){
            $this->placeholder = true;
            $this->labelview = false;
            $this->noLabel = "no_label";
        }else{
            $this->placeholder = $placeholder;
            $this->labelview = $labelview;
            $this->noLabel = "";
        }

    }

    public function render(): View|Closure|string {
        return view('components.admin.form.input');
    }
}
