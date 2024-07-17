<?php

namespace App\AppPlugin\BlogPost;

use App\AppPlugin\BlogPost\Models\BlogTags;
use App\AppPlugin\BlogPost\Models\BlogTagsTranslation;

use App\AppPlugin\BlogPost\Traits\BlogConfigTraits;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\def\DefTagsRequest;
use App\Http\Traits\DbFunTraits;
use App\Http\Traits\TagsTraits;
use Illuminate\Support\Facades\View;


class BlogTagsController extends AdminMainController {

    use TagsTraits;
    use BlogConfigTraits;
    use DbFunTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "BlogTags";
        $this->PrefixRole = 'Blog';
        $this->selMenu = "admin.Blog.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/blogPost.app_menu_tags');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->tags = new BlogTags();
        $this->tagsTranslation = new BlogTagsTranslation();

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["filterid" => 0, "orderbyPostion" => 1],
            'yajraTable' => true,
        ];

        $Config = self::LoadConfig();
        View::share('Config',$Config);


        self::loadConstructData($sendArr);

        if(!$this->TableTags){
            abort(403);
        }

    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     TagsStoreUpdate
    public function TagsStoreUpdate(DefTagsRequest $request, $id = 0) {
        return self::TraitsTagsStoreUpdate($request, $id);
    }

}
