<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UploadFile extends Component {
    public $rowCol;
    public $fileName;
    public $label;
    public $labelPhoto;
    public $viewType;
    public $req;
    public $rowData;
    public $fildName;
    public $multiple;
    public $acceptFile;
    public $thisfilterid;
    public $emptyphotourl;
    public $notes;
    public $addFilterList;
    public $filterName;

    public function __construct(
        $rowCol = 'col-12',
        $fileName = 'image',
        $label = '',
        $labelPhoto = null,
        $viewType = null,
        $notes = null,
        $req = true,
        $rowData = array(),
        $fildName = 'photo_thum_1',
        $multiple = false,
        $acceptFile = "image/*",# image/*,.zip
        $thisfilterid = '',
        $emptyphotourl = '#',
        $addFilterList = true,
        $filterName = "filter_id",

    ) {
        $this->addFilterList = $addFilterList;
        $this->rowCol = $rowCol;
        $this->fileName = $fileName;
        $this->labelPhoto = __('admin/def.form_current_photo');
        $this->label = __('admin/def.form_photo_upload');
        $this->viewType = $viewType;
        $this->req = $req;
        $this->rowData = $rowData;
        $this->fildName = $fildName;
        $this->multiple = $multiple;
        $this->acceptFile = $acceptFile;
        $this->thisfilterid = $thisfilterid;
        $this->emptyphotourl = $emptyphotourl;
        $this->notes = $notes;
        $this->filterName = $filterName;



        if($this->viewType == 'Edit') {
            $this->req = false;
        }

        if(config('app.upload_photo_notes') == true and intval($this->thisfilterid) != 0) {
//            $notesSend =  UploadFilter::where('id',$this->thisfilterid)->first();
//            $printName = "notes_".thisCurrentLocale();
//            $this->notes = $notesSend->$printName ?? '';
        }

    }

    public function render(): View|Closure|string {
        return view('components.admin.form.upload-file');
    }
}
