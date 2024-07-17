<?php

namespace App\View\Components\Admin\Lang;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MetaTageFildeLight extends Component {

    public $key;
    public $row;
    public $defName;
    public $defdes;
    public $des;
    public $seo;


    public function __construct(
        $key = null,
        $row = array(),
        $defName = null,
        $defdes = null,
        $des = true,
        $seo = true,
    ) {
        $this->key = $key;
        $this->row = $row;
        $this->des = $des;
        $this->seo = $seo;


        if($defName == null) {
            $this->defName = __('admin/form.text_name');
        } else {
            $this->defName = $defName;
        }

        if($defdes == null) {
            $this->defdes = __('admin/form.text_content');
        } else {
            $this->defdes = $defdes;
        }

    }

    public function render(): View|Closure|string {
        return view('components.admin.lang.meta-tage-filde-light');
    }
}
