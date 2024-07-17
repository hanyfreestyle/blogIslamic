<?php

namespace App\View\Components\Admin\Orders;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Log extends Component {

    public $order;
    public $title;
    public $icon;
    public $color;
    public $option_3;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $order = array(),
        $option_3 = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->order = $order;

        if($this->order->status == 2){
            $this->title = __('admin/orders.log_confirm') ;
            $this->icon = "fas fa-truck-moving";
            $this->color = "callout-info";
        }elseif($this->order->status == 3){
            $this->title = __('admin/orders.log_done') ;
            $this->icon = "fas fa-clipboard-check";
            $this->color = " callout-success";
        }elseif($this->order->status == 4){
            $this->title = __('admin/orders.log_rejected') ;
            $this->icon = "fas fa-window-close";
            $this->color = " callout-danger";
        }



        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.admin.orders.log');
    }
}
