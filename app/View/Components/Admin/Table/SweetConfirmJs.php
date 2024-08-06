<?php

namespace App\View\Components\Admin\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SweetConfirmJs extends Component {

    public $className;
    public $icon;
    public $sTitle;
    public $sText;
    public $bCancel;
    public $bConfirm;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $className = 'sweet_confirm_but',
        $icon = 'info', # [info,error]
        $sTitle = null,
        $sText = "empty",
        $bCancel = null,
        $bConfirm = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->className = $className;
        $this->icon = $icon;
        if ($sTitle) {
            $this->sTitle = $sTitle;
        } else {
            $this->sTitle = __('admin/alertMass.sweet_title');
        }
        if ($sText != 'empty') {
            $this->sText = $sText;
        } else {
            $this->sText = null;
        }

        if ($bCancel) {
            $this->bCancel = $bCancel;
        } else {
            $this->bCancel = __('admin/alertMass.sweet_cancel_button_text');
        }

        if ($bConfirm) {
            $this->bConfirm = $bConfirm;
        } else {
            $this->bConfirm = __('admin/alertMass.sweet_confirm_button_yes');
        }

        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.admin.table.sweet-confirm-js');
    }
}
