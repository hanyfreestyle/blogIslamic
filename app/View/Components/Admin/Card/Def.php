<?php

namespace App\View\Components\Admin\Card;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Def extends Component{
    public $pageData ;
    public $bg;
    public $title;
    public $addFormError ;
    public $fullError ;

    public function __construct(
        $pageData = array(),
        $title=null,
        $bg = "primary",
        $addFormError = true,
        $fullError = false,
    )
    {
        $this->pageData = $pageData;
        $this->bg = $bg;
        if(!isset($title)){
            if($pageData['ViewType'] == 'Add'){
                $this->title = __('admin/def.page_add');
            }elseif($pageData['ViewType'] == 'Edit'){
                $this->title = __('admin/def.page_edit');
            }elseif($pageData['ViewType'] == 'List'){
                $this->title = __('admin/def.page_list');
            }elseif($pageData['ViewType'] == 'deleteList'){
                $this->title = __('admin/def.delete_restor_view');
            }
        }else{
            $this->title = $title;
        }

        $this->addFormError = $addFormError ;
        $this->fullError = $fullError ;
    }
    public function render(): View|Closure|string
    {
        return view('components.admin.card.def');
    }
}
