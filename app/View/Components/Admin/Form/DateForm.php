<?php

namespace App\View\Components\Admin\Form;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DateForm extends Component {

    public $label;
    public $labelview;
    public $name;
    public $req;
    public $id;
    public $col;
    public $value;

    public function __construct(
        $name = null,
        $label = null,
        $labelview = true,
        $req = true,
        $id = null,
        $col = '3',
        $value = null,

    ) {

        $this->labelview = $labelview;
        $this->col = $col;
        $this->req = $req;
        $this->name = $name;

        if($label == null) {
            $this->label = __('admin/form.text_published_at');
        } else {
            $this->label = $label;
        }
        if($id == null) {
            $this->id = $this->name;
        } else {
            $this->id = $id;
        }

        if($value == null) {
            $this->value = '';
        } else {
            $this->value = CheckDateFormat($value);
        }

    }

    public function render(): View|Closure|string {
        return view('components.admin.form.date-form');
    }
}
