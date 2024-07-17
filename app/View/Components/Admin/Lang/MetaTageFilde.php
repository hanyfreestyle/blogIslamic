<?php

namespace App\View\Components\Admin\Lang;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MetaTageFilde extends Component {
    public $key;
    public $row;
    public $reqspan;
    public $viewtype;
    public $slug;
    public $labelView;
    public $holder;
    public $keyLang;
    public $defName;
    public $defdes;
    public $other;
    public $otherName;
    public $showlang;
    public $langAdd;
    public $seo;
    public $des;


    public function __construct(
        $key = null,
        $row = array(),
        $reqspan = true,
        $viewtype = "Add",
        $slug = true,
        $labelView = true,
        $holder = false,
        $keyLang = null,
        $defName = null,
        $defdes = null,
        $other = false,
        $otherName = null,
        $showlang = true,
        $langAdd = array(),
        $seo = true,
        $des = true,

    ) {
        $this->key = $key;
        $this->row = $row;
        $this->viewtype = $viewtype;
        $this->seo = $seo;
        $this->des = $des;

        if ($this->viewtype == 'Add') {
            $this->reqspan = false;
        } else {
            $this->reqspan = $reqspan;
        }
        $this->slug = $slug;
        $this->labelView = $labelView;

        $this->holder = $holder;
        if ($labelView == false) {
            $this->holder = true;
        }

        if ($defName == null) {
            $this->defName = __('admin/form.text_category_name');
        } else {
            $this->defName = $defName;
        }

        if ($defdes == null) {
            $this->defdes = __('admin/form.text_content');
        } else {
            $this->defdes = $defdes;
        }


        $this->keyLang = __('admin.multiple_lang_key_' . $this->key);


        if (count($langAdd) > 1) {

        } else {

        }

        $this->showlang = $showlang;

    }

    public function render(): View|Closure|string {
        return view('components.admin.lang.meta-tage-filde');
    }
}
