<?php

namespace App\View\Components\Admin\Cash;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DbBox extends Component
{

    public $row;
    public $key;
    public $title;
    public $icon;
    public $date;
    public $color;

    public function __construct(
        $row = array(),
        $key = null,
        $title = "",
        $icon = "fa fa-home",
        $date =  "",
        $color =  "",
    )
    {
        $this->row = $row;
        $this->key = $key;
        $this->title = $title;
        $this->icon = $icon;
        $this->date = $date;
        $this->color = $color;


        if($this->key == 'Developer'){
            $checkDate =   self::CheckDate($row,'developer_update');
            $this->title = __('admin/config/cash.db_developer') ." ".$checkDate['lengthText']  ;
            $this->icon = "fas fa-truck-monster" ;
            $this->date = $checkDate['PrintDate'];
            $this->color = $checkDate['cardColor'];
        }elseif ($this->key == 'Location'){
            $checkDate =   self::CheckDate($row,'location_update');
            $this->title = __('admin/config/cash.db_location') ." ".$checkDate['lengthText']  ;
            $this->icon = "fas fa-map-marker-alt" ;
            $this->date = $checkDate['PrintDate'];
            $this->color = $checkDate['cardColor'];
        }elseif ($this->key == 'Project'){
            $checkDate =   self::CheckDate($row,'project_update');
            $this->title = __('admin/config/cash.db_project') ." ".$checkDate['lengthText']  ;
            $this->icon = "fas fa-building" ;
            $this->date = $checkDate['PrintDate'];
            $this->color = $checkDate['cardColor'];
        }elseif ($this->key == 'Post'){
            $checkDate =   self::CheckDate($row,'post_update');
            $this->title = __('admin/config/cash.db_Post') ." ".$checkDate['lengthText']  ;
            $this->icon = "fab fa-html5" ;
            $this->date = $checkDate['PrintDate'];
            $this->color = $checkDate['cardColor'];
        }
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # CheckDate
    static function CheckDate($row,$key){
        $now = Carbon::now();
        if($row->$key == null){
            return[
                'PrintDate'=>  'غير محدثة' ,
                'Length'=> '' ,
                'lengthText'=> '' ,
                'cardColor'=> 'bg-danger' ,
            ];
        }else{
            $end =  Carbon::parse($row->$key);
            $length = $end->diffInDays($now);


            if($length == 0){
                $lengthText =__('admin/config/cash.date_now');
            }else{
                $lengthText = __('admin/config/cash.date_from') .'('.$length.')'.__('admin/config/cash.date_now');
            }
            if ($length <= 7){
                $cardColor = "bg-success";
            }else{
                $cardColor = "bg-danger" ;
            }
        }


        return[
            'PrintDate'=>  Carbon::parse($row->$key)->locale(app()->getLocale())->translatedFormat('jS M Y') ,
            'Length'=> $length ,
            'lengthText'=> $lengthText ,
            'cardColor'=> $cardColor ,

        ];
    }


    public function render(): View|Closure|string
    {
        return view('components.admin.cash.db-box');
    }
}
