<?php

namespace App\View\Components\Admin\Java;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File;
use Illuminate\View\Component;

class Ckeditor4 extends Component
{

    public $name;
    public $dir;
    public $height;
    public $uploadPhoto;
    public $filebrowser;
    public $id;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $name = true,
        $dir = 'en',
        $height = 350,
        $uploadPhoto = true,
        $filebrowser = true,
        $id = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    )
    {
        $this->name = $name;
        $this->dir = $dir;
        $this->height = $height;

        if(File::isFile(base_path('routes/AppPlugin/fileManager.php'))) {
            $this->uploadPhoto = $uploadPhoto;
            $this->filebrowser = $filebrowser;
        }else{
            $this->uploadPhoto = false;
            $this->filebrowser = false;
        }

        $this->id = $id;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }


    public function render(): View|Closure|string
    {
        return view('components.admin.java.ckeditor4');
    }
}
