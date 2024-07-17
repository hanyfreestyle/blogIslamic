<?php

namespace App\View\Components\Admin\Main;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;


class FilterForm extends Component {

    public $row;
    public $formName;
    public $getSessionData;
    public $exportBut;
    public $newRoute;
    public $expText;
    public $newRouteTxt;

    public $fromDate;
    public $toDate;
    public $country;
    public $project;
    public $exportView;
    public $isActive;
    public $continent;
    public $countryId;

    public function __construct(


        $row = array(),
        $formName = null,
        $exportBut = true,
        $newRoute = null,
        $expText = null,
        $newRouteTxt = null,
        $fromDate = true,
        $toDate = true,
        $country = false,
        $project = false,
        $exportView = true,
        $isActive = false,
        $continent = false,
        $countryId = false,
    ) {


        $this->row = $row;
        $this->formName = $formName;

        $this->getSessionData = Session::get($this->formName);
        // dd($this->getSessionData);

        $this->exportBut = $exportBut;
        $this->newRoute = $newRoute;
        $this->expText = __('admin/formFilter.but_export');

        if ($newRouteTxt) {
            $this->newRouteTxt = $newRouteTxt;
        } else {
            $this->newRouteTxt = $this->expText;
        }


        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->country = $country;
        $this->project = $project;
        $this->exportView = $exportView;
        $this->isActive = $isActive;
        $this->continent = $continent;
        $this->countryId = $countryId;

    }

    public function render(): View|Closure|string {
        return view('components.admin.main.filter-form');
    }
}
