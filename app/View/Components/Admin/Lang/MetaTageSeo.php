<?php

namespace App\View\Components\Admin\Lang;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MetaTageSeo extends Component {

    public $showlang;
    public $keyLang;
    public $key;
    public $row;
    public $defName;
    public $des;
    public $defDes;
    public $seo;
    public $slug;
    public $viewtype;
    public $fullRow;
    public $desRow;
    public $seoRow;
    public $seoReq;

    public function __construct(
        $showlang = true,
        $key = null,
        $row = array(),
        $defName = null,
        $des = true,
        $defDes = null,
        $seo = true,
        $slug = true,
        $viewtype = null,
        $fullRow = true,

    ) {
        $this->showlang = $showlang;
        $this->key = $key;
        $this->row = $row;
        if ($defName == null) {
            $defName = __('admin/form.text_name');
        }
        $this->defName = $defName;

        $this->des = $des;
        if ($defDes == null) {
            $defDes = __('admin/form.text_content');
        }
        $this->defDes = $defDes;
        $this->seo = $seo;
        $this->slug = $slug;

        $this->viewtype = $viewtype;
        if ($this->viewtype == 'Add') {
            $this->seoReq = false;
        } else {
            $this->seoReq = true;
        }

        $this->keyLang = __('admin.multiple_lang_key_' . $this->key);

        $this->fullRow = $fullRow;
        if ($this->seo == false and $this->slug == false) {
            $this->fullRow = true;
            $this->showlang = false;
        }

        if ($this->fullRow) {
            $this->desRow = "col-lg-12";
            $this->seoRow = "col-lg-12";
        } else {
            $this->desRow = "col-lg-8";
            $this->seoRow = "col-lg-4";
        }


    }

    public function render(): View|Closure|string {
        return view('components.admin.lang.meta-tage-seo');
    }
}
