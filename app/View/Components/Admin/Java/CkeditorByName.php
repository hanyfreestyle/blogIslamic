<?php

namespace App\View\Components\Admin\Java;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CkeditorByName extends Component
{

    public $name;
    public $dir;
    public $height;
    public $uploadPhoto;
    public $option_3;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $name = true,
        $dir = 'en',
        $height = 350,
        $uploadPhoto = false,
        $option_3 = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    )
    {
        $this->name = $name;
        $this->dir = $dir;
        $this->height = $height;
        $this->uploadPhoto = $uploadPhoto;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.java.ckeditor-by-name');
    }
}
