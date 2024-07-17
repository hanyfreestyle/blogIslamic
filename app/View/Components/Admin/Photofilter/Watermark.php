<?php

namespace App\View\Components\Admin\Photofilter;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Watermark extends Component
{
    public $row;
    public $isactive;
    public $printphoto;


    public function __construct(
        $row = array(),
        $isactive = true,
        $printphoto = null,
    )
    {
        $this->row = $row;
        $this->isactive = $isactive;

        $watermark_img = old('watermark_img',$row->watermark_img);
        if($watermark_img != ''){
            $printphoto = app('url')->asset($watermark_img);
        }else{
            $printphoto = "";
        }
        $this->printphoto = $printphoto;

    }

    public function render(): View|Closure|string
    {
        return view('components.admin.photofilter.watermark');
    }
}
