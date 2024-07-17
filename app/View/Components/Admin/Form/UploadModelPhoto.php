<?php

namespace App\View\Components\Admin\Form;


use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UploadModelPhoto extends Component {


    public $addFilterList;
    public $thisfilterid;
    public $filterName;
    public $filterSelect;
    public $filterInputName;

    public $col;
    public $label;
    public $labelview;
    public $req;


    public $fileName;

    public $multiple;
    public $acceptFile;

    public $row;
    public $page;
    public $viewType;
    public $dbName;
    public $labelPhoto;
    public $remove;
    public $route;


    public function __construct(
        $addFilterList = true,
        $thisfilterid = 0,
        $filterName = '_filterid',
        $filterSelect = true,
        $filterInputName = 'filter_id',

        $col = '6',
        $label = null,
        $labelview = true,
        $req = true,


        $fileName = 'image',
        $multiple = false,
        $acceptFile = "image/*",# image/*,.zip

        $row = array(),
        $page = array(),
        $viewType = false,
        $dbName = 'photo_thum_1',
        $labelPhoto = null,
        $remove = true,
        $route = '.emptyPhoto',


    ) {
        $this->addFilterList = $addFilterList;
        $this->thisfilterid = $thisfilterid;
        $this->filterName = $filterName;
        $this->filterInputName = $filterInputName;
        $this->filterSelect = $filterSelect;

        $this->col = $col;
        $this->label = $label;
        if($this->label == null) {
            $this->label = __('admin/def.form_photo_upload');
        }
        $this->labelview = $labelview;
        $this->req = $req;


        $this->fileName = $fileName;
        $this->multiple = $multiple;
        $this->acceptFile = $acceptFile;

        $this->page = $page;
        if(isset($this->page['ViewType']) and $this->page['ViewType'] == 'Edit') {
            $this->viewType = true;
        }
        $this->dbName = $dbName;
        $this->row = $row;

        $this->labelPhoto = $labelPhoto;
        if($this->labelPhoto == null) {
            $this->labelPhoto = __('admin/def.form_current_photo');
        }

        $this->remove = $remove;
        $this->route = $route;


    }

    public function render(): View|Closure|string {
        return view('components.admin.form.upload-model-photo');
    }
}
