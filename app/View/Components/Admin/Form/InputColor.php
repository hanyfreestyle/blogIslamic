<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputColor extends Component
{
    public $row;
    public $name;
    public $label;
    public $value;
    public function __construct(
        $row =null,
        $name ="",
        $label = "",
        $value = "",

    )
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->row = $row;
        if($this->row != null) {
            $this->value = old($name,$row->$name);
        }else{

        }

    }


    public function render(): View|Closure|string
    {
        return view('components.admin.form.input-color');
    }
}
