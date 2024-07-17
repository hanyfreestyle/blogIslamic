<?php

namespace App\AppPlugin\Config\Meta;

use App\Helpers\AdminHelper;
use App\Http\Controllers\AdminMainController;
use App\Http\Traits\CrudTraits;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class MetaTagController extends AdminMainController {

    use CrudTraits;

    function __construct(MetaTag $model) {

        parent::__construct();
        $this->controllerName = "Meta";
        $this->PrefixRole = 'config';
        $this->selMenu = "admin.config.";
        $this->PrefixCatRoute = "";
        $this->PageTitle = __('admin/configMeta.app_menu');
        $this->PrefixRoute = $this->selMenu . $this->controllerName;
        $this->model = $model;

        $sendArr = [
            'TitlePage' => $this->PageTitle,
            'PrefixRoute' => $this->PrefixRoute,
            'PrefixRole' => $this->PrefixRole,
            'AddConfig' => true,
            'restore' => 1,
        ];
        self::loadConstructData($sendArr);
        $this->middleware('permission:' . $this->PrefixRole . '_meta_view', ['only' => ['index']]);
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # ClearCash
    public function ClearCash() {
        Cache::forget('WebMeta_Cash');
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     index
    public function index() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "List";
        $pageData['Trashed'] = MetaTag::onlyTrashed()->count();

        $rowData = self::getSelectQuery(MetaTag::where('id', '!=', 0));
        return view('AppPlugin.ConfigMeta.index', compact('pageData', 'rowData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     SoftDeletes
    public function SoftDeletes() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "deleteList";
        $rowData = self::getSelectQuery(MetaTag::onlyTrashed());
        return view('AppPlugin.ConfigMeta.index', compact('pageData', 'rowData'));
    }
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     create
    public function create() {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Add";
        $oldData = new MetaTag();
        return view('AppPlugin.ConfigMeta.form', compact('oldData', 'pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     edit
    public function edit($id) {
        $pageData = $this->pageData;
        $pageData['ViewType'] = "Edit";
        $oldData = MetaTag::findOrFail($id);
        return view('AppPlugin.ConfigMeta.form', compact('oldData', 'pageData'));
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     storeUpdate
    public function storeUpdate(MetaTagRequest $request, $id = '0') {
        try {
            DB::transaction(function () use ($request, $id) {

                $saveData = MetaTag::findOrNew($id);
                $saveData->cat_id = AdminHelper::Url_Slug($request->input('cat_id'),['delimiter'=>'_']);
                $saveData->save();
                self::SaveAndUpdateDefPhoto($saveData, $request, 'meta', 'cat_id');

                foreach (config('app.web_lang') as $key => $lang) {
                    $saveTranslation = MetaTagTranslation::where('meta_tag_id', $saveData->id)->where('locale', $key)->firstOrNew();
                    $saveTranslation->meta_tag_id = $saveData->id;
                    $saveTranslation->locale = $key;
                    $saveTranslation->g_title = $request->input($key . '.g_title');
                    $saveTranslation->g_des = $request->input($key . '.g_des');
                    if(config('AppPlugin.Meta.name')){
                        $saveTranslation->name = $request->input($key . '.name');
                        $saveTranslation->des = $request->input($key . '.des');
                    }
                    $saveTranslation->save();
                }
            });
        } catch (\Exception $exception) {
            return back()->with('data_not_save', "");
        }

        self::ClearCash();
        return self::redirectWhere($request, $id, $this->PrefixRoute . '.index');
    }

}
