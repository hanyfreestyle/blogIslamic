<?php

namespace App\View\Components\Admin\Form;

use App\AppPlugin\Data\ConfigData\Models\ConfigData;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;


class SelectData extends Component {
    public $row;
    public $col;
    public $labelview;
    public $label;
    public $req;
    public $name;
    public $id;
    public $sendArr;
    public $sendid;
    public $sendvalue;
    public $printName;
    public $catId;
    public $filterForm;


    public function __construct(
        $row = array(),
        $col = "3",
        $labelview = true,
        $label = "Input Name",
        $req = true,
        $name = null,
        $id = null,
        $sendid = 'id',
        $sendvalue = "",
        $printName = 'name',
        $catId = null,
        $filterForm = false,

    ) {
        $this->row = $row;
        $this->col = "col-lg-" . $col;
        $this->labelview = $labelview;
        $this->label = $label;
        $this->req = $req;
        $this->name = $name;
        if ($id == null) {
            $this->id = $name;
        } else {
            $this->id = $id;
        }
        $configData = self::CashConfigDataList();
        $this->catId = $catId;
        $this->sendArr = $configData->where('cat_id', $this->catId);
        $this->sendid = $sendid;

        $this->printName = $printName;


        if($filterForm){
            $this->sendvalue = $sendvalue;
        }else{
            if ($sendvalue != null) {
                $this->sendvalue = $sendvalue;
            } else {
                $rowName = $this->name;
                $this->sendvalue = old($printName, $row->$rowName);
            }
        }

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashConfigDataList
    static function CashConfigDataList($stopCash = 0) {
        if ($stopCash) {
            $CashConfigDataList = ConfigData::query()->orderByTranslation('name', 'ASC')->get();
        } else {
            $CashConfigDataList = Cache::remember('CashConfigDataList', cashDay(7), function () {
                return ConfigData::query()->orderByTranslation('name', 'ASC')->get();
            });
        }
        return $CashConfigDataList;
    }

    public function render(): View|Closure|string {
        return view('components.admin.form.select-data');
    }
}
