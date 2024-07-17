<?php

namespace App\View\Components\Admin\Ajax;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UpdateStatusBut extends Component{

    public $row ;
    public $class ;
    public $field ;
    public $role ;

    public function __construct(
        $row = array(),
        $class = 'status_but',
        $field = 'is_active',
        $role = null,
    )
    {
        $this->row = $row ;
        $this->class = $class ;
        $this->field = $field ;
        $this->role = $role ;
    }


    public function render(): View|Closure|string
    {
        return view('components.admin.ajax.update-status-but');
    }
}
