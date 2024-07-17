<?php

namespace App\View\Components\Admin\Form;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Date extends Component {

    public $label;
    public $labelview;
    public $name;
    public $reqspan;
    public $id;
    public $col;
    public $value;

    public function __construct(
        $name = null,
        $label = null,
        $labelview = true,
        $reqspan = true,
        $id = null,
        $col = 'col-lg-3',
        $value = null,
        $type = null,
    ) {


        if($type == 'fromDate') {
            $this->name = 'from_date';
            $this->label = __('admin/formFilter.fr_date_from');
            $this->reqspan = false;

        } elseif($type == 'toDate') {
            $this->name = 'to_date';
            $this->label = __('admin/formFilter.fr_date_to');
            $this->reqspan = false;
        } else {
            $this->name = $name;
            $this->label = $label;
            $this->reqspan = $reqspan;
        }


        if($id == null) {
            $this->id = $this->name;
        } else {
            $this->id = $id;
        }

        $this->labelview = $labelview;
        $this->col = $col;

        if($value == null) {
            $this->value = '';
        } else {
            $this->value = Carbon::parse($value)->format("Y-m-d");
        }

    }

    public function render(): View|Closure|string {
        return view('components.admin.form.date');
    }
}
