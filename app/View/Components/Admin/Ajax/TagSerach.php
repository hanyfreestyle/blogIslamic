<?php

namespace App\View\Components\Admin\Ajax;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TagSerach extends Component
{

    public $row;
    public $id;
    public $length;
    public $newTags;
    public $option_3;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $row = array(),
        $id = 'tag_id',
        $length = 2,
        $newTags = true,
        $option_3 = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    )
    {
        $this->row = $row;
        $this->id = $id;
        $this->length = $length;
        $this->newTags = $newTags;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.ajax.tag-serach');
    }
}
