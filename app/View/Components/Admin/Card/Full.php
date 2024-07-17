<?php

namespace App\View\Components\Admin\Card;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Full extends Component
{
    public $bg;
    public $title;
    public $collapsed, $removable, $maximizable, $disabled;
    public $outline, $full;
    public $cardHeaderView;
    public $showIcon;
    public $collapsedStyle;
    public $addButtonRoute ;
    public $addButtonName ;
    public $addFormError ;
    public $titleColor ;
    public $sendRole ;
    public $RestoreRole ;
    public $pageData ;

    public function __construct(
        $title=null,
        $bg = "primary",
        $collapsed = false, $removable = false,
        $maximizable = false, $disabled = false,
        $outline = true, $full = false,
        $cardHeaderView = true,
        $showIcon = false,
        $collapsedStyle = 'collapse',
        $addButtonRoute = '#',
        $addButtonName= null,
        $titleColor= null,
        $addFormError = true,
        $sendRole = '',
        $RestoreRole = '',
        $pageData = array(),
    )
    {
        $this->bg = $bg;
        $this->title = $title;
        $this->collapsed = $collapsed;
        $this->removable = $removable;
        $this->maximizable = $maximizable;
        $this->disabled = $disabled;
        $this->outline = $outline;
        $this->full = $full;
        $this->addFormError = $addFormError ;
        $this->cardHeaderView = $cardHeaderView;
        $this->showIcon = $showIcon;
        $this->sendRole = $sendRole;
        $this->RestoreRole = $RestoreRole;
        $this->pageData = $pageData;


        if($showIcon){
            $this->collapsedStyle = $collapsedStyle;
        }else{
            $this->collapsedStyle = "collapse_stop";
        }

        if($addButtonName){
            $this->addButtonName = $addButtonName;
        }else{
            $this->addButtonName = __('admin/form.button_add');
        }
        if($titleColor){
            $this->titleColor = $titleColor;
        }else{
            if($this->outline == false){
                $this->titleColor = 'text-light';
            }else{
                $this->titleColor = 'text-'.$bg;
            }
        }

        if($title == null and isset($pageData['ListPageName'])){
            //  $this->title = $pageData['ListPageName'];
        }


        if(isset($pageData['AddPageUrl'])){
            $this->addButtonRoute = $pageData['AddPageUrl'] ;
        }

        if(isset($pageData['AddRole'])){
            $this->sendRole = $pageData['AddRole'] ;
        }

        if(isset($pageData['RestoreRole'])){
            $this->RestoreRole = $pageData['RestoreRole'] ;
        }

        if(!isset( $this->title)){
            if($pageData['ViewType'] == 'Add'){
                $this->title = __('admin/def.page_add');
            }elseif($pageData['ViewType'] == 'Edit'){
                $this->title = __('admin/def.page_edit');
            }elseif($pageData['ViewType'] == 'List'){
                $this->title =__('admin/def.page_list');
            }elseif($pageData['ViewType'] == 'deleteList'){
                $this->title = __('admin/def.delete_restor_view');
            }
        }

    }

    public function render(): View|Closure|string
    {
        return view('components.admin.card.full');
    }
}
