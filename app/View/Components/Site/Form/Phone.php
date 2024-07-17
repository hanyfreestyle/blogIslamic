<?php

namespace App\View\Components\Site\Form;

use App\AppPlugin\Data\Country\Country;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Phone extends Component {

    public $col;
    public $labelview;
    public $dir;
    public $id;
    public $label;
    public $req;
    public $name;
    public $inputclass;
    public $value;
    public $placeholder;
    public $initialCountry;
    public $style;

    public function __construct(
        $col = '6',
        $labelview = true,
        $dir = null,
        $id = null,
        $label = null,
        $req = true,
        $name = null,
        $inputclass = null,
        $value = null,
        $placeholder = false,
        $initialCountry = 'eg',
        $style = null,
    ) {
        $this->col = $col;
        $this->labelview = $labelview;
        $this->dir = $dir;
        $this->id = $id;
        $this->label = $label;
        $this->req = $req;
        $this->name = $name;
        if($this->id == null){
            $this->id = $this->name ;
        }
        $this->inputclass = $inputclass;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->initialCountry = $initialCountry;
        $this->style = $style;
    }

    public function render(): View|Closure|string {
        $onlyCountries = Cache::remember('CashOnlyCountries',cashDay(7), function (){
            return  Country::where('is_active',true)->pluck('iso2')->toArray();
        });
        $onlyCountriesList = "";
        foreach ($onlyCountries as $country){
            $onlyCountriesList .= "'";
            $onlyCountriesList .= strtolower($country);
            $onlyCountriesList .= "',";
        }

        return view('components.site.form.phone',compact('onlyCountriesList'));
    }
}
