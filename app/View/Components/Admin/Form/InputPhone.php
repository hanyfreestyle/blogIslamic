<?php

namespace App\View\Components\Admin\Form;


use App\AppPlugin\Data\Country\Country;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class InputPhone extends Component
{

    public $colrow;
    public $labelview;
    public $dir;
    public $id;
    public $label;
    public $requiredSpan;
    public $name;
    public $inputclass;
    public $value;
    public $placeholder;
    public $initialCountry;
    public $option_10;

    public function __construct(
        $colrow = 'col-md-6 col-sm-12',
        $labelview = false,
        $dir = null,
        $id = null,
        $label = null,
        $requiredSpan = true,
        $name = null,
        $inputclass = null,
        $value = null,
        $placeholder = false,
        $initialCountry = 'eg',
        $option_10 = null,
    )
    {
        $this->colrow = $colrow;
        $this->labelview = $labelview;
        $this->dir = $dir;
        $this->id = $id;
        $this->label = $label;
        $this->requiredSpan = $requiredSpan;
        $this->name = $name;
        if($this->id == null){
            $this->id = $this->name ;
        }
        $this->inputclass = $inputclass;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->initialCountry = $initialCountry;
        $this->option_10 = $option_10;
    }

    public function render(): View|Closure|string{

        $onlyCountries = Cache::remember('CashOnlyCountries',cashDay(7), function (){
            return  Country::where('is_active',true)->pluck('iso2')->toArray();
        });

        $onlyCountriesList = "";
        foreach ($onlyCountries as $country){
            $onlyCountriesList .= "'";
            $onlyCountriesList .= strtolower($country);
            $onlyCountriesList .= "',";
        }

        return view('components.admin.form.input-phone',compact('onlyCountriesList'));
    }
}
