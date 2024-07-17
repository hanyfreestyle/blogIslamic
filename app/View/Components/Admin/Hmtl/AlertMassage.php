<?php

namespace App\View\Components\Admin\Hmtl;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AlertMassage extends Component {
    public $type;
    public $bg;
    public $align;
    public $mass;

    public function __construct(
        $type = null,
        $bg = "p",
        $align = 'c',
        $mass = 'Text',

    ) {
        $this->type = $type;
        $this->bg = getBgColor($bg);
        $this->align = getAlign($align);
        $this->mass = $mass;


        if ($type) {
            switch ($type) {
                case 'nodata':
                    $this->bg = getBgColor('d');
                    $this->mass = __('admin/alertMass.no_data');
                    break;
                case 'delete':
                    break;
            }
        }

    }

    public function render(): View|Closure|string {
        return view('components.admin.hmtl.alert-massage');
    }
}
