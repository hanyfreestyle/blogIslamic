<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SubmitRoleBack extends Component
{

    public $type ;
    public $name ;
    public $text ;
    public $size ;
    public $bg ;
    public $outline ;
    public $buttonBackGround ;
    public $dir ;
    public $pageData ;
    public $addNew  ;

    public function __construct(
        $type= 'submit',
        $name = 'B1',
        $text = 'Hany',
        $size = '',#btn-lg
        $bg = 'primary',
        $outline = false,
        $dir = '',
        $pageData = array(),
        $addNew = true,
    )
    {
        $this->type = $type;
        $this->name = $name;
        $this->size = $size ;
        $this->bg = $bg ;
        $this->dir = $dir ;
        $this->pageData = $pageData ;
        $this->addNew = $addNew ;


        if($this->pageData['ViewType'] == 'Add') {
            $this->text = __('admin/form.button_add');
        }elseif ($this->pageData['ViewType'] == 'Edit'){
            $this->text = __('admin/form.button_edit');
        }elseif ($this->pageData['ViewType'] == 'Update'){
            $this->text = __('admin/form.button_update');
        }else{
            $this->text = $text;
        }

        if($outline){
            $this->buttonBackGround = 'btn-outline-'.$bg ;
        }else{
            $this->buttonBackGround = 'btn-'.$bg ;
        }


        if($dir == ''){
            if(LaravelLocalization::getCurrentLocale() == "ar"){
                $this->dir = 'float-left' ;
            }else{
                $this->dir = 'float-right' ;
            }
        }else{
            $this->dir = 'float-'.$dir ;
        }
    }


    public function render(): View|Closure|string
    {
        return view('components.admin.form.submit-role-back');
    }
}
