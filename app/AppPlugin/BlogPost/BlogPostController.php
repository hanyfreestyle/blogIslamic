<?php

namespace App\AppPlugin\BlogPost;

use App\AppPlugin\BlogPost\Models\Blog;
use App\AppPlugin\BlogPost\Models\BlogCategory;
use App\AppPlugin\BlogPost\Models\BlogPhoto;
use App\AppPlugin\BlogPost\Models\BlogPhotoTranslation;
use App\AppPlugin\BlogPost\Models\BlogReview;
use App\AppPlugin\BlogPost\Models\BlogTags;
use App\AppPlugin\BlogPost\Models\BlogTranslation;
use App\AppPlugin\BlogPost\Traits\BlogConfigTraits;
use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Requests\def\DefPostRequest;
use App\Http\Traits\CrudPostTraits;
use App\Http\Traits\CrudTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;


class BlogPostController extends AdminMainController {

    use CrudTraits;
    use CrudPostTraits;
    use BlogConfigTraits;

    function __construct() {
        parent::__construct();
        $this->controllerName = "BlogPost";
        $this->PrefixRole = 'Blog';
        $this->selMenu = "admin.Blog.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/blogPost.app_menu_blog');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;

        $this->model = new Blog();
        $this->translation = new BlogTranslation();
        $this->modelCategory = new BlogCategory();
        $this->modelPhoto = new BlogPhoto();
        $this->photoTranslation = new BlogPhotoTranslation();
        $this->modelTags = new BlogTags();
        $this->modelReview = new BlogReview();

        $this->modelPhotoColumn = 'blog_id';
        $this->UploadDirIs = 'blog';
        $this->translationdb = 'blog_id';

        $this->PrefixTags = "admin.BlogPost";
        View::share('PrefixTags', $this->PrefixTags);

        $Config = self::LoadConfig();
        View::share('Config', $Config);

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'configArr' => ["editor" => $Config['postEditor'], 'morePhotoFilterid' => $Config['TableMorePhotos']],
            'yajraTable' => true,
            'AddLang' => true,
            'AddMorePhoto' => true,
            'restore' => 1,
        ];

        self::loadConstructData($sendArr);

        if (File::isFile(base_path('routes/AppPlugin/proProduct.php'))) {
            $this->CashBrandList = self::CashBrandList($this->StopeCash);
            View::share('CashBrandList', $this->CashBrandList);
        }

    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('CashSidePopularTags');
        Cache::forget('CashSideBlogCategories');
        Cache::forget('CashBrandMenuList');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function UpdateReview() {
        $allBlog = Blog::all();
        foreach ($allBlog as $blog) {
            $blogReview = new BlogReview();
            $blogReview->user_id = $blog->user_id;
            $blogReview->blog_id = $blog->id;
            $blogReview->name = null;
            $blogReview->des = null;
            $blogReview->loop_index = 1;
            $blogReview->updated_at = $blog->created_at;
            $blogReview->save();
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostIndex(Request $request) {

        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['SubView'] = false;
        $pageData['Trashed'] = $this->model::onlyTrashed()->count();

        if (Route::currentRouteName() == 'admin.Shop.Product.SoftDelete') {
            $is_archived = 0;
            $routeName = '.DataTableSoftDelete';
            $filterRoute = ".filter";
            $pageData['ViewType'] = "deleteList";
        } else {
            if (Route::currentRouteName() == "admin.Blog.BlogPost.index_draft" or Route::currentRouteName() == "admin.Blog.BlogPost.filter_draft") {
                $is_active = 0;
                $routeName = '.DataTableDraft';
                $filterRoute = ".filter_draft";
                $this->formName = 'BlogIndexDraft';
            } else {
                $is_active = 1;
                $routeName = '.DataTable';
                $filterRoute = ".filter";
                $this->formName = 'BlogIndex';
            }
        }

        $session = self::getSessionData($request);

        if ($session == null) {
            $rowData = self::indexQuery($is_active);
        } else {
            $rowData = self::BlogFilterQ(self::indexQuery($is_active), $session);
        }

        return view('AppPlugin.BlogPost.index')->with([
            'pageData' => $pageData,
            'routeName' => $routeName,
            'rowData' => $rowData,
            'filterRoute' => $filterRoute,
            'formName' => $this->formName,
        ]);

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function indexQuery($isActive) {
        $data = Blog::query()->select(['blog_post.id', 'user_id', 'photo_thum_1', 'is_active', 'published_at'])
            ->where('is_active', $isActive)
            ->with('tablename')
            ->with('userName');

        $teamleader = Auth::user()->can('Blog_teamleader');
        if (!$teamleader) {
            $data->where('user_id', Auth::user()->id);
        }
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function BlogDataTable(Request $request) {
        $this->formName = 'BlogIndex';
        if ($request->ajax()) {
            $session = self::getSessionData($request);
            $data = self::BlogFilterQ(self::indexQuery(1), $session);
            return self::BlogColumn($data)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function BlogDataTableDraft(Request $request) {
        $this->formName = 'BlogIndexDraft';
        if ($request->ajax()) {
            $session = self::getSessionData($request);
            $data = self::BlogFilterQ(self::indexQuery(0), $session);
            return self::BlogColumn($data)->make(true);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    static function BlogFilterQ($query, $session, $order = null) {
        $query->where('id', '!=', 0);
        if (isset($session['name']) and $session['name'] != null) {
            $query->whereTranslationLike('name', '%' . $session['name'] . '%');
        }

        if (isset($session['des_text']) and $session['des_text'] != null) {
            $query->whereTranslationLike('des_text', '%' . $session['des_text'] . '%');
        }


        if (isset($session['cat_id']) and $session['cat_id'] != null) {
            $id = $session['cat_id'];
            $query->whereHas('categories', function ($query) use ($id) {
                $query->where('category_id', $id);
            });
        }

        if (isset($session['user_id']) and $session['user_id'] != null) {
            $users_id = $session['user_id'];
            $query->wherein('user_id', $users_id);
        }

        if (isset($session['from_date']) and $session['from_date'] != null) {
            $query->whereDate('published_at', '>=', Carbon::createFromFormat('Y-m-d', $session['from_date']));
        }

        if (isset($session['to_date']) and $session['to_date'] != null) {
            $query->whereDate('published_at', '<=', Carbon::createFromFormat('Y-m-d', $session['to_date']));
        }

        return $query;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function BlogColumn($data, $arr = array()) {

        $viewPhoto = AdminHelper::arrIsset($arr, 'Photo', true);

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('tablename.0.name', function ($row) {
                return $row->tablename[0]->name ?? '';
            })
            ->editColumn('tablename.1.name', function ($row) {
                return $row->tablename[1]->name ?? '';
            })
            ->editColumn('userName', function ($row) {
                return $row->userName->name ?? '';
            })
            ->addColumn('photo', function ($row) use ($viewPhoto) {
                if ($viewPhoto) {
                    return TablePhoto($row);
                }
            })
            ->editColumn('published_at', function ($row) {
                return [
                    'display' => date("Y-m-d", strtotime($row->published_at)),
                    'timestamp' => strtotime($row->published_at)
                ];
            })
            ->addColumn('CatName', function ($row) {
                return view('datatable.but')->with(['btype' => 'CatName', 'row' => $row])->render();
            })
            ->addColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })
            ->addColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(["photo", 'Edit', "Delete", 'CatName']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostCreate() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $oldData = null;

        $Categories = $this->modelCategory::all();
        $tags = $this->modelTags::where('id', '!=', 0)->take(100)->get();
        $selTags = [];
        $rowData = $this->model::findOrNew(0);
        $LangAdd = self::getAddLangForAdd();
        $selCat = [];
        $wordCount = null;
        return view('AppPlugin.BlogPost.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'Categories' => $Categories,
            'LangAdd' => $LangAdd,
            'selCat' => $selCat,
            'tags' => $tags,
            'selTags' => $selTags,
            'selActive' => 0,
            'wordCount' => $wordCount,
            'oldData' => $oldData,
        ]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostEdit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $oldData = null;


        $teamleader = Auth::user()->can('Blog_teamleader');
        if (!$teamleader) {
            $rowData = $this->model::where('id', $id)->where('user_id', Auth::user()->id)->with('categories')->firstOrFail();
        } else {
            $rowData = $this->model::where('id', $id)->with('categories')->firstOrFail();
        }

        if (isset($_GET['revision'])) {
            $revisionId = intval($_GET['revision']);
            $oldData = BlogReview::where('id', $revisionId)->firstOrFail();
        }

        $wordCount = AdminHelper::str_word_count_ar($rowData->des_text);
        $Categories = $this->modelCategory::all();
        $selCat = $rowData->categories()->pluck('category_id')->toArray();
        $LangAdd = self::getAddLangForEdit($rowData);
        $selTags = $rowData->tags()->pluck('tag_id')->toArray();
        $tags = $this->modelTags::whereIn('id', $selTags)->take(50)->get();

        return view('AppPlugin.BlogPost.form')->with([
            'pageData' => $pageData,
            'rowData' => $rowData,
            'Categories' => $Categories,
            'LangAdd' => $LangAdd,
            'selCat' => $selCat,
            'tags' => $tags,
            'selTags' => $selTags,
            'selActive' => $rowData->is_active,
            'wordCount' => $wordCount,
            'oldData' => $oldData,
        ]);
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function publishNow($id) {

        $teamleader = Auth::user()->can('Blog_teamleader');
        if (!$teamleader) {
            $rowData = $this->model::where('id', $id)->where('is_active', 0)->where('user_id', Auth::user()->id)->firstOrFail();
        } else {
            $rowData = $this->model::where('id', $id)->where('is_active', 0)->with('categories')->firstOrFail();
        }
        $dateValue = Carbon::parse(now())->format("Y-m-d");
        $rowData->published_at = $dateValue;
        $rowData->is_active = 1;
        $rowData->save();
        return redirect()->route($this->PrefixRoute . ".index");
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostStoreUpdate(DefPostRequest $request, $id = 0) {

        $saveData = $this->model::findOrNew($id);
        try {
            DB::transaction(function () use ($request, $saveData) {
                $categories = $request->input('categories');
                $tags = $request->input('tag_id');
                $user_id = Auth::user()->id;

                $saveData->is_active = $request->input('is_active');
                $saveData->published_at = SaveDateFormat($request, 'published_at');
                if ($request->input('form_type') == 'Add' and $this->TableReview) {
                    $saveData->user_id = $user_id;
                }
                $saveData->updated_at = now();
                $saveData->save();

                self::SaveAndUpdateDefPhoto($saveData, $request, $this->UploadDirIs, 'ar.name');

                if ($request->input('form_type') == 'Add' and $this->TableReview) {
                    $blogReview = $this->modelReview;
                    $blogReview->user_id = $user_id;
                    $blogReview->blog_id = $saveData->id;
                    $blogReview->name = null;
                    $blogReview->des = null;
                    $blogReview->loop_index = 1;
                    $blogReview->updated_at = now();
                    $blogReview->save();
                } elseif ($request->input('form_type') == 'Edit' and $this->TableReview) {
                    if ($saveData->des != $request->input('ar.des')) {
                        $blogReview = $this->modelReview;
                        $blogReview->user_id = $user_id;
                        $blogReview->blog_id = $saveData->id;
                        $blogReview->name = $saveData->name;
                        $blogReview->des = $saveData->des;
                        $blogReview->loop_index = $this->modelReview::where('blog_id', $saveData->id)->count() + 1;
                        $blogReview->updated_at = now();
                        $blogReview->save();
                    }
                }

                $countReview = $this->modelReview::where('blog_id', $saveData->id)->count();
                $limitSave = 10;
                if ($countReview > $limitSave) {
                    $oldDataReview = $this->modelReview::where('blog_id', $saveData->id)->orderby('id', 'desc')->get();
                    $x = $limitSave;
                    foreach ($oldDataReview as $review) {
                        $review->loop_index = $x;
                        $x = $x - 1;
                        $review->save();
                    }
                    $this->modelReview::where('blog_id', $saveData->id)->where('loop_index', '<=', 0)->delete();
                }


                $saveData->categories()->sync($categories);
                $saveData->tags()->sync($tags);



                $addLang = json_decode($request->add_lang);
                foreach ($addLang as $key => $lang) {
                    $CatId = $this->DbPostCatId;
                    $saveTranslation = $this->translation->where($CatId, $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->$CatId = $saveData->id;
                    $saveTranslation->des_text = AdminHelper::textClean($request->input($key . '.des'));
                    $saveTranslation->slug = AdminHelper::Url_Slug($request->input($key . '.slug'));
                    $saveTranslation = self::saveTranslationMain($saveTranslation, $key, $request);
                    $saveTranslation->save();
                }
            });

        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }
        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');

    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     destroy
    public function destroyEdit($id) {
        $deleteRow = $this->model->where('id', $id)->firstOrFail();
        $deleteRow->delete();
        self::ClearCash();
        return redirect()->route($this->PrefixRoute . '.index')->with('confirmDelete', "");
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function PostForceDeleteException($id) {

        $deleteRow = $this->model::onlyTrashed()->where('id', $id)->firstOrFail();
//        $deleteRow = $this->model::onlyTrashed()->where('id', $id)->with('more_photos')->firstOrFail();
//        if (count($deleteRow->more_photos) > 0) {
//            foreach ($deleteRow->more_photos as $del_photo) {
//                AdminHelper::DeleteAllPhotos($del_photo);
//            }
//        }
//        $deleteRow = AdminHelper::DeleteAllPhotos($deleteRow);
//        AdminHelper::DeleteDir($this->UploadDirIs, $id);
        $deleteRow->forceDelete();
        self::ClearCash();
        return back()->with('confirmDelete', "");
    }


}
