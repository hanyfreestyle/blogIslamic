<?php

namespace App\View\Components\Admin\DataTable;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Plugins extends Component
{

    public $style;
    public $jscode;
    public $tablename;
    public $viewbut;
    public $butlist;
    public $isActive;
    public $pageLength;
    public function __construct(
        $isActive = false,
        $style = false,
        $jscode = false,
        $tablename = "MainDataTable",
        $viewbut = false,
        $butlist = ' "print", "colvis" ', #"copy", "csv", "excel", "pdf", "print", "colvis"
        $pageLength = 10,
    )
    {
        $this->isActive = $isActive ;
        $this->style = $style ;
        $this->jscode = $jscode;
        $this->tablename = $tablename;
        $this->viewbut = $viewbut;
        $this->butlist = $butlist;
        $this->pageLength = $pageLength;
    }


    public function render(): View|Closure|string
    {
        return view('components.admin.data-table.plugins');
    }
}
