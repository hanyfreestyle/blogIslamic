<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SelectArr extends Component {
    public $row;
    public $name;
    public $label;
    public $sendvalue;
    public $col;
    public $colrow;
    public $sendArr;
    public $selectType;
    public $printValName;
    public $labelview;
    public $applang;
    public $changelang;
    public $sendid;
    public $addFilde;
    public $req ;

    public function __construct(
        $row = array(),
        $name = "",
        $label = "",
        $sendvalue = "",
        $col = "4",
        $colrow = null,

        $sendArr = array(),
        $selectType = 'normal',
        $printValName = 'name',
        $labelview = true,
        $applang = null,
        $changelang = null,
        $sendid = 'id',
        $addFilde = null,
        $req = true,

    ) {
        $this->name = $name;
        $this->label = $label;
        $this->printValName = $printValName;
        $this->sendvalue = $sendvalue;


        $this->req = $req;
        $this->colrow = $colrow;
        $this->col = "col-lg-" . $col;

        $this->sendArr = $sendArr;
        $this->selectType = $selectType;

        $this->labelview = $labelview;
        $this->sendid = $sendid;

        $this->applang = LaravelLocalization::getCurrentLocale();
        if ($this->applang == 'ar') {
            $this->changelang = 'en';
        } else {
            $this->changelang = 'ar';
        }

        $this->addFilde = $addFilde;

        if ($sendvalue != null) {
            $this->sendvalue = $sendvalue;
        } else {
            $rowName = $this->name;
            $this->sendvalue = old($rowName, issetArr($row,$rowName,null));
        }

    }

    public function render(): View|Closure|string {
        return view('components.admin.form.select-arr');
    }
}
