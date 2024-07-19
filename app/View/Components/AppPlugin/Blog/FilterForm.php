<?php

namespace App\View\Components\AppPlugin\Blog;

use App\AppPlugin\BlogPost\Models\BlogCategory;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class FilterForm extends Component {

    public $getSessionData;
    public $row;
    public $formName;
    public $defRoute;


    public function __construct(
        $row = array(),
        $formName = 'ProductFilters',
        $isActive = true,
        $defRoute = ".filter",

    ) {
        $this->row = $row;
        $this->formName = $formName;
        $this->isActive = $isActive;
        $this->defRoute = $defRoute;
        $this->getSessionData = Session::get($this->formName);
    }

    public function render(): View|Closure|string {
        $CategoriesList = BlogCategory::all();
        $UserList = User::all();

        return view('components.app-plugin.blog.filter-form')->with([
            'CategoriesList' => $CategoriesList,
            'UserList' => $UserList,
        ]);
    }
}
