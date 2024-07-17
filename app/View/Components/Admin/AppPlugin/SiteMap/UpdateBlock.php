<?php

namespace App\View\Components\Admin\AppPlugin\SiteMap;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UpdateBlock extends Component
{

    public $row;
    public $route;
    public $title;
    public $catid;


    public function __construct(
        $row = array(),
        $route = null,
        $title = null,
        $catid = null,

    )
    {
        $this->row = $row;
        $this->route = $route;
        $this->title = $title;
        $this->catid = $catid;

    }

    public function render(): View|Closure|string
    {
        return view('components.admin.app-plugin.site-map.update-block');
    }
}
