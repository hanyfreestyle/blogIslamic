<?php

namespace App\Http\Controllers;

use App\AppCore\Menu\AdminMenuController;
use App\AppCore\UploadFilter\Models\UploadFilter;


use App\AppPlugin\Product\Models\Brand;
use App\Helpers\AdminHelper;
use App\Helpers\photoUpload\PuzzleUploadProcess;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Spatie\Valuestore\Valuestore;
use Yajra\DataTables\Facades\DataTables;

class AdminMainController extends DefaultMainController {

    public $modelSettings;
    public $StopeCash;

    public function __construct(
        $StopeCash = 0,
    ) {

        parent::__construct();
        $this->middleware('auth');
        $this->StopeCash = $StopeCash;

        View::share('filterTypes', UploadFilter::cash_UploadFilter());

        $modelsNameArr = [
            "users" => ['name' => __('admin/config/roles.menu_roles_users')],
            "roles" => ['name' => __('admin/config/roles.menu_roles_role')],
            "config" => ['name' => __('admin.app_menu_setting')],
            "data" => ['name' => __('admin.app_menu_data')],
            "leads" => ['name' => __('admin/leadsContactUs.app_menu')],
            "app_setting" => ['name' => __('admin/configApp.app_menu')],
            "Product" => ['name' => __('admin/proProduct.app_menu')],
            "Faq" => ['name' => __('admin/faq.app_menu')],
            "Blog" => ['name' => __('admin/blogPost.app_menu')],
            "FileManager" => ['name' => __('admin/fileManager.app_menu')],
            "orders" => ['name' => __('admin/orders.app_menu')],
            "customer" => ['name' => __('admin/customer.app_menu')],
            "Pages" => ['name' => __('admin/pages.app_menu')],
            "Periodicals" => ['name' => __('admin/Periodicals.app_menu')],

            "BlogPost" => ['name' => __('admin/model/blogPost.app_menu')],
        ];


        View::share('modelsNameArr', $modelsNameArr);

        $FilterTypeArr = [
            "1" => ['id' => '1', 'name' => __('admin/config/upFilter.filter_action_1')],
            "2" => ['id' => '2', 'name' => __('admin/config/upFilter.filter_action_2')],
            "3" => ['id' => '3', 'name' => __('admin/config/upFilter.filter_action_3')],
            "4" => ['id' => '4', 'name' => __('admin/config/upFilter.filter_action_4')],
            "5" => ['id' => '5', 'name' => __('admin/config/upFilter.filter_action_5')],
        ];
        View::share('filterTypeArr', $FilterTypeArr);

        $PrintPhotoPosition = [
            "1" => ['id' => '1', 'name' => "Top"],
            "2" => ['id' => '2', 'name' => "Bottom"],
        ];
        View::share('PrintPhotoPosition', $PrintPhotoPosition);

        $BrokenUrl_Arr = [
            "1" => ['id' => 'Root', 'name' => __('admin/broken.list-Root')],
            "2" => ['id' => 'Developer', 'name' => __('admin/broken.list-Developer')],
            "3" => ['id' => 'Pages', 'name' => __('admin/broken.list-Pages')],
            "4" => ['id' => 'Blog', 'name' => __('admin/broken.list-Blog')],
            "5" => ['id' => 'Listing', 'name' => __('admin/broken.list-Listing')],
        ];
        View::share('BrokenUrl_Arr', $BrokenUrl_Arr);


        $WebSearchTypeArr = [
            "1" => ['id' => '1', 'name' => __('admin/config/webConfig.web_serach_type_1')],
            "2" => ['id' => '2', 'name' => __('admin/config/webConfig.web_serach_type_2')],
        ];
        View::share('WebSearchTypeArr', $WebSearchTypeArr);


        $modelSettings = Valuestore::make(config_path(config('app.model_settings_name')));
        $modelSettings = $modelSettings->all();
        $this->modelSettings = $modelSettings;
        View::share('modelSettings', $modelSettings);

        $adminMenu = AdminMenuController::CashAdminMenu();
        View::share('adminMenu', $adminMenu);
    }



#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   ForgetSession
    public function ForgetSession(Request $request) {
        Session::forget($request->input('formName'));
        return redirect()->back();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   getSessionData
    public function getSessionData($request) {

        if (isset($request->formName)) {

            $request->validate([
                'from_date' => 'nullable|date|date_format:Y-m-d',
                'to_date' => 'nullable|date|after_or_equal:from_date',
            ]);

            $session = Session::get($this->formName);
            if($session){
                if($request->input('country_id')){
                    if(issetArr($session,'country_id',null) != $request->input('country_id')){
                        $request['city_id'] = null;
                        $request['area_id'] = null;
                    }
                }
                if($request->input('city_id')){
                    if(issetArr($session,'city_id',null) != $request->input('city_id')){
                        $request['area_id'] = null;
                    }
                }
            }


//            if($request->input('country_id')){
//                $session = Session::get($this->formName);
//                if($session){
//                    if($session['country_id'] != $request->input('country_id')){
//                        $request['city_id'] = null;
//                        $request['area_id'] = null;
//                    }
//                }
//            }
//
//            if($request->input('city_id')){
//                $session = Session::get($this->formName);
//                if($session){
//                    if($session['city_id'] != $request->input('city_id')){
//                        $request['area_id'] = null;
//                    }
//                }
//            }

            Session::put($this->formName, $request->all());
            Session::save();

        }

        $session = Session::get($this->formName);
        return $session;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function FilterQ($query, $session, $order = null) {
        $query->where('id', '!=', 0);

        if (isset($session['from_date']) and $session['from_date'] != null) {
            $query->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $session['from_date']));
        }

        if (isset($session['to_date']) and $session['to_date'] != null) {
            $query->whereDate('created_at', '<=', Carbon::createFromFormat('Y-m-d', $session['to_date']));
        }

        if (isset($session['country']) and $session['country'] != null) {
            $query->where('country', $session['country']);
        }

        if (isset($session['project_id']) and $session['project_id'] != null) {
            $query->where('project_id', $session['project_id']);
        }

        if (isset($session['is_active']) and $session['is_active'] != null) {
            $query->where('is_active', $session['is_active']);
        }

        if (isset($session['country_id']) and $session['country_id'] != null) {
            $query->where('country_id', $session['country_id']);
        }

        if ($order != null) {
            $orderBy = explode("|", $order);
            $query->orderBy($orderBy[0], $orderBy[1]);
        }

        return $query;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getDefSetting
    public function getDefSetting($controllerName, $key, $def) {
        if (isset($this->modelSettings[$controllerName . $key])) {
            return $this->modelSettings[$controllerName . $key];
        } else {
            return $def;
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     getSelect
    public function getSelectQuery($query) {
        $controllerName = $this->controllerName;

        $perPage = self::getDefSetting($controllerName, '_perpage', '5');
        $dataTable = self::getDefSetting($controllerName, '_datatable', '0');
        $orderBy = self::getDefSetting($controllerName, '_orderby', '1');

        switch ($orderBy) {
            case 1:
                $query->orderBy('id', 'DESC');
                break;
            case 2:
                $query->orderBy('id', 'ASC');
                break;
            case 3:
                $query->orderByTranslation('name', 'DESC');
                break;
            case 4:
                $query->orderByTranslation('name', 'ASC');
                break;
            case 5:
                $query->orderBy('postion', 'ASC');
                break;
            case 6:
                $query->orderBy('created_at', 'DESC');
                break;
            case 7:
                $query->orderBy('created_at', 'ASC');
                break;

//                published_at
            default:
        }

        if ($dataTable == '1') {
            return $query->get();
        } else {
            return $query->paginate($perPage);
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # GetAddLangForAdd
    public function getAddLangForAdd() {
        if (Route::currentRouteName() == $this->PrefixRoute . '.create_ar') {
            $LangAdd = ['ar' => 'Arabic'];
        } elseif (Route::currentRouteName() == $this->PrefixRoute . '.create_en') {
            $LangAdd = ['en' => 'English'];
        } else {
            $LangAdd = config('app.web_lang');
        }
        return $LangAdd;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # getAddLangForEdit
    public function getAddLangForEdit($row) {
        $LangAdd = [];
        if (Route::currentRouteName() == $this->PrefixRoute . '.editAr') {
            $LangAdd = ['ar' => 'Arabic'];
        } elseif (Route::currentRouteName() == $this->PrefixRoute . '.editEn') {
            $LangAdd = ['en' => 'English'];
        } else {
            if (count(config('app.web_lang')) > 1) {
                foreach ($row->translations as $Lang) {
                    if ($Lang->locale == 'ar') {
                        $LangAdd += ['ar' => 'Arabic'];
                    }
                    if ($Lang->locale == 'en') {
                        $LangAdd += ['en' => 'English'];
                    }
                }
            } else {
                foreach (config('app.web_lang') as $key => $value) {
                    if ($key == 'ar') {
                        $LangAdd += ['ar' => 'Arabic'];
                    }
                    if ($key == 'en') {
                        $LangAdd += ['en' => 'English'];
                    }
                }
            }

        }
        return $LangAdd;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # saveTranslation
    public function saveTranslationMain($saveTranslation, $key, $request) {
        $saveTranslation->locale = $key;
        $saveTranslation->name = $request->input($key . '.name');
        $saveTranslation->des = $request->input($key . '.des');

        if (isset($request[$key]['g_title']) and $request->input($key . '.g_title') == null) {
            $saveTranslation->g_title = $request->input($key . '.name');
        } else {
            $saveTranslation->g_title = $request->input($key . '.g_title');
        }
        if (isset($request[$key]['g_des']) and $request->input($key . '.g_des') == null) {
            $saveTranslation->g_des = AdminHelper::seoDesClean($request->input($key . '.des'));
        } else {
            $saveTranslation->g_des = $request->input($key . '.g_des');
        }
        return $saveTranslation;
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # loadConstructData
    public function loadConstructData($sendArr) {
        $this->configView = AdminHelper::arrIsset($sendArr, 'configView', null);
//        'configArr'=> ["datatable"=>1,"orderby"=>1,"orderbyPostion"=>1,"filterid"=>1,"morePhotoFilterid"=>1,"orderbyDate"=>1,"editor"=>1,"icon"=>1,]
//       'configArr'=> [ "filterid"=>1,"morePhotoFilterid"=>1 ,selectfilterid ]
        $this->configArr = AdminHelper::arrIsset($sendArr, 'configArr', array());

        $this->middleware('permission:' . $this->PrefixRole . '_view', ['only' => ['index', 'CategoryIndex']]);
        $this->middleware('permission:' . $this->PrefixRole . '_add', ['only' => ['create', 'CategoryCreate']]);

        $this->middleware('permission:' . $this->PrefixRole . '_edit', ['only' => [
            'edit', 'updateStatus', 'emptyPhoto', 'editRoleToPermission',
            'CategoryEdit', 'CategoryStoreUpdate', 'CategorySort', 'CategorySaveSort',
            'TagsEdit', 'TagsConfig', 'TagsOnFly',
        ]]);

        $this->middleware('permission:' . $this->PrefixRole . '_delete', ['only' => ['destroy', 'destroyException']]);
        $this->middleware('permission:' . $this->PrefixRole . '_restore', ['only' => ['SoftDeletes', 'Restore', 'ForceDelete']]);

        $this->viewDataTable = AdminHelper::arrIsset($this->modelSettings, $this->controllerName . '_datatable', 0);
        View::share('viewDataTable', $this->viewDataTable);

        $this->viewEditor = AdminHelper::arrIsset($this->modelSettings, $this->controllerName . '_editor', 0);
        View::share('viewEditor', $this->viewEditor);

        $this->viewLabel = AdminHelper::arrIsset($this->modelSettings, $this->controllerName . '_label_view', 1);
        View::share('viewLabel', $this->viewLabel);


        $yajraTable = AdminHelper::arrIsset($sendArr, 'yajraTable', false);
        View::share('yajraTable', $yajraTable);


        View::share('PrefixRoute', $this->PrefixRoute);
        View::share('PrefixRole', $this->PrefixRole);
        View::share('controllerName', $this->controllerName);
        View::share('PrefixCatRoute', $this->PrefixCatRoute);
        View::share('configArr', $this->configArr);
        View::share('PrintLocaleName', 'name_' . thisCurrentLocale());
        View::share('DefCategoryTextName', null);

        $this->formName = AdminHelper::arrIsset($sendArr, 'formName', null);
        View::share('formName', $this->formName);

        $pageData = AdminHelper::returnPageDate($sendArr);
        $this->pageData = $pageData;
        $this->yajraTable = $yajraTable;
    }


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  redirectWhere
    public function redirectWhere($request, $id, $route) {
        if ($id == '0') {
            if ($request->input('AddNewSet') !== null) {
                return redirect()->back();
            } else {
                return redirect(route($route))->with('Add.Done', "");
            }
        } else {
            if ($request->input('GoBack') !== null) {
                return redirect()->back()->with('Edit.Done', "");
            } else {
                return redirect(route($route))->with('Edit.Done', "");
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    public function SaveAndUpdateDefPhoto($saveData, $request, $dir, $slug = "slug", $sendArr = array()) {

        $filterInputName = AdminHelper::arrIsset($sendArr, 'filter', 'filter_id');
        $setCountOfUpload = AdminHelper::arrIsset($sendArr, 'count', 2);
        $setfileUploadName = AdminHelper::arrIsset($sendArr, 'file', 'image');

        $saveImgData = new PuzzleUploadProcess();
        $saveImgData->setCountOfUpload($setCountOfUpload);
        $saveImgData->setUploadDirIs($dir . '/' . $saveData->id);
        $saveImgData->setnewFileName($request->input($slug));
        $saveImgData->setfileUploadName($setfileUploadName);
        $saveImgData->UploadOne($request, $filterInputName);
        $saveData = AdminHelper::saveAndDeletePhoto($saveData, $saveImgData);
        $saveData->save();
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  redirectWhere
    public function redirectWhereNew($request, $id, $route) {
        if ($id == '0') {
            if ($request->input('AddNewSet') !== null) {
                return redirect()->back();
            } else {
                return redirect($route)->with('Add.Done', "");
            }
        } else {
            if ($request->input('GoBack') !== null) {
                return redirect()->back()->with('Edit.Done', "");
            } else {
                return redirect($route)->with('Edit.Done', "");
            }
        }
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   ConfigModelUpdate
    public function ConfigModelUpdate(Request $request) {

        $model_id = $request->input('model_id') . "_";
        $PrefixRoute = $request->input('PrefixRoute') . ".index";

        $this->validate($request, [
            $model_id . 'perpage' => 'sometimes|required|integer|between:1,100',
            $model_id . 'datatable' => 'sometimes|required',
            $model_id . 'filterid' => 'sometimes|required',
            $model_id . 'orderby' => 'sometimes|required',
        ]);

        $valuestore = Valuestore::make(config_path(config('app.model_settings_name')));
        foreach ($request->all() as $key => $value) {
            $valuestore->put($key, $value);
        }
        $valuestore->forget('_token');
        $valuestore->forget('B1');
        $valuestore->forget('model_id');

        if ($request->input('GoBack') !== null) {
            return redirect()->back()->with('Edit.Done', "");
        } else {
            if (Route::has($PrefixRoute)) {
                if ($request->input('ModelId') != null) {
                    return redirect(route($PrefixRoute, $request->input('ModelId')))->with('Edit.Done', "");
                } else {
                    return redirect(route($PrefixRoute))->with('Edit.Done', "");
                }
            } else {
                return redirect()->back()->with('Edit.Done', "");
            }
        }
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  DataTableAddColumns
    public function DataTableAddColumns($data, $arr = array()) {

        $viewPhoto = AdminHelper::arrIsset($arr, 'Photo', true);

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('tablename.0.name', function ($row) {
                return $row->tablename[0]->name ?? '';
            })
            ->editColumn('tablename.1.name', function ($row) {
                return $row->tablename[1]->name ?? '';
            })
            ->editColumn('arName', function ($row) {
                return $row->arName->name ?? '';
            })
            ->editColumn('enName', function ($row) {
                return $row->enName->name ?? '';
            })
            ->addColumn('photo', function ($row) use ($viewPhoto) {
                if ($viewPhoto) {
                    return TablePhoto($row);
                }
            })
            ->addColumn('is_active', function ($row) {
                return is_active($row->is_active);
            })
            ->addColumn('is_published', function ($row) {
                return is_active($row->is_published);
            })
            ->editColumn('regular_price', function ($row) {
                return number_format($row->regular_price);
            })
            ->editColumn('price', function ($row) {
                return number_format($row->price);
            })
            ->editColumn('published_at', function ($row) {
                return [
                    'display' => date("Y-m-d", strtotime($row->published_at)),
                    'timestamp' => strtotime($row->published_at)
                ];
            })
            ->addColumn('Brand', function ($row) {
                return $row->brand->name ?? '';
            })
            ->addColumn('CatName', function ($row) {
                return view('datatable.but')->with(['btype' => 'CatName', 'row' => $row])->render();
            })
            ->addColumn('AddLang', function ($row) {
                return view('datatable.but')->with(['btype' => 'addLang', 'row' => $row])->render();
            })
            ->addColumn('MorePhoto', function ($row) {
                return view('datatable.but')->with(['btype' => 'MorePhoto', 'row' => $row])->render();
            })
            ->addColumn('Edit', function ($row) {
                return view('datatable.but')->with(['btype' => 'Edit', 'row' => $row])->render();
            })
            ->addColumn('Delete', function ($row) {
                return view('datatable.but')->with(['btype' => 'Delete', 'row' => $row])->render();
            })
            ->rawColumns(["photo", "is_active", "is_published", 'Edit', "Delete", 'MorePhoto', 'AddLang', 'OldPhotos', 'ViewListing', 'CatName']);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   FormRequestSeo
    static function FormRequestSeo($id, $addLang, $table, $filedName, $rulesConfig) {

        foreach ($addLang as $key => $lang) {
            $rules[$key . ".name"] = 'required';

            if($rulesConfig['des']){
                $rules[$key . ".des"] = 'required';
            }
            if ($id == '0') {
                if($rulesConfig['slug']){
                    $rules[$key . ".slug"] = "required|unique:$table,slug";
                }
            } else {
                if($rulesConfig['slug']){
                    $rules[$key . ".slug"] = "required|unique:$table,slug,$id,$filedName,locale,$key";
                }
                if($rulesConfig['seo']){
                    $rules[$key . ".g_des"] = 'required';
                    $rules[$key . ".g_title"] = 'required';
                }
            }
        }
        return $rules;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   FormRequestDataSeo
    static function FormRequestDataSeo($id, $addLang, $seo, $table, $filedName) {
        foreach ($addLang as $key => $lang) {
            if ($id == '0') {
                $rules[$key . ".name"] = "required|unique:$table,name";
            } else {
                $rules[$key . ".name"] = "required|unique:$table,name,$id,$filedName,locale,$key";
            }

            if ($seo) {
                if ($id == '0') {
                    $rules[$key . ".slug"] = "required|unique:$table,slug";
                } else {
                    $rules[$key . ".slug"] = "required|unique:$table,slug,$id,$filedName,locale,$key";
                    $rules[$key . ".g_des"] = 'required';
                    $rules[$key . ".g_title"] = 'required';
                }
            }
        }
        return $rules;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function prepareSlug($data) {
        $addLang = json_decode($data['add_lang']);
        foreach ($addLang as $key => $lang) {
            if (isset($data[$key . '.slug'])) {
                data_set($data, $key . '.slug', AdminHelper::Url_Slug($data[$key]['slug']));
            }
        }
        return $data;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     CashCountryList
    static function CashBrandList($stopCash = 0) {
        if ($stopCash) {
            $CashBrandList = Brand::CashBrandList();
        } else {
            $CashBrandList = Cache::remember('CashBrandList', cashDay(7), function () {
                return Brand::CashBrandList();
            });
        }
        return $CashBrandList;
    }

}
