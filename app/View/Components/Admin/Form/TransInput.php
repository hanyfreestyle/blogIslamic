<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TransInput extends Component {

    public $row;
    public $key;
    public $name;
    public $reqname;
    public $newreqname;
    public $value;

    public $addClass;
    public $col;
    public $labelView;
    public $label;
    public $ldir;
    public $req;
    public $tdir;

    public $holder;
    public $placeholder;
    public $id;

    public function __construct(
        $addClass = null,
        $row = null,
        $key = null,
        $name = '',
        $value = null,

        $col = 12,
        $labelView = true,
        $label = null,
        $ldir = null,
        $req = true,
        $tdir = null,

        $holder = false,
        $placeholder = null,
        $id = null,

    ) {
        $this->addClass = $addClass;
        $this->row = $row;
        $this->key = $key;
        $this->name = $name;
        $this->reqname = $this->key . "." . $this->name;
        $this->newreqname = trim(str_replace('_', " ", $this->reqname));

        if($this->row != null) {
            $this->value = old($key . '.' . $name, $row->translateOrNew($key)->$name);
        } else {
            $this->value = $value;
        }

        $this->col = $col;
        $this->labelView = $labelView;
        $this->ldir = $ldir;
        $this->req = $req;
        $this->tdir = $tdir;
        if(count(config('app.web_lang')) > 1) {
            $this->label = $label . " (" . $key . ")";
        } else {
            $this->label = $label;
        }

        $this->holder = $holder;
        if($this->placeholder == null) {
            $this->placeholder = $this->label;
        }else{
            $this->placeholder = $this->label;
        }

        if($id == null){
            $this->id = $this->name."_".$this->key;
        }else{
            $this->id = $id;
        }



    }

    public function render(): View|Closure|string {
        return view('components.admin.form.trans-input');
    }
}
