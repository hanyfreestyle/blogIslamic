<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component {
    public $lable;
    public $size;
    public $bg;
    public $tip;
    public $url;
    public $icon;
    public $type;
    public $id;
    public $sweetDelClass;
    public $printLable;
    public $target;
    public $count;
    public $viewbut;

    public function __construct(
        $url = "#",
        $lable = "",
        $size = "s",
        $bg = "p",
        $tip = true,
        $target = false,
        $icon = null,
        $type = null,
        $id = null,
        $sweetDelClass = '',
        $printLable = '',
        $count = 0,
        $viewbut = true,
    ) {
        //  dd($printLable);
        $this->printLable = $printLable;
        $this->lable = $lable;
        $this->tip = $tip;
        $this->url = $url;
        $this->icon = $icon;
        $this->target = $target;

        $this->size = getButSize($size);
        $this->bg = getBgColor($bg);
        $this->id = $id;
        $this->sweetDelClass = $sweetDelClass;
        $this->count = $count;
        $this->viewbut = $viewbut;

        if($type) {
            switch ($type) {
                case 'add':
                    $this->icon = 'fas fa-plus-square';
                    $this->bg = getBgColor('p');
                    $this->printLable = __('admin/form.button_add');
                    break;

                case 'edit':
                    $this->icon = 'fas fa-pencil-alt';
                    $this->bg = getBgColor('i');
                    $this->printLable = __('admin/form.button_edit');
                    break;

                case 'AddRelease':
                    $this->icon = 'fas fa-plus-circle';
                    $this->bg = getBgColor('p');
                    $this->printLable = "اضافة اصدار";
                    break;

                case 'ListRelease':
                    $this->icon = 'fas fa-search';
                    $this->bg = getBgColor('dark');
                    $this->printLable = "عرض الاصدارات";
                    break;
                case 'delete':
                    $this->icon = 'fas fa-trash';
                    $this->bg = getBgColor('d');
                    $this->printLable = __('admin/form.button_delete');
                    break;

                case 'deleteSweet':
                    $this->icon = 'fas fa-trash ';
                    $this->bg = getBgColor('d');
                    $this->printLable = __('admin/form.button_delete');
                    $this->sweetDelClass = ' sweet_daleteBtn_noForm ';
                    break;

                case 'deleteContent':
                    $this->icon = 'fas fa-trash ';
                    $this->bg = getBgColor('d');
                    $this->printLable = __('admin/form.button_delete_content');
                    $this->sweetDelClass = ' sweet_daleteBtn_noForm ';
                    $this->tip = false;
                    break;

                case 'liveDelete':
                    $this->icon = 'fas fa-trash ';
                    $this->bg = getBgColor('d');
                    $this->printLable = __('admin/form.button_delete');
                    $this->sweetDelClass = ' liveDelete_daleteBtn';
                    break;

                case 'deleteSweet_err':
                    $this->icon = 'fas fa-trash ';
                    $this->bg = getBgColor('d');
                    $this->printLable = __('admin/form.button_delete');
                    $this->sweetDelClass = ' sweet_daleteBtn__err ';
                    break;

                case 'force':
                    $this->icon = 'fas fa-trash';
                    $this->bg = getBgColor('d');
                    $this->printLable = __('admin/def.delete_force');
                    $this->sweetDelClass = ' sweet_daleteBtn_noForm ';
                    break;

                case 'restor':
                    $this->icon = 'fas fa-redo';
                    $this->bg = getBgColor('p');
                    $this->printLable = __('admin/def.delete_restor');
                    break;

                case 'sort':
                    $this->icon = 'fas fa-sort-amount-up';
                    $this->bg = getBgColor('i');
                    $this->printLable = __('admin/form.button_sort');
                    break;

                case 'back':
                    $this->icon = 'fas fa-hand-point-left';
                    $this->bg = getBgColor('dark');
                    $this->printLable = __('admin/form.button_back');
                    $this->tip = false;
                    break;

                case 'morePhoto':
                    $this->icon = 'fas fa-images';
                    if(intval($this->count) == '0') {
                        $this->bg = getBgColor('dark');
                    } else {
                        $this->bg = getBgColor('p');
                    }
                    $this->printLable = __('admin/form.button_more_photo');
                    break;

                case 'password':
                    $this->icon = 'fas fa-lock';
                    $this->bg = getBgColor('dark');
                    $this->printLable ="Password";
                    break;

                case 'units':
                    $this->icon = 'fas fa-bath';
                    $this->bg = getBgColor('p');
                    $this->printLable = __('admin/project.list_units');
                    $this->tip = false;
                    break;

                case 'webView':
                    $this->icon = 'fas fa-home';
                    $this->bg = getBgColor('p');
                    $this->printLable = "";
                    $this->tip = true;
                    $this->target = true;
                    break;


                default:
            }

        } else {
            // $this->lable = $lable;
        }
    }

    public function render(): View|Closure|string {
        return view('components.admin.form.action-button');
    }
}
